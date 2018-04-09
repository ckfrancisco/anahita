<? defined('KOOWA') or die('Restricted access');?>

<? if (is_array($object)) : ?>
<data name="title">
	<?= sprintf(@text('COM-CLASSES-STORY-CLASSES-CLOSED'), @name($subject)) ?>
</data>

<data name="body">
	<ol>
	<? foreach ($object as $obj) : ?>
	<?
        $priority = '';
        switch ($obj->priority) {
            case ComClassesDomainEntityClass::PRIORITY_HIGHEST: $priority = @text('COM-CLASSES-CLASS-PRIORITY-HIGHEST');break;
            case ComClassesDomainEntityClass::PRIORITY_HIGH: $priority = @text('COM-CLASSES-CLASS-PRIORITY-HIGH');break;
            case ComClassesDomainEntityClass::PRIORITY_NORMAL: $priority = @text('COM-CLASSES-CLASS-PRIORITY-NORMAL');break;
            case ComClassesDomainEntityClass::PRIORITY_LOW:$priority = @text('COM-CLASSES-CLASS-PRIORITY-LOW');break;
            default : $priority = @text('COM-CLASSES-CLASS-PRIORITY-LOWEST');break;
        }
    ?>
	<li><?= @link($obj) ?> <span class="an-meta"> - (<?= @text('COM-CLASSES-CLASS-PRIORITY') ?>: <?=$priority?>)</span></li>
	<? endforeach; ?>
	</ol>
</data>
<? else : ?>
<data name="title">
	<?=sprintf(@text('COM-CLASSES-STORY-CLASS-CLOSED'), @name($subject), @route($object->getURL()))?>
</data>
<data name="body">
    <div>
		<?= @link($object) ?>
	</div>
</data>
<? endif; ?>
