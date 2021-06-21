<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$updates ="";
if(filter_input(INPUT_POST,'collected'))
{
    if(!empty(filter_input(INPUT_POST,'collect')))
    {
        if(filter_input(INPUT_COOKIE,'unique'))
        {
            $uniq = filter_input(INPUT_COOKIE,'unique');
            $select = "select * from prescription where patient_id=$uniq";
            $select_q = mysqli_query($connect,$select);
            $tot = mysqli_num_rows($select_q);
            if($tot!=0)
            {
                while($row = mysqli_fetch_array($select_q))
                {
                    $desc = $row['prescription_details'];
                    $medicine = substr($desc, 0,-4);
                    $preg_match = preg_match('#\[(.*?)\]#', $desc, $match);
                    //echo $match[1];
                    $med = "select * from medicine where medicine_name = '$medicine'";
                    $med_q = mysqli_query($connect, $med);
                    $nmed = mysqli_num_rows($med_q);
                    while($r = mysqli_fetch_array($med_q))
                    {
                       $qty = $r['qty'];
                       if($match[1] > $qty)
                       {
                           //setcookie('medicine',  serialize($medicine));
                           $query = "insert into orders(orders_meds)values('$medicine')";
                           $q_confirm = mysqli_query($connect, $query); 
                           header("location:order.php");
                         
                       }else{
                         $left = " [";
                         $right = "]";
                        $medi = $medicine.$left.$match[1].$right;
                        $update = "update prescription set collected = true where prescription_details='$medi' and patient_id=$uniq";
                        $q_update = mysqli_query($connect, $update);
                        if($q_update)
                        {
                            $updates = "Prescription has been collected";
                        }else{
                            echo 'not working';
                        }
                            
                       }
                    }
                }
            }   
           /*$uniq = filter_input(INPUT_COOKIE,'unique');
            $update = "update prescription set collected = true where patient_id=$uniq";
            $q_update = mysqli_query($connect, $update);
            if($q_update)
            {
                $updates = "Prescription has been collected";
            }  else {
                echo "dololo";
            }*/
        }
    }        
}