<?php 
class CtrlLibrary extends Controller {

	private function global($id,$mediaType,$pageName,$title = 'No title')
	{
		if($id == 0 OR $id < 1)
		{
			$id = 1;
		}
		$_SESSION['pageName'] = $pageName;
		$_SESSION['title'] = $title;

		$entityByPage = $_SESSION['entityByPage'];

		if (isset($_SESSION['id'])) {
			$this->loadDao('User');
			$d['user'] = $this->DaoUser->read($_SESSION['id']);
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
				header('Location:'.WEBROOT.'Library/'.$_SESSION['pageName']);
			}
			else
			{
				$_SESSION['pageID'] = $id;
			}
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
			$_SESSION['title'] = 'Login';
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
		$_SESSION['title'] = 'Modifier';
		if (isset($_SESSION['id'])) {
		$this->loadDao('User');
		$d['user'] = $this->DaoUser->read($_SESSION['id']);
			if (!empty($this->input)) {

				$this->loadDao('Library');
				
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

				logVar('success','SuccessForm');
				if(isset($_SESSION['pageName']))
				{
					header('Location:'.WEBROOT.'Library/'.$_SESSION['pageName']);
				}
				else
				{
					header('Location:'.WEBROOT.'Library/index');
				}
			}
			else 
			{
				$this->loadDao('Library');
				$userid = htmlentities($_SESSION['id']);
				$d['library'] = $this->DaoLibrary->readOne($id);
				$d['id'] = $id;
				$this->set($d);

				// on foreach library pour $data->getName()
				foreach($d['library'] as $data){
					$_SESSION['title'] = 'Modifier : '.$data->getName();
				}
				
				$this->render('default','Library','edit', $id);
			}
		} 
		else
		{
		logVar('danger','RequireAuth');
		$this->render('default','User','logIn');
		}
	}

	public function create()
	{

		$_SESSION['title'] = 'Ajouter';

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
				logVar('success','SuccessForm');
				header('Location:'.WEBROOT.'Library/'.$_SESSION['pageName']);
			}
			else 
			{
				$this->loadDao('User');
				$d['user'] = $this->DaoUser->read($_SESSION['id']);
				$this->set($d);
				$this->render('default','Library','create');
			}
		} 
		else
		{
			$_SESSION['title'] = 'Login';
			logVar('danger','RequireAuth');
			$this->render('default','User','logIn');
		}
	}

	public function detail($id)
	{
		if (isset($_SESSION['id'])) {
			$this->loadDao('User');
			$d['user'] = $this->DaoUser->read($_SESSION['id']);
			$userid = $_SESSION['id'];
			$this->loadDao('Library');
			
			$d['library'] = $this->DaoLibrary->readOne($id,$userid);

			foreach($d['library'] as $key => $data){}

			$_SESSION['title'] = $data->getName();

			$this->set($d);
			$this->render('default','Library','detail',$id);
		}
		else 
		{
			
			$_SESSION['title'] = 'Login';
			logVar('danger','RequireAuth');
			$this->render('default','User','logIn');
		}
	}
	
	public function delete($id)
	{
		if (isset($_SESSION['id'])) 
		{
			$this->loadDao('Library');
			$this->DaoLibrary->delete($id);

			logVar('success','DeleteLibrary');
			redirectHome();
		}
		else 
		{
			$_SESSION['title'] = 'Login';
			logVar('danger','RequireAuth');
			$this->render('default','User','logIn');	
		}
	}

}
?>