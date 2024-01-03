<?php
  $requestUri = "https://recettes.ppsfleet.navy/api/recipe/4/";
  $headers = array(
      'Authorization: Bearer tda_c97ace6a_db2d_4535_be87_967011f4d91c',
  );
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $requestUri);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  //  tda_c97ace6a_db2d_4535_be87_967011f4d91c
  $response = curl_exec($ch);
  // $data = unserialize($result);
  
  curl_close($ch);

  $data = json_decode($response, true);

  $recette_name = $data['name'];
  $recettes_ingredients = array();
  $recettes_instructions = array();
  $servings = $data['servings'];
  
  foreach ($data['steps'] as $step){
    //$recettes_ingredients = array_merge($recettes_ingredients, $step['ingredients']);
    foreach ($step['ingredients'] as $ingredient_obj) {
      // todo: put in a function
      $ingredient_name = $ingredient_obj["food"]["name"];
      $ingredient_unit = $ingredient_obj["unit"]["name"];
      $ingredient_amount = $ingredient_obj["amount"];
      $ingredient_str = "{$ingredient_amount} {$ingredient_unit} de {$ingredient_name}";
      array_push($recettes_ingredients, $ingredient_str);
    }


    array_push($recettes_instructions, $step['ingredients_markdown']);
  }

  //print_r($recettes_ingredients);

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>cook.fede.re</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="recette-page">
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
      foreach ($recettes_ingredients as $ingredient_line){
        echo "<li> $ingredient_line </li>";
      }
      ?>
      </ul>
    </div>
  </aside>
  <section id="right-part">
    <h1><?= $recette_name ?></h1>
    <div class="recette">
      <?php
        foreach ($recettes_instructions as $instruction_line){
          echo "<p> $instruction_line </p>";
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
</body>
</html>
