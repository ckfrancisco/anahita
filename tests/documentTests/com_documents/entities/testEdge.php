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
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_base/domains/entities/edge.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/packages/Documents/src/components/com_documents/domains/entities/document.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/packages/Documents/src/components/com_documents/domains/entities/edge.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/tests/loadAnahita.php';
use PHPUnit\Framework\TestCase;

// use IteratorAggregate;
// use ArrayAccess;
// use Countable;

final class testEdge extends TestCase {

  public function testObjectCreation () {
    loadFramework();
    $edge = KService::get('repo:documents.document')->getEdge();
    assertNotNull($edge);
  }

  public function testEdgeCorrectType() {
    loadFramework();
    $edge = KService::get('repo:documents.document')->getEdge();
    $this->assertEquals('ComDocumentsDomainEntityEdge', gettype($edge));
  }

  public function testAfterEntityInsert() {
    loadFramework();
    $edge = KService::get('repo:documents.document')->getEdge();
    $edge->_afterEntityInsert(new KCommandContext( array (
      'entity' =>  KService::get('repo:documents:document')->getEntity()
    )));
  }

  public function testAfterEntityDelete() {
    loadFramework();
    $edge = KService::get('repo:documents.document')->getEdge();
    $edge->_afterEntityDelete(new KCommandContext( array (
      'entity' =>  KService::get('repo:documents:document')->getEntity()
    )));
  }
}
