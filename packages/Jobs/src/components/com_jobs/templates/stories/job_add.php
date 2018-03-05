<? defined('KOOWA') or die('Restricted access');?>

<? if (is_array($object)) : ?>
<data name="title">
	<?= sprintf(@text('COM-JOBS-STORY-NEW-JOBS'), @name($subject)) ?>
</data>
<? else: ?>
<data name="title">
	<?= sprintf(@text('COM-JOBS-STORY-NEW-JOB'), @name($subject), @route($object->getURL())); ?>
</data>
<? endif;?>

<data name="body">
	<? $caption = htmlspecialchars($object->title, ENT_QUOTES) ?>
	<? if (!empty($object->title)): ?>
	<h4 class="entity-title">
		<a href="<?= @route($object->getURL()) ?>">
			<?= $object->title ?>
		</a>
	</h4>
	<? endif; ?>

	<? if (!empty($object->link)): ?>
	<a class="entity-link btn" href="<?= $object->link ?>">
		<i class="icon icon-info-sign"></i>
		Link
	</a>
	<? endif; ?>

	<? if (!empty($object->majors)): ?>
	<div class="entity-title">
		<h5>
			Majors
		</h5>
		<ul>
			<? $majors = explode("\n", $object->majors) ?>
			<? foreach ($majors as $major) : ?>
				<li><?= $major ?></li>
			<? endforeach; ?>
		</ul>
	</div>
	<? endif; ?>

	<? if ($object->body) : ?>
	<div class="entity-description">
		<?= @content(nl2br($object->body), array('exclude' => 'gist')) ?>
	</div>
	<? endif;?>

	<? if (!empty($object->filename)): ?>
	<div class="entity-portrait-medium">
		<a data-rel="story-<?= $story->id ?>" data-trigger="MediaViewer" title="<?= $caption ?>" href="<?= $object->getPortraitURL('original'); ?>">
			<img src="<?= $object->getPortraitURL('medium') ?>" />
		</a>
	</div>
	<? endif; ?>
</data>
