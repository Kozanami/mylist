<?php
    for($i=0; $data> $i ; $i++)
    {
        // si $i est divisable par 2 et qu'il n'est pas égale à false alors ...
        if(($i % 2) !== 0)
        {
            ?> <img class="star-rating" src="<?= WEBROOT ?>img/gold_star_2.svg" alt="étoile de notation"> <?php
        }
    }
    // si $i est divisable par 2 et qu'il n'est pas égale à false alors ...
    if(($i % 2) !== 0)
    { 
        ?> <img class="star-rating" src="<?= WEBROOT ?>img/gold_star_1.svg" alt="étoile de notation"> <?php
    }
    
    // tant que $i n'est pas égale à 10 ou supérieur à 10
    while(($i != 10) OR ($i > 10))
    {
        $i++;
        if(($i % 2) !== 0)
        {
            ?> <img class="star-rating" src="<?= WEBROOT ?>img/empty_star_1.svg" alt="étoile de notation"> <?php
        }
    }
?>