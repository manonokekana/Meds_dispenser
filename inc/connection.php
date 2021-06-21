<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'clinic';

$connect = mysqli_connect($server, $user, $password);
if(!$connect)
{
    die('Error connecting to Database!! Contact Administrator');
}else
{
    $dbselect = mysqli_select_db($connect, $db);
    if(!$dbselect)
    {
        die('Error selecting database');
    }
}
