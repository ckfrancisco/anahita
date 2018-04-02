<? defined('KOOWA') or die ?>

<? if (defined('ANDEBUG') && ANDEBUG) : ?>
<script src="com_jobs/js/majors.js" />
<? else: ?>
<script src="com_jobs/js/min/majors.min.js" />
<? endif; ?>

<form id="job-form" class="composer-form" method="post" action="<?= @route() ?>" enctype="multipart/form-data">
    <fieldset>
	    <legend><?= @text('COM-JOBS-JOB-ADD')  ?></legend>

		<div class="control-group">
			<label class="control-label" for="job-title">
				<?= @text('COM-JOBS-COMPOSER-JOB-POST-TITLE') ?>
			</label>
			<div class="controls">
				<input id="job-title" class="input-block-level" type="text" name="name" rows="1" maxlength="5000" required autofocus></input>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="job-link">
				<?= @text('COM-JOBS-COMPOSER-JOB-POST-LINK') ?>
			</label>
			<div class="controls">
				<input id="job-link" class="input-block-level" type="url" name="link" rows="1" maxlength="5000"></input>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="job-start-date">
				<?= @text('COM-JOBS-COMPOSER-JOB-POST-START-DATE') ?>
			</label>
			<div class="controls">
				<input id="job-start-date" class="input-block-level" type="date" name="startDate"></input>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="job-location">
				<?= @text('COM-JOBS-COMPOSER-JOB-POST-LOCATION') ?>
			</label>
			<div class="controls">
				<input id="job-location" class="input-block-level" type="text" name="location" rows="1" maxlength="5000"></input>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="job-majors">
				<?= @text('COM-JOBS-COMPOSER-JOB-POST-MAJORS') ?>
			</label>
			<div class="controls">
				<textarea class="input-block-level" type="text" rows="1" maxlength="5000" id="job-majors" name="majors" style="display:none"></textarea>
				<input class="input-block-level" type="text" rows="1" maxlength="5000"></input>
			</div>
			<button id="btn-add-major-input" type="button" style="width:24px">+</button>
			<button id="btn-rem-major-input" type="button" style="width:24px">-</button>
		</div>

		<div class="control-group">
            <label class="control-label" for="job-description">
                <?= @text('COM-JOBS-COMPOSER-JOB-POST-DESCRIPTION') ?>
            </label>

            <div class="controls">
                <?= @editor(array(
                    'name' => 'body',
                    'content' => '',
                    'html' => array(
                        'maxlength' => '20000',
                        'cols' => '5',
                        'rows' => '5',
                        'class' => 'input-block-level',
                        'id' => 'job-description',
                        ),
                )); ?>
            </div>
        </div>

		<div class="control-group">
			<label class="control-label" for="job-employment">
				<?= @text('COM-JOBS-COMPOSER-JOB-POST-EMPLOYMENT') ?>
			</label>
			<div class="controls">
				<?= @helper('selectemployment') ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="job-visa">
				<?= @text('COM-JOBS-COMPOSER-JOB-POST-VISA') ?>
			</label>
			<div class="controls">
				<?= @helper('selectvisa') ?>
			</div>
		</div>
					
		<div class="control-group">
			<label class="control-label" for="job-file">
				<?= @text('COM-JOBS-COMPOSER-FILE-SELECT') ?>
			</label>
			<div class="controls">
				<input id="job-file" type="file" name="file"/>
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