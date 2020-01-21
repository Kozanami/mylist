<?php 
class CtrlLibrary extends Controller {

	public function index($id = 1)
	{
		$entityByPage = 2;
		
		$d['title'] = 'Bibliothèque';

		if (isset($_SESSION['id'])) {
			$userid = $_SESSION['id'];
			$this->loadDao('Library');

			$currentPage = $id;

			$firstEntry = ($currentPage-1)*$entityByPage;
			$lastEntry = $firstEntry + $entityByPage;
			$countmax = $this->DaoLibrary->countLibrary($userid);

			if( $countmax > 0 )
			{
				$d['pmax'] = ceil( ($entityByPage) / $countmax );
			}
			else
			{
				$d['pmax'] = 1;
			}
			
			$d['pId'] = $id;
			$d['library'] = $this->DaoLibrary->read($userid,$firstEntry,$lastEntry);
			$this->set($d);
			$this->render('default','Library','index', $id);				
		} 
		else 
		{
			$d['log'] = '<div class="alert alert-warning" role="alert">Veuillez vous connecter avant d\'acceder à votre compte</div>';
			$this->set($d); 
			$this->render('default','User','logIn');
		}
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

				$d['log'] = '<div class="alert alert-success" role="alert">Envoie effectuer</div>';
				$pmax = 5;
				$this->set($d);

				header('Location:'.WEBROOT.'Library/index/'.$id);

			}
			else 
			{
				$this->loadDao('Library');
				$userid = htmlentities($_SESSION['id']);
				$d['library'] = $this->DaoLibrary->readOne($id);

				foreach($d['library'] as $key => $data){}
		
				$tempTitle = $data->getName();
		
				$d['title'] = 'Modifier : '.$tempTitle;

				$this->set($d);
				$this->render('default','Library','edit', $id);
			}
		} 
		else
		{
		$d['log'] = '<div class="alert alert-warning" role="alert">Veuillez vous connecter avant d\'acceder à votre compte</div>';
		$this->set($d); 
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

				$d['log'] = '<div class="alert alert-success" role="alert">Envoie effectuer</div>';
				$this->set($d);

				header('Location:'.WEBROOT.'Library/index/'.$id);

			}
			else 
			{
				$this->render('default','Library','create');
			}
		} 
		else
		{
		$d['log'] = '<div class="alert alert-warning" role="alert">Veuillez vous connecter avant d\'acceder à votre compte</div>';
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

			$d['log'] = '<div class="alert alert-warning" role="alert">Veuillez vous connecter avant d\'acceder à votre compte</div>';
			$this->set($d); 
			$this->render('default','User','logIn');
		}
	}
	
}
?>