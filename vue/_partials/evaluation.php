<?php
    for($i=0; $data> $i ; $i++)
    {
        // si $i est divisable par 2 et qu'il n'est pas égale à false alors ...
        if(($i % 2) !== 0)
        {
            ?> <span class="gold-star"><i class="fas fa-star gold-star"></i></span> <?php
        }
    }
    // si $i est divisable par 2 et qu'il n'est pas égale à false alors ...
    if(($i % 2) !== 0)
    { 
        ?> <span class="gold-star"><i class="fas fa-star-half-alt"></i></span> <?php
    }
    
    // tant que $i n'est pas égale à 10 ou supérieur à 10
    while(($i != 10) OR ($i > 10))
    {
        $i++;
        if(($i % 2) !== 0)
        {
            ?> <span class="empty-star"><i class="far fa-star"></i></span><?php
        }
    }
?>