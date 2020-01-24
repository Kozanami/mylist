<div class="container-fluid col-md-6 text-center">
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
              loadPartials('evaluation',$data->getEvaluation());
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
    <?php loadPartials('pagination'); ?>
</div>