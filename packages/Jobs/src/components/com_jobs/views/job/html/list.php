<? defined('KOOWA') or die; ?>

<? if ($job->authorize('edit')) : ?>
<div class="an-entity editable" data-url="<?= @route($job->getURL()) ?>">
<? else : ?>
<div class="an-entity">
<? endif; ?>
	<div class="clearfix">
		<div class="entity-portrait-square">
			<?= @avatar($job->author) ?>
		</div>

		<div class="entity-container">
			<h4 class="author-name"><?= @name($job->author) ?></h4>
			<ul class="an-meta inline">
				<li><?= @date($job->creationTime) ?></li>
				<? if (!$job->owner->eql($job->author)): ?>
				<li><?= @name($job->owner) ?></li>
				<? endif; ?>
			</ul>
		</div>
	</div>

	<div class="entity-description-wrapper">
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

		<? if ($object->startDate) : ?>
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-START-DATE') ?>
		</h5>
		<div>
			<?= @content(nl2br($object->startDate), array('exclude' => 'gist')) ?>
		</div>
		<? endif;?>

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
			<?= @content(nl2br($object->employment), array('exclude' => 'gist')) ?>
		</div>
		<? endif;?>

		<? if ($object->visa) : ?>
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-VISA') ?>
		</h5>
		<div>
			<?= @content(nl2br($object->visa), array('exclude' => 'gist')) ?>
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
	</div>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li>
				<a href="<?= @route($job->getURL()) ?>">
				<?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $job->numOfComments) ?>
				</a>
			</li>
		</ul>

		<div class="vote-count-wrapper an-meta" id="vote-count-wrapper-<?= $job->id ?>">
			<?= @helper('ui.voters', $job); ?>
		</div>
	</div>

	<div class="entity-actions">
		<?= @helper('ui.commands', @commands('list')) ?>
	</div>
</div>
