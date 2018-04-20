<? defined('KOOWA') or die('Restricted access'); ?>

<? $classes = @service('repos:classes.classes')->getEntity()->reset() ?>

<form class="composer-form" method="post" action="<?= @route() ?>">
	<fieldset>
		<legend><?=@text('COM-CLASSES-CLASSES-ADD')?></legend>

		<div class="control-group">
			<label class="control-label" for="classes-title"><?= @text('COM-CLASSES-MEDIUM-TITLE') ?></label>
			<div class="controls">
				<input id="classes-title" name="title" class="input-block-level" value="<?= @escape($classes->title) ?>" size="50" maxlength="255" type="text" required autofocus />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="classes-description"><?= @text('COM-CLASSES-MEDIUM-DESCRIPTION') ?></label>
			<div class="controls">
				<textarea id="classes-description" class="input-block-level" name="description" cols="5" rows="3" maxlength="5000" required><?= @escape($classes->description) ?></textarea>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="classes-priority"><?= @text('COM-CLASSES-CLASSES-PRIORITY') ?></label>
			<div class="controls">
				<?= @helper('prioritylist', $classes->priority) ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" id="privacy" ><?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?></label>
			<div class="controls">
				<?= @helper('ui.privacy', array('entity' => $classes, 'auto_submit' => false, 'options' => $actor)) ?>
			</div>
		</div>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-POSTING') ?>">
				<?= @text('LIB-AN-ACTION-ADD') ?>
			</button>
		</div>
	</fieldset>
</form>
