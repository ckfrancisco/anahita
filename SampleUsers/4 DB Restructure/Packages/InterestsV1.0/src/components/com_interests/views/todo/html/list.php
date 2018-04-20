<? defined('KOOWA') or die ?>

<? $highlight = ($interests->open) ? 'an-highlight' : '' ?>
<div class="an-entity <?= $highlight ?>">
	<div class="clearfix">
		<div class="entity-portrait-square">
			<?= @avatar($interests->author) ?>
		</div>

		<div class="entity-container">
			<h4 class="author-name">
			    <?= @name($interests->author) ?>
			</h4>

			<ul class="an-meta inline">
				<li><?= @date($interests->creationTime) ?></li>
				<? if (!$interests->owner->eql($interests->author)): ?>
				<li><?= @name($interests->owner) ?></li>
				<? endif; ?>
			</ul>
		</div>
	</div>

	<h3 class="entity-title">
		<a href="<?= @route($interests->getURL()) ?>">
		    <?= @escape($interests->title) ?>
		</a>
	</h3>

	<? if ($interests->description): ?>
	<div class="entity-description">
		<?= @helper('text.truncate', @content($interests->description), array('length' => 500, 'consider_html' => true, 'read_more' => true)); ?>
	</div>
	<? endif; ?>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li><?= @text('COM-INTERESTS-INTERESTS-PRIORITY') ?>: <span class="priority <?= @helper('priorityLabel', $interests) ?>"><?= @helper('priorityLabel', $interests) ?></span></li>
			<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $interests->numOfComments) ?></li>

			<? if (!$interests->open) : ?>
			<li><?= sprintf(@text('COM-INTERESTS-INTERESTS-COMPLETED-BY-REPORT'), @date($interests->openStatusChangeTime), @name($interests->lastChanger)) ?></li>
		<? endif; ?>
		</ul>

		<div class="an-meta" class="vote-count-wrapper" id="vote-count-wrapper-<?= $interests->id ?>">
			<?= @helper('ui.voters', $interests); ?>
		</div>
	</div>

	<div class="entity-actions">
		<?= @helper('ui.commands', @commands('list')) ?>
	</div>
</div>
