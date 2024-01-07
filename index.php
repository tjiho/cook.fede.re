<?php
  $requestUri = "https://recettes.ppsfleet.navy/api/recipe/?query=&internal=false&random=false&page=1&page_size=25&sort_order=name&include_children=true";

  require 'config.php';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $requestUri);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  //  tda_c97ace6a_db2d_4535_be87_967011f4d91c
  $response = curl_exec($ch);
  // $data = unserialize($result);

  curl_close($ch);

  $data = json_decode($response, true);

?>


<?php
  include "src/template/start.php";
?>
  <h1> Liste des recettes </h1>
  <div class="recipes-list">
  <?php
  foreach ($data["results"] as $recipe){
  ?>
    <a class='recipe-link' href='/recipe.php?id=<?= $recipe['id']?>'> 
      <div class='recipe-link__name'>
      <span class='recipe-link__name__content'><?= $recipe['name']?></span> 
      </div>
      <span class='recipe-link__point'></span> 
      <span class='recipe-link__page'>Page  <?= $recipe['id']?></span>
    </a>
  <?php
  }
  ?>
  </div>

<?php
  include "src/template/end.php";
?>
