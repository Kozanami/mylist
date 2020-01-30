<div class="container-fluid col-auto d-flex justify-content-center text-center">

	<form action="<?= WEBROOT ?>User/logIn" method="POST" class="content col-md-4 col-xs-fluid">
	<img class="logo" src="<?= WEBROOT ?>img/logo.png" alt="">
		<h1 class="text-center">Connexion</h1>
		<div class="form-group mt-2">
			<label for="exampleInputEmail1">Email</label>
			<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
			<small id="emailHelp" class="form-text text-muted">Ecrivez une adresse Email valide</small>
		</div>
		<div class="form-group">
			<label for="Password">Mot de passe</label>
			<input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1">
			<small id="password" class="form-text text-muted">Sécurité de votre mot de passe</small>
		</div>

		<div class="custom-control custom-checkbox my-1 mr-sm-2">
			<input type="checkbox" name="rememberme" class="custom-control-input" id="customControlInline">
			<label class="custom-control-label" for="customControlInline">Se souvenir de moi</label>
		</div>
	
			<button type="submit" class="btn btn-primary col-lg">Submit</button>
	</form>
</div>

