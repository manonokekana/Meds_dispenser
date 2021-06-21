    <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include 'inc/record.php';
    include 'inc/prescribe.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Doctor</title>
        <link href="css/styles.css" type="text/css" rel="stylesheet"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="jquery-ui-1.12.1/jquery-ui.js"></script>
    </head>
    <?php
    session_start();
    //$success ="www";
    $id_s = $_SESSION=filter_input(INPUT_POST,'patient_id');
    $diagnost = $_SESSION=filter_input(INPUT_POST,'records');
    $comments = $_SESSION = filter_input(INPUT_POST,'comments');
    $r_date = $_SESSION = filter_input(INPUT_POST,'r_date');
    ?>
    <body>
        <div class="row" style="box-shadow: 5px 5px 5px silver">
            <div class="col-md-6" style="padding-left:3%;padding-bottom: 5px;">
                  <img src="images/thetho.png" alt="sthethoscope" width="10%"/>
            </div>
            <div class='col-md-6' style='text-align: right;padding-top: 15px;padding-right: 3%'>
                <a href='index.php'><< back "<?php echo $_COOKIE['username'];?>"</a>
            </div>
        </div>
        <div class="row" style="padding-top: 2%">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <ul class="nav nav-tabs" role="tablist" id="myTab">
                    <li class="nav-item">
                        <a class="nav-link active" role="tab" data-toggle="tab" href="#home">Record Patient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu">Prescribe Medicine</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#history">Medical History</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <form method="post" action="">
                            <br>Patient ID NO:
                            <input type="text" name="patient_id" class="form-control" value="<?php if(!empty($id_s)){ echo $id_s;}?>">
                            <div style="font-style: italic;color: red"><?php echo $error;?></div>
                            <br>Diagnostics & Results:
                            <input type="text" name="records" class="form-control" value="<?php if(!empty($diagnost)){ echo $diagnost;}?>">
                            <br>Additional Comments:
                            <input type="text" name="comments" class="form-control" value="<?php if(!empty($comments)){ echo $comments;}?>">
                            <br>Return Date:
                            <div class="calender_block">
                                <input type="text" id="select_date" name="r_date" class="form-control" value="<?php if(!empty($r_date)){ echo $r_date;}?>">
                                <br>
                            </div>
                            <input type="submit" name="record_visit" value="Record Visit" class="form-control"/>
                            <div style="color:red;font-style:italic;"><br> <?php echo $success; ?></div>
                            <br><a href="logout.php" id="clear">Cancel</a>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="menu">
                        <form action='' method="post">
                            <br><i> Patient ID:
                            <?php
                                  if(!empty($id_s)){ echo $id_s;}   
                            ?>
                            <br>Please enter patient's subscription below:</i><br><br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Medicine</th>
                                        <th>Quantity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                                $s_query = "select medicine_name from medicine";
                                                $medicine = mysqli_query($connect, $s_query);
                                                if(mysqli_num_rows($medicine)!=0)
                                                {
                                                    echo '<select name="medicine" id="medicine" class="form-control">'
                                                    . '<option value="" selected="selected">Choose Medicine</option>';
                                                    while($row = mysqli_fetch_array($medicine))
                                                    {
                                                        echo '<option value="'.$row['medicine_name'].'">'.$row['medicine_name'].'</option>';
                                                    } 
                                                    echo '</select>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="col-xs-2">
                                                <input type="text" name="qty" id="qty" class="form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" name="add" onclick="addMed()" class="form-control">Add</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <select id="mySelect" name="mySelect[]" multiple size="4" class="form-control">  
                            </select><br>
                            <input type="button" id="myBtn" class="form-control" value="Prescribe" name="pre_meds" onclick="selectAll()"/>
                            <?php echo $message ?>
                            <div id="myModal" class="modal" data-backdrop="static">
                        <div class="col-md-6 modal-content" style="text-align: center;">
                          <span class="close">&times;</span>
                          <p>How you would like to give the Prescription to the Patient?</p>
                          <table>
                              <tr>
                                  <td align="right">
                                      <input type="submit" name="sms" class="form-control" value="SMS" onclick="selectAll()"/>
                                  </td>
                                  <td>
                                      <input type="submit" name="print" class="form-control" value="Print" onclick="selectAll()"/>
                                  </td>
                                  <td align="left">
                                      <input type="button" id="cancel" name="cancel" class="form-control" value="Cancel"/>
                                  </td>
                              </tr>
                          </table>
                        </div>
                        </div>
                        </form>
                        
                       
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="history">
                        <?php
                            
                        if(!empty($id_s))
                        {
                            $myfile = fopen("records\.$id_s.txt","r");
                            while(! feof($myfile))
                            {
                                echo fgets($myfile)."<br />";
                            }
                            fclose($myfile);
                        }else if(!empty($_COOKIE['pid'])) 
                            {
                                $cc = filter_input(INPUT_COOKIE,'pid');
                                $myfile = fopen("records\.$cc.txt","r");
                            while(! feof($myfile))
                            {
                                echo fgets($myfile)."<br />";
                            }
                            fclose($myfile);
                            }  else {
                            echo "No record/patient selected!!";
                        }   
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </body>
</html>
<script type ="text/javascript">
    $(function(){
        $("#select_date").datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            minDate: new Date()
            });
          });
    
    var arrayitems = [];
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
    
    function addMed()
    {
        var opt = document.getElementById('medicine').value;
        var qty = document.getElementById('qty').value;
        var comb = opt.concat(" [",qty,"]");
        var x = document.getElementById("mySelect");
        var option = document.createElement("option");
        option.text = comb;
        x.add(option);
        
        arrayitems.push(comb);
     //   var x1 = arrayitems.toString();
     //   alert(x1);
    }
    function selectAll() 
    { 
        selectBox = document.getElementById("mySelect");

        for (var i = 0; i < selectBox.options.length; i++) 
        { 
             selectBox.options[i].selected = true; 
        } 
    }
    var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
var cancel = document.getElementById("cancel");

btn.onclick = function() {
  modal.style.display = "block";
};

span.onclick = function() {
  modal.style.display = "none";
};

window.onclick = function(event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
};
cancel.onclick = function(){
    modal.style.display = "none";
}

</script>
     