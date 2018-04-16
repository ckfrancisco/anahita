<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\PHPUnit_Extensions_Selenium2TestCase;

class initialTest extends PHPUnit_Extensions_Selenium2TestCase
{
  public function setUp()
  {
    $this->setHost('localhost');
    $this->setPort(4444);
    $this->setBrowserUrl('http://vaprobash.dev');
    $this->setBrowser('firefox');
    $this->setBrowserUrl('http://localhost');
  }

  public function tearDown() {
    $this->stop();
  }

  public function testLogin() {
    $this->url('index.php');
    $this->byName('username')->value('PeterQafoku');
    $this->byName('password')->value('password');
    //click on submit
    this->clickOnElement('Submit');
    //check to see if search is present
    $check = $this->byName('term');
    assertEquals($check->value(),'Search ...');
  }

  public function testFailLogin() {
    $this->url('index.php');
    $this->byName('username')->value('PeterQafoku');
    $this->byName('password')->value('1234');
    //click on submit
    $this->clickOnElement('Submit');
    //check to see if search is present
    $check = $this->byName('error');
    assertEquals($check->value(),'Invalid Credentials. Please try again.');
  }

  public function testStoryPost() {
    $this->testLogin(); //login first
    $this->clickOnElement('tab-content-item');
    assertEquals($this->byName('NoteText')->value(), "Enter Note Text here");
    $this->byName('NoteText')->value('this is a post');
    $this->clickOnElement('Submit');
    $check = $this->byName('story');
    assertEquals($check->value(),'this is a post');
  }

}
