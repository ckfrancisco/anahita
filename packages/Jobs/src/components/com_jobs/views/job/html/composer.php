<? defined('KOOWA') or die('Restricted access'); ?>

<? $job = @service('repos:jobs.job')->getEntity()->reset() ?>

<form class="composer-form" method="post" action="<?= @route() ?>" enctype="multipart/form-data">
    <fieldset>
	    <legend><?= @text('COM-JOBS-JOB-ADD')  ?></legend>

		<div class="control-group">
			<label class="control-label" for="job-file">
			    <?= @text('COM-JOBS-COMPOSER-FILE-SELECT') ?>
			</label>
			<div class="controls">
				<input accept="image/*" id="job-file" type="file" name="file" required autofocus />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="job-link">
				<?= @text('COM-JOBS-COMPOSER-JOB-POST-LINK') ?>
			</label>
			<div class="controls">
				<input type="text" class="input-block-level" name="link" value="<?= @escape($item->link) ?>" size="50" maxlength="5000" required>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="job-majors">
				<?= @text('COM-JOBS-COMPOSER-JOB-POST-MAJORS') ?>
			</label>
			<div class="controls">
				<textarea id="job-majors" class="input-block-level" name="majors" cols="5" rows="3" maxlength="5000"></textarea>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="job-title">
				<?= @text('COM-JOBS-COMPOSER-JOB-POST-TITLE') ?>
			</label>
			<div class="controls">
				<textarea id="job-title" class="input-block-level" name="title" cols="5" rows="1" maxlength="5000"></textarea>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="job-description">
			    <?= @text('COM-JOBS-COMPOSER-JOB-POST-DESCRIPTION') ?>
			</label>
			<div class="controls">
				<textarea id="job-description" class="input-block-level" name="body" cols="5" rows="3" maxlength="5000"></textarea>
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

	</fieldset>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-POSTING') ?>">
            <?=@text('LIB-AN-ACTION-SHARE')?>
        </button>
    </div>
</form>
