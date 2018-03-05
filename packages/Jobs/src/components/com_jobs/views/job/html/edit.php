<? defined('KOOWA') or die ?>

<? if (defined('ANDEBUG') && ANDEBUG) : ?>
<script src="com_jobs/js/majors.js" />
<? else: ?>
<script src="com_jobs/js/min/majors.min.js" />
<? endif; ?>

<form action="<?= @route($item->getURL()) ?>" method="post" >
	<div class="control-group">
		<label class="control-label" for="job-title">
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-TITLE') ?>
		</label>
		<div class="controls">
			<input id="job-title"class="input-block-level" type="text" name="name" rows="1" maxlength="5000" value="<?= $item->name ?>" required autofocus></input>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="job-link">
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-LINK') ?>
		</label>
		<div class="controls">
			<input id="job-link" class="input-block-level" type="url" name="link" rows="1" maxlength="5000" value="<?= $item->link ?>"></input>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="job-majors">
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-MAJORS') ?>
		</label>
		<div class="controls">
			<textarea class="input-block-level" type="text" rows="1" maxlength="5000" id="job-majors" name="majors" style="display:none"></textarea>

			<? if (!empty($item->majors)): ?>
				<? $majors = explode("\n", $item->majors) ?>
				<? foreach ($majors as $major) : ?>
					<input class="input-block-level" type="text" rows="1" maxlength="5000" value="<?= $major ?>"></input>
				<? endforeach; ?>
			<? else: ?>
				<input class="input-block-level" type="text" rows="1" maxlength="5000"></input>
			<? endif; ?>

		</div>
		<button id="btn-add-major-input" type="button" style="width:24px">+</button>
		<button id="btn-rem-major-input" type="button" style="width:24px">-</button>
	</div>

	<div class="control-group">
		<label class="control-label" for="job-description">
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-DESCRIPTION') ?>
		</label>
		<div class="controls">
			<textarea id="job-description" class="input-block-level" name="body" rows="3" maxlength="5000"><?= $item->body ?></textarea>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="privacy">
			<?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?>
		</label>
		<div class="controls">
			<?= @helper('ui.privacy', array('entity' => $job, 'auto_submit' => false, 'options' => $actor)) ?>
		</div>
	</div>

	<div class="form-actions">
		<a data-trigger="EditableCancel" class="btn" href="<?= @route($item->getURL()) ?>">
		    <?= @text('LIB-AN-ACTION-CANCEL') ?>
		</a>

		<button type="submit" class="btn btn-primary">
		    <?= @text('LIB-AN-ACTION-UPDATE') ?>
		</button>
	</div>
</form>