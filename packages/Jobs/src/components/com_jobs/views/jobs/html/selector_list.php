<? defined('KOOWA') or die('Restricted access');?>

<? if (count($jobs)) :?>
<? foreach ($jobs as $job) : ?>
<div class="thumbnail-wrapper" job="<?= $job->id ?>">
	<a data-trigger="MediaViewer" class="thumbnail-link" href="<?= $job->getPortraitURL('original') ?>" title="<?= @escape($job->title) ?>">
		<img caption="<?= $job->title ?>" class="thumbnail" src="<?= $job->getPortraitURL('square') ?>" alt="<?= @escape($job->title) ?>" />
	</a>
</div>
<? endforeach; ?>
<? else: ?>
<?= @message(@text('LIB-AN-NODES-EMPTY-LIST-MESSAGE')) ?>
<? endif; ?>
