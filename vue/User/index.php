<?php 
	if (isset($user)) 
	{
		
?>
	<div class="d-flex justify-content-center pb-2 pt-2">
		<div class="container-fluid col-md-4 bg-dark pb-3 pt-3">
				<li class="list-group-item bg-dark">
					<img src="<?php echo WEBROOT.'img/avatar/'.$user->getAvatar(); ?>" alt="image de profil" class="d-flex img-thumbnail bg-dark border-info mb-3 mx-auto"><input type="file" class="btn btn-info btn-lg btn-block" value="Editer mon Avatar">
				</li>
				<table class="table table-striped table-dark mb-0">
					<td>
						<ul class="list-group">
						<form action="">
						<li class="list-group-item bg-dark">
							Email : <?php echo $user->getEmail(); ?>
						</li>
						<li class="list-group-item bg-dark">
							<input type="text" class="form-control bg-dark text-light" value="<?php echo $user->getEmail(); ?>">
						</li>
						<li class="list-group-item bg-dark">
							Nom : <?php echo $user->getLastName(); ?>
						</li>
						<li class="list-group-item bg-dark">
							<input type="text" class="form-control bg-dark text-light" value="<?php echo $user->getLastName(); ?>">
						</li>
						<li class="list-group-item bg-dark">
							Prénom : <?php echo $user->getFirstName(); ?>
						</li>
						<li class="list-group-item bg-dark">
							<input type="text" class="form-control bg-dark text-light" value="<?php echo $user->getFirstName(); ?>">
						</li>
						</form>
						<li class="list-group-item bg-dark">
							<a href="<?php WEBROOT ?>User/edit"><input type="submit" class="btn btn-success btn-lg btn-block" value="Editer mon profil"></a>
						</li>
						<li class="list-group-item bg-dark">
							<a href="<?php echo WEBROOT ?>/User/delete"><input type="submit" class="btn btn-danger btn-lg btn-block" value="Supprimer mon compte"></a>
						</li>
						</ul>
					</td>
				</table>
			</form>
		</div>
	</div>
<?php 
	}
	else
	{

	}
?>