<? defined('KOOWA') or die('Restricted access'); ?>

<? $tester = @service('repos:tester.tester')->getEntity()->reset() ?>

<form class="composer-form" method="post" action="<?= @route() ?>">
	<fieldset>
		<legend><?=@text('COM-TESTER-TESTER-ADD')?></legend>

		<div class="control-group">
			<label class="control-label" for="tester-title"><?= @text('COM-TESTER-MEDIUM-TITLE') ?></label>
			<div class="controls">
				<input id="tester-title" name="title" class="input-block-level" value="<?= @escape($tester->title) ?>" size="50" maxlength="255" type="text" required autofocus />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="tester-description"><?= @text('COM-TESTER-MEDIUM-DESCRIPTION') ?></label>
			<div class="controls">
				<textarea id="tester-description" class="input-block-level" name="description" cols="5" rows="3" maxlength="5000" required><?= @escape($tester->description) ?></textarea>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="tester-priority"><?= @text('COM-TESTER-TESTER-PRIORITY') ?></label>
			<div class="controls">
				<?= @helper('prioritylist', $tester->priority) ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" id="privacy" ><?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?></label>
			<div class="controls">
				<?= @helper('ui.privacy', array('entity' => $tester, 'auto_submit' => false, 'options' => $actor)) ?>
			</div>
		</div>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-POSTING') ?>">
				<?= @text('LIB-AN-ACTION-ADD') ?>
			</button>
		</div>
	</fieldset>
</form>
