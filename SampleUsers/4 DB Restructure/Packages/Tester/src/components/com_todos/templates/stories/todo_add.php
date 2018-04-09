<? defined('KOOWA') or die('Restricted access');?>

<? if (is_array($object)) : ?>
<data name="title">
	<?= sprintf(@text('COM-TESTER-STORY-NEW-TESTER'), @name($subject)) ?>
</data>

<data name="body">
<ol>
	<? foreach ($object as $obj) : ?>
	<?
      $priority = '';
      switch ($obj->priority) {
            case ComTesterDomainEntityTester::PRIORITY_HIGHEST: $priority = @text('COM-TESTER-TESTER-PRIORITY-HIGHEST');break;
            case ComTesterDomainEntityTester::PRIORITY_HIGH: $priority = @text('COM-TESTER-TESTER-PRIORITY-HIGH');break;
            case ComTesterDomainEntityTester::PRIORITY_NORMAL: $priority = @text('COM-TESTER-TESTER-PRIORITY-NORMAL');break;
            case ComTesterDomainEntityTester::PRIORITY_LOW:$priority = @text('COM-TESTER-TESTER-PRIORITY-LOW');break;
            default : $priority = @text('COM-TESTER-TESTER-PRIORITY-LOWEST');break;
      }
    ?>
	<li><?= @link($obj) ?> <span class="an-meta"> - (<?= @text('COM-TESTER-TESTER-PRIORITY') ?>: <?=$priority?>)</span></li>
	<? endforeach; ?>
</ol>
</data>
<? else : ?>
<data name="title">
	<?= sprintf(@text('COM-TESTER-STORY-NEW-TESTER'), @name($subject), @route($object->getURL())) ?>
</data>

<data name="body">
    <h4 class="entity-title">
    	<a href="<?= @route($object->getURL()) ?>">
    		<?= $object->title ?>
    	</a>
    </h4>
    <div class="entity-body">
	    <?= @helper('text.truncate', @content(nl2br($object->body), array('exclude' => 'gist')), array('length' => 200, 'consider_html' => true, 'read_more' => true)); ?>
	</div>
</data>
<? endif; ?>
