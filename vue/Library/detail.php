
<div class="row justify-content-center">
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<?php 
					if (isset($library)) {
						foreach($library as $key => $data){
						echo '<ul class="list-group">';
						echo '<li class="list-group-item"> Nom : '.$data->getName().'</li>';
						echo '<li class="list-group-item"> Catégorie: '.$data->getCategory().'</li>';
						echo '<li class="list-group-item"> Genre : '.$data->getSubcategory().'</li>';
						echo '<li class="list-group-item"> Saison : '.$data->getSeason().'/'.$data->getSmax().'</li>';
						echo '<li class="list-group-item"> Episode : '.$data->getEpisode().'/'.$data->getEpmax().'</li>';
						$tabTag = explode(",", $data->getTag());
						echo '<li class="list-group-item"> Tags : ';
						foreach($tabTag as $tag){
							echo '<button class="badge badge-secondary m-1">'.$tag.'</button>';
						}
						echo  '</li class="list-group-item">';
						echo '<li class="list-group-item"> Note : '.$data->getEvaluation().'/10</li>';
						echo '<li class="list-group-item"> Mémo : '.$data->getNote().'</li>';
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