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


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>cook.fede.re</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="recipe-list-page">
 <h1> Cook.fede.re </h1>
 <?php
 foreach ($data["results"] as $recipe){
   echo "<a class='recipe-link' href='/recipe.php?id={$recipe['id']}'> {$recipe['name']} 🔗 </a>";
 }
 ?>
</body>
</html>
