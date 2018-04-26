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
<div class="suggestions-container">
    <div class="span4 visible-desktop">
        <h4 class="block-title"><?= @text('Suggestions') ?></h4>

        <?php
      			$db = KService::get('anahita:database');

      			// query that retrieves the current user's location
      			// 1. Execute the query
      			// 2. Retrieve the row from the query result
      			// 3. Index the row to get the user's location
      			$current_user_query_result = $db->execute("SELECT geo_city FROM an_nodes WHERE created_by = $entity->id;");	     // 1.
      			$current_user_query_result_row = mysqli_fetch_row($current_user_query_result);								                   // 2.
      			$current_user_city = $current_user_query_result_row[0];														                               // 3.

      			// build the array for the current user
          	$current_user = array(
          		"name" => $entity->name,
              "location" => $current_user_city
            );

          	// query that retrieves the name and location of every other user
          	// in english: retrieve the user's username and location where the user is a person, the location belongs to the user, and the user is not the current user
          	$everyone_else_query = "SELECT DISTINCT user.name, user.alias, location.geo_city, location.geo_state_province FROM an_nodes AS user, an_nodes AS location ";
          	$everyone_else_query .= "WHERE user.type = 'ComActorsDomainEntityActor,ComPeopleDomainEntityPerson,com:people.domain.entity.person' ";
          	$everyone_else_query .= "AND user.id = location.created_by AND user.id <> $entity->id GROUP BY(user.name);";
          	$everyone_else_query_result = $db->execute($everyone_else_query);
          	$everyone_else_query_result_all = mysqli_fetch_all($everyone_else_query_result);

          	// initialze the array to hold the arrays of every other person
          	// i.e. an array of arrays in the form
          	// [["name": "PersonName", "location": "Place"], ["name": "OtherName", "location": "OtherPlace"], ...]
          	$everyone_else = array();

          	// loop through the query result
          	for ($i = 0; $i < count($everyone_else_query_result_all); $i++)
          	{
          		// create the array for each person
          		$person = array(
                "name" => $everyone_else_query_result_all[$i][0],
          			"alias" => $everyone_else_query_result_all[$i][1],
          			"location" => $everyone_else_query_result_all[$i][2] . ", " . $everyone_else_query_result_all[$i][3]
          		);

          		// add the person array to the super array
          		array_push($everyone_else, $person);
          	}
            
          	// encode the arrays to json, used to pass to the python script
            $json_current_user = escapeshellarg(json_encode($current_user));
            $json_everyone_else = escapeshellarg(json_encode($everyone_else));

            // for debugging, append this as another parameter to the shell_exec string: 2>&1
            // execute the python script
      			$output = shell_exec("../src/components/com_search/controllers/searching.py $json_current_user $json_everyone_else");
      			$output_decoded = json_decode($output);
  		  ?>	

        <span class="suggestions">
            <a href = "index.php/people/<? echo($output_decoded[0][0]); ?>"><? echo($output_decoded[0][1]); ?></a><br>
            <a href = "index.php/people/<? echo($output_decoded[1][0]); ?>"><? echo($output_decoded[1][1]); ?></a><br>
            <a href = "index.php/people/<? echo($output_decoded[2][0]); ?>"><? echo($output_decoded[2][1]); ?></a>
        </span>
    </div>
</div>