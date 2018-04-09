<? defined('KOOWA') or die('Restricted access'); ?>

<? $class = @service('repos:classes.class')->getEntity()->reset() ?>

<form class="composer-form" method="post" action="<?= @route() ?>">
	<fieldset>
		<legend><?=@text('COM-CLASSES-CLASS-ADD')?></legend>

		<div class="control-group">
			<label class="control-label" for="class-title"><?= @text('COM-CLASSES-MEDIUM-TITLE') ?></label>
			<div class="controls">
				<input id="class-title" name="title" class="input-block-level" value="<?= @escape($class->title) ?>" size="50" maxlength="255" type="text" required autofocus />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="class-description"><?= @text('COM-CLASSES-MEDIUM-DESCRIPTION') ?></label>
			<div class="controls">
				<textarea id="class-description" class="input-block-level" name="description" cols="5" rows="3" maxlength="5000" required><?= @escape($class->description) ?></textarea>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="class-priority"><?= @text('COM-CLASSES-CLASS-PRIORITY') ?></label>
			<div class="controls">
				<?= @helper('prioritylist', $class->priority) ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" id="privacy" ><?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?></label>
			<div class="controls">
				<?= @helper('ui.privacy', array('entity' => $class, 'auto_submit' => false, 'options' => $actor)) ?>
			</div>
		</div>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-POSTING') ?>">
				<?= @text('LIB-AN-ACTION-ADD') ?>
			</button>
		</div>
	</fieldset>
</form>
