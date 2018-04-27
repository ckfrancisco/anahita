<? defined('KOOWA') or die('Restricted access'); ?>

<? $interests = @service('repos:interests.interests')->getEntity()->reset() ?>

<form class="composer-form" method="post" action="<?= @route() ?>">
	<fieldset>
		<legend><?=@text('COM-INTERESTS-INTERESTS-ADD')?></legend>

		<div class="control-group">
			<label class="control-label" for="interests-title"><?= @text('COM-INTERESTS-MEDIUM-TITLE') ?></label>
			<div class="controls">
				<input id="interests-title" name="title" class="input-block-level" value="<?= @escape($interests->title) ?>" size="50" maxlength="255" type="text" required autofocus />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="interests-description"><?= @text('COM-INTERESTS-MEDIUM-DESCRIPTION') ?></label>
			<div class="controls">
				<textarea id="interests-description" class="input-block-level" name="description" cols="5" rows="3" maxlength="5000" required><?= @escape($interests->description) ?></textarea>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="interests-priority"><?= @text('COM-INTERESTS-INTERESTS-PRIORITY') ?></label>
			<div class="controls">
				<?= @helper('prioritylist', $interests->priority) ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" id="privacy" ><?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?></label>
			<div class="controls">
				<?= @helper('ui.privacy', array('entity' => $interests, 'auto_submit' => false, 'options' => $actor)) ?>
			</div>
		</div>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-POSTING') ?>">
				<?= @text('LIB-AN-ACTION-ADD') ?>
			</button>
		</div>
	</fieldset>
</form>
