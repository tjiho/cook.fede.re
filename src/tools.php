<?php
function generate_ingredient_line($ingredient_obj) {
    $ingredient_name = $ingredient_obj["food"]["name"];
    $ingredient_amount = $ingredient_obj["amount"];

    if($ingredient_obj["unit"])
    {
        $ingredient_unit = get_plural_form_in_french($ingredient_amount, $ingredient_obj["unit"]["name"]);
        $ingredient_str = "{$ingredient_amount} {$ingredient_unit} de {$ingredient_name}";
    } else {
        $ingredient_name_with_plural = get_plural_form_in_french($ingredient_amount, $ingredient_name);
        $ingredient_str = "{$ingredient_amount} {$ingredient_unit} de {$ingredient_name_with_plural}";
    }

    return $ingredient_str;
}


function get_plural_form_in_french($number, $noun) {

    if($number < 2) {
        return $noun;
    }

    if(strlen($noun) == 1) {
        return $noun;
    }

    
    
    $noun_divides_by_space =  explode(" ", $noun);
    $first_word = array_shift($noun_divides_by_space);
    $end_word = implode(" ", $noun_divides_by_space);

    if(str_ends_with($first_word, 'x') || str_ends_with($first_word, 's')) {
        return $noun;
    }

    if(str_ends_with($noun, 'au'))
    {
        return "{$first_word}x $end_word";
    }

    return "{$first_word}s $end_word";
}
?>