<div class="container-fluid col-md-6">
	<form action="<?= WEBROOT ?>Library/create" method="POST" class="content col-auto">
		<h1 class="text-center">Ajouter un média à ma liste</h1>
			<?php 
				if (isset($log)) {
					echo $log;
				}
			?>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" class="form-control" id="name" placeholder="Interstellar" required>
		</div>

		<div class="form-group">
		<label for="category">Type</label>
		<select id="category" name="category" class="form-control">
			<option selected disabled>Choisi un Type</option>
			<option>Film</option>
			<option>Série</option>
			<option>Anime</option>
			<option>Déssin Animé</option>
			<option>Cour Métrage</option>
		</select>
		</div>

		<div class="form-group">
			<label for="subcategory">Genre</label>
			<input type="subcategory" name="subcategory" id="subcategory" class="form-control" placeholder="Science-Fiction" required>
		</div>

		<div class="form-row">
		<div class="col">
			<label for="episode">Episode actuelle</label>
			<input type="number" name="episode" id="episode" class="form-control" placeholder="5" value="1" required>
		</div>
		<div class="col">
		<label for="epmax">Episode max</label>
			<input type="number" name="epmax" id="epmax" class="form-control" placeholder="24" value="1" required>
		</div>
		</div>

		<div class="form-row">
		<div class="col">
			<label for="season">Saison actuelle</label>
			<input type="number" name="season" id="season" class="form-control" placeholder="2" value="1" required>
		</div>
		<div class="col">
			<label for="smax">Saisons max</label>
			<input type="number" name="smax" id="smax" class="form-control" placeholder="4" value="1" required>
		</div>
	</div>


		<div class="form-group">
			<label for="tag">Tag</label>
			<input type="text" name="tag" id="tag" class="form-control" placeholder="espace, temporelle, voyage">
		</div>

		<div class="form-group">
			<label for="evaluation">Note</label>
			<input type="number" name="evaluation" id="evaluation" class="form-control">
		</div>

		<div class="form-group">
			<label for="note">Mémo</label>
			<textarea id="note" name="note" class="form-control"
			rows="5" cols="33" placeholder="Pour me rappeller, mettre une description ou autre"></textarea>

		</div>
			<button type="submit" class="btn btn-primary col-lg">Submit</button>
	</form>
</div>