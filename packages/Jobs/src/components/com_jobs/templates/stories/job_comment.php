<? defined('KOOWA') or die('Restricted access'); ?>

<data name="title">
	<?= sprintf(@text('COM-JOBS-STORY-NEW-JOB-COMMENT'), @name($subject), @route($object->getURL().'&permalink='.$comment->id)) ?>
</data>

<? if ($type != 'notification') :?>
<data name="body">
<? if (!empty($object->name)): ?>
	<h4 class="entity-title">
		<a href="<?= @route($object->getURL()) ?>">
			<?= $object->name ?>
		</a>
	</h4>
	<? endif; ?>

	<? if (!empty($object->link)): ?>
	<a class="entity-link btn" href="<?= $object->link ?>">
		<i class="icon icon-info-sign"></i>
		Link
	</a>
	<? endif; ?>

	<? if (!empty($object->startDate)) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-START-DATE') ?>
	</h5>
	<div>
		<?= date("F j Y", $object->startDate->getDate(DATE_FORMAT_UNIXTIME)) ?>
	</div>
	<? endif;?>

	<? if (!empty($object->majors)) : ?>
	<div class="entity-title">
		<h5>
			<?= @text('COM-JOBS-COMPOSER-JOB-POST-MAJORS') ?>
		</h5>
		<ul>
			<? $majors = explode("\n", $object->majors) ?>
			<? foreach ($majors as $major) : ?>
				<li><?= $major ?></li>
			<? endforeach; ?>
		</ul>
	</div>
	<? endif; ?>

	<? if (!empty($object->location)) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-LOCATION') ?>
	</h5>
	<div>
		<?= @content(nl2br($object->location), array('exclude' => 'gist')) ?>
	</div>
	<? endif;?>

	<? if (!empty($object->employment)) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-EMPLOYMENT') ?>
	</h5>
	<div>
		<?= @content(nl2br($object->employment), array('exclude' => 'gist')) ?>
	</div>
	<? endif;?>

	<? if (!empty($object->visa)) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-VISA') ?>
	</h5>
	<div>
		<?= @content(nl2br($object->visa), array('exclude' => 'gist')) ?>
	</div>
	<? endif;?>

	<? if (!empty($object->body)) : ?>
	<h5>
		<?= @text('COM-JOBS-COMPOSER-JOB-POST-DESCRIPTION') ?>
	</h5>
	<div class="entity-description">
		<?= @content(nl2br($object->body), array('exclude' => 'gist')) ?>
	</div>
	<? endif;?>

	<? if (!empty($object->filename)): ?>
	<div class="entity-portrait-medium">
		<a data-rel="story-<?= $object->id ?>" data-trigger="MediaViewer" title="<?= $object->title ?>" href="<?= $object->getPortraitURL('original'); ?>">
			<img src="<?= $object->getPortraitURL('medium') ?>" />
		</a>
	</div>
	<? endif; ?>
</data>
<? endif;?>

<? if ($type == 'notification') :?>
<? $commands->insert('viewcomment', array('label' => @text('LIB-AN-VIEW-COMMENT')))->href($object->getURL().'&permalink='.$comment->id)?>
<data name="email_body">
    <table cellspacing="0" cellpadding="0">
        <tr>
            <td valign="top" style="padding-right:10px">
                <a href="<?= @route($object->getURL().'&permalink='.$comment->id) ?>">
        			<img width="100" src="<?= $object->getPortraitURL('square') ?>" />
        		</a>
            </td>
            <td valign="top">
                <?= nl2br($comment->body) ?>
            </td>
    </table>
</data>
<? endif;?>
