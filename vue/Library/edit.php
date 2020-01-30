<div class="container-fluid col-md-6">
	<div class="content">
	<?php 
	if (isset($library)) {
		foreach($library as $key => $data){
		}
	}
	?>
	</div>

	<form action="<?php WEBROOT ?>Library/edit" method="POST" class="content col-auto">
		<h1 class="text-center">Ajouter un média à ma liste</h1>
		<input type="hidden" name="id" value="<?php $data->getId(); ?>">
		
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" class="form-control" id="name" placeholder="Interstellar" value="<?php echo $data->getName(); ?>">
		</div>

		<div class="form-group">
		<label for="category">Type</label>
		<select id="category" name="category" class="form-control">
		<?php
			if($data->getCategory()){

				switch($data->getCategory())
				{
					case 1:
						$category = 'Film';
						break;
					case 2:
						$category = 'Série';
						break;
					case 3:
						$category = 'Anime';
						break;
					case 4:
						$category = 'Déssin Animé';
						break;
					case 5:
						$category = 'Cour Métrage';
						break;

				}
				echo '<option selected value="'.$data->getCategory().'">'.$category.'</option>';
			}
			else
			{
				echo '<option selected disabled>Choisi un Type</option>';
			}


			
			switch($data->getCategory())
			{
				case 1:
					echo '
					
					<option value="2">Série</option>
					<option value="3">Anime</option>
					<option value="4">Déssin Animé</option>
					<option value="5">Cour Métrage</option>

					';
				break;
				case 2:
					echo '
					
					<option value="1">Film</option>
					<option value="3">Anime</option>
					<option value="4">Déssin Animé</option>
					<option value="5">Cour Métrage</option>
					
					';
				break;
				case 3:
					echo '
					
					<option value="1">Film</option>
					<option value="2">Série</option>
					<option value="4">Déssin Animé</option>
					<option value="5">Cour Métrage</option>
					
					';
				break;
				case 4:
					echo '
					
					<option value="1">Film</option>
					<option value="2">Série</option>
					<option value="3">Anime</option>
					<option value="5">Cour Métrage</option>
					
					';
				break;
				case 5:
					echo '
					
					<option value="1">Film</option>
					<option value="2">Série</option>
					<option value="3">Anime</option>
					<option value="4">Déssin Animé</option>
					
					';
				break;
			}
			?>
		</select>
		</div>
			<input type="hidden" name="id" value="<?php echo $data->getId(); ?>">
		<div class="form-group">
			<label for="subcategory">Genre</label>
			<input type="subcategory" name="subcategory" id="subcategory" class="form-control" placeholder="Science-Fiction" value="<?php echo $data->getSubcategory(); ?>">
		</div>

		<div class="form-row">
		<div class="col">
			<label for="episode">Episode actuelle</label>
			<input type="number" name="episode" id="episode" class="form-control form-control-lg" placeholder="5"  value="<?php echo $data->getSeason(); ?>">
		</div>
		<div class="col">
		<label for="epmax">Episode max</label>
			<input type="number" name="epmax" id="epmax" class="form-control form-control-lg" placeholder="24"  value="<?php echo $data->getSmax(); ?>">
		</div>
		</div>

		<div class="form-row">
		<div class="col">
			<label for="season">Saison actuelle</label>
			<input type="number" name="season" id="season" class="form-control form-control-lg" placeholder="2"  value="<?php echo $data->getEpisode(); ?>">
		</div>
		<div class="col">
			<label for="smax">Saisons max</label>
			<input type="number" name="smax" id="smax" class="form-control form-control-lg" placeholder="4"  value="<?php echo $data->getEpmax(); ?>">
		</div>
	</div>


		<div class="form-group">
			<label for="tag">Tag</label>
			<input type="text" name="tag" id="tag" class="form-control" placeholder="espace, temporelle, voyage"  value="<?php echo $data->getTag(); ?>">
		</div>

		<div class="form-group">
			<label for="evaluation">Note actuelle : <?php loadPartials('evaluation',$data->getEvaluation()); ?></label>
			<select class="form-control form-control-lg" name="evaluation" id="evaluation">
				<?php
				
				for($i = 1 ; $i < 11 ; $i++)
				{
					if($i != $data->getEvaluation()){
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
					else
					{
						echo '<option value="'.$data->getEvaluation().'" selected>'.$data->getEvaluation().'</option>';
					}	
				}
				?>
			</select>
		</div>

		<div class="form-group">
			<label for="note">Mémo</label>
			<textarea id="note" name="note" class="form-control"
			rows="5" cols="33" placeholder="Pour me rappeller, mettre une description ou autre"><?php echo $data->getNote(); ?></textarea>

		</div>
			<button type="submit" class="btn btn-primary col-lg">Editer</button>
	</form>
</div>