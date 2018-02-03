<? defined('KOOWA') or die; ?>

<? if ($document->authorize('edit')) : ?>
<div class="an-entity editable" data-url="<?= @route($document->getURL()) ?>">
<? else : ?>
<div class="an-entity">
<? endif; ?>

	<div class="entity-portrait-medium">
		<? $caption = htmlspecialchars($document->title, ENT_QUOTES); ?>
		<a data-trigger="MediaViewer" title="<?= $caption ?>" href="<?= $document->getPortraitURL('original') ?>">
			<img alt="<?= @escape($document->title) ?>" src="<?= $document->getPortraitURL('medium') ?>" />
		</a>
	</div>

	<div class="entity-description-wrapper">
		<? if ($document->title): ?>
			<h3 class="entity-title">
				<?= @escape($document->title) ?>
			</h3>
		<? elseif ($document->authorize('edit')) : ?>
			<h3 class="entity-title">
				<span class="muted"><?= @text('LIB-AN-EDITABLE-PLACEHOLDER') ?></span>
			</h3>
		<? endif; ?>

		<div class="entity-description">
			<?= @content(nl2br($document->description), array('exclude' => array('gist', 'video'))) ?>
		</div>
	</div>

	<div class="entity-meta">
		<div class="an-meta" id="vote-count-wrapper-<?= $document->id ?>">
		<?= @helper('ui.voters', $document); ?>
		</div>
	</div>
</div>
