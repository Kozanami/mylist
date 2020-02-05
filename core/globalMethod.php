<?php 

    // Charger un Partials
    function loadPartials($name,$data = null)
    {
        if($_SERVER['HTTP_HOST'] =='127.0.0.1' OR $_SERVER['HTTP_HOST'] == 'localhost')
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

    // Error Module
    function logVar($type, $message, $log = null)
    {
        $_SESSION['logType'] = $type;
        $_SESSION['logMessage'] = $GLOBALS['message'.$message];
        
        if($log != null)
        {
            strval($log);
            $_SESSION['logContainerWidth'] = $log;
        }
    }

    function text($name)
    {
       return $GLOBALS['text'.$name];
    }

    /////////////////////////////////////////////////
    //////////////       test        /////////////
    /////////////////////////////////////////////////

    function dump_require()
    {
        return var_dump(get_included_files());
    }

    // return le dossier ou l'on ce trouve 
    function testPath(){
        return basename(__DIR__);
    }
?>