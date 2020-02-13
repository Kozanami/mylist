<?php 

class CtrlUser extends Controller {

	public function index() {
		if (isset($_SESSION['id'])) {
			$this->loadDao('User');
			$d['user'] = $this->DaoUser->read($_SESSION['id']);
			$this->set($d);
			$this->render('default','User','index');
		} else {
			$this->render('default','User','logIn');
		}

	}

	public function edit()
	{
		if (isset($_SESSION['id']))
		{
			if (
					!empty($this->input['email']) 
					&& 
					!empty($this->input['firstname'])
					&&
					!empty($this->input['lastname'])
					&&
					!empty($this->input['password'])
				) 
			{
				$this->loadDao('User');
				$id = $_SESSION['id'];
				$email = htmlentities($this->input['email']);
				$firstname = htmlentities($this->input['firstname']);
				$lastname = htmlentities($this->input['lastname']);
				if(isset($this->input['avatar']))
				{
					$avatar = htmlentities($this->input['avatar']);
				}
				if(!empty($this->input['newpassword']))
				{
					$newpassword = htmlentities($this->input['newpassword']);
				}
				$passInput = htmlentities($this->input['password']);
				
				$user = $this->DaoUser->read($id);

				$verif = $this->DaoUser->readByEmail($email);
				if($verif == null OR $email == $user->getEmail())
				{
					$passUser = $user->getPassword();

					if(password_verify($passInput, $passUser))
					{
						$user->setFirstName($firstname);
						$user->setLastName($lastname);
						$user->setEmail($email);
						
						if(isset($newpassword))
						{
							// si les mots de passe ne sont pas identique
							if(!password_verify($newpassword, $passUser))
							{
								$newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
								$user->setPassword($newpassword);
							}
							else
							{
								logVar('alert','NewPasswordError');
								header('Location: '.WEBROOT.'User/index');
								// on met un exit pour stopper le code car pour une raison inconnue il continnue
								exit();
							}
						}
						else
						{
							$user->setPassword($passUser);
						}
						if(isset($avatar)){
							$user->setAvatar($avatar);
						}
						$this->DaoUser->update($user);
						logVar('success','SuccessForm');
						header('Location:'.WEBROOT.'User/index');
					}
					else
					{
						logVar('alert','PasswordError');
						header('Location:'.WEBROOT.'User/index');
					}
				}
				else
				{
					logVar('danger','EmailDuplicate');
					header('Location:'.WEBROOT.'User/index');
				}
			}
			else 
			{	
				logVar('alert','InputEmpty');
				header('Location:'.WEBROOT.'User/index');
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

					logVar('success','SubcrireSuccess',6);

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
				if(isset($_POST['rememberme']))
				{
					$rememberUser = htmlentities($_POST['rememberme']);
				}
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
					logVar('danger','MailPassError');
					$this->render('default','User','logIn');
				}
			} else {
				logVar('danger','MailPassError');
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