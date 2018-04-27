<? defined('KOOWA') or die('Restricted access');?>

<? if (is_array($object)) : ?>
<data name="title">
	<?= sprintf(@text('COM-INTERESTS-STORY-NEW-INTERESTS'), @name($subject)) ?>
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
	<?= sprintf(@text('COM-INTERESTS-STORY-NEW-INTERESTS'), @name($subject), @route($object->getURL())) ?>
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
