<? defined('KOOWA') or die('Restricted access'); ?>

<? if (defined('ANDEBUG') && ANDEBUG) : ?>
<script  src="com_documents/js/upload.js" />
<? else: ?>
<script  src="com_documents/js/min/upload.min.js" />
<? endif; ?>

<div class="row">
	<div class="span8">
		<?= @helper('ui.header') ?>

	    <div id="documents-add">
	    	<div class="dropzone"></div>

	    	<form>
        	    <? if ($actor->authorize('administration')) : ?>
        		<div id="document-privacy-selector" class="control-group">
        			<label class="control-label" for="privacy" id="privacy"><?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?></label>
        			<div class="controls">
        				<? $entity = @service('repos:documents.document')->getEntity()->reset() ?>
        				<?= @helper('ui.privacy', array('entity' => $entity, 'auto_submit' => false, 'options' => $actor)) ?>
        			</div>
        		</div>
                <? endif;?>

            	<div class="form-actions">
            	    <button class="btn" data-trigger="RemoveDocuments"><?= @text('LIB-AN-ACTION-CANCEL') ?></button>
            	    <button class="btn btn-primary" data-trigger="UploadDocuments"><?= @text('LIB-AN-ACTION-UPLOAD')?></button>
            	</div>
            </form>
        </div>

	</div>
</div>

<script>
$('#documents-add').documentUpload({
	filedrop : '.dropzone',
	url : "<?= @route('view=document&format=json&oid='.$actor->id) ?>",
	setsUrl : "<?= @route('view=sets&oid='.$actor->id.'&layout=add_documents') ?>",
	parallelUploads : 2,
	maxFilesize : <?= get_config_value('documents.uploadlimit', 4) ?>,
	maxFiles : 10,
	addRemoveLinks : true,
	autoQueue: false,
	acceptedFiles : 'doc/pdf',
	dictDefaultMessage : "<?= @text('COM-DOCUMENTS-UPLOAD-DROP-FILES-TO-UPLOAD') ?>",
	dictInvalidFileType : "<?= @text('COM-DOCUMENTS-UPLOAD-INVALID-FILE-TYPE') ?>",
	dictFileTooBig : "<?= sprintf(@text('COM-DOCUMENTS-UPLOAD-FILE-TOO-BIG'), get_config_value('documents.uploadlimit', 4)) ?>",
	dictRemoveFile : "<?= @text('LIB-AN-ACTION-REMOVE') ?>"
});
</script>
