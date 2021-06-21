<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'connection.php';
$error = "";
$success = "";
$pres_error = "";
if(filter_input(INPUT_POST,'record_visit'))
{
    $id_no = filter_input(INPUT_POST,'patient_id');
    $match_id = "select * from patient where id_no = '$id_no'";
    $match_query = mysqli_query($connect, $match_id);
    $num_id = mysqli_num_rows($match_query);
    $today = date('y-m-d');
   
    $array = mysqli_fetch_array($match_query);
    if($num_id == 1)
    {
        $patient_id = $array['patient_id'];
        $rdate = date('y-m-d');
        $records = filter_input(INPUT_POST,'records');
        $r_comments = filter_input(INPUT_POST,'comments');
        $next_date = filter_input(INPUT_POST,'r_date');
        setcookie('pp_id',$patient_id);
        
        $r_query = "insert into records (patient_id,r_date,records,comments,next_date) values ('$patient_id','$rdate','$records','$r_comments','$next_date')";
        $r_results = mysqli_query($connect,$r_query);
        
        if(isset($id_no))
        {
            $myfile = "records\.$id_no.txt";
            $handle = fopen($myfile, 'a')or die('Could open file: '.$myfile);
            $dates = "\n Date: $today";
            fwrite($handle, $dates);
            $personal = "\n ID No: $id_no";
            fwrite($handle, $personal);
            $v_records = "\n Diagnotiscs & results: $records";
            fwrite($handle, $v_records);
            $v_comments = "\n Comments: $r_comments";
            fwrite($handle, $v_comments);
            $doctor = $_COOKIE['username'];
            $_doctor = "\n Doctor: $doctor";
            fwrite($handle, $_doctor);
            fwrite($handle,"\n ");

        }
                $success="Visit has been recorded";
    }else{
        $error = "ID not registered";
    }        
}

