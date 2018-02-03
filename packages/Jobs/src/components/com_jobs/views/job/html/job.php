<? defined('KOOWA') or die; ?>

<? if ($job->authorize('edit')) : ?>
<div class="an-entity editable" data-url="<?= @route($job->getURL()) ?>">
<? else : ?>
<div class="an-entity">
<? endif; ?>

	<div class="entity-portrait-medium">
		<? $caption = htmlspecialchars($job->title, ENT_QUOTES); ?>
		<a data-trigger="MediaViewer" title="<?= $caption ?>" href="<?= $job->getPortraitURL('original') ?>">
			<img alt="<?= @escape($job->title) ?>" src="<?= $job->getPortraitURL('medium') ?>" />
		</a>
	</div>

	<div class="entity-description-wrapper">
		<? if ($job->title): ?>
			<h3 class="entity-title">
				<?= @escape($job->title) ?>
			</h3>
		<? elseif ($job->authorize('edit')) : ?>
			<h3 class="entity-title">
				<span class="muted"><?= @text('LIB-AN-EDITABLE-PLACEHOLDER') ?></span>
			</h3>
		<? endif; ?>

		<div class="entity-description">
			<?= @content(nl2br($job->description), array('exclude' => array('gist', 'video'))) ?>
		</div>
	</div>

	<div class="entity-meta">
		<div class="an-meta" id="vote-count-wrapper-<?= $job->id ?>">
		<?= @helper('ui.voters', $job); ?>
		</div>
	</div>
</div>
