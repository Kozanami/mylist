<?php 
   if (isset($_SESSION['logMessage']) AND isset($_SESSION['logType'])) {
        echo '<div class="container-fluid col-md-8 text-center">';
        if($_SESSION['logType'] == 'alert'){
            echo'<div class="alert alert-warning" role="alert">';
        }
        elseif($_SESSION['logType'] == 'danger'){
            echo'<div class="alert alert-danger" role="alert">';
        }
        elseif($_SESSION['logType'] == 'info'){
            echo'<div class="alert alert-danger" role="alert">';
        }
        elseif($_SESSION['logType'] == 'success'){
            echo'<div class="alert alert-success" role="alert">';
        }
        else
        {
            echo'<div class="alert alert-secondary" role="alert">';
        }

        echo $_SESSION['logMessage'];

        echo '</div>';

        unset($_SESSION['logMessage']);
        unset($_SESSION['logType']);

        echo '</div>';
    }
?>