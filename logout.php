<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$_SESSION['id_no']="";
$past = time() - 3600;
foreach ( $_COOKIE as $key => $value )
{
    setcookie( $key, $value, $past, '/' );
}
header('location:doctor.php');

