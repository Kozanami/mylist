<?php 

    // Error Module
    function errorLog($type, $message)
    {
        $_SESSION['logType'] = $type;
        $_SESSION['logMessage'] = $message;
    }

?>