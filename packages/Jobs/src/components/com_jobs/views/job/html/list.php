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
		<? if (!empty($job->title)): ?>
		<h4 class="entity-title">
			<a href="<?= @route($job->getURL()) ?>">
				<?= $job->title ?>
			</a>
		</h4>
		<? endif; ?>

		<? if (!empty($job->link)): ?>
		<a class="entity-link btn" href="<?= $job->link ?>">
			<i class="icon icon-info-sign"></i>
			Link
		</a>
		<? endif; ?>

		<? if (!empty($job->majors)): ?>
		<div class="entity-title">
			<h5>
				Majors
			</h5>
			<ul>
				<? $majors = explode("\n", $job->majors) ?>
				<? foreach ($majors as $major) : ?>
					<li><?= $major ?></li>
				<? endforeach; ?>
			</ul>
		</div>
		<? endif; ?>

		<? if ($job->postDate) : ?>
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-POST-DATE') ?>
		</h5>
		<div class="entity-post-date">
			<?= @content(nl2br($job->postDate), array('exclude' => 'gist')) ?>
		</div>
		<? endif;?>

		<? if ($job->starDate) : ?>
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-START-DATE') ?>
		</h5>
		<div>
			<?= @content(nl2br($job->starDate), array('exclude' => 'gist')) ?>
		</div>
		<? endif;?>

		<? if ($job->location) : ?>
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-LOCATION') ?>
		</h5>
		<div>
			<?= @content(nl2br($job->location), array('exclude' => 'gist')) ?>
		</div>
		<? endif;?>

		<? if ($job->employment) : ?>
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-EMPLOYMENT') ?>
		</h5>
		<div>
			<?php switch($job->employment): 
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

		<? if ($job->visa) : ?>
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-VISA') ?>
		</h5>
		<div>
			<?php switch($job->visa): 
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

		<? if ($job->body) : ?>
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-DESCRIPTION') ?>
		</h5>
		<div class="entity-description">
			<?= @content(nl2br($job->body), array('exclude' => 'gist')) ?>
		</div>
		<? endif;?>

		<? if (!empty($job->filename)): ?>
		<div class="entity-portrait-medium">
			<a data-rel="story-<?= $job->id ?>" data-trigger="MediaViewer" title="<?= $job->title ?>" href="<?= $job->getPortraitURL('original'); ?>">
				<img src="<?= $job->getPortraitURL('medium') ?>" />
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
