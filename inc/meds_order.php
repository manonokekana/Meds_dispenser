<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include'connection.php';

if(filter_input(INPUT_POST,'submit'))
{
    $clean = "truncate orders";
    $qclean = mysqli_query($connect, $clean);
    $clinic = filter_input(INPUT_POST,'clinic');
    echo $clinic;
   /* ?><script type="text/javascript">
        alert("Your order will be deilvered in 2 working days. Tahnk You!!");
        location.href = "dispenser.php";
    </script><?php*/
   // header('location:dispenser.php');*/
}