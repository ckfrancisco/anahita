<? defined('KOOWA') or die('Restricted access'); ?>

<? $classes = empty($classes) ? @service('repos:classes.classes')->getEntity()->reset() : $classes; ?>

<? $url = $classes->getURL().'&oid='.$actor->id; ?>

<form method="post" action="<?= @route($url) ?>" class="an-entity">
	<fieldset>
		<legend><?= ($classes->persisted()) ? @text('COM-CLASSES-CLASSES-EDIT') : @text('COM-CLASSES-CLASSES-ADD') ?></legend>

		<div class="control-group">
			<label class="control-label" for="title"><?= @text('COM-CLASSES-MEDIUM-TITLE') ?></label>
			<div class="controls">
				<input required name="title" class="input-block-level" value="<?= @escape($classes->title) ?>" size="50" maxlength="255" type="text">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="classes-description"><?= @text('COM-CLASSES-MEDIUM-DESCRIPTION') ?></label>
			<div class="controls">
                <textarea maxlength="5000" class="input-block-level" name="description" cols="50" rows="5"><?= @escape($classes->description) ?></textarea>
            </div>
		</div>

		<div class="control-group">
			<label class="control-label" for="priority"><?= @text('COM-CLASSES-CLASSES-PRIORITY') ?></label>
			<div class="controls">
				<?= @helper('prioritylist', $classes->priority)?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" id="privacy" ><?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?></label>
			<div class="controls">
				<?= @helper('ui.privacy', array('entity' => $classes, 'auto_submit' => false, 'options' => $actor)) ?>
			</div>
		</div>

		<div class="form-actions">
			<? if ($classes->persisted()): ?>
				<? if (KRequest::type() == 'AJAX'): ?>
				<a data-action="cancel" class="btn" href="<?= @route($url.'&layout=list') ?>">
					<?= @text('LIB-AN-ACTION-CANCEL') ?>
				</a>
				<? else : ?>
				<? $cancelURL = ($classes->persisted()) ? $classes->getURL() : 'view=classes&oid='.$actor->id ?>
				<a class="btn" href="<?= @route($cancelURL) ?>">
					<?= @text('LIB-AN-ACTION-CANCEL') ?>
				</a>
				<? endif; ?>

				<button type="submit" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-UPDATING') ?>">
					<?= @text('LIB-AN-ACTION-UPDATE') ?>
				</button>
			<? else : ?>
			<a data-trigger="CancelAdd" class="btn" href="<?= @route('view=classes&oid='.$actor->id) ?>">
				<?= @text('LIB-AN-ACTION-CANCEL') ?>
			</a>

			<button data-trigger="Add" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-POSTING') ?>">
				<?= @text('LIB-AN-ACTION-ADD') ?>
			</button>
			<? endif; ?>
		</div>
	</fieldset>
</form>
