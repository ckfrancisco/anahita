<? defined('KOOWA') or die ?>

<form id="jobs-set-assignment" method="post" action="<?= @route('view=set&oid='.$actor->id) ?>">
	<? foreach ($jobs as $job): ?>
	<input type="hidden" name="job_id[]" value="<?= $job->id ?>" />
	<? endforeach; ?>
	<input type="hidden" value="addjob" name="action" />

	<?= @message(@text('COM-JOBS-SET-SELECT-SIMPLE-INSTRUCTIONS')) ?>

	<? if ($actor->sets->getTotal()) : ?>
	<div class="clearfix">
		<label><?= @text('COM-JOBS-SET-SELECT-ONE') ?></label>
		<div class="input">
			<select id="set-selector" name="id" class="input-xlarge" required>
				<option value=""><?= @text('COM-JOBS-SET-SELECT-NO-SET-IS-SELECTED') ?></option>
				<? $sets = $actor->sets->order('title'); ?>
	            <? foreach ($sets as $set): ?>
				<option value="<?= $set->id ?>"><?= @escape($set->title) ?></option>
				<? endforeach; ?>
			</select>
		</div>
	</div>
	<? endif; ?>

	<? if ($actor->authorize('action', 'com_jobs:set:add')): ?>
	<div class="control-group">
		<label class="control-label" for="title"><?= @text('COM-JOBS-ACTION-OR-CREATE-A-NEW-SET') ?></label>
		<div class="controls">
			<input class="input-large" name="title" size="32" maxlength="100" type="text" required>
		</div>
	</div>
	<? endif; ?>

	<div class="form-actions">
		<a class="btn" href="<?= @route('view=jobs&oid='.$actor->id) ?>"><?= @text('COM-JOBS-ACTION-NO-THANK-YOU') ?></a>
		<button class="btn btn-primary"><?= @text('COM-JOBS-ACTION-SET-ADD-JOBS') ?></button>
	</div>
</form>
