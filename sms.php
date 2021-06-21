<?php

include 'inc/connection.php';
                        
                        if(filter_input(INPUT_COOKIE,'lastkey'))
                        {
                            $lastkey = filter_input(INPUT_COOKIE,'pp_id');
                            
                            $pres_select =  "select patient_id,name,surname,contact,sum(prescription_id) as k, GROUP_CONCAT(prescription_details) as prescription_concat,collected,doctor_name"
                . " from patient join prescription using(patient_id) join doctor using(doctor_id) where patient_id=$lastkey and collected=0 GROUP BY patient_id";
                            $pre_select_query = mysqli_query($connect, $pres_select);
                            $num = mysqli_num_rows($pre_select_query);
                            
                            
                            if($num > 0)
                            {
                                while($arr = mysqli_fetch_array($pre_select_query))
                                {
                                   // $pname = $arr['name'];
                                    $uni=$arr['k'];
                                    $pname = $arr['name'];
                                    $psurname = $arr['surname'];
                                    $pdetails = $arr['prescription_concat'];
                                    $doctor = $arr['doctor_name'];
                                    $contact = $arr['contact'];
                                    $pdetail = str_replace(',','<br />',$pdetails);
                                    
                                    $message = $uni." ".$pdetails;
                                    $url = "https://www.winsms.co.za/api/batchmessage.asp?";
                                    $userp = "user=";
                                    $passwordp = "&password=";
                                    $messagep = "&message=";
                                    $numbersp = "&Numbers=";
                                    // WinSMS username variable - Set your WinSMS username here.
                                    $username = "gladkebuang@gmail.com";
                                    // WinSMS password variable - Set your WinSMS password here.
                                    $password = "Glad@Kebu@123"; 
                                    // WinSMS message variable - Set your WinSMS message here.
                                    //$message = "test My PHP with encoding";
                                    // URL encoding of your message.
                                    $encmessage = urlencode(utf8_encode($message));
                                    // WinSMS cellphone numbers variable - Set your cellphone numbers here separated with a ;
                                    $numbers = $contact;
                                    // Combines all the variables together
                                    $all = $url.$userp.$username.$passwordp.$password.$messagep.$encmessage.$numbersp.$numbers;
                                    // Opens the URL in read only mode
                                    $fp = fopen($all, 'r');

                                    // Gets feedback from HTTP submittle
                                    while(!feof($fp)){
                                    $line = fgets($fp, 4000);
                                  //  print($line);
                                    //echo "<br>";
                                    }
                                    fclose($fp);
                                                echo "Subscription has been sent to $pname $psurname <br>";
                                                echo '<a href="doctor.php">Back</a>';
                                            }

                                        }
                                    }else{
                                        echo "Prescription not sent";
                                    }