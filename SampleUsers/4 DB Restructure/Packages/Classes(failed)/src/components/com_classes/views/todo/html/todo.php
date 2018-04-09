<? defined('KOOWA') or die('Restricted access') ?>

<? $highlight = ($class->open) ? 'an-highlight' : '' ?>
<div class="an-entity <?= $highlight ?>">
	<div class="clearfix">
		<div class="entity-portrait-square"><?= @avatar($class->author) ?></div>

		<div class="entity-container">
			<h4 class="author-name"><?= @name($class->author) ?></h4>
			<div class="an-meta">
				<?= @date($class->creationTime) ?>
			</div>
		</div>
	</div>

	<h3 class="entity-title"><?= @escape($class->title) ?></h3>

	<? if ($class->description): ?>
	<div class="entity-description">
	<?= @content(nl2br($class->description)); ?>
	</div>
	<? endif; ?>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li><?= @text('COM-CLASSES-CLASS-PRIORITY') ?>: <span class="priority <?= @helper('priorityLabel', $class) ?>"><?= @helper('priorityLabel', $class) ?></span></li>
		</ul>

		<div class="an-meta" class="vote-count-wrapper" id="vote-count-wrapper-<?= $class->id ?>">
			<?= @helper('ui.voters', $class); ?>
		</div>
	</div>
</div>
