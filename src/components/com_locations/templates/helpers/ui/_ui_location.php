<? defined('KOOWA') or die; ?>

<? if (defined('ANDEBUG') && ANDEBUG) : ?>
  <? if($entity->authorize('edit')): ?>
  <script src="com_locations/js/geoposition.js" />
  <? endif; ?>
<script src="com_locations/js/location.js" />
<? else: ?>
  <? if($entity->authorize('edit')): ?>
  <script src="com_locations/js/min/geoposition.min.js" />
  <? endif; ?>
<script src="com_locations/js/min/location.min.js" />
<? endif; ?>

<?= @map_api(array()) ?>

<? if(count($entity->locations)): ?>
<div class="map-container">
<?= @map($locations) ?>
</div>
<? endif; ?>

<? $locations_url = 'option=com_locations&view=locations&layout=list_tags&locatable_id='.$entity->id; ?>
<ul class="an-locations" id="locations-<?= $entity->id ?>" data-url="<?= @route($locations_url) ?>"></ul>

<? if($entity->authorize('edit')) : ?>
<? $selector_url = 'option=com_locations&view=locations&layout=selector&locatable_id='.$entity->id; ?>
<div class="toolbar">
  <!-- Edited by Alex: Only display the add location button if the user did not yet enter their location -->
  <? if(count($entity->locations) == 0): ?>
  	<button disabled class="btn btn-small" data-url="<?= @route($selector_url) ?>" data-trigger="LocationSelector" data-locatable="<?= $entity->id ?>">
  	+ <?= @text('LIB-AN-ACTION-ADD-LOCATION') ?>
  	</button>
  <? endif; ?>
</div>
<? endif; ?>

<!-- Added by Alex -->
<? $top_three_suggestions = array("LeBlanc", "LeBron", "LeJames"); ?>

<div class="suggestions-container">
    <div class="span4 visible-desktop">
        <h4 class="block-title"><?= @text('Suggestions') ?></h4>
        <span class="suggestions">
            <?= $top_three_suggestions[0] ?><br>
            <?= $top_three_suggestions[1] ?><br>
            <?= $top_three_suggestions[2] ?>
        </span>
    </div>
</div>