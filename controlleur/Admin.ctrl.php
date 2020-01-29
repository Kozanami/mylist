<?php 
class CtrlAdmin extends Controller {
 
    public function index($id = 1)
    {
		if(isset($_SESSION['id'])) {
            $this->loadDao('User');
            $d['user'] = $this->DaoUser->read($_SESSION['id']);
            if(isset($_SESSION['roleAdmin']))
            {
                if($_SESSION['roleAdmin'] == 'ROLE_ADMIN')
                {
                    if($id == 0 OR $id < 1)
                    {
                        $id = 1;
                    }
                    $_SESSION['controller'] = 'Admin';
                    $_SESSION['pageName'] = 'index';
                    $_SESSION['title'] = 'Gestion des Utilisateurs';
                    $entityByPage = $_SESSION['entityByPage'];

                    $countmax = $this->DaoUser->countUser();
                  
                    $currentPage = $id;

                    $firstEntry = ($currentPage-1)*$entityByPage;

                    $d['data'] = $this->DaoUser->readAll($firstEntry);
                    $this->set($d);
                    
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
                        $this->render('admin','Admin','index', $id);
                    }
                    else
                    {
                        $_SESSION['pageID'] = $id;
                    }
                    $this->render('admin','Admin','index', $id);
                }
                else
                {
                    $this->set($d);
                    logVar('danger','AccessDenied');
                    $this->render('default','Library','index');
                }
            }
            else
            {
                $this->set($d);
                logVar('danger','AccessDenied');
                $this->render('admin','Admin','auth');
            }
        }
        else
        {
            logVar('danger','RequireAuth');
            $this->render('admin','User','logIn');
		}
    } 
    
    public function edit($id = null)
	{
		if (isset($_SESSION['id'])) {
            if ($id != null AND $id >0) 
            {
                $this->loadDao('User');
                $d['data'] = $this->DaoUser->read($id);
                $d['user'] = $this->DaoUser->read($_SESSION['id']);
                $this->set($d);
                $this->render('admin','Admin','edit', $id);	
            }
            else
            {
                logVar('alert','UrlErrorId');
                header('Location: '.WEBROOT.'Admin/index/');
            }
		} 
		else
		{
		logVar('danger','RequireAuth');
		$this->render('default','User','logIn');
		}
    }
    
    public function sendEdit()
	{
		if (isset($_SESSION['id'])) {
            $id = htmlentities($this->input['id']);
            if ($id != null AND $id > 0) 
            {
                $this->loadDao('User');
                if ($this->input) 
                {
                    $email = htmlentities($this->input['email']);
                    $firstname = htmlentities($this->input['firstname']);
                    $lastname = htmlentities($this->input['lastname']);
                    if(isset($this->input['avatar'])){
                        $avatar = htmlentities($this->input['avatar']);
                    }
                    if(!empty($this->input['newpassword']))
                    {
                        $newpassword = htmlentities($this->input['newpassword']);
                    }
                    
                    $user = $this->DaoUser->read($id);
                    $verif = $this->DaoUser->readByEmail($email);
                    if($verif == null OR $email == $user->getEmail())
                    {
                        $passUser = $user->getPassword();

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
                                header('Location: '.WEBROOT.'Admin/edit/'.$id);
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
                        $user->setArchive(0);
                        $user->setId($user->getId());

                        $this->DaoUser->update($user);
                        logVar('success','SuccessForm',4);
                    }
                    else
                    {
                        logVar('danger','EmailDuplicate');
                        header('Location:'.WEBROOT.'Admin/edit'.$id);
                    }
                }
                header('Location: '.WEBROOT.'Admin/edit/'.$id);
            }
            else
            {
                logVar('alert','UrlErrorId');
                header('Location: '.WEBROOT.'Admin/index/');
            }
		} 
		else
		{
		logVar('danger','RequireAuth');
		$this->render('default','User','logIn');
		}
	}

    public function auth() {
        if (isset($_SESSION['id'])) {
            $this->loadDao('User');
            $d['user'] = $this->DaoUser->read($_SESSION['id']);
            $this->set($d);
            if(isset($_SESSION['roleAdmin']) AND $_SESSION['roleAdmin'] == 'ROLE_ADMIN')
            {
                header('Location: '.WEBROOT.'Admin/index/');
            }
            else
            {
                $_SESSION['title'] = 'Authentification Admin';
                if (!empty($this->input)) {

                    $email = htmlentities($this->input['email']);
            
                    $user = $this->DaoUser->readByEmail($email);
            
                    if ($user != null) {
                        $passInput = htmlentities($this->input['password']);
                        $passUser = $user->getPassword();
                        
                        if (password_verify($passInput, $passUser)) {
                            if($user->getRole() == 'ROLE_ADMIN')
                            {
                                $_SESSION['roleAdmin'] = $user->getRole();
                                header('Location:'.WEBROOT.'Admin/index');
                            }
                            else
                            {
                                logVar('danger','AccessDenied');
                                header('Location:'.WEBROOT.'Library/index');
                            }     
                        }
                        else 
                        {
                            logVar('danger','MailPassError');
                            $this->render('admin','Admin','auth');
                        }
                    }
                    else
                    {
                        logVar('danger','MailPassError');
                        $this->render('admin','Admin','auth');
                    }
            
                }
                else
                {
                    $this->render('admin','Admin','auth');
                }
            }
        }
        else
        {
            logVar('danger','RequireAuth');
            $this->render('admin','User','logIn');
        }
    }

    public function logOut() {
        if(isset($_SESSION['roleAdmin']))
        {
            unset($_SESSION['roleAdmin']);
            header('Location:'.WEBROOT.'Library/index');
        }
    }

    public function delete($id)
	{
		if (isset($_SESSION['id'])) {
			$this->loadDao('User');
			$this->DaoUser->delete($id);
            unset($_SESSION[$id]);
			logVar('success','DeleteAccountUser', 4);
			header('Location:'.WEBROOT.'Admin/index');
        }
        else
        {
			logVar('danger','RequireAuth');
			$this->render('default','User','signIn');
		}
	}

    public function upgrade()
    {
        if (isset($_SESSION['id']))
        {
            $this->loadDao('User');
            $user = $this->DaoUser->read($_SESSION['id']);
            $user->setRole('ROLE_ADMIN');
            $this->DaoUser->adminRank($user);
            logVar('danger','AdminCheat');
            header('Location:'.WEBROOT.'Library/index');
        }
        else
        {
            logVar('danger','RequireAuth');
            $this->render('admin','User','logIn');
        }
    }
}
?>