<? defined('KOOWA') or die('Restricted access');?>

<? foreach ($jobs as $job) : ?>
<?= @view('job')->layout('list')->job($job)->filter($filter) ?>
<? endforeach; ?>
