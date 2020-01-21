<?php 
class User extends AbstractEntity {
	private $firstName;
	private $lastName;
	private $email;
	private $password;
	private $avatar;
	private $statut;
	private $archive;

	public function __construct($email,$password){
		$this->email = $email;
		$this->password = $password;
	 }

	public function getFirstName() {
		return $this->firstName;
	}
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	public function getLastName() {
		return $this->lastName;
	}
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
	public function getAvatar() {
		return $this->avatar;
	}
	public function setAvatar($avatar) {
		$this->avatar = $avatar;
	}
	public function getStatut() {
		return $this->statut;
	}
	public function setStatut($statut) {
		$this->statut = $statut;
	}
	public function getArchive() {
		return $this->archive;
	}
	public function setArchive($archive) {
		$this->archive = $archive;
	}
}
    
 ?>