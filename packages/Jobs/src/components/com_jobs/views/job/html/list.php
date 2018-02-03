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

	<div class="entity-portrait-medium">
		<? $caption = htmlspecialchars($job->title, ENT_QUOTES); ?>
		<a data-rel="media-jobs-<?= $job->id ?>" data-trigger="MediaViewer" title="<?= $caption ?>" href="<?= $job->getPortraitURL('original') ?>">
			<img alt="<?= @escape($job->title) ?>" src="<?= $job->getPortraitURL('medium') ?>" />
		</a>
	</div>

	<div class="entity-description-wrapper">
		<? if ($job->title): ?>
			<h4 class="entity-title">
				<a title="<?= @escape($job->title) ?>" href="<?= @route($job->getURL()) ?>">
					<?= @escape($job->title) ?>
				</a>
			</h4>
		<? elseif ($job->authorize('edit')) : ?>
			<h4 class="entity-title">
				<span class="muted"><?= @text('LIB-AN-EDITABLE-PLACEHOLDER') ?></span>
			</h4>
		<? endif; ?>

    	<div class="entity-description">
    	<?= @helper('text.truncate', @content(nl2br($job->description), array('exclude' => array('gist', 'video'))), array('length' => 200, 'read_more' => true, 'consider_html' => true)); ?>
    	</div>
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
