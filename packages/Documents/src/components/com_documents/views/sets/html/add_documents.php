<? defined('KOOWA') or die ?>

<form id="documents-set-assignment" method="post" action="<?= @route('view=set&oid='.$actor->id) ?>">
	<? foreach ($documents as $document): ?>
	<input type="hidden" name="document_id[]" value="<?= $document->id ?>" />
	<? endforeach; ?>
	<input type="hidden" value="adddocument" name="action" />

	<?= @message(@text('COM-DOCUMENTS-SET-SELECT-SIMPLE-INSTRUCTIONS')) ?>

	<? if ($actor->sets->getTotal()) : ?>
	<div class="clearfix">
		<label><?= @text('COM-DOCUMENTS-SET-SELECT-ONE') ?></label>
		<div class="input">
			<select id="set-selector" name="id" class="input-xlarge" required>
				<option value=""><?= @text('COM-DOCUMENTS-SET-SELECT-NO-SET-IS-SELECTED') ?></option>
				<? $sets = $actor->sets->order('title'); ?>
	            <? foreach ($sets as $set): ?>
				<option value="<?= $set->id ?>"><?= @escape($set->title) ?></option>
				<? endforeach; ?>
			</select>
		</div>
	</div>
	<? endif; ?>

	<? if ($actor->authorize('action', 'com_documents:set:add')): ?>
	<div class="control-group">
		<label class="control-label" for="title"><?= @text('COM-DOCUMENTS-ACTION-OR-CREATE-A-NEW-SET') ?></label>
		<div class="controls">
			<input class="input-large" name="title" size="32" maxlength="100" type="text" required>
		</div>
	</div>
	<? endif; ?>

	<div class="form-actions">
		<a class="btn" href="<?= @route('view=documents&oid='.$actor->id) ?>"><?= @text('COM-DOCUMENTS-ACTION-NO-THANK-YOU') ?></a>
		<button class="btn btn-primary"><?= @text('COM-DOCUMENTS-ACTION-SET-ADD-DOCUMENTS') ?></button>
	</div>
</form>
