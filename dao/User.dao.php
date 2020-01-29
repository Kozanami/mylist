<?php 
require_once('model/User.class.php');

class DaoUser {

    public function create($user) {
        DB::request('INSERT INTO user (email,password) VALUES (?,?)', array($user->getEmail(),$user->getPassword()));
        $user->setId(DB::lastId());
        return $user;
    }
    
    public function read($id) {
        $datas = DB::request('SELECT * FROM  user WHERE id = ? AND archive = 0',array($id));
        if (!empty($datas)) {
            foreach ($datas as $key => $data) {
                $user = new User($data['email'],$data['password']);
                $user->setId($data['id']);
                $user->setLastName($data['lastname']);
                $user->setFirstName($data['firstname']);
                $user->setAvatar($data['avatar']);
                $user->setStatut($data['statut']);
                $user->setRole($data['role']);
            }  
            return $user;
        } else {
            return null;
        }
    }
    
    public function readAll() {
        $datas = DB::request('SELECT * FROM user WHERE archive = 0'); 
        if(!empty($datas)) {
            foreach($datas as $key => $data){
                $tablUser[$key] = new User($data['email'], $data['password']);
                $tablUser[$key]->setId($data['id']);  
                $tablUser[$key]->setLastName($data['lastname']);
                $tablUser[$key]->setFirstName($data['firstname']);
                $tablUser[$key]->setAvatar($data['avatar']);
                $tablUser[$key]->setStatut($data['statut']);
             }
            return $tablUser;
         } else {
             return null;
         }  
     }
     
    public function readByEmail($email) {
    $datas = DB::request('SELECT * FROM user WHERE email = ? AND archive = 0', array($email));
    if (!empty($datas)) {
     foreach ($datas as $key => $data) {
                $user = new User($data['email'],$data['password']);
                $user->setId($data['id']);
                $user->setLastName($data['lastname']);
                $user->setFirstName($data['firstname']);
                $user->setAvatar($data['avatar']);
                $user->setStatut($data['statut']);
                $user->setRole($data['role']);
            }
            return $user;
        } else {
            return null;
        }
    }
    
        public function update($user){
            DB::request('UPDATE user SET firstname = ?,lastname = ?, email = ?,password = ?,avatar = ?, statut = ? WHERE id = ?', array(
                $user->getFirstName(),
                $user->getLastName(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getAvatar(),
                $user->getStatut(),
                $user->getId()
             )
            );
        }

    public function archive($id,$archive) {
        DB::request('UPDATE user SET archive = ? WHERE id = ?', array($archive, $id));
    }

    public function delete($id) {
        DB::request('DELETE FROM user WHERE id = ?', array($id));
    }

    public function adminRank($user){
        DB::request('UPDATE user SET role = ? WHERE id = ?', array(
            $user->getRole(),
            $user->getId()
         )
        );
    }
}

 ?>