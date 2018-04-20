<? defined('KOOWA') or die ?>

<div class="row">
	<div class="span8">
	<?= @helper('ui.header'); ?>
	<?= @template('interests'); ?>
	<? @commands('toolbar') ?>
	<?= @helper('ui.comments', $interests, array('pagination' => true)); ?>
	</div>

	<div class="span4 visible-desktop">
		<h4 class="block-title">
		<?= @text('LIB-AN-META') ?>
		</h4>

		<div class="block-content">
    		<ul class="an-meta">
    			<? if (isset($interests->editor)) : ?>
    			<li><?= sprintf(@text('LIB-AN-ENTITY-EDITOR'), @date($interests->updateTime), @name($interests->editor)) ?></li>
    			<? endif; ?>
    			<? if (!$interests->open) : ?>
    			<li>
    				<?= sprintf(@text('COM-INTERESTS-INTERESTS-COMPLETED-BY-REPORT'), @date($interests->openStatusChangeTime), @name($interests->lastChanger)) ?>
    			</li>
    			<? endif; ?>
    			<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $interests->numOfComments) ?></li>
    		</ul>
		</div>

		<? if(count($interests->locations) || $interests->authorize('edit')): ?>
		<h4 class="block-title">
			<?= @text('LIB-AN-ENTITY-LOCATIONS') ?>
		</h4>

		<div class="block-content">
		<?= @location($interests) ?>
		</div>
		<? endif; ?>

		<? if ($actor->authorize('administration')): ?>
		<h4 class="block-title">
		    <?= @text('COM-INTERESTS-INTERESTS-PRIVACY') ?>
		</h4>

		<div class="block-content">
		    <?= @helper('ui.privacy', $interests) ?>
		</div>
		<? endif; ?>
	</div>
</div>
