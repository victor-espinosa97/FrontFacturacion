<?php
    session_start();
    ini_set( 'display_errors', 0 );
    error_reporting( E_ALL );
    date_default_timezone_set("America/Lima");
    
    require_once 'autentica.php';
    
    if(isset($_POST['btn_login'])){ 
        if ($_POST['btn_login']=='valida') {
            call_user_func( array( new Autentica, 'valida_user' ) );
        }else{ 
            header('Location: ../');
        }
        
        // if (!isset ($_SESSION['SESION']))
        // { 
        //    header('Location: ../../');
        // }
        
    } else{
        header('Location: ../');
    } 
?>