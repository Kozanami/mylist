<?php 

	if (isset($user)) 
	{
?>
<div class="container-fluid col-auto d-flex justify-content-center text-center">
	<form action="<?= WEBROOT ?>Admin/auth" method="POST" class="content col-4">
		<h1 class="text-center">Connexion</h1>
		<div class="form-group">
			<label for="exampleInputEmail1">Email</label>
			<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		</div>
		<div class="form-group">
			<label for="Password">Mot de passe</label>
			<input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1">
		</div>
	
			<button type="submit" class="btn btn-primary col-lg">Submit</button>
	</form>
</div>


<?php 
	}
	else
	{
        header('Location:'.WEBROOT.'Library/index');
	}
?>