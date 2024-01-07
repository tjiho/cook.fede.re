<?php
  require 'config.php';
  require 'src/tools.php';

  $id = $_GET["id"];

  $requestUri = "https://recettes.ppsfleet.navy/api/recipe/{$id}/";

  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $requestUri);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  //  tda_c97ace6a_db2d_4535_be87_967011f4d91c
  $response = curl_exec($ch);
  // $data = unserialize($result);

  curl_close($ch);

  $data = json_decode($response, true);

  $recipe_name = $data['name'];
  $recipes_ingredients = array();
  $recipes_instructions = array();
  $servings = $data['servings'];

  foreach ($data['steps'] as $step){
    //$recipes_ingredients = array_merge($recipes_ingredients, $step['ingredients']);
    foreach ($step['ingredients'] as $ingredient_obj) {
      $ingredient_str = generate_ingredient_line($ingredient_obj);
      array_push($recipes_ingredients, $ingredient_str);
    }


    array_push($recipes_instructions, $step['ingredients_markdown']);
  }

  //print_r($recipes_ingredients);

?>



<?php
  include "src/template/start.php";
?>
  <div id="recipe-page">
    <aside>
      <div class="citation">
        <div class="citation-content">Un gateau typique des vacances chez les grands parents</div>
      </div>
      <div class="information">
        <h2>Portions</h2>
        <div><?= $servings ?> personnes</div>
      </div>
      <div class="ingredients">
        <h2>Ingrédients</h2>
        <ul>
        <?php
        foreach ($recipes_ingredients as $ingredient_line){
          echo "<li> $ingredient_line </li>";
        }
        ?>
        </ul>
      </div>
    </aside>
    <section id="right-part">
      <h1><?= $recipe_name ?></h1>
      <div class="recipe">
        <?php
          foreach ($recipes_instructions as $instruction_line){
            echo "<div class='recipe-step'> $instruction_line </div>";
          }
        ?>
        <!-- <h3>Étape 1</h3>
        <p>Faire fondre le chocolat dans le lait.</p>
        <h3>Étape 2</h3>
        <p>Ajouter la semoule en remuant.</p>
        <h3>Étape 3</h3>
        <p>Faire cuire 8 minutes.</p> -->
      </div>
    </section>
  </div>
<?php
  include "src/template/end.php";
?>
