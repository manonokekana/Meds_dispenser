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
        <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    </head>
    <?php
    include 'inc/connection.php';
    $incorrect= "";
    ?>
    
<?php
    $user_logged = filter_input(INPUT_POST,'log_user');
    $p_user_pass= filter_input(INPUT_POST, 'user_password');
    
    if(filter_input(INPUT_POST,'submit'))
    {
        if(filter_input(INPUT_POST,'user')=='doctor')
        {
            if(!empty($user_logged) && !empty($p_user_pass))
            {
                $find_doc = "select * from doctor where practice_no = '$user_logged'";
                $find_query= mysqli_query($connect, $find_doc);
                $num_user = mysqli_num_rows($find_query);
                $arr_user = mysqli_fetch_array($find_query);
                if($num_user==1)
                {
                    $l_user = $arr_user['doctor_name'];
                    $l_id = $arr_user['doctor_id'];
                    $l_password=$arr_user['password'];
                    if($p_user_pass==$l_password)
                    {
                        setcookie('username',$l_user);
                        setcookie('d_id',$l_id);
                        header('location:doctor.php');
                    }else{
                        $incorrect = 'invalid password';
                    }
                }  else {
                    $incorrect = 'invalid username';
                } 
            }  else {
                $incorrect = "Please enter all the credentials";
            }
        }elseif(filter_input(INPUT_POST,'user')=='dispenser')
        {
            if(!empty($user_logged) && !empty($p_user_pass))
            {
                $front_d = "select * from dispenser where emp_no = '$user_logged'";
                $front_query = mysqli_query($connect,$front_d);
                $num_front = mysqli_num_rows($front_query);
                $arr_front= mysqli_fetch_array($front_query);
                if($num_front ==1)
                {
                    $p_user = $arr_front['front_name'];
                    $password = $arr_front['password'];
                    if($p_user_pass==$password)
                    {
                        setcookie('user_name',$p_user);
                        header('location:dispenser.php'); 
                    } else {
                        $incorrect = "Invalid Password";
                    }
                }  else {
                     $incorrect = "Invalid Employee number";
                }
            }else {
                $incorrect = "Please enter all the credentials";
            }
        }elseif(filter_input(INPUT_POST,'user') == "")
            {
                $incorrect = "Please select Dispenser or Doctor";
            }
    }?>
  <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="padding-top: 5%;text-align: center;">
                    <img src="images/thetho.png" alt="sthethoscope" width="100%"/>
                    <br>
                    <form method="post" action="index.php">
                        <table style="text-align: left">
                            <tr>
                                <td>
                                    <input type="radio" name="user" id="doctor" value="doctor"/>
                                </td>
                                <td>
                                    Doctor
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" name="user" id="dispenser" value="dispenser"
                                </td>
                                <td>
                                    Pharmacist/Front Desk
                                </td>
                            </tr>
                            
                        </table><br>
                        
                        <script type="text/javascript">
                            var user = "";
                            $("#doctor").click(function(){
                                document.getElementById('usee').innerHTML = "Please enter practice no:";
                            });
                            $("#dispenser").click(function(){
                                document.getElementById('usee').innerHTML = "Please enter employee code:";
                            });
                            
                        </script>
                        <div id="usee"></div>
                        <input type="text" name="log_user" class="form-control" placeholder="Enter Practice/Employee no"/><br>
                        <input type="password" name="user_password" class="form-control" placeholder="Enter Password" /><br>
                        <input type="submit" name="submit" value="Submit" class="form-control"/>
                        <br><div style="color: red"><?php echo $incorrect ?></div>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>    
       
      