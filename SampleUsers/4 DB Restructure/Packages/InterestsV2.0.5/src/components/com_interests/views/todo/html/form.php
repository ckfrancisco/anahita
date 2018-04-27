<? defined('KOOWA') or die('Restricted access'); ?>

<? $interests = empty($interests) ? @service('repos:interests.interests')->getEntity()->reset() : $interests; ?>

<? $url = $interests->getURL().'&oid='.$actor->id; ?>

<form method="post" action="<?= @route($url) ?>" class="an-entity">
	<fieldset>
		<legend><?= ($interests->persisted()) ? @text('COM-INTERESTS-INTERESTS-EDIT') : @text('COM-INTERESTS-INTERESTS-ADD') ?></legend>

		<div class="control-group">
			<label class="control-label" for="title"><?= @text('COM-INTERESTS-MEDIUM-TITLE') ?></label>
			<div class="controls">
				<input required name="title" class="input-block-level" value="<?= @escape($interests->title) ?>" size="50" maxlength="255" type="text">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="interests-description"><?= @text('COM-INTERESTS-MEDIUM-DESCRIPTION') ?></label>
			<div class="controls">
                <textarea maxlength="5000" class="input-block-level" name="description" cols="50" rows="5"><?= @escape($interests->description) ?></textarea>
            </div>
		</div>

		<div class="control-group">
			<label class="control-label" for="priority"><?= @text('COM-INTERESTS-INTERESTS-PRIORITY') ?></label>
			<div class="controls">
				<?= @helper('prioritylist', $interests->priority)?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" id="privacy" ><?= @text('LIB-AN-PRIVACY-FORM-LABEL') ?></label>
			<div class="controls">
				<?= @helper('ui.privacy', array('entity' => $interests, 'auto_submit' => false, 'options' => $actor)) ?>
			</div>
		</div>

		<div class="form-actions">
			<? if ($interests->persisted()): ?>
				<? if (KRequest::type() == 'AJAX'): ?>
				<a data-action="cancel" class="btn" href="<?= @route($url.'&layout=list') ?>">
					<?= @text('LIB-AN-ACTION-CANCEL') ?>
				</a>
				<? else : ?>
				<? $cancelURL = ($interests->persisted()) ? $interests->getURL() : 'view=interests&oid='.$actor->id ?>
				<a class="btn" href="<?= @route($cancelURL) ?>">
					<?= @text('LIB-AN-ACTION-CANCEL') ?>
				</a>
				<? endif; ?>

				<button type="submit" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-UPDATING') ?>">
					<?= @text('LIB-AN-ACTION-UPDATE') ?>
				</button>
			<? else : ?>
			<a data-trigger="CancelAdd" class="btn" href="<?= @route('view=interests&oid='.$actor->id) ?>">
				<?= @text('LIB-AN-ACTION-CANCEL') ?>
			</a>

			<button data-trigger="Add" class="btn btn-primary" data-loading-text="<?= @text('LIB-AN-MEDIUM-POSTING') ?>">
				<?= @text('LIB-AN-ACTION-ADD') ?>
			</button>
			<? endif; ?>
		</div>
	</fieldset>
</form>
