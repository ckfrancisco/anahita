<? defined('KOOWA') or die('Restricted access'); ?>

<h4><?= @text('COM-JOBS-SELECTOR-TITLE') ?></h4>

<?= @message(@text('COM-JOBS-SELECTOR-INSTRUCTIONS')) ?>

<? if (!empty($exclude_set)): ?>
<div class="form-actions">
	<a data-trigger="CloseJobSelector" href="#" class="btn"><?= @text('LIB-AN-ACTION-CLOSE') ?></a>
</div>
<? endif; ?>

<?
$url = array('view' => 'jobs', 'layout' => 'selector_list', 'oid' => $actor->id);

if (!empty($exclude_set)) {
    $url['exclude_set'] = $exclude_set;
}
?>
<div id="job-selector-list" class="an-entities media-grid">
<?= @template('selector_list') ?>
</div>

<script>
$('#job-selector-list').infinitescroll({
	url : '<?= @route($url) ?>',
	item : '.thumbnail-wrapper',
	scrollable : '#job-selector-list',
	window: '#job-selector'
});
</script>
