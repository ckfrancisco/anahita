<?php

//class ComDocumentsDomainBehaviorFileable extends LibBaseDomainBehaviorFileable {
class ComDocumentsDomainBehaviorFileable extends LibBaseDomainBehaviorStorable {

  protected function _initialize(KConfig $config) {
     parent::initialize($config);
    syslog(1,"init complete");

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

  protected function _beforeEntityDelete(KCommandContext $context) {
    $this->deletePath($this->filename, false);
  }

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
}
