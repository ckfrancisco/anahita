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
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-MAJORS') ?>
		</h5>
		<ul>
			<? $majors = explode("\n", $object->majors) ?>
			<? foreach ($majors as $major) : ?>
				<li><?= $major ?></li>
			<? endforeach; ?>
		</ul>
	</div>
	<? endif; ?>

	<? if ($object->postDate) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-POST-DATE') ?>
	</h5>
	<div class="entity-post-date">
		<?= @content(nl2br($object->postDate), array('exclude' => 'gist')) ?>
	</div>
	<? endif;?>

	<? if ($object->starDate) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-START-DATE') ?>
	</h5>
	<div>
		<?= @content(nl2br($object->starDate), array('exclude' => 'gist')) ?>
	</div>
	<? endif;?>

	<? if ($object->location) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-LOCATION') ?>
	</h5>
	<div>
		<?= @content(nl2br($object->location), array('exclude' => 'gist')) ?>
	</div>
	<? endif;?>

	<? if ($object->employment) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-EMPLOYMENT') ?>
	</h5>
	<div>
		<?php switch($object->employment): 
		case 1: ?>
			<?= @content(nl2br("Full-Time"), array('exclude' => 'gist')) ?>
		<?php break; ?>
		<?php case 0: ?>
			<?= @content(nl2br("Part-Time"), array('exclude' => 'gist')) ?>
		<?php break; ?>
		<?php case -1: ?>
			<?= @content(nl2br("Internship"), array('exclude' => 'gist')) ?>
		<?php break; ?>
		<?php endswitch; ?>
	</div>
	<? endif;?>

	<? if ($object->visa) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-VISA') ?>
	</h5>
	<div>
		<?php switch($object->visa): 
		case 1: ?>
			<?= @content(nl2br("U.S. Citizen"), array('exclude' => 'gist')) ?>
		<?php break; ?>
		<?php case 0: ?>
			<?= @content(nl2br("Green Card"), array('exclude' => 'gist')) ?>
		<?php break; ?>
		<?php case -1: ?>
			<?= @content(nl2br("Work Visa"), array('exclude' => 'gist')) ?>
		<?php break; ?>
		<?php endswitch; ?>
	</div>
	<? endif;?>

	<? if ($object->body) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-DESCRIPTION') ?>
	</h5>
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
