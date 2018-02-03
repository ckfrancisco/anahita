<? defined('KOOWA') or die('Restricted access'); ?>

<? if (defined('ANDEBUG') && ANDEBUG) : ?>
<script  src="com_jobs/js/upload.js" />
<? else: ?>
<script  src="com_jobs/js/min/upload.min.js" />
<? endif; ?>

<div class="row">
	<div class="span8">
		<?= @helper('ui.header') ?>

	    <div id="jobs-add">
	    	<div class="dropzone"></div>

	    	<form>
        	    <? if ($actor->authorize('administration')) : ?>
        		<div id="job-privacy-selector" class="control-group">
        			<label class="control-label" for="privacy" id="privacy"><?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?></label>
        			<div class="controls">
        				<? $entity = @service('repos:jobs.job')->getEntity()->reset() ?>
        				<?= @helper('ui.privacy', array('entity' => $entity, 'auto_submit' => false, 'options' => $actor)) ?>
        			</div>
        		</div>
                <? endif;?>

            	<div class="form-actions">
            	    <button class="btn" data-trigger="RemoveJobs"><?= @text('LIB-AN-ACTION-CANCEL') ?></button>
            	    <button class="btn btn-primary" data-trigger="UploadJobs"><?= @text('LIB-AN-ACTION-UPLOAD')?></button>
            	</div>
            </form>
        </div>

	</div>
</div>

<script>
$('#jobs-add').jobUpload({
	filedrop : '.dropzone',
	url : "<?= @route('view=job&format=json&oid='.$actor->id) ?>",
	setsUrl : "<?= @route('view=sets&oid='.$actor->id.'&layout=add_jobs') ?>",
	parallelUploads : 2,
	maxFilesize : <?= get_config_value('jobs.uploadlimit', 4) ?>,
	maxFiles : 10,
	addRemoveLinks : true,
	autoQueue: false,
	acceptedFiles : 'image/jpeg,image/jpg,image/png,image/gif',
	dictDefaultMessage : "<?= @text('COM-JOBS-UPLOAD-DROP-FILES-TO-UPLOAD') ?>",
	dictInvalidFileType : "<?= @text('COM-JOBS-UPLOAD-INVALID-FILE-TYPE') ?>",
	dictFileTooBig : "<?= sprintf(@text('COM-JOBS-UPLOAD-FILE-TOO-BIG'), get_config_value('jobs.uploadlimit', 4)) ?>",
	dictRemoveFile : "<?= @text('LIB-AN-ACTION-REMOVE') ?>"
});
</script>
