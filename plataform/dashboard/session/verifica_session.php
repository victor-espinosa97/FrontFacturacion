<?php
    if (isset($_SESSION['SESION'])){
        $id_decrypt = openssl_decrypt($_SESSION['SESION']['ID'], COD, KEY);
        if (!is_numeric($id_decrypt)) {
            header('Location: ../../../');
    	}
        $encrytid = $_SESSION['SESION']['ID'];
        
    }else{
        header('Location: ../../../');
    }
     
?>