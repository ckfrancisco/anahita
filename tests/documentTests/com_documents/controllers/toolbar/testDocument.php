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

include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/inflector/inflector.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/event/subscriber/interface.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/vendor/nooku/libraries/koowa/event/subscriber/abstract.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/libraries/anahita/controller/toolbar/interface.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/libraries/anahita/controller/toolbar/abstract.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_base/controllers/toolbars/abstract.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_base/controllers/toolbars/default.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_medium/controllers/toolbars/default.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_medium/controllers/abstract.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/src/components/com_medium/controllers/default.php';
include '/home/peterqafoku/Documents/CPTS421/sparq/anahita/packages/Documents/src/components/com_documents/controllers/toolbars/document.php';
use PHPUnit\Framework\TestCase;

final class testToolbarDocument extends TestCase {

  //todo look more into creating an instance of this type
  public function testObjectCreation() {
    $this->assertInstanceOf(
      $doc = new ComDocumentsControllerToolbarDocument(new Kconfig(
         array(
           'name' => 'documents',
           'identifier' => 'document'
         )
         ))
    );

  }
}
