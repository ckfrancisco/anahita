<? defined('KOOWA') or die ?>

<form id="set-form" method="post" action="<?= @route('option=com_documents&view=set&oid='.$actor->id.'&layout=selector_list&reset=1') ?>">
	<input type="hidden" name="action" value="adddocument" />
	<input type="hidden" name="document_id" value="<?= $document->top()->id ?>" />

	<fieldset>
		<legend><?= @text('COM-DOCUMENTS-SET-ADD') ?></legend>
		<div class="control-group">
			<label class="control-label" for="title"><?= @text('LIB-AN-MEDIUM-TITLE') ?></label>
			<div class="controls">
				<input name="title" class="input-large" size="50" maxlength="255" type="text" required>
			</div>
		</div>

		<div class="form-actions">
			<button data-action="CloseSetSelector" class="btn">
			    <?= @text('LIB-AN-ACTION-CLOSE') ?>
			</button>
			<button type="submit" class="btn btn-primary">
				<i class="icon-plus-sign icon-white"></i>
				<?= @text('LIB-AN-ACTION-NEW') ?>
			</button>
		</div>
	</fieldset>
</form>

<h4><?= @text('COM-DOCUMENTS-SET-SELECT') ?></h4>

<?
$assigned_sets = array();
if (count($document->top()->sets)) {
    foreach ($document->top()->sets as $set) {
        $assigned_sets[] = $set->id;
    }
}
?>

<div id="sets" class="an-entities">
<? if (count($sets)): ?>
	<? foreach ($sets as $set): ?>
	<?= @view('set')->layout('selector_list')->set('set', $set)->assignedSets($assigned_sets); ?>
	<? endforeach; ?>
<? else: ?>
<?= @message(@text('LIB-AN-NODES-EMPTY-LIST-MESSAGE')) ?>
<? endif; ?>
</div>
