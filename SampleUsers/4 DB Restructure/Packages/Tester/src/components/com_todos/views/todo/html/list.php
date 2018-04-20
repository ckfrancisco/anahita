<? defined('KOOWA') or die ?>

<? $highlight = ($tester->open) ? 'an-highlight' : '' ?>
<div class="an-entity <?= $highlight ?>">
	<div class="clearfix">
		<div class="entity-portrait-square">
			<?= @avatar($tester->author) ?>
		</div>

		<div class="entity-container">
			<h4 class="author-name">
			    <?= @name($tester->author) ?>
			</h4>

			<ul class="an-meta inline">
				<li><?= @date($tester->creationTime) ?></li>
				<? if (!$tester->owner->eql($tester->author)): ?>
				<li><?= @name($tester->owner) ?></li>
				<? endif; ?>
			</ul>
		</div>
	</div>

	<h3 class="entity-title">
		<a href="<?= @route($tester->getURL()) ?>">
		    <?= @escape($tester->title) ?>
		</a>
	</h3>

	<? if ($tester->description): ?>
	<div class="entity-description">
		<?= @helper('text.truncate', @content($tester->description), array('length' => 500, 'consider_html' => true, 'read_more' => true)); ?>
	</div>
	<? endif; ?>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li><?= @text('COM-TESTER-TESTER-PRIORITY') ?>: <span class="priority <?= @helper('priorityLabel', $tester) ?>"><?= @helper('priorityLabel', $tester) ?></span></li>
			<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $tester->numOfComments) ?></li>

			<? if (!$tester->open) : ?>
			<li><?= sprintf(@text('COM-TESTER-TESTER-COMPLETED-BY-REPORT'), @date($tester->openStatusChangeTime), @name($tester->lastChanger)) ?></li>
		<? endif; ?>
		</ul>

		<div class="an-meta" class="vote-count-wrapper" id="vote-count-wrapper-<?= $tester->id ?>">
			<?= @helper('ui.voters', $tester); ?>
		</div>
	</div>

	<div class="entity-actions">
		<?= @helper('ui.commands', @commands('list')) ?>
	</div>
</div>
