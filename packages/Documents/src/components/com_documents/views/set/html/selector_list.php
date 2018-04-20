<? defined('KOOWA') or die ?>

<?
if (!isset($assigned_sets)) {
    $assigned_sets = array();
    if (count($document->top()->sets)) {
        foreach ($document->top()->sets as $set) {
            $assigned_sets[] = $set->id;
        }
    }
}

$highlight = (in_array($set->id, $assigned_sets)) ? true : false;
$action = (in_array($set->id, $assigned_sets)) ? 'removedocument' : 'adddocument';
?>

<div class="an-entity an-entity-select-option <?= ($highlight) ? 'an-highlight' : '' ?>" data-action="<?= $action ?>" data-url="<?= @route($set->getURL()) ?>" >
	<div class="entity-portrait-square">
		<img src="<?= $set->getCoverSource('square') ?>" />
	</div>

	<div class="entity-container">
		<h4 class="entity-title">
			<?= @helper('text.truncate',  @escape($set->title), array('length' => 25, 'omission' => '...')) ?>
		</h4>

		<div class="entity-meta">
			<?= sprintf(@text('COM-DOCUMENTS-SET-META-DOCUMENTS'), $set->getDocumentCount()) ?>
		</div>
	</div>
</div>
