<div class="container-fluid col-auto d-flex justify-content-center text-center">
	<form action="<?= WEBROOT ?>User/signIn" method="POST" class="content col-md-4 col-xs-fluid">
		<h1 class="text-center">Inscription</h1>
		<div class="form-group">
			<label for="exampleInputEmail1">Email</label>
			<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
			<small id="emailHelp" class="form-text text-muted">Ecrivez une adresse Email valide</small>
		</div>
		<div class="form-group">
			<label for="Password">Mot de passe</label>
			<input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1">
			<small id="password" class="form-text text-muted">Sécurité de votre mot de passe</small>
		</div>
		<div class="form-group">
			<div class="progress">
				<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
			<button type="submit" class="btn btn-primary col-lg">Submit</button>
	</form>
</div>