<?php 
class CtrlAdmin extends Controller {

    public function index()
    {
        $_SESSION['title'] = 'Gestion des Utilisateurs';
		if(isset($_SESSION['id'])) {
            $this->loadDao('User');
            $d['user'] = $this->DaoUser->read($_SESSION['id']);
            $this->set($d);
            if(isset($_SESSION['roleAdmin']))
            {
                if($_SESSION['roleAdmin'] == 'ROLE_ADMIN')
                {
                    $this->render('admin','Admin','index');
                }
                else
                {
                   logVar('danger','AccessDenied');
                    $this->render('default','Library','index');
                }
            }
            else
            {
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

    public function auth() {
        if (isset($_SESSION['id'])) {
            $this->loadDao('User');
            $d['user'] = $this->DaoUser->read($_SESSION['id']);
            $this->set($d);
            if(isset($_SESSION['roleAdmin']) AND $_SESSION['roleAdmin'] == 'ROLE_ADMIN')
            {
                $this->render('admin','Admin','index');
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
                                $this->render('admin','Admin','index');
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