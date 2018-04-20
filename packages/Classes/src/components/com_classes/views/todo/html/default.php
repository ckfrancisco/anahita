<? defined('KOOWA') or die ?>

<div class="row">
	<div class="span8">
	<?= @helper('ui.header'); ?>
	<?= @template('classes'); ?>
	<? @commands('toolbar') ?>
	<?= @helper('ui.comments', $classes, array('pagination' => true)); ?>
	</div>

	<div class="span4 visible-desktop">
		<h4 class="block-title">
		<?= @text('LIB-AN-META') ?>
		</h4>

		<div class="block-content">
    		<ul class="an-meta">
    			<? if (isset($classes->editor)) : ?>
    			<li><?= sprintf(@text('LIB-AN-ENTITY-EDITOR'), @date($classes->updateTime), @name($classes->editor)) ?></li>
    			<? endif; ?>
    			<? if (!$classes->open) : ?>
    			<li>
    				<?= sprintf(@text('COM-CLASSES-CLASSES-COMPLETED-BY-REPORT'), @date($classes->openStatusChangeTime), @name($classes->lastChanger)) ?>
    			</li>
    			<? endif; ?>
    			<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $classes->numOfComments) ?></li>
    		</ul>
		</div>

		<? if(count($classes->locations) || $classes->authorize('edit')): ?>
		<h4 class="block-title">
			<?= @text('LIB-AN-ENTITY-LOCATIONS') ?>
		</h4>

		<div class="block-content">
		<?= @location($classes) ?>
		</div>
		<? endif; ?>

		<? if ($actor->authorize('administration')): ?>
		<h4 class="block-title">
		    <?= @text('COM-CLASSES-CLASSES-PRIVACY') ?>
		</h4>

		<div class="block-content">
		    <?= @helper('ui.privacy', $classes) ?>
		</div>
		<? endif; ?>
	</div>
</div>
