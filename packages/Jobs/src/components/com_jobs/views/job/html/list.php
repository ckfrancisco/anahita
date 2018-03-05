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

		<? if ($job->body) : ?>
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
