<? defined('KOOWA') or die; ?>

<? if ($document->authorize('edit')) : ?>
<div class="an-entity editable" data-url="<?= @route($document->getURL()) ?>">
<? else : ?>
<div class="an-entity">
<? endif; ?>
	<div class="clearfix">
		<div class="entity-portrait-square">
			<?= @avatar($document->author) ?>
		</div>

		<div class="entity-container">
			<h4 class="author-name"><?= @name($document->author) ?></h4>
			<ul class="an-meta inline">
				<li><?= @date($document->creationTime) ?></li>
				<? if (!$document->owner->eql($document->author)): ?>
				<li><?= @name($document->owner) ?></li>
				<? endif; ?>
			</ul>
		</div>
	</div>

	<div class="entity-portrait-medium">
		<? $caption = htmlspecialchars($document->title, ENT_QUOTES); ?>
		<a data-rel="media-documents-<?= $document->id ?>" data-trigger="MediaViewer" title="<?= $caption ?>" href="<?= $document->getPortraitURL('original') ?>">
			<img alt="<?= @escape($document->title) ?>" src="<?= $document->getPortraitURL('medium') ?>" />
		</a>
	</div>

	<div class="entity-description-wrapper">
		<? if ($document->title): ?>
			<h4 class="entity-title">
				<a title="<?= @escape($document->title) ?>" href="<?= @route($document->getURL()) ?>">
					<?= @escape($document->title) ?>
				</a>
			</h4>
		<? elseif ($document->authorize('edit')) : ?>
			<h4 class="entity-title">
				<span class="muted"><?= @text('LIB-AN-EDITABLE-PLACEHOLDER') ?></span>
			</h4>
		<? endif; ?>

    	<div class="entity-description">
    	<?= @helper('text.truncate', @content(nl2br($document->description), array('exclude' => array('gist', 'video'))), array('length' => 200, 'read_more' => true, 'consider_html' => true)); ?>
    	</div>
	</div>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li>
				<a href="<?= @route($document->getURL()) ?>">
				<?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $document->numOfComments) ?>
				</a>
			</li>
		</ul>

		<div class="vote-count-wrapper an-meta" id="vote-count-wrapper-<?= $document->id ?>">
			<?= @helper('ui.voters', $document); ?>
		</div>
	</div>

	<div class="entity-actions">
		<?= @helper('ui.commands', @commands('list')) ?>
	</div>
</div>
