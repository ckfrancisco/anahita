<? defined('KOOWA') or die('Restricted access');?>

<? if (count($jobs)) : ?>
<?
$url['layout'] = 'list';

if (isset($filter)) {
    $url['filter'] = $filter;
} elseif (isset($actor)) {
    $url['oid'] = $actor->id;
}
?>

<?= @infinitescroll(null, array(
  'url' => $url,
  'id' => 'an-jobs'
)) ?>
<? else: ?>
<?= @message(@text('LIB-AN-NODES-EMPTY-LIST-MESSAGE')) ?>
<? endif; ?>
