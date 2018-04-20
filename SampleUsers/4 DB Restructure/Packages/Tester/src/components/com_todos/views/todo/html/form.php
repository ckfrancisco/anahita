<? defined('KOOWA') or die('Restricted access'); ?>

<? $tester = empty($tester) ? @service('repos:tester.tester')->getEntity()->reset() : $tester; ?>

<? $url = $tester->getURL().'&oid='.$actor->id; ?>

<form method="post" action="<?= @route($url) ?>" class="an-entity">
	<fieldset>
		<legend><?= ($tester->persisted()) ? @text('COM-TESTER-TESTER-EDIT') : @text('COM-TESTER-TESTER-ADD') ?></legend>

		<div class="control-group">
			<label class="control-label" for="title"><?= @text('COM-TESTER-MEDIUM-TITLE') ?></label>
			<div class="controls">
				<input required name="title" class="input-block-level" value="<?= @escape($tester->title) ?>" size="50" maxlength="255" type="text">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="tester-description"><?= @text('COM-TESTER-MEDIUM-DESCRIPTION') ?></label>
			<div class="controls">
                <textarea maxlength="5000" class="input-block-level" name="description" cols="50" rows="5"><?= @escape($tester->description) ?></textarea>
            </div>
		</div>

		<div class="control-group">
			<label class="control-label" for="priority"><?= @text('COM-TESTER-TESTER-PRIORITY') ?></label>
			<div class="controls">
				<?= @helper('prioritylist', $tester->priority)?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" id="privacy" ><?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?></label>
			<div class="controls">
				<?= @helper('ui.privacy', array('entity' => $tester, 'auto_submit' => false, 'options' => $actor)) ?>
			</div>
		</div>

		<div class="form-actions">
			<? if ($tester->persisted()): ?>
				<? if (KRequest::type() == 'AJAX'): ?>
				<a data-action="cancel" class="btn" href="<?= @route($url.'&layout=list') ?>">
					<?= @text('LIB-AN-ACTION-CANCEL') ?>
				</a>
				<? else : ?>
				<? $cancelURL = ($tester->persisted()) ? $tester->getURL() : 'view=tester&oid='.$actor->id ?>
				<a class="btn" href="<?= @route($cancelURL) ?>">
					<?= @text('LIB-AN-ACTION-CANCEL') ?>
				</a>
				<? endif; ?>

				<button type="submit" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-UPDATING') ?>">
					<?= @text('LIB-AN-ACTION-UPDATE') ?>
				</button>
			<? else : ?>
			<a data-trigger="CancelAdd" class="btn" href="<?= @route('view=tester&oid='.$actor->id) ?>">
				<?= @text('LIB-AN-ACTION-CANCEL') ?>
			</a>

			<button data-trigger="Add" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-POSTING') ?>">
				<?= @text('LIB-AN-ACTION-ADD') ?>
			</button>
			<? endif; ?>
		</div>
	</fieldset>
</form>
