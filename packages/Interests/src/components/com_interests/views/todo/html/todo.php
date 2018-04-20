<? defined('KOOWA') or die('Restricted access') ?>

<? $highlight = ($interests->open) ? 'an-highlight' : '' ?>
<div class="an-entity <?= $highlight ?>">
	<div class="clearfix">
		<div class="entity-portrait-square"><?= @avatar($interests->author) ?></div>

		<div class="entity-container">
			<h4 class="author-name"><?= @name($interests->author) ?></h4>
			<div class="an-meta">
				<?= @date($interests->creationTime) ?>
			</div>
		</div>
	</div>

	<h3 class="entity-title"><?= @escape($interests->title) ?></h3>

	<? if ($interests->description): ?>
	<div class="entity-description">
	<?= @content(nl2br($interests->description)); ?>
	</div>
	<? endif; ?>

	<div class="entity-meta">
		<ul class="an-meta inline">
			<li><?= @text('COM-INTERESTS-INTERESTS-PRIORITY') ?>: <span class="priority <?= @helper('priorityLabel', $interests) ?>"><?= @helper('priorityLabel', $interests) ?></span></li>
		</ul>

		<div class="an-meta" class="vote-count-wrapper" id="vote-count-wrapper-<?= $interests->id ?>">
			<?= @helper('ui.voters', $interests); ?>
		</div>
	</div>
</div>
