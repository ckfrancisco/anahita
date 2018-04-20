<? defined('KOOWA') or die('Restricted access'); ?>

<data name="title">
	<?= sprintf(@text('COM-DOCUMENTS-STORY-NEW-SET'),  @name($subject), @route($object->getURL())) ?>
</data>

<data name="body">
	<? if (!empty($object->title)): ?>
	<h4 class="entity-title">
    	<a href="<?= @route($object->getURL()) ?>">
    		<?= $object->title ?>
    	</a>
    </h4>
	<? endif; ?>

	<? if ($object->description): ?>
	<div class="entity-description">
	    <?= @content(nl2br($object->description), array('exclude' => 'gist')) ?>
	</div>
	<? endif; ?>

	<div class="media-grid">
		<? $documents = $object->documents->order('documentSets.ordering')->limit(10)->fetchSet(); ?>
		<? foreach ($documents as $i => $document): ?>
		<? $caption = htmlspecialchars($document->title, ENT_QUOTES); ?>
		<? if ($i > 12) {
    break;
} ?>
		<div class="entity-portrait">
			<a data-rel="story-<?= $story->id ?>" data-trigger="MediaViewer" title="<?= $caption ?>" href="<?= $document->getPortraitURL('original') ?>">
				<img src="<?= $document->getPortraitURL('square') ?>" />
			</a>
		</div>
	    <? endforeach; ?>
	</div>

	<div class="entity-meta">
		<?= sprintf(@text('COM-DOCUMENTS-SET-META-DOCUMENTS'), $object->getDocumentCount()) ?>
	</div>
</data>
