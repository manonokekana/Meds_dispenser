<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$pname="";
$pdetails="";
$doctor="";
$unique="";
$collected = "No";
$error = "";
$empty = "";
$meds="";    

if(filter_input(INPUT_POST,'search'))
{
    $p_id= filter_input(INPUT_POST,'search_id');
    $total = strlen($p_id);
    if(!empty($p_id) && $total==13)
    {
       
            $find_patient =  "select patient_id,name,sum(prescription_id) as k, GROUP_CONCAT(prescription_details) as prescription_concat,collected,doctor_name"
                . " from patient join prescription using(patient_id) join doctor using(doctor_id) where id_no=$p_id and collected=0 GROUP BY id_no";

            $find_query=  mysqli_query($connect, $find_patient);
            $num = mysqli_num_rows($find_query);
            $arr_find = mysqli_fetch_array($find_query);
            if($num == 1)
            {
                $pass = $arr_find['patient_id'];
                $pname = $arr_find['name'];
                $unique = $arr_find['k'];
                $pdetails = $arr_find['prescription_concat'];
                $doctor = $arr_find['doctor_name'];
                //echo"<td><input type='checkbox' name='collect' class='form-control'/></td>";
                                                               
            setcookie('unique',$pass);
            } else {
                $error = "No active prescription for the above.Check ID!!";
                session_start();
                $id_search = $_SESSION=filter_input(INPUT_POST,'search_id');
            } 
 
    }  elseif(!empty($p_id) && $total != 13 ) {
        
        $un = "select patient_id,name,sum(prescription_id) as s, GROUP_CONCAT(prescription_details) as prescription_concat,collected,doctor_name"
                . " from patient join prescription using(patient_id) join doctor using(doctor_id) where collected=0 GROUP BY id_no";
        $un_q = mysqli_query($connect, $un);
        while($rq = mysqli_fetch_array($un_q))
        {
            $rq1 = $rq['s'];
            if($rq1==$p_id)
            {
                $pass = $rq['patient_id'];
                $pname = $rq['name'];
                $unique = $rq['s'];
                $pdetails = $rq['prescription_concat'];
                $doctor = $rq['doctor_name'];
                setcookie('unique',$pass);
                break;
            }  else {
               
               // $error="Invalid unique number";
            }   
        }
        }elseif (empty ($p_id)) {
        $empty ="Please enter ID/unique number";
    } 
    
}                               
                           