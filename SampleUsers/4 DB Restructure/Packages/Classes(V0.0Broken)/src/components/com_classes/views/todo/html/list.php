<? defined('KOOWA') or die ?>

<? $highlight = ($class->open) ? 'an-highlight' : '' ?>
<div class="an-entity <?= $highlight ?>">
	<div class="clearfix">
		<div class="entity-portrait-square">
			<?= @avatar($class->author) ?>
		</div>

		<div class="entity-container">
			<h4 class="author-name">
			    <?= @name($class->author) ?>
			</h4>

			<ul class="an-meta inline">
				<li><?= @date($class->creationTime) ?></li>
				<? if (!$class->owner->eql($class->author)): ?>
				<li><?= @name($class->owner) ?></li>
				<? endif; ?>
			</ul>
		</div>
	</div>

	<h3 class="entity-title">
		<a href="<?= @route($class->getURL()) ?>">
		    <?= @escape($class->title) ?>
		</a>
	</h3>

	<? if ($class->description): ?>
	<div class="entity-description">
		<?= @helper('text.truncate', @content($class->description), array('length' => 500, 'consider_html' => true, 'read_more' => true)); ?>
	</div>
	<? endif; ?>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li><?= @text('COM-CLASSES-CLASS-PRIORITY') ?>: <span class="priority <?= @helper('priorityLabel', $class) ?>"><?= @helper('priorityLabel', $class) ?></span></li>
			<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $class->numOfComments) ?></li>

			<? if (!$class->open) : ?>
			<li><?= sprintf(@text('COM-CLASSES-CLASS-COMPLETED-BY-REPORT'), @date($class->openStatusChangeTime), @name($class->lastChanger)) ?></li>
		<? endif; ?>
		</ul>

		<div class="an-meta" class="vote-count-wrapper" id="vote-count-wrapper-<?= $class->id ?>">
			<?= @helper('ui.voters', $class); ?>
		</div>
	</div>

	<div class="entity-actions">
		<?= @helper('ui.commands', @commands('list')) ?>
	</div>
</div>
