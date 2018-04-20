<? defined('KOOWA') or die('Restricted access') ?>

<? $highlight = ($tester->open) ? 'an-highlight' : '' ?>
<div class="an-entity <?= $highlight ?>">
	<div class="clearfix">
		<div class="entity-portrait-square"><?= @avatar($tester->author) ?></div>

		<div class="entity-container">
			<h4 class="author-name"><?= @name($tester->author) ?></h4>
			<div class="an-meta">
				<?= @date($tester->creationTime) ?>
			</div>
		</div>
	</div>

	<h3 class="entity-title"><?= @escape($tester->title) ?></h3>

	<? if ($tester->description): ?>
	<div class="entity-description">
	<?= @content(nl2br($tester->description)); ?>
	</div>
	<? endif; ?>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li><?= @text('COM-TESTER-TESTER-PRIORITY') ?>: <span class="priority <?= @helper('priorityLabel', $tester) ?>"><?= @helper('priorityLabel', $tester) ?></span></li>
		</ul>

		<div class="an-meta" class="vote-count-wrapper" id="vote-count-wrapper-<?= $tester->id ?>">
			<?= @helper('ui.voters', $tester); ?>
		</div>
	</div>
</div>
