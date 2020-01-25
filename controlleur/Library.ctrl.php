<?php 
class CtrlLibrary extends Controller {

	public function global($id,$mediaType = null,$pageName,$title = 'No title')
	{
		if($id == 0 OR $id < 1)
		{
			$id = 1;
		}
		
		$_SESSION['title'] = $title;

		$entityByPage = $_SESSION['entityByPage'];

		if (isset($_SESSION['id'])) {
			$userid = $_SESSION['id'];
			$this->loadDao('Library');

			$currentPage = $id;

			$firstEntry = ($currentPage-1)*$entityByPage;
			if($mediaType != null)
			{
				$countmax = $this->DaoLibrary->countLibrary($userid,$mediaType);
			}
			else
			{
				$countmax = $this->DaoLibrary->countLibrary($userid);
			}

			if( $countmax > 0 )
			{
				$_SESSION['pageMax'] = ceil( $countmax / $entityByPage );
			}
			else
			{
				$_SESSION['pageMax'] = 1;
			}

			if($id > $_SESSION['pageMax'])
			{
				header('Location:'.WEBROOT.'Library/'.$_SESSION['pageName'].'/');
			}
			else
			{
				$_SESSION['pageID'] = $id;
			}

			$_SESSION['pageName'] = $pageName;
			if($mediaType != null)
			{
				$d['library'] = $this->DaoLibrary->read($userid,$firstEntry,$mediaType);
			}
			else
			{
				$d['library'] = $this->DaoLibrary->read($userid,$firstEntry);
			}

			$this->set($d);
			$this->render('default','Library',$_SESSION['pageName'], $id);				
		} 
		else 
		{
			logVar('danger','RequireAuth');
			$this->render('default','User','logIn');
		}
	}

	public function index($id = 1)
	{
		$this->global($id,null,'index','Bibliothèque');
	}

	public function film($id = 1)
	{
		$this->global($id,1,'film','Les Films');
	}

	public function serie($id = 1)
	{
		$this->global($id,2,'serie','Les Série');
	}

	public function anime($id = 1)
	{
		$this->global($id,3,'anime','Les Animés');
	}

	public function dessinAnime($id = 1)
	{
		$this->global($id,4,'dessinAnime','Les Déssin Animés');
	}
	public function courtMetrage($id = 1)
	{
		$this->global($id,5,'courtMetrage','Les court Métrage');
	}

	public function edit($id = null)
	{
		$d['title'] = 'Modifier';
		if (isset($_SESSION['id'])) {
			if (!empty($this->input)) {

				$this->loadDao('Library');

				// Vérif regexp pour l'email

				// Vérif regexp mot de passe

				// Vérif si email present dans la bdd 
				
				$name = htmlentities($this->input['name']);
				$category = htmlentities($this->input['category']);
				$subcategory = htmlentities($this->input['subcategory']);
				$season = htmlentities($this->input['season']);
				$smax = htmlentities($this->input['smax']);
				$episode = htmlentities($this->input['episode']);
				$epmax = htmlentities($this->input['epmax']);
				$tag = htmlentities($this->input['tag']);
				$evaluation = htmlentities($this->input['evaluation']);
				$note = htmlentities($this->input['note']);
				$userid = htmlentities($_SESSION['id']);
				$id = htmlentities($this->input['id']);

				$library = new Library($name,$category,$subcategory,$season,$smax,$episode,$epmax,$tag,$evaluation,$note,$userid);
				$this->DaoLibrary->update($library,$id);

				logVar('sucess','Envoie effectuer');
				$this->set($d);
				if(isset($_SESSION['pageName']))
				{
					header('Location:'.WEBROOT.'Library/'.$_SESSION['pageName']);
				}
				else
				{
					header('Location:'.WEBROOT.'Library/index/');
				}
			}
			else 
			{
				$this->loadDao('Library');
				$userid = htmlentities($_SESSION['id']);
				$d['library'] = $this->DaoLibrary->readOne($id);

				foreach($d['library'] as $key => $data){}
		
				$d['title'] = 'Modifier : '.$data->getName();
				$d['id'] = $id;
				$this->set($d);
				$this->render('default','Library','edit', $id);
			}
		} 
		else
		{
		logVar('danger','RequireAuth');
		$this->render('default','User','logIn');
		}
	}

	public function create($id = 1) {

		$d['title'] = 'Ajouter';

		if (isset($_SESSION['id'])) {
			if (!empty($this->input)) {
				$this->loadDao('Library');

				// Vérif regexp pour l'email

				// Vérif regexp mot de passe

				// Vérif si email present dans la bdd 
				$name = htmlentities($this->input['name']);
				$category = htmlentities($this->input['category']);
				$subcategory = htmlentities($this->input['subcategory']);
				$season = htmlentities($this->input['season']);
				$smax = htmlentities($this->input['smax']);
				$episode = htmlentities($this->input['episode']);
				$epmax = htmlentities($this->input['epmax']);
				$tag = htmlentities($this->input['tag']);
				$evaluation = htmlentities($this->input['evaluation']);
				$note = htmlentities($this->input['note']);
				$userid = htmlentities($_SESSION['id']);

				$library = new Library($name,$category,$subcategory,$season,$smax,$episode,$epmax,$tag,$evaluation,$note,$userid);
				$this->DaoLibrary->create($library);

				switch($category)
				{
					case 1:
						$textCategory = 'Le Film';
						break;
					case 2:
						$textCategory = 'La Série';
						break;
					case 3:
						$textCategory = 'L\'Anime';
						break;
					case 4:
						$textCategory = 'Le Déssin Animé';
						break;
					case 5:
						$textCategory = 'Le Cour Métrage';
						break;
				}

				logVar('alert', $textCategory.' a bien été ajouter à votre liste');

				header('Location:'.WEBROOT.'Library/'.$_SESSION['pageName'].'/'.$id);
				
			}
			else 
			{
				$this->render('default','Library','create');
			}
		} 
		else
		{
		logVar('danger','RequireAuth');
		$this->set($d);
		$this->render('default','User','logIn');
	}
	}

	public function detail($id){

		if (isset($_SESSION['id'])) {
			$userid = $_SESSION['id'];
			$this->loadDao('Library');
			
			$d['library'] = $this->DaoLibrary->readOne($id,$userid);

			foreach($d['library'] as $key => $data){}

			$tempTitle = $data->getName();

			$d['title'] = $tempTitle;

			$this->set($d);
			$this->render('default','Library','detail',$id);
		} else {
			
			$d['title'] = 'Détails';

			logVar('danger','RequireAuth');
			$this->set($d); 
			$this->render('default','User','logIn');
		}
	}
	
	public function delete($id){
		if (isset($_SESSION['id'])) 
		{
			$this->loadDao('Library');
			$this->DaoLibrary->delete($id);

			logVar('danger','Le média a bien était supprimer de la liste');

			redirectHome();
		}
		else 
		{
			$d['title'] = 'Login';
			logVar('danger','RequireAuth');
			$this->set($d); 
			$this->render('default','User','logIn');	
		}
	}

}
?>