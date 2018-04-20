<? defined('KOOWA') or die('Restricted access');?>

<? if (is_array($object)) : ?>
<data name="title">
	<?= sprintf(@text('COM-CLASSES-STORY-NEW-CLASSES'), @name($subject)) ?>
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
	<?= sprintf(@text('COM-CLASSES-STORY-NEW-CLASSES'), @name($subject), @route($object->getURL())) ?>
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
