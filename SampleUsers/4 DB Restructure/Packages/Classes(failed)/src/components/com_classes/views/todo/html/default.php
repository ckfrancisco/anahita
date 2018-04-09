<? defined('KOOWA') or die ?>

<div class="row">
	<div class="span8">
	<?= @helper('ui.header'); ?>
	<?= @template('class'); ?>
	<? @commands('toolbar') ?>
	<?= @helper('ui.comments', $class, array('pagination' => true)); ?>
	</div>

	<div class="span4 visible-desktop">
		<h4 class="block-title">
		<?= @text('LIB-AN-META') ?>
		</h4>

		<div class="block-content">
    		<ul class="an-meta">
    			<? if (isset($class->editor)) : ?>
    			<li><?= sprintf(@text('LIB-AN-ENTITY-EDITOR'), @date($class->updateTime), @name($class->editor)) ?></li>
    			<? endif; ?>
    			<? if (!$class->open) : ?>
    			<li>
    				<?= sprintf(@text('COM-CLASSES-CLASS-COMPLETED-BY-REPORT'), @date($class->openStatusChangeTime), @name($class->lastChanger)) ?>
    			</li>
    			<? endif; ?>
    			<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $class->numOfComments) ?></li>
    		</ul>
		</div>

		<? if(count($class->locations) || $class->authorize('edit')): ?>
		<h4 class="block-title">
			<?= @text('LIB-AN-ENTITY-LOCATIONS') ?>
		</h4>

		<div class="block-content">
		<?= @location($class) ?>
		</div>
		<? endif; ?>

		<? if ($actor->authorize('administration')): ?>
		<h4 class="block-title">
		    <?= @text('COM-CLASSES-CLASS-PRIVACY') ?>
		</h4>

		<div class="block-content">
		    <?= @helper('ui.privacy', $class) ?>
		</div>
		<? endif; ?>
	</div>
</div>
