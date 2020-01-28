
<div class="row justify-content-center">
	<div class="col-md-4">
		<div class="card bg-secondary">
			<div class="card-body bg-dark">
				<?php 
					if (isset($library)) {
						foreach($library as $key => $data){

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

						echo '<ul class="list-group">';
						echo '<li class="list-group-item bg-secondary"> Nom : '.$data->getName().'</li>';
						echo '<li class="list-group-item bg-secondary"> Catégorie: '.$category.'</li>';
						echo '<li class="list-group-item bg-secondary"> Genre : '.$data->getSubcategory().'</li>';
						echo '<li class="list-group-item bg-secondary"> Saison : '.$data->getSeason().'/'.$data->getSmax().'</li>';
						echo '<li class="list-group-item bg-secondary"> Episode : '.$data->getEpisode().'/'.$data->getEpmax().'</li>';
						$tabTag = explode(",", $data->getTag());
						echo '<li class="list-group-item bg-secondary"> Tags : ';
						foreach($tabTag as $tag){
							echo '<button class="badge badge-secondary m-1">'.$tag.'</button>';
						}
						echo  '</li class="list-group-item bg-secondary">';
						echo '<li class="list-group-item bg-secondary"> Note : '.$data->getEvaluation().'/10</li>';
						echo '<li class="list-group-item bg-secondary"> Mémo : '.$data->getNote().'</li>';
						?>

						<?php
						echo '</ul class="list-group">';
						break;
						}
					}
				?>
				<div class="p-4 text-center">
					
					<span class="mr-3">
						<a href="<?= WEBROOT.'Library/edit/'.$data->getId(); ?>">
							<button class="btn btn-primary p-2" type="submit">Editer</button>
						</a>
					</span>
					<span>
						<a href="<?= WEBROOT.'Library/delete/'.$data->getId(); ?>">
							<button class="btn btn-danger p-2" type="submit">Supprimer</button>
						</a>

					</span>
				</div>
			</div>
		</div>
	</div>
</div>