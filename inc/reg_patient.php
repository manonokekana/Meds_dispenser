<?php

/* 
 
 */
  
    if(filter_input(INPUT_POST,'register')) 
    {
        
        $firstname = filter_input(INPUT_POST,'first_name');
        $lastname = filter_input(INPUT_POST,'last_name');
        $dateofbirth = filter_input(INPUT_POST,'dob');
        $id = filter_input(INPUT_POST,'id_no');
        $age = filter_input(INPUT_POST,'age');
        $address = filter_input(INPUT_POST,'address');
        $contact = filter_input(INPUT_POST,'contact');
        
        if($firstname !="")
        {
            $query = "insert into patient (name,surname,dob,id_no,age,address,contact)values('$firstname','$lastname','$dateofbirth','$id','$age','$address','$contact')";
            $confirm = mysqli_query($connect, $query);
            if($confirm)
            {
                $myfile = "records\.$id.txt";
                $handle = fopen($myfile, 'w') or die('Issue opening file:'.$myfile);
                ?><script type='text/javascript'>alert('New patient registered. Thank you!!');</script><?php
            }else{echo 'error';}
        }else{
            ?><script type='text/javascript'>alert('Please enter all the details');</script><?php
        }  
    }
    
    
