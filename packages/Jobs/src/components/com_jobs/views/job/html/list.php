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

	<? if (!empty($job->name)): ?>
	<div class="entity-title">
		<h4>
			<a href="<?= @route($job->getURL()) ?>">
				list <?= $job->name ?>
			</a>
		</h4>
	</div>
	<? endif; ?>

	<? if (!empty($job->link)): ?>
	<div class="entity-title">
		<a class="entity-link btn" href="<?= $job->link ?>">
			<i class="icon icon-info-sign"></i>
			Link
		</a>
	</div>
	<? endif; ?>

	<? if (!empty($job->startDate)) : ?>
	<div class="entity-title">
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-START-DATE') ?>
		</h5>
		<div>
			<?= date("F j Y", $job->startDate->getDate(DATE_FORMAT_UNIXTIME)) ?>
		</div>
	</div>
	<? endif;?>

	<? if (!empty($job->majors)) : ?>
	<div class="entity-title">
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-MAJORS') ?>
		</h5>
		<ul>
			<? $majors = explode("\n", $job->majors) ?>
			<? foreach ($majors as $major) : ?>
				<li><?= $major ?></li>
			<? endforeach; ?>
		</ul>
	</div>
	<? endif; ?>

	<? if (!empty($job->location)) : ?>
	<div class="entity-title">
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-LOCATION') ?>
		</h5>
		<div>
			<?= @content(nl2br($job->location), array('exclude' => 'gist')) ?>
		</div>
	</div>
	<? endif;?>

	<? if (!empty($job->employment)) : ?>
	<div class="entity-title">
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-EMPLOYMENT') ?>
		</h5>
		<div>
			<?= @content(nl2br($job->employment), array('exclude' => 'gist')) ?>
		</div>
	</div>
	<? endif;?>

	<? if (!empty($job->visa)) : ?>
	<div class="entity-title">
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-VISA') ?>
		</h5>
		<div>
			<?= @content(nl2br($job->visa), array('exclude' => 'gist')) ?>
		</div>
	</div>
	<? endif;?>

	<? if (!empty($job->body)) : ?>
	<div class="entity-title">
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-DESCRIPTION') ?>
		</h5>
		<div class="entity-description">
			<?= @content(nl2br($job->body), array('exclude' => 'gist')) ?>
		</div>
	</div>
	<? endif;?>

	<? if (!empty($job->filename)): ?>
	<div class="entity-title">
		<div class="entity-portrait-medium">
			<a data-rel="story-<?= $story->id ?>" data-trigger="MediaViewer" title="<?= $caption ?>" href="<?= $job->getPortraitURL('original'); ?>">
				<img src="<?= $job->getPortraitURL('medium') ?>" />
			</a>
		</div>
	</div>
	<? endif; ?>

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
