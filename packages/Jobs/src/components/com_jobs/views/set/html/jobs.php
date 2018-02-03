<? defined('KOOWA') or die ?>

<? $jobs = $set->jobs->order('jobSets.ordering'); ?>

<? $index = 0; ?>
<? foreach ($jobs as $job) :?>
<div class="thumbnail-wrapper <?= ($index == 0) ? 'cover' : ''; ?>" job="<?= $job->id ?>">
	<a data-trigger="MediaViewer" class="thumbnail-link" href="<?= $job->getPortraitURL('original') ?>" title="<?= @escape($job->title) ?>">
		<? $caption = htmlspecialchars($job->title, ENT_QUOTES) ?>
		<img caption="<?= $caption ?>" class="thumbnail" src="<?= $job->getPortraitURL('square') ?>" alt="<?= @escape($job->title) ?>" />
	</a>
</div>
<? ++$index; ?>
<? endforeach; ?>
