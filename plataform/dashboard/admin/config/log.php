<?php

//$log = new log(); 
//$log->user($msg,$username); //use for user errors 
//$log->general($msg); //use for general errors

class log { 
  // 
  const USER_ERROR_DIR = 'Logs/app.log';
  const GENERAL_ERROR_DIR = 'Logs/app.log'; 

  /* 
   User Errors... 
  */ 
    public function log_eventos($msg,$username,$class,$function,$parameters) 
    { 
    $date = date('Y-m-d h:i:s A'); 
    $log = $date ." | MESSAGE: ".$msg." | USER: ".$username." | CLASS: ".$class." | FUNCTION: ".$function." | PARAMETERS: ".var_export($parameters, true)."\n\n"; 
    error_log($log, 3, self::USER_ERROR_DIR); 
    } 
    /* 
   General Errors... 
  */ 
    public function general($msg) 
    { 
    $date = date('d.m.Y h:i:s'); 
    $log = $msg."   |  Date:  ".$date."\n"; 
    error_log($msg."   |  Tarih:  ".$date, 3, self::GENERAL_ERROR_DIR); 
    } 

} 

?>