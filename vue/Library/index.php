<div class="container-fluid col-md-8 text-center">
  <a href="<?= WEBROOT.'Library/create' ?>"><button type="button" class="add-media btn btn-primary bg-perso btn-lg btn-block"><i class="fas fa-plus"></i> Ajouter un média</button></a>

  <table class="table table-striped table-dark mb-0">
    <thead>
      <tr>
        <th scope="col">Nom</th>
        <th scope="col">Episode</th>
        <th scope="col">Saison</th>
        <th scope="col">Note</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if (isset($library))
        {
          foreach($library as $key => $data)
          {
      ?>
      <tr>
        <td>
          <a href="<?= WEBROOT.'Library/detail/'.$data->getId(); ?>" class="color-perso"><i class="far fa-eye"></i> <?= $data->getName(); ?></a>
        </td>
        <td>
          <?= $data->getEpisode(); ?> / <?= $data->getEpmax(); ?>
        </td>
        <td>
          <?= $data->getSeason(); ?> / <?= $data->getSmax(); ?>
        </td>
        <td class="d-lg-block d-none">
          <?php
            for($i=0; $data->getEvaluation() > $i ; $i++)
            {
              if(($i % 2) !== 0)
              {
              ?>
                <img class="star-rating" src="<?= WEBROOT ?>img/star-24px.svg" alt="étoile notation">
              <?php
              }
            }
            if(($i % 2) !== 0)
            { 
              ?>
                <img class="star-rating" src="<?= WEBROOT ?>img/star_half-24px.svg" alt="étoile notation">
              <?php
            }
          ?>
        </td>
         
        <td class="d-lg-none d-block">
        <?= $data->getEvaluation(); ?>/10
        </td>
      </tr>

      <?php 	
          }
        }
      ?>
    </tbody>
  </table>
  <div class="library-border bg-perso mt-0 p-2">
    <ul class="pagination justify-content-center mb-0">
          <?php
            if($pId-1 >= 1)
            {
            ?>
             <li class="page-item">
              <a class="page-link" href="<?= WEBROOT ?>Library/index/<?= $pId-1 ?>">Previous</a>
            </li>
            <?php
            }
            else
            {
            ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Previous</a>
            </li>
            <?php
            }
            ?>
        <?php
         for($a=1; $a < $pmax; $a++)
          {
            if($pId === $a)
            {
            ?>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
              <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <?php
            }
            else
            {
            ?> <li class="page-item"><a class="page-link" href="<?= WEBROOT ?>Library/index/<?php echo $a; ?>"><?php echo $a; ?></a></li> <?php
            }
          }

          if($pId >= $pmax)
              {
              ?>
              <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
              </li>
            <?php
            }
            else
            {
            ?>
            <li class="page-item">
            <a class="page-link" href="<?= WEBROOT ?>Library/index/<?= $pId+1 ?>">Next</a>
            </li>

            <?php
            }
            ?>
    </ul>
  </div>
</div>