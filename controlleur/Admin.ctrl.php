<?php 
class CtrlAdmin extends Controller {
 
    public function index($id)
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
                        header('Location:'.WEBROOT.'Admin/index');
                    }
                    else
                    {
                        $_SESSION['pageID'] = $id;
                    }

                    $d['data'] = $this->DaoUser->readAll($firstEntry);
                    $this->set($d);
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