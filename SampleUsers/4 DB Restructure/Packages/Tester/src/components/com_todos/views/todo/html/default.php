<? defined('KOOWA') or die ?>

<div class="row">
	<div class="span8">
	<?= @helper('ui.header'); ?>
	<?= @template('tester'); ?>
	<? @commands('toolbar') ?>
	<?= @helper('ui.comments', $tester, array('pagination' => true)); ?>
	</div>

	<div class="span4 visible-desktop">
		<h4 class="block-title">
		<?= @text('LIB-AN-META') ?>
		</h4>

		<div class="block-content">
    		<ul class="an-meta">
    			<? if (isset($tester->editor)) : ?>
    			<li><?= sprintf(@text('LIB-AN-ENTITY-EDITOR'), @date($tester->updateTime), @name($tester->editor)) ?></li>
    			<? endif; ?>
    			<? if (!$tester->open) : ?>
    			<li>
    				<?= sprintf(@text('COM-TESTER-TESTER-COMPLETED-BY-REPORT'), @date($tester->openStatusChangeTime), @name($tester->lastChanger)) ?>
    			</li>
    			<? endif; ?>
    			<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $tester->numOfComments) ?></li>
    		</ul>
		</div>

		<? if(count($tester->locations) || $tester->authorize('edit')): ?>
		<h4 class="block-title">
			<?= @text('LIB-AN-ENTITY-LOCATIONS') ?>
		</h4>

		<div class="block-content">
		<?= @location($tester) ?>
		</div>
		<? endif; ?>

		<? if ($actor->authorize('administration')): ?>
		<h4 class="block-title">
		    <?= @text('COM-TESTER-TESTER-PRIVACY') ?>
		</h4>

		<div class="block-content">
		    <?= @helper('ui.privacy', $tester) ?>
		</div>
		<? endif; ?>
	</div>
</div>
