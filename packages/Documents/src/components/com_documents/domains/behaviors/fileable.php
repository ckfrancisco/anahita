<?php

//class ComDocumentsDomainBehaviorFileable extends LibBaseDomainBehaviorFileable {
//class ComDocumentsDomainBehaviorFileable extends LibBaseDomainBehaviorStorable {
class ComDocumentsDomainBehaviorFileable extends AnDomainBehaviorAbstract {

  protected function _initialize(KConfig $config) {

    //remove this if we end up going back to LibBaseDomainBehaviorStorable
    $config->append(array(
         'storage' => $this->getService('plg:storage.default'),
    ));

    parent::initialize($config);
    //syslog(1,"init complete");

     unset($config['attributes']);
    $config->append(array (
      'attributes' => array (
          'filename',
          'filesize' => array(
              'column' => 'filesize',
              'type' => 'integer',
              'write' => 'private'
          ),
         'mimeType' => array(
               'column' => 'medium_mime_type',
               'match' => '/\w+\/\w+/',
               'write' => 'private'
           ),        )
       ));
  }

  public function getStoragePath($path = '') {
    return 'n'.$this->parent->id.'/'.$path;
  }

  public function setFileData($data, $mimetype) {
    if(!$this->validate()) {
      throw new KException('Something bad happened');
    }

    if(!$this->presisted() ) {
      $settings = KService::get('com:settings.setting');
      $this->filename = hash('sha256',str_shuffle($settings->secret.((string)(int)microtime(true))));
      $this->filesize = strlen($data);
      $this->mimetype = $mimetype;
      $this->save();
      $this->writeData($this->filename,$data,false);
    }
  }

  // protected function _beforeEntityDelete(KCommandContext $context) {
  //   $this->deletePath($this->filename, false);
  // }

  /**
   * Store Data.
   *
   * @param array|KConfig $file
   */
  public function storeFile($file)
  {
      $filename = md5($this->id);
      $data = file_get_contents($file->tmp_name);

      if ($this->getFileName() == $this->name) {
          $this->name = $file->name;
      }

      $file->append(array(
          'type' => mime_content_type($file->name),
      ));

      $this->mimeType = $file->type;
      $this->setValue('file_name', $file->name);
      $this->fileSize = strlen($data);
      $this->writeData($filename, $data, false);
  }

  /**
   * Return the file content;.
   *
   * @return string
   */
  public function getFileContent()
  {
      $filename = md5($this->id);

      return $this->readData($filename, false);
  }

  /**
   * Return the original file name.
   *
   * @return string
   */
  public function getFileName()
  {
      return $this->getValue('file_name');
  }
//this is stuff from libBaseDomainBehaviorStorable, to remove later if needed

/**
 * Return the storage path of an entity. If $path is passed, it will
 * append the $path to the base storage path.
 *
 * @param string $path The path to append the storage path with
 *
 * @return string
 */
public function getStoragePath($path = '')
{
    //prepend the path with a \/
    if (strlen($path)) {
        $path = '/'.$path;
    }

    $base = $this->_mixer->id;

    //for ownable entities, use the owner component to prefix
    //the path
    if ($this->_mixer->isOwnable()) {
        $path = '/'.$this->_mixer->component.$path;
        $base = $this->_mixer->owner->id;
    }

    return 'n'.$base.$path;
}

/**
 * Write data to entity storage.
 *
 * @param string $path   The relative path to store the data in
 * @param string $data   The data to store
 * @param bool   $public The storage mode. Can be public or private
 */
public function writeData($path = '', $data, $public = true)
{
    $path = $this->getStoragePath($path);

    return $this->_storage->write($path, $data, $public);
}

/**
 * Read data from entity storage.
 *
 * @param string $path   The relative path to read the data from
 * @param bool   $public The storage mode. Can be public or private
 *
 * @return string
 */
public function readData($path = '', $public = true)
{
    $path = $this->getStoragePath($path);

    return $this->_storage->read($path, $public);
}

/**
 * Delete an existing data with the path.
 *
 * @param string $path   The relative path to delete the data from
 * @param bool   $public The storage mode. Can be public or private
 */
public function deletePath($path = '', $public = true)
{
    $path = $this->getStoragePath($path);

    return $this->_storage->delete($path, $public);
}

/**
 * Checks the existance of path.
 *
 * @param string $path   The relative path to check
 * @param bool   $public The storage mode. Can be public or private
 *
 * @return bool
 */
public function pathExists($path = '', $public = true)
{
    $path = $this->getStoragePath($path);

    return $this->_storage->exists($path, $public);
}

/**
 * Gets the unique identifiable location (URL) for a given path.
 *
 * @param string $path   The relative path to check
 * @param bool   $public The storage mode. Can be public or private
 *
 * @return bool
 */
public function getPathURL($path = '', $public = true)
{
    $path = $this->getStoragePath($path);

    return $this->_storage->getUrl($path, $public);
}

/**
 * Completely remove the storage.
 */
public function removeStorage()
{
    $this->deletePath('', true);
    $this->deletePath('', false);
}

/**
 * Before delete command.
 *
 * When an entity is deleted, the call of this command removes the deleted entity storage
 *
 * @param KCommandContext $context Context parameter
 */
protected function _beforeEntityDelete(KCommandContext $context)
{
    $entity = $context->entity;
    $entity->removeStorage();
}

}
