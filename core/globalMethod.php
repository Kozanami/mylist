<?php 

    // return le dossier ou l'on ce trouve 
    function testPath(){
        return basename(__DIR__);
    }

    // Charger un Partials
    function loadPartials($name,$data = null)
    {
        if($_SERVER['HTTP_HOST'] = '127.0.0.1' OR $_SERVER['HTTP_HOST'] = 'localhost')
        {
            require($_SERVER['DOCUMENT_ROOT'] . SERVERNAME . '/vue/_partials/'.$name.'.php'); // Local Host
        }
        else
        {
            require($_SERVER['DOCUMENT_ROOT'] .'/vue/_partials/'.$name.'.php'); // OVH
        }
        return $data;
    }

    // header location page principale
    function redirectHome()
    {
        header('Location:'.WEBROOT.'Library/index');
    }

    function activeTab($name)
    {
        if(isset($_SESSION['pageName']))
        {
            if($_SESSION['pageName'] == $name)
            { 
                echo 'active'; 
            }
        }
    }
    
    /////////////////////////////////////////////////
    //////////////       Module         /////////////
    /////////////////////////////////////////////////

    // Error Module
    function logText($type, $message, $log = null)
    {
        $_SESSION['logType'] = $type;
        $_SESSION['logMessage'] = $message;

        if(is_int($log) > 0 AND is_int($log) < 13)
        {
            echo 'danger','La taille attribuer au container depasse celle de bootstrap [Module Error GlobalMethod.php]';
        }

        if(!$log = null AND is_int($log) AND is_int($log) > 0 AND is_int($log) < 13)
        {
            $_SESSION['logContainerWidth'] = $log;
        }
    }

    function logVar($type, $message, $log = null)
    {
        $_SESSION['logType'] = $type;
        $_SESSION['logMessage'] = $GLOBALS['text'.$message];
        
        if($log != null)
        {
            strval($log);
            $_SESSION['logContainerWidth'] = $log;
        }
    }

?>