<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include 'inc/connection.php';
    include 'inc/reg_patient.php';
    include 'inc/getPatient.php';
    include 'inc/collect.php';

    session_start();
    //$success ="www";
    $search = $_SESSION=filter_input(INPUT_POST,'search_id');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dispenser</title>
        <link href="css/styles.css" type="text/css" rel="stylesheet"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="row" style="box-shadow: 5px 5px 5px silver">
            <div class="col-md-6" style="padding-left:3%;padding-bottom: 5px;">
                <img src="images/thetho.png" alt="sthethoscope" width="10%"/>
            </div>
            <div class='col-md-6' style='text-align: right;padding-top: 15px;padding-right: 3%'>
                <a href='index.php'>Logout <?php if(isset($_COOKIE['username'])){ echo $_COOKIE['user_name'];}?></a>
            </div>
        </div>
        <div class="row" style="padding-top: 2%">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <ul class="nav nav-tabs" role="tablist" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link active" role="tab" data-toggle="tab" href="#home">Existing Patient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu">New Patient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#orders">Orders</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <form method="post" action="">
                            <br> Enter ID\Prescription Number to search Patient:<br>
                            <input type='text' name='search_id' class='form-control' value="<?php if(!empty($search)){ echo $search;}?>"/><br>
                            <input type='submit' name='search' value='Search' class='form-control'/>
                            <div style="font: 14px italic;color: red;"><?php echo $error;echo $empty; ?></div>
                            <table class="table" style="font-size:13px;">
                                <thead>
                                <th>Name</th>
                                <th>Unique no</th>
                                <th>Prescription</th>
                                <th>Prescribed By</th>
                                <th>Collect</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $pname ?></td>
                                        <td><?php echo $unique?></td>
                                        <?php $pdet = str_replace(',','<br />',$pdetails) ?>
                                        <td><?php echo $pdet ?></td>
                                        <td><?php echo $doctor ?></td>
                                        <td>
                                            <input type="checkbox" name="collect" class="form-control"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php echo $meds; ?>
                           <input type="submit" name="collected" value="0k" class="form-control"/>
                        <div style=""><?php echo $updates ?> </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="menu">
                        <form action='' id="details" method="post">
                            <br><h3>New Patient</h3><br>
                            First Name:
                            <input type='text' name='first_name' class='form-control'/>
                            <br>Last Name:
                            <input type='text' name='last_name' class='form-control'/>
                            <br>Date Of Birth:
                            <input type='date' name='dob' class='form-control'/>
                            <br>ID No:
                            <input type='text' name='id_no' size="13" id="idn" onfocusout="myFunction" class="form-control"/>
                            <div id="debug" style="font-style: italic;color:red;"></div>
                            <br>Age:
                            <input type='text' name='age' class="form-control"/>
                            <br>Contact Tel:
                            <input type='tel' id="contact" size="10" name='contact' class='form-control'/>
                            <div id="display" style="font-style: italic;color:red;"></div>
                            <br>Address:
                            <input type='text' name='address' class='form-control'/><br>
                            <input type='submit' name='register' value='Register' class='form-control'/><br><br>
                                  </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="orders">
                        <?php
                        $p_id=filter_input(INPUT_COOKIE,'unique');
                           if(!empty($p_id)){
                                
                                $find_patient =  "select patient_id,name,surname,id_no,sum(prescription_id) as k, GROUP_CONCAT(prescription_details) as prescription_concat,collected,doctor_name"
                                . " from patient join prescription using(patient_id) join doctor using(doctor_id) where patient_id=$p_id and ordered=1 GROUP BY id_no";
                                $find_query=  mysqli_query($connect, $find_patient);
                                $num = mysqli_num_rows($find_query);
                                $arr_find = mysqli_fetch_array($find_query);
                                    if($num >0)
                                    {
                                         $pass = $arr_find['patient_id'];
                                        $pname = $arr_find['name'];
                                         $unique = $arr_find['k'];
                                         $surname =$arr_find['surname'];
                                         $id = $arr_find['id_no'];
                                         $pdetails = $arr_find['prescription_concat'];
                                        $doctor = $arr_find['doctor_name'];
                                        echo "Medicine orderd for: <br />".$pname." ".$surname."<br /> ID No: ".$id."<br><br>";
                                        $pdetail = str_replace(',','<br />',$pdetails);
                                        echo $pdetail;
                                    }else{
                                        echo "Patient has no outstanding orders";
                                    }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
         <script type ="text/javascript">
    $('#myTab a').click(function(e){
        e.preventDefault();
       $(this).tab('show'); 
    });
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e){
        var id = $(e.target).attr('href').substr(1);
        window.location.hash = id;
    });
    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');
</script>
                 
    </body>
</html>
<script type="text/javascript">
  function validateRSAidnumber() {

  $('#debug').empty();

  // the anatomy of an RSA ID Number : http://warwickchapman.com/the-anatomy-of-an-rsa-id-number
  // structure: (YYMMDD GSSS CAZ)

  var idnumber = $('#idn').val(),
    invalid = 0;

  // display debugging
  var debug = $('#debug');

  // check that value submitted is a number
  if (isNaN(idnumber)) {
    debug.append('Value supplied is not a valid number.<br />');
    invalid++;
  }

  // check length of 13 digits
  if (idnumber.length !== 13) {
    debug.append('Number supplied does not have 13 digits.<br />');
    invalid++;
  }

  // check that YYMMDD group is a valid date
  var yy = idnumber.substring(0, 2),
    mm = idnumber.substring(2, 4),
    dd = idnumber.substring(4, 6);

  var dob = new Date(yy, (mm - 1), dd);

  // check values - add one to month because Date() uses 0-11 for months
  if (!(((dob.getFullYear() + '').substring(2, 4) === yy) && (dob.getMonth() === mm - 1) && (dob.getDate() === dd))) {
    debug.append('Date in first 6 digits is invalid.<br />');
    invalid++;
  }

  // evaluate GSSS group for gender and sequence 
  var gender = parseInt(idnumber.substring(6, 10), 10) > 5000 ? "M" : "F";

  // ensure third to last digit is a 1 or a 0
  if (idnumber.substring(10, 11) > 1) {
    debug.append('Third to last digit can only be a 0 or 1 but is a ' + idnumber.substring(10, 11) + '.<br />');
    invalid++;
  } else {
    // determine citizenship from third to last digit (C)
    var saffer = parseInt(idnumber.substring(10, 11), 10) === 0 ? "C" : "F";
  }

  // ensure second to last digit is a 8 or a 9
  if (idnumber.substring(11, 12) < 8) {
    debug.append('Second to last digit can only be a 8 or 9 but is a ' + idnumber.substring(11, 12) + '.<br />');
    invalid++;
  }

  // calculate check bit (Z) using the Luhn algorithm
  var ncheck = 0,
    beven = false;

  for (var c = idnumber.length - 1; c >= 0; c--) {
    var cdigit = idnumber.charAt(c),
      ndigit = parseInt(cdigit, 10);

    if (beven) {
      if ((ndigit *= 2) > 9) ndigit -= 9;
    }

    ncheck += ndigit;
    beven = !beven;
  }

  if ((ncheck % 10) !== 0) {
    debug.append('Checkbit is incorrect.<br />');
    invalid++;
  }

  // if one or more checks fail, display details
  if (invalid > 0) {
    debug.css('display', 'block');
  }

  return (ncheck % 10) === 0;
}
 $("#idn").focusout(validateRSAidnumber);

    
</script>