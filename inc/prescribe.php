<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'connection.php';

$message="";
if(filter_input(INPUT_POST,'sms'))
{ 
    if(filter_input(INPUT_POST,'qty'))
    {
        //header('location:sms.php');
        $select = $_POST['mySelect'];
      //   $select = filter_input(INPUT_POST,'mySelect');
   
    foreach ($select as $item)
    {
        $medicine = substr($item, 0,-4);
        $preg_match = preg_match('#\[(.*?)\]#', $item, $match);
        if($preg_match > 0)
        {
            $select_st = "select qty from medicine where medicine_name='$medicine'";
            $select_query = mysqli_query($connect, $select_st);
            $qty_total = mysqli_num_rows($select_query);
            if($qty_total !==0)
            {
                while($row = mysqli_fetch_array($select_query))
                {
                            $now = filter_input(INPUT_COOKIE,'d_id');
                            $patient_id = filter_input(INPUT_COOKIE,'pp_id');
                            $pre_query = "insert into prescription (patient_id,doctor_id,prescription_details,collected) values ('$patient_id','$now','$item',0)";
                            $pre_results = mysqli_query($connect, $pre_query);
                            $lastkey = mysqli_insert_id($connect);
                            setcookie('lastkey', $lastkey);
                            header('location:sms.php');
                }
            }       
            
        }
    }
    
    }
}elseif(filter_input(INPUT_POST,'print')){
    if(filter_input(INPUT_POST,'qty'))
    {
        //header('location:sms.php');
        $select = $_POST['mySelect'];
      //   $select = filter_input(INPUT_POST,'mySelect');
   
    foreach ($select as $item)
    {
        $medicine = substr($item, 0,-4);
        $preg_match = preg_match('#\[(.*?)\]#', $item, $match);
        if($preg_match > 0)
        {
            $select_st = "select qty from medicine where medicine_name='$medicine'";
            $select_query = mysqli_query($connect, $select_st);
            $qty_total = mysqli_num_rows($select_query);
            if($qty_total !==0)
            {
                while($row = mysqli_fetch_array($select_query))
                {
                    $now = filter_input(INPUT_COOKIE,'d_id');
                    $patient_id = filter_input(INPUT_COOKIE,'pp_id');
                    $pre_query = "insert into prescription (patient_id,doctor_id,prescription_details,collected) values ('$patient_id','$now','$item',0)";
                    $pre_results = mysqli_query($connect, $pre_query);
                    $lastkey = mysqli_insert_id($connect);
                    setcookie('lastkey', $lastkey);
                    header('location:print.php');
                }
            }       
            
        }
    }
    
    }
}                         
