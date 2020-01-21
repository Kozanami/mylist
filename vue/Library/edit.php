<div class="container-fluid col-md-6">
	<div class="content">
	<?php 
	if (isset($library)) {
		foreach($library as $key => $data){
	}
	}
	?>
	</div>

	<form action="<?= WEBROOT ?>Library/edit" method="POST" class="content col-auto">
		<h1 class="text-center">Ajouter un média à ma liste</h1>
			<?php 
				if (isset($log)) {
					echo $log;
				}
			?>
		<input type="hidden" name="id" value="<?= $data->getId(); ?>">

		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" class="form-control" id="name" placeholder="Interstellar" value="<?= $data->getName(); ?>">
		</div>

		<div class="form-group">
		<label for="category">Type</label>
		<select id="category" name="category" class="form-control">
		<?php
			if($data->getCategory()){
				echo '<option selected>'.$data->getCategory().'</option>';
			}
			else
			{
				echo '<option selected disabled>Choisi un Type</option>';
			}
			?>
			<option value="1">Film</option>
			<option value="2">Série</option>
			<option value="3">Anime</option>
			<option value="5">Déssin Animé</option>
			<option value="6">Cour Métrage</option>
		</select>
		</div>
			<input type="hidden" name="id" value="<?= $data->getId(); ?>">
		<div class="form-group">
			<label for="subcategory">Genre</label>
			<input type="subcategory" name="subcategory" id="subcategory" class="form-control" placeholder="Science-Fiction" value="<?= $data->getSubcategory(); ?>">
		</div>

		<div class="form-row">
		<div class="col">
			<label for="episode">Episode actuelle</label>
			<input type="number" name="episode" id="episode" class="form-control" placeholder="5"  value="<?= $data->getSeason(); ?>">
		</div>
		<div class="col">
		<label for="epmax">Episode max</label>
			<input type="number" name="epmax" id="epmax" class="form-control" placeholder="24"  value="<?= $data->getSmax(); ?>">
		</div>
		</div>

		<div class="form-row">
		<div class="col">
			<label for="season">Saison actuelle</label>
			<input type="number" name="season" id="season" class="form-control" placeholder="2"  value="<?= $data->getEpisode(); ?>">
		</div>
		<div class="col">
			<label for="smax">Saisons max</label>
			<input type="number" name="smax" id="smax" class="form-control" placeholder="4"  value="<?= $data->getEpmax(); ?>">
		</div>
	</div>


		<div class="form-group">
			<label for="tag">Tag</label>
			<input type="text" name="tag" id="tag" class="form-control" placeholder="espace, temporelle, voyage"  value="<?= $data->getTag(); ?>">
		</div>

		<div class="form-group">
			<label for="evaluation">Note</label>
			<input type="number" name="evaluation" id="evaluation" class="form-control"  value="<?= $data->getEvaluation(); ?>">
		</div>

		<div class="form-group">
			<label for="note">Mémo</label>
			<textarea id="note" name="note" class="form-control"
			rows="5" cols="33" placeholder="Pour me rappeller, mettre une description ou autre"><?= $data->getNote(); ?></textarea>

		</div>
			<button type="submit" class="btn btn-primary col-lg">Editer</button>
	</form>
</div>