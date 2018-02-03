<? defined('KOOWA') or die ?>

<? $documents = $set->documents->order('documentSets.ordering'); ?>

<? $index = 0; ?>
<? foreach ($documents as $document) :?>
<div class="thumbnail-wrapper <?= ($index == 0) ? 'cover' : ''; ?>" document="<?= $document->id ?>">
	<a data-trigger="MediaViewer" class="thumbnail-link" href="<?= $document->getPortraitURL('original') ?>" title="<?= @escape($document->title) ?>">
		<? $caption = htmlspecialchars($document->title, ENT_QUOTES) ?>
		<img caption="<?= $caption ?>" class="thumbnail" src="<?= $document->getPortraitURL('square') ?>" alt="<?= @escape($document->title) ?>" />
	</a>
</div>
<? ++$index; ?>
<? endforeach; ?>
