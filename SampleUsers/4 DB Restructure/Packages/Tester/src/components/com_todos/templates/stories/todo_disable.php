<? defined('KOOWA') or die('Restricted access');?>

<? if (is_array($object)) : ?>
<data name="title">
	<?= sprintf(@text('COM-TESTER-STORY-TESTER-CLOSED'), @name($subject)) ?>
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
	<?=sprintf(@text('COM-TESTER-STORY-TESTER-CLOSED'), @name($subject), @route($object->getURL()))?>
</data>
<data name="body">
    <div>
		<?= @link($object) ?>
	</div>
</data>
<? endif; ?>
