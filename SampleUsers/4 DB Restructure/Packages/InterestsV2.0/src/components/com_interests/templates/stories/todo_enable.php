<? defined('KOOWA') or die('Restricted access');?>

<? if (is_array($object)) : ?>
<data name="title">
	<?= sprintf(@text('COM-INTERESTS-STORY-INTERESTS-OPENED'), @name($subject)) ?>
</data>
<data name="body">
<ol>
	<? foreach ($object as $obj) : ?>
	<?
        $priority = '';
        switch ($obj->priority) {
            case ComInterestsDomainEntityInterests::PRIORITY_HIGHEST: $priority = @text('COM-INTERESTS-INTERESTS-PRIORITY-HIGHEST');break;
            case ComInterestsDomainEntityInterests::PRIORITY_HIGH: $priority = @text('COM-INTERESTS-INTERESTS-PRIORITY-HIGH');break;
            case ComInterestsDomainEntityInterests::PRIORITY_NORMAL: $priority = @text('COM-INTERESTS-INTERESTS-PRIORITY-NORMAL');break;
            case ComInterestsDomainEntityInterests::PRIORITY_LOW:$priority = @text('COM-INTERESTS-INTERESTS-PRIORITY-LOW');break;
            default : $priority = @text('COM-INTERESTS-INTERESTS-PRIORITY-LOWEST');break;
        }
    ?>
	<li><?= @link($obj) ?> <span class="an-meta"> - (<?= @text('COM-INTERESTS-INTERESTS-PRIORITY') ?>: <?=$priority?>)</span></li>
	<? endforeach; ?>
</ol>
</data>
<? else : ?>
<data name="title">
	<?= sprintf(@text('COM-INTERESTS-STORY-INTERESTS-OPENED'), @name($subject), @route($object->getURL()))?>
</data>
<data name="body">
	<?
        $priority = '';
        switch ($object->priority) {
            case ComInterestsDomainEntityInterests::PRIORITY_HIGHEST: $priority = @text('COM-INTERESTS-INTERESTS-PRIORITY-HIGHEST');break;
            case ComInterestsDomainEntityInterests::PRIORITY_HIGH: $priority = @text('COM-INTERESTS-INTERESTS-PRIORITY-HIGH');break;
            case ComInterestsDomainEntityInterests::PRIORITY_NORMAL: $priority = @text('COM-INTERESTS-INTERESTS-PRIORITY-NORMAL');break;
            case ComInterestsDomainEntityInterests::PRIORITY_LOW:$priority = @text('COM-INTERESTS-INTERESTS-PRIORITY-LOW');break;
            default : $priority = @text('COM-INTERESTS-INTERESTS-PRIORITY-LOWEST');break;
        }
    ?>
	<div>
		<?= @link($object) ?> <span class="an-meta"> - (<?= @text('COM-INTERESTS-INTERESTS-PRIORITY') ?>: <?=$priority?>)</span>
	</div>
</data>
<? endif; ?>
