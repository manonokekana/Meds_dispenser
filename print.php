<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Printing</title>
        <link href="css/styles.css" type="text/css" rel="stylesheet"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                    <br> <h2>Prescription for Medication</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="border: 1px solid graytext">
                    <?php
                        include 'inc/connection.php';
                        
                        if(filter_input(INPUT_COOKIE,'lastkey'))
                        {
                            $lastkey = filter_input(INPUT_COOKIE,'pp_id');
                            
                            $pres_select =  "select patient_id,id_no,name,surname,sum(prescription_id) as k, GROUP_CONCAT(prescription_details) as prescription_concat,collected,doctor_name"
                . " from patient join prescription using(patient_id) join doctor using(doctor_id) where patient_id=$lastkey and collected=0 GROUP BY patient_id";
                            $pre_select_query = mysqli_query($connect, $pres_select);
                            $num = mysqli_num_rows($pre_select_query);
                            
                            
                            if($num > 0)
                            {
                                while($arr = mysqli_fetch_array($pre_select_query))
                                {
                                    $pid=$arr['id_no'];
                                    //$cc = $arr['id_no'];
                                    $pname = $arr['name'];
                                    $uni=$arr['k'];
                                    $psurname = $arr['surname'];
                                $pdetails = $arr['prescription_concat'];
                                $doctor = $arr['doctor_name'];
                                
                                echo "<table class='table'>";
                                echo "<tr>";
                                echo "<td> Unique Number:";
                                echo "</td>";
                                echo "<td>";
                                echo "$uni";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td>Patient Name: ";
                                echo "</td>";
                                echo "<td> $pname $psurname";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td> Prescribed by:";
                                echo "</td>";
                                echo "<td> $doctor";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td> Prescription:";
                                echo "</td>";
                                $pdetail = str_replace(',','<br />',$pdetails);
                                echo "<td> $pdetail";
                                echo "</td>";
                                echo "</tr>";
                                echo "</table>"
                                . "<br>-----------------------------------<br>Signature<br><br>";
                                }
                                setcookie('pid',$pid);
                                
                            }
                        }else{
                            echo "Prescription not inserted";
                        }
                    ?>
                    <button name="print" id="print" value="Print" onclick="printer()">Print</button><br>
                    <a href="doctor.php#history" style="" id="cancel">Back</a><br>
                    <script type="text/javascript">
                        function printer()
                        {
                            $('#print').hide();
                            window.print();
                            $('#cancel').show();
                        }
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>
