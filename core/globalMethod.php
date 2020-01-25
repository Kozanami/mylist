<?php 

    // return le dossier ou l'on ce trouve 
    function testPath(){
        return basename(__DIR__);
    }

    // Charger un Partials
    function loadPartials($name,$data = null)
    {
        require($_SERVER['DOCUMENT_ROOT'] . SERVERNAME . '/vue/_partials/'.$name.'.php');
        return $data;
    }

    // header location page principale
    function redirectHome()
    {
        header('Location:'.WEBROOT.'Library/index');
    }

    /////////////////////////////////////////////////
    //////////////       Module         /////////////
    /////////////////////////////////////////////////

    // Error Module
    function logText($type, $message)
    {
        $_SESSION['logType'] = $type;
        $_SESSION['logMessage'] = $message;
    }

    function logVar($type, $message)
    {
        $_SESSION['logType'] = $type;
        $_SESSION['logMessage'] = $GLOBALS['text'.$message];
    }

?>