<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Clinic System</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/styles.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
        <script src="jquery-ui-1.12.1/jquery-ui.js"></script>
    </head>
    <?php
        include 'inc\connection.php';
    ?>
  <body>
 
<input type="submit" value="xxxx" id="myBtn">
<div id="myModal" class="modal">
  <div class="modal-content" style="text-align: center;">
    <span class="close">&times;</span>
    <p>How you would like to give the Prescription to the Patient?</p>
    <table>
        <tr>
            <td align="right">
                <button class="form-control" onclick="window.location.href =''">&nbsp;SMS&nbsp;</button>
            </td>
            <td>
                <button class="form-control" onclick="">Print</button>
            </td>
            <td align="left">
                <button class="form-control" onclick="window.location.href =''">Cancel</button>
            </td>
        </tr>
    </table>
  </div>
</div>
<script type="text/javascript">
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

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

</script>
  </body>
      