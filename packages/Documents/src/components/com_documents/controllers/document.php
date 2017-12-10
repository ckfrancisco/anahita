<?php

/**
 * Document Controller.
 *
 * @category   Sparq
 *
 * @author     Peter Qafoku
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComDocumentsControllerDocument extends ComMediumControllerDefault
{
  /**
   * The max upload limit.
   *
   * @var int
   */
  protected $_max_upload_limit;

  /**
   * Constructor.
   *
   * @param KConfig $config An optional KConfig object with configuration options.
   */
  public function __construct(KConfig $config)
  {
      parent::__construct($config);
      $this->_max_upload_limit = $config->max_upload_limit;
  }

  /**
   * Initializes the default configuration for the object.
   *
   * Called from {@link __construct()} as a first step of object instantiation.
   *
   * @param KConfig $config An optional KConfig object with configuration options.
   */
  protected function _initialize(KConfig $config)
  {
    //todo set a max document uploadlimit, i think photos.uploadlimit is in the database
    //has to do with repos
    //this is set in Photos/src/templates/helpers/ui.php
      $config->append(array(
          'max_upload_limit' => get_config_value('photos.uploadlimit', 2),
      ));

      parent::_initialize($config);
  }

  /**
   * Browse Photos.
   *
   * @param KCommandContext $context
   */
   //pretty much renamed things from photo to documents, need to see where these changes take place
  protected function _actionBrowse($context)
  {
      $this->getService('repos:documents.set'); //todo this was repos:photos.set, what does this reference?
      $documents = parent::_actionBrowse($context);
      $documents->order('creationTime', 'DESC');

      if ($this->exclude_set != '') {
          $set = $this->actor->sets->fetch(array('id' => $this->exclude_set));

          if (!empty($set)) {
              $document_ids = array();

              foreach ($set->documents as $document) {
                  $document_ids[] = $document->id;
              }

              if (count($document_ids)) {
                  $documents->where('document.id', '<>', $document_ids);
              }
          }
      }
      return $documents;
  }
  /**
   * Method to upload and Add a photo.
   *
   * @param KCommandContext $context
   */
  protected function _actionAdd($context)
  {
      $data = $context->data;
      $file = KRequest::get('files.file', 'raw');
      $content = @file_get_contents($file['tmp_name']);
      $filesize = strlen($content);
      $uploadlimit = $this->_max_upload_limit * 1024 * 1024; //might need to up this to upload large pdfs

      $exif = (function_exists('exif_read_data')) ? @exif_read_data($file['tmp_name']) : array();

      if ($filesize == 0) {
          throw new LibBaseControllerExceptionBadRequest('File is missing');

          return;
      }

      if ($filesize > $uploadlimit) {
          throw new LibBaseControllerExceptionBadRequest('Exceed maximum size');

          return;
      }

      //todo figure out what needs to change here and below

      $orientation = 0;

      if (!empty($exif) && isset($exif['Orientation'])) {
          $orientation = $exif['Orientation'];
      }

      $data['portrait'] = array(
          'data' => $content,
          'rotation' => $orientation,
          'mimetype' => isset($file['type']) ? $file['type'] : null,
      );

      $photo = $this->actor->photos->addNew($data);
      $photo->setExifData($exif);
      $photo->save();
      $this->setItem($photo);
      $this->getResponse()->status = KHttpResponse::CREATED;

      if ($photo->body && preg_match('/\S/', $photo->body)) {
          $context->append(array(
              'story' => array('body' => $photo->body),
          ));
      }

      return $photo;
  }
}
