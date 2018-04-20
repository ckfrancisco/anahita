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
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/libraries/anahita/domain/entity/abstract.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/libraries/anahita/domain/entity/default.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_base/domains/entities/node.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_medium/domains/entities/medium.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/packages/Documents/src/components/com_documents/domains/entities/document.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/tests/loadAnahita.php';

use PHPUnit\Framework\TestCase;

// use IteratorAggregate;
// use ArrayAccess;
// use Countable;

final class testComDocumentsDomainEntityDocument extends TestCase {
  public function testObjectCreation() {
         loadFramework();
         $document = KService::get('repo:documents.document')->getEntity();
        // $document = new ComDocumentsDomainEntityDocument (new Kconfig(
        //   array(
        //     'name' => 'documents',
        //     'identifier' => 'document',
        //     'service_identifier' => 'foo'
        //   )
        // ));

      $this->assertNotNull($document);
  }

  public function testCorrectType() {
    loadFramework();
    $document = KService::get('repo:documents.document')->getEntity();

    $this->assertEquals('ComDocumentsDomainEntityDocument', gettype($docment));
}
