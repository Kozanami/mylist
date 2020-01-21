<?php 
if (isset($user)) {
	echo '<ul>';
	echo '<li><img src="'.WEBROOT.'img/'.$user->getAvatar().'"></li>';
	echo '<li> Nom : '.$user->getLastName().'</li>';
	echo '<li> Prénom : '.$user->getFirstName().'</li>';
	echo '<li> Email : '.$user->getEmail().'</li>';
	echo '</ul>';
}
?>