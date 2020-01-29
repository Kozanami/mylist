<?php 
	if (isset($user)) 
	{
		
?>
	<div class="d-flex justify-content-center pb-2 pt-2">
		<div class="container-fluid col-md-4 bg-dark pb-3 pt-3">
				<li class="list-group-item bg-dark">
					<img src="<?= WEBROOT.'img/avatar/'.$user->getAvatar(); ?>" alt="image de profil" class="d-flex img-thumbnail bg-dark border-info mb-3 mx-auto"><input type="file" class="btn btn-info btn-lg btn-block" value="Editer mon Avatar">
				</li>
				<table class="table table-striped table-dark mb-0">
					<td>
						<ul class="list-group">
						<form action="<?= WEBROOT ?>User/edit" method="POST">
							<li class="list-group-item bg-dark">
								Email : <?= $user->getEmail(); ?>
							</li>
							<li class="list-group-item bg-dark">
								<input type="email" name="email" class="form-control bg-dark text-light" value="<?= $user->getEmail(); ?>">
							</li>

							<li class="list-group-item bg-dark">
								Nom : <?= $user->getLastName(); ?>
							</li>
							<li class="list-group-item bg-dark">
								<input type="text" name="lastname" class="form-control bg-dark text-light" value="<?= $user->getLastName(); ?>">
							</li>

							<li class="list-group-item bg-dark">
								Prénom : <?= $user->getFirstName(); ?>
							</li>
							<li class="list-group-item bg-dark">
								<input type="text" name="firstname" class="form-control bg-dark text-light" value="<?= $user->getFirstName(); ?>">
							</li>

							<li class="list-group-item bg-dark">
								Nouveau mot de passe ( Seulement si vous désirez le changer )
							</li>
							<li class="list-group-item bg-dark">
								<input type="password" name="newpassword" class="form-control bg-dark text-light">
							</li>

							<li class="list-group-item bg-dark">
								Votre mot de passe
							</li>
							<li class="list-group-item bg-dark">
								<input type="password" name="password" class="form-control bg-dark text-light">
							</li>
							<li class="list-group-item bg-dark">
								<input type="submit" class="btn btn-success btn-lg btn-block" value="Editer mon profil">
							</li>
						</form>

						<li class="list-group-item bg-dark">
							<a href="<?= WEBROOT ?>/User/delete"><input type="submit" class="btn btn-danger btn-lg btn-block" value="Supprimer mon compte"></a>
						</li>
						</ul>
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