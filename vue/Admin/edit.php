<?php 
	if (isset($data)) 
	{
?>
	<div class="d-flex justify-content-center pb-2 pt-2">
		<div class="container-fluid col-md-4 bg-dark pb-3 pt-3">
            <h3 class="text-center">Editer l'utilisateur "
                <?php 
                    if($data->getLastName() == '' OR $data->getFirstName() == '')
                    {
                        echo 'ID : '.$data->getId();
                    }
                    else
                    {
                        echo $data->getLastName().' '.$data->getFirstName();
                    }
                ?>
            "</h3>
            <li class="list-group-item bg-dark">
                <img src="<?= WEBROOT.'img/avatar/'.$data->getAvatar(); ?>" alt="image de profil" class="d-flex img-thumbnail bg-dark border-info mb-3 mx-auto"><input type="file" class="btn btn-info btn-lg btn-block" value="Editer mon Avatar">
            </li>
            <table class="table table-striped table-dark mb-0">
                <td>
                    <ul class="list-group">
                    <form action="<?= WEBROOT ?>Admin/sendEdit/<?= $data->getId(); ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $data->getId(); ?>">
                        <li class="list-group-item bg-dark">
                            Email : <?= $data->getEmail(); ?>
                        </li>
                        <li class="list-group-item bg-dark">
                            <input type="email" name="email" class="form-control bg-dark text-light" value="<?= $data->getEmail(); ?>">
                        </li>

                        <li class="list-group-item bg-dark">
                            Nom : <?= $data->getLastName(); ?>
                        </li>
                        <li class="list-group-item bg-dark">
                            <input type="text" name="lastname" class="form-control bg-dark text-light" value="<?= $data->getLastName(); ?>">
                        </li>

                        <li class="list-group-item bg-dark">
                            Prénom : <?= $data->getFirstName(); ?>
                        </li>
                        <li class="list-group-item bg-dark">
                            <input type="text" name="firstname" class="form-control bg-dark text-light" value="<?= $data->getFirstName(); ?>">
                        </li>

                        <li class="list-group-item bg-dark">
                            Nouveau mot de passe ( Seulement si vous désirez le changer )
                        </li>
                        <li class="list-group-item bg-dark">
                            <input type="password" name="newpassword" class="form-control bg-dark text-light">
                        </li>

                        <li class="list-group-item bg-dark">
                            <input type="submit" class="btn btn-success btn-lg btn-block" value="Editer mon profil">
                        </li>
                    </form>

                    <li class="list-group-item bg-dark">
                        <a href="<?= WEBROOT ?>/Admin/delete"><input type="submit" class="btn btn-danger btn-lg btn-block" value="Supprimer le compte"></a>
                    </li>
					</td>
				</table>
		</div>
	</div>
<?php 
	}
	else
	{
		header('Location:'.WEBROOT.'Library/index');
	}
?>