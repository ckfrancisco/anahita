<?php

class ComDocumentsDomainBehaviorFileable extends LibBaseDomainBehaviorFileable {

  protected function _initialize(KConfig $config) {
    parent::initialize($config);
    unset($config['attributes']);
    $config->append(array (
      'attributes' => array (
          'filename',
          'filesize',
          'mimetype'
        )
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

  public function getFileContent() {
    return $this->readData($this->filename, false);
  }

  protected function _beforeEntityDelete(KCommandContext $context) {
    $this->deletePath($this->filename, false);
  }
}
