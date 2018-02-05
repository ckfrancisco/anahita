<? defined('KOOWA') or die('Restricted access');?>

<? foreach ($documents as $document) : ?>
<?= @view('document')->layout('list')->document($document)->filter($filter) ?>
<? endforeach; ?>
