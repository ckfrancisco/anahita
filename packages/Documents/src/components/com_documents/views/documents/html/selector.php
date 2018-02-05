<? defined('KOOWA') or die('Restricted access'); ?>

<h4><?= @text('COM-DOCUMENTS-SELECTOR-TITLE') ?></h4>

<?= @message(@text('COM-DOCUMENTS-SELECTOR-INSTRUCTIONS')) ?>

<? if (!empty($exclude_set)): ?>
<div class="form-actions">
	<a data-trigger="CloseDocumentSelector" href="#" class="btn"><?= @text('LIB-AN-ACTION-CLOSE') ?></a>
</div>
<? endif; ?>

<?
$url = array('view' => 'documents', 'layout' => 'selector_list', 'oid' => $actor->id);

if (!empty($exclude_set)) {
    $url['exclude_set'] = $exclude_set;
}
?>
<div id="document-selector-list" class="an-entities media-grid">
<?= @template('selector_list') ?>
</div>

<script>
$('#document-selector-list').infinitescroll({
	url : '<?= @route($url) ?>',
	item : '.thumbnail-wrapper',
	scrollable : '#document-selector-list',
	window: '#document-selector'
});
</script>
