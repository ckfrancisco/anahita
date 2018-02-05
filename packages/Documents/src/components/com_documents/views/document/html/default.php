<? defined('KOOWA') or die; ?>

<? if ($document->authorize('edit')) : ?>

<? if (defined('ANDEBUG') && ANDEBUG) : ?>
<script src="com_documents/js/documentset.js" />
<? else: ?>
<script src="com_documents/js/min/documentset.min.js" />
<? endif; ?>

<? endif; ?>

<div class="row">
	<div class="span8">
	<?= @helper('ui.header') ?>
	<?= @template('document') ?>
	<?= @helper('ui.comments', $document) ?>
	</div>

	<div class="span4 visible-desktop">
    	<h4 class="block-title">
    	<?= @text('COM-DOCUMENTS-DOCUMENT-RELATED-SETS') ?>
    	</h4>

    	<div class="block-content">
    		<div id="sets-wrapper" data-url="<?= @route('option=com_documents&view=sets&layout=sidebar&oid='.$actor->id) ?>" data-document="<?= $document->id ?>">
            <?= @view('sets')->layout('sidebar')->set('sets', $document->sets) ?>
    		</div>
		</div>

		<h4 class="block-title">
		<?= @text('LIB-AN-META') ?>
		</h4>

      <div class="block-content">
        	<ul class="an-meta">
        		<li><?= sprintf(@text('LIB-AN-ENTITY-AUTHOR'), @date($document->creationTime), @name($document->author)) ?></li>
        		<li><?= sprintf(@text('LIB-AN-ENTITY-EDITOR'), @date($document->updateTime), @name($document->editor)) ?></li>
        		<li><?= sprintf(@text('COM-DOCUMENTS-DOCUMENT-META-SETS'), $document->sets->getTotal()) ?></li>
        		<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $document->numOfComments) ?></li>
        	</ul>
    	</div>

			<? if(count($document->locations) || $document->authorize('edit')): ?>
			<h4 class="block-title">
				<?= @text('LIB-AN-ENTITY-LOCATIONS') ?>
			</h4>

			<div class="block-content">
			<?= @location($document) ?>
			</div>
			<? endif; ?>

    	<? if ($actor->authorize('administration')) : ?>
    	<h4 class="block-title">
    	<?= @text('COM-DOCUMENTS-DOCUMENT-PRIVACY') ?>
    	</h4>

    	<div class="block-content">
    	<?= @helper('ui.privacy', $document) ?>
    	</div>
    	<? endif; ?>
	</div>
</div>
