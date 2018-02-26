<?php
declare(strict_types=1);

include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/config/interface.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/config/config.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/command/context.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/service/interface.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/service/service.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/libraries/anahita/functions.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/object/serviceable.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/object/handlable.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/object/object.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/libraries/anahita/controller/abstract.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/libraries/default/base/controller/abstract.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/libraries/default/base/controller/resource.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_base/controllers/resource.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_base/controllers/service.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_medium/controllers/abstract.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_medium/controllers/default.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/packages/Documents/src/components/com_documents/controllers/document.php';
use PHPUnit\Framework\TestCase;
use IteratorAggregate;
use ArrayAccess;
use Countable;

final class testComDocumentsControllerDocument extends TestCase {

    public function testObjectCreation() {
      $this->assertInstanceOf(
          $document = new ComDocumentsControllerDocument(new Kconfig(
            array(
              'name' => 'documents',
              'identifier' => 'document'
            )
            ))
        );
    }

    public function testBrowse() {

      $document = new ComDocumentsControllerDocument(new Kconfig(
        array(
          'name' => 'documents',
          'identifier' => 'document'
        )
      ));
      $this->assertNotNull($document->_actionBrowse(new KCommandContext()));
    }

    public function testAdd() {
      $document = new ComDocumentsControllerDocument(new Kconfig(
        array(
          'name' => 'documents',
          'identifier' => 'document'
        )
      ));
      $this->assertNotNull($document->_actionAdd(new KCommandContext()));
    }
}
