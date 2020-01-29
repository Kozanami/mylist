
<?php 
	// if (isset($data)) 
	// {	
?>
<div class="container-fluid col-md-6 text-center">
<div class="add-media bg-info mt-0 p-2"></div>
<table class="table table-dark mb-0 table-hover">
    <thead>
      <tr>
        <th scope="col">Nom & Prénom</th>
        <th scope="col">Email</th>
        <th scope="col">Statut</th>
        <th scope="col">Editer</th>
        <th scope="col">Supprimer</th>
      </tr>
    </thead>
    <tbody>
    <?php
        foreach($data as $dataforeach)
        {
    ?>
      <tr>
        <td>
            <?= $dataforeach->getLastName().' '.$dataforeach->getFirstName(); ?>
        </td>
        <td>
            <?= $dataforeach->getEmail(); ?>
        </td>
        <td>
            <?= $dataforeach->getStatut(); ?>
        </td>
        <td>
            <a href="<?= WEBROOT ?>/Admin/edit/<?= $dataforeach->getId(); ?>"><i class="fas fa-edit"></i></a>
        </td>
        <td>
            <a href="<?= WEBROOT ?>/Admin/delete/<?= $dataforeach->getId(); ?>"><i class="fas fa-trash-alt"></i></a>
        </td>
      </tr>
    <?php
        }
    ?>
    </tbody>
  </table>
    <?php loadPartials('pagination'); ?>
</div>
<?php 
	// }
	// else
	// {
	// 	header('Location:'.WEBROOT.'Library/index');
	// }
?>