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

	public function edit()
	{
		if (isset($_SESSION['id'])) {
			if (!empty($this->input)) {
				$this->loadDao('User');

				$email = htmlentities($this->input['email']);
				$firstname = htmlentities($this->input['firstname']);
				$lastname = htmlentities($this->input['lastname']);
				if(isset($this->input['avatar'])){
					$avatar = htmlentities($this->input['avatar']);
				}
				if(isset($this->input['newpassword'])){
					$newpassword = htmlentities($this->input['newpassword']);
				}
				$password = htmlentities($this->input['password']);
				$password = password_hash($password, PASSWORD_DEFAULT);

				$user = $this->DaoUser->readByEmail($email);

				if($user->getPassword() == $password)
				{
					$user->setFirstName($firstname);
					$user->setLastName($lastname);
					$user->setEmail($email);
					if(isset($newpassword)){
						$user->setPassword($newpassword);
					}
					else
					{
						$user->setPassword($password);
					}
					if(isset($avatar)){
						$user->setAvatar($avatar);
					}
					$user->setId($user->getId());

				$this->DaoLibrary->update($user);

				logVar('success','SuccessForm');
				header('Location:'.WEBROOT.'Library/index');
				}
				else
				{
					logVar('alert','PasswordError');
					$this->render('default','User','index');
				}
			}
			else 
			{	
				logVar('alert','InputEmpty');
				$this->render('default','User','index');
			}
		} 
		else
		{
		logVar('danger','RequireAuth');
		$this->render('default','User','logIn');
		}
	}

	public function delete()
	{
		if (isset($_SESSION['id'])) {
			$id = $_SESSION['id'];
			$this->loadDao('User');
			$this->DaoUser->delete($id);
			setcookie('email','',time()-3600,$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);
			setcookie('password','',time()-3600,$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);
			session_unset();
			session_destroy();
			logVar('success','DeleteAccount', 4);
			header('Location:'.WEBROOT.'User/signIn');
		} else {
			logVar('danger','RequireAuth');
			$this->render('default','User','signIn');
		}
	}

	public function signIn() {
		$_SESSION['title'] = 'inscription';
		if (!empty($this->input)) {
			$this->loadDao('User');

			$email = htmlentities($this->input['email']);
			$user = $this->DaoUser->readByEmail($email);
			
			if($user)
			{
				if($email != $user->getEmail())
				{
				
					$password = htmlentities($this->input['password']);
					$password = password_hash($password, PASSWORD_DEFAULT);

					$user = new User($email,$password);

					$this->DaoUser->create($user);

					logVar('success','SubcrireSuccess',4);

					$_SESSION['id'] = htmlentities($user->getId());
					$_SESSION['email'] = htmlentities($user->getEmail());

					header('Location:'.WEBROOT.'Library/index');
				
				}
				else
				{
					logVar('danger','EmailDuplicate',4);
					$this->render('default','User','signIn');
				}
			}
			else
			{
				$password = htmlentities($this->input['password']);
				$password = password_hash($password, PASSWORD_DEFAULT);

				$user = new User($email,$password);

				$this->DaoUser->create($user);

				logVar('success','SubcrireSuccess',4);

				$_SESSION['id'] = htmlentities($user->getId());
				$_SESSION['email'] = htmlentities($user->getEmail());

				header('Location:'.WEBROOT.'Library/index');
			}
		} 
		else
		{
			$this->render('default','User','signIn');
		}
	}

	public function logIn() {
		$_SESSION['title'] = 'connexion';
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
					$this->render('default','Library','index');
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