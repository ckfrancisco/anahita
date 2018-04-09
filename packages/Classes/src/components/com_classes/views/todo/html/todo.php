<? defined('KOOWA') or die('Restricted access') ?>

<? $highlight = ($classes->open) ? 'an-highlight' : '' ?>
<div class="an-entity <?= $highlight ?>">
	<div class="clearfix">
		<div class="entity-portrait-square"><?= @avatar($classes->author) ?></div>

		<div class="entity-container">
			<h4 class="author-name"><?= @name($classes->author) ?></h4>
			<div class="an-meta">
				<?= @date($classes->creationTime) ?>
			</div>
		</div>
	</div>

	<h3 class="entity-title"><?= @escape($classes->title) ?></h3>

	<? if ($classes->description): ?>
	<div class="entity-description">
	<?= @content(nl2br($classes->description)); ?>
	</div>
	<? endif; ?>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li><?= @text('COM-CLASSES-CLASSES-PRIORITY') ?>: <span class="priority <?= @helper('priorityLabel', $classes) ?>"><?= @helper('priorityLabel', $classes) ?></span></li>
		</ul>

		<div class="an-meta" class="vote-count-wrapper" id="vote-count-wrapper-<?= $classes->id ?>">
			<?= @helper('ui.voters', $classes); ?>
		</div>
	</div>
</div>
