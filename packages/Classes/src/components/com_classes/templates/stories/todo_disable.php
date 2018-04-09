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
            case ComClassesDomainEntityClasses::PRIORITY_HIGHEST: $priority = @text('COM-CLASSES-CLASSES-PRIORITY-HIGHEST');break;
            case ComClassesDomainEntityClasses::PRIORITY_HIGH: $priority = @text('COM-CLASSES-CLASSES-PRIORITY-HIGH');break;
            case ComClassesDomainEntityClasses::PRIORITY_NORMAL: $priority = @text('COM-CLASSES-CLASSES-PRIORITY-NORMAL');break;
            case ComClassesDomainEntityClasses::PRIORITY_LOW:$priority = @text('COM-CLASSES-CLASSES-PRIORITY-LOW');break;
            default : $priority = @text('COM-CLASSES-CLASSES-PRIORITY-LOWEST');break;
        }
    ?>
	<li><?= @link($obj) ?> <span class="an-meta"> - (<?= @text('COM-CLASSES-CLASSES-PRIORITY') ?>: <?=$priority?>)</span></li>
	<? endforeach; ?>
	</ol>
</data>
<? else : ?>
<data name="title">
	<?=sprintf(@text('COM-CLASSES-STORY-CLASSES-CLOSED'), @name($subject), @route($object->getURL()))?>
</data>
<data name="body">
    <div>
		<?= @link($object) ?>
	</div>
</data>
<? endif; ?>
