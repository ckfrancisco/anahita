<?php

function loadFramework() {
  if (!defined('ANPATH_BASE')) {

    $_composerLoader = $GLOBALS['composerLoader'];
    define('ANPATH_BASE', WWW_ROOT);
    $_SERVER['HTTP_HOST'] = ''; //i do think this stuff needs to change since we wont be hosting the website when testing, but im not sure
    require_once ( ANPATH_BASE.'/includes/framework.php' );
    KService::get('com://site/application.dispatcher')->load();
    global $composerLoader, $console;
    $composerLoader = $_composerLoader;
    $console = $this;
    }
}
