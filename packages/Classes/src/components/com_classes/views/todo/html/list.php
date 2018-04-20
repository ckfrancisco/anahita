<? defined('KOOWA') or die ?>

<? $highlight = ($classes->open) ? 'an-highlight' : '' ?>
<div class="an-entity <?= $highlight ?>">
	<div class="clearfix">
		<div class="entity-portrait-square">
			<?= @avatar($classes->author) ?>
		</div>

		<div class="entity-container">
			<h4 class="author-name">
			    <?= @name($classes->author) ?>
			</h4>

			<ul class="an-meta inline">
				<li><?= @date($classes->creationTime) ?></li>
				<? if (!$classes->owner->eql($classes->author)): ?>
				<li><?= @name($classes->owner) ?></li>
				<? endif; ?>
			</ul>
		</div>
	</div>

	<h3 class="entity-title">
		<a href="<?= @route($classes->getURL()) ?>">
		    <?= @escape($classes->title) ?>
		</a>
	</h3>

	<? if ($classes->description): ?>
	<div class="entity-description">
		<?= @helper('text.truncate', @content($classes->description), array('length' => 500, 'consider_html' => true, 'read_more' => true)); ?>
	</div>
	<? endif; ?>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li><?= @text('COM-CLASSES-CLASSES-PRIORITY') ?>: <span class="priority <?= @helper('priorityLabel', $classes) ?>"><?= @helper('priorityLabel', $classes) ?></span></li>
			<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $classes->numOfComments) ?></li>

			<? if (!$classes->open) : ?>
			<li><?= sprintf(@text('COM-CLASSES-CLASSES-COMPLETED-BY-REPORT'), @date($classes->openStatusChangeTime), @name($classes->lastChanger)) ?></li>
		<? endif; ?>
		</ul>

		<div class="an-meta" class="vote-count-wrapper" id="vote-count-wrapper-<?= $classes->id ?>">
			<?= @helper('ui.voters', $classes); ?>
		</div>
	</div>

	<div class="entity-actions">
		<?= @helper('ui.commands', @commands('list')) ?>
	</div>
</div>
