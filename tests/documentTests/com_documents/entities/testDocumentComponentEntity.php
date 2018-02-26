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

include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/event/subscriber/interface.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_components/domains/entities/component.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_medium/domains/entities/component.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/packages/Documents/src/components/com_documents/domains/entities/component.php';
use PHPUnit\Framework\TestCase;


final class testComDocumentsDomainEntityComponent  extends TestCase {

  public function testObjectCreation() {
      $documentEntityComp = new ComDocumentsDomainEntityComponent(new Kconfig(
        array(
          'name' => 'documents',
          'identifier' => 'document',
          'service_identifier' => 'foo'
        )
      ));
      $this->assertNotNull($documentEntityComp);
  }

  public function testSetGadgets() {
    $documentEntityComp = new ComDocumentsDomainEntityComponent(new Kconfig(
      array(
        'name' => 'documents',
        'identifier' => 'document',
        'service_identifier' => 'foo'
      )
    ));
    $this->assertNotNull($documentEntityComp);
    $this->assertNotNull($documentEntityComp->_setGadgets()); //todo look into actor type for set Gadgets
  }

}
