<?php 

    // return le dossier ou l'on ce trouve 
    function testPath(){
        return basename(__DIR__);
    }

    // Charger un Partials
    function loadPartials($name,$data = null)
    {
        require_once($_SERVER['DOCUMENT_ROOT'] . SERVERNAME . '/vue/_partials/'.$name.'.php');
        return $data;
    }

    /////////////////////////////////////////////////
    //////////////       Module         /////////////
    /////////////////////////////////////////////////

    // Error Module
    function errorLog($type, $message)
    {
        $_SESSION['logType'] = $type;
        $_SESSION['logMessage'] = $message;
    }

?>