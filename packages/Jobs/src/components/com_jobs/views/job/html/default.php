<? defined('KOOWA') or die; ?>

<? if ($job->authorize('edit')) : ?>

<? if (defined('ANDEBUG') && ANDEBUG) : ?>
<script src="com_jobs/js/jobset.js" />
<? else: ?>
<script src="com_jobs/js/min/jobset.min.js" />
<? endif; ?>

<? endif; ?>

<div class="row">
	<div class="span8">
	<?= @helper('ui.header') ?>
	<?= @template('job') ?>
	<?= @helper('ui.comments', $job) ?>
	</div>

	<div class="span4 visible-desktop">
    	<h4 class="block-title">
    	<?= @text('COM-JOBS-JOB-RELATED-SETS') ?>
    	</h4>

    	<div class="block-content">
    		<div id="sets-wrapper" data-url="<?= @route('option=com_jobs&view=sets&layout=sidebar&oid='.$actor->id) ?>" data-job="<?= $job->id ?>">
            <?= @view('sets')->layout('sidebar')->set('sets', $job->sets) ?>
    		</div>
		</div>

		<h4 class="block-title">
		<?= @text('LIB-AN-META') ?>
		</h4>

      <div class="block-content">
        	<ul class="an-meta">
        		<li><?= sprintf(@text('LIB-AN-ENTITY-AUTHOR'), @date($job->creationTime), @name($job->author)) ?></li>
        		<li><?= sprintf(@text('LIB-AN-ENTITY-EDITOR'), @date($job->updateTime), @name($job->editor)) ?></li>
        		<li><?= sprintf(@text('COM-JOBS-JOB-META-SETS'), $job->sets->getTotal()) ?></li>
        		<li><?= sprintf(@text('LIB-AN-MEDIUM-NUMBER-OF-COMMENTS'), $job->numOfComments) ?></li>
        	</ul>
    	</div>

			<? if(count($job->locations) || $job->authorize('edit')): ?>
			<h4 class="block-title">
				<?= @text('LIB-AN-ENTITY-LOCATIONS') ?>
			</h4>

			<div class="block-content">
			<?= @location($job) ?>
			</div>
			<? endif; ?>

    	<? if ($actor->authorize('administration')) : ?>
    	<h4 class="block-title">
    	<?= @text('COM-JOBS-JOB-PRIVACY') ?>
    	</h4>

    	<div class="block-content">
    	<?= @helper('ui.privacy', $job) ?>
    	</div>
    	<? endif; ?>
	</div>
</div>
