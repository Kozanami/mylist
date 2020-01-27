<?php 
	if (isset($user)) 
	{
?>
		<div class="card" style="width: 18rem;">
		<img src="<?php WEBROOT.'img/'.$user->getAvatar() ?>" alt="..." class="card-img-top">
		<div class="card-body">
			<h5 class="card-title">Mon Profil</h5>
			<li> Nom : <?php $user->getLastName(); ?></li>
			<?php $user->getFirstName(); ?>
			<?php $user->getEmail(); ?>
		</div>
		</div>
<?php 
	}
?>