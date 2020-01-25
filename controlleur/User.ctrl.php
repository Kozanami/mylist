<?php 

class CtrlUser extends Controller {
	public function index() {
		$this->loadDao('User');

		if (isset($_SESSION['id'])) {
			$d['user'] = $this->DaoUser->read($_SESSION['id']);
			$this->set($d);
			$this->render('default','User','index');
		} else {
			$d['log'] = '<div class="alert alert-warning" role="alert">Veuillez vous connecter avant d\'acceder à votre compte</div>';
			$this->set($d); 
			$this->render('default','User','logIn');
		}

	}

	public function signIn($id = 1) {
		if (!empty($this->input)) {
			$this->loadDao('User');

			// Vérif regexp pour l'email

			// Vérif regexp mot de passe

			// Vérif si email present dans la bdd 

			$email = htmlentities($this->input['email']);
			$password = htmlentities($this->input['password']);
			$password = password_hash($password, PASSWORD_DEFAULT);

			$user = new User($email,$password);

			$this->DaoUser->create($user);

			$d['log'] = '<div class="alert alert-success" role="alert">Inscription réussie !</div>';
			$this->set($d);

			header('Location:'.WEBROOT.'Library/index');

		} else {
			$this->render('default','User','signIn');
		}
	}

	public function logIn($id = 1) {

		if (!empty($this->input)) {
			$this->loadDao('User');

			$email = htmlentities($this->input['email']);

			$user = $this->DaoUser->readByEmail($email);

			if ($user != null) {
				$passInput = htmlentities($this->input['password']);
				$passUser = $user->getPassword();
				$rememberUser = htmlentities($_POST['rememberme']);
				// on vérifie que le POST['rememberme'] existe sinon on attribut false a la variable $rememberUser
				if (password_verify($passInput, $passUser)) {
					$_SESSION['id'] = htmlentities($user->getId());
					$_SESSION['email'] = htmlentities($user->getEmail());
					// si $rememberUser existe et égale à true alors on crée les cookie sinon on les supprimer si il existes
					if(isset($rememberUser) AND $rememberUser == true) {
						setcookie('email',$email,time()+$_SESSION['cookieTime'],$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);
						setcookie('password',$passUser,time()+$_SESSION['cookieTime'],$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);
					}
					else
					{
						setcookie('email','',time()-3600,$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);
						setcookie('password','',time()-3600,$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);
					}

					header('Location:'.WEBROOT.'Library/index');
				} else {
					$d['log'] = '<div class="alert alert-danger" role="alert">Email ou mot de passe incorrect</div>';
					$this->set($d);
					$this->render('default','Library','index', $id);
				}
			} else {
				$d['log'] = '<div class="alert alert-danger" role="alert">Email ou mot de passe incorrect</div>';
				$this->set($d);
				$this->render('default','User','logIn');
			}

		} else {
			$this->render('default','User','logIn');
		}
	}

	public function logOut() {
		setcookie('email','',time()-3600,$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);
		setcookie('password','',time()-3600,$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);
		session_unset();
		session_destroy();
		header('Location:'.WEBROOT.'User/logIn');
	}
}
?>