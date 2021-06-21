<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Availability at other Clinics</title>
        <meta charset="UTF-8">
        <link href="css/styles.css" type="text/css" rel="stylesheet"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="jquery-ui-1.12.1/jquery-ui.js"></script>
    </head>
    <?php
        include 'inc/connection.php';
        include 'inc/meds_order.php';
    ?>
    <body>
        <div class="row" style="box-shadow: 5px 5px 5px silver">
            <div class="col-md-6" style="padding-left:3%;padding-bottom: 5px;">
                  <img src="images/thetho.png" alt="sthethoscope" width="10%"/>
            </div>
            <div class='col-md-6' style='text-align: right;padding-top: 15px;padding-right: 3%'>
                <a href='dispenser.php'>Logout <?php if(filter_input(INPUT_POST,'username')){ echo $_COOKIE['username'];}?></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php
                if(filter_input(INPUT_POST,'clinic'))
                {
                    $data = "select orders_meds from orders";
                $q_data = mysqli_query($connect,$data);
                echo"<table class='table'>"
                . "<thead>"
                        . "<th>Medicine</th>"
                        . "<th>Clinic</th>"
                        . "<th>In Stock</th>"
                        . "</thead>";
                echo "<tbody>";
                while($row = mysqli_fetch_array($q_data))
                {
                    $check = $row['orders_meds'];
                    $qcheck = "select distinct medicine_name,quantity,clinic_name from medicine join med_clinic using (medicine_id) join clinic using (clinic_id) where medicine_name='$check' and quantity > 0";
                    $checkq = mysqli_query($connect,$qcheck);
                    while($r = mysqli_fetch_array($checkq))
                    {
                        $med = $r['medicine_name'];
                        $clinic = $r['clinic_name'];
                        $qty = $r['quantity'];
                       echo "<tr>"
                        . "<td>".$med."</td>"
                               . "<td>".$clinic."</td>"
                               . "<td>".$qty."</td>";
                       echo"</tr>";
                    }
                }
                }
                
        ?>
                <br><form method="post" action="">
                    <select name="clinic" class="form-control">
                        <option>Select Clinic</option>
                        <option>JHB</option>
                        <option>PTA</option>
                        <option>CPT</option>
                        <option>DBN</option>
                    </select><br>
                    <input type="submit" name="submit" value="Order" class="form-control">
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
        
    </body>
</html>
