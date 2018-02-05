<? defined('KOOWA') or die('Restricted access');?>

<? if (count($documents)) :?>
<? foreach ($documents as $document) : ?>
<div class="thumbnail-wrapper" document="<?= $document->id ?>">
	<a data-trigger="MediaViewer" class="thumbnail-link" href="<?= $document->getPortraitURL('original') ?>" title="<?= @escape($document->title) ?>">
		<? $caption = htmlspecialchars($document->title, ENT_QUOTES) ?>
		<img caption="<?= $caption ?>" class="thumbnail" src="<?= $document->getPortraitURL('square') ?>" alt="<?= @escape($document->title) ?>" />
	</a>
</div>
<? endforeach; ?>
<? else: ?>
<?= @message(@text('LIB-AN-NODES-EMPTY-LIST-MESSAGE')) ?>
<? endif; ?>
