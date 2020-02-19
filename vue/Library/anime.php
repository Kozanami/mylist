<div class="container-fluid col-md-6 text-center">

<?php loadPartials('libraryTop'); ?>
    <thead>
      <tr>
        <th scope="col">Nom</th>
        <th scope="col">Episode</th>
        <th scope="col">Saison</th>
        <th scope="col">Note</th>
        <th></th>
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
              loadPartials('evaluation',$data->getEvaluation());
            ?>
        </td>
         
        <td class="d-lg-none">
        <?= $data->getEvaluation(); ?>/10
        </td>
        <td>
            <?php 
              $libraryId = $data->getId();
              if($data->getLike()){
                $type = "delete";
                $icon = "fas fa-heart";
                
              }
              else
              { 
                $type = "add";
                $icon = "far fa-heart";            
              } 
            ?>

              <a href="#" onclick="DoLike('<?= $_SESSION['id'] ?>' , '<?= $libraryId ?>', '<?= WEBROOT.'Library' ?>');">

                <i id="<?= $type.'Like'.$libraryId ?>" class="<?= $icon ?>"></i>

              </a>
            </td>
      </tr>

      <?php 	
          }
        }
      ?>
    </tbody>
  </table>
    <?php loadPartials('pagination'); ?>
</div>