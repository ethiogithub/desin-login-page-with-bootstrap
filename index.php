
<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('database_conn.php');
?>

<?php
$conn = mysqli_connect('localhost','root','r00tme1221') or die ("The connectin is failed");
mysqli_select_db($conn, "stu_meal") or die ("The database not connected");
if(isset($_POST['login'])){
  $user_name = mysqli_real_escape_string($conn, $_POST['username']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);
 //echo hash_password($pass);
  //$hash_pass=hash_password('$pass');
  $_SESSION['username']=$user_name;
  //$_SESSION['usertype']=$utype;
  $query = "SELECT * from user_acount where username='$user_name' and password='".hash_password($pass)."' ";
  $res = mysqli_query($conn, $query); 
  if($res){
    while($row=mysqli_fetch_assoc($res)){
      $utype=$row['usertype'];
      /* $user_type=mysqli_fetch_array($res);*/
      $_SESSION['usertype']=$utype;
      if(isset($_SESSION['usertype'])){
       $query="SELECT status FROM user_acount where username='$user_name'";
       $result=mysqli_query( $conn, $query);
       if($result){
         $st=mysqli_fetch_array($result);
         if($st['status']==1){
          if($_SESSION['usertype']==0){
            $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='0'");
            if($q){
              header( 'Location: http://localhost/dtu/smics/superadmin/bwbfwifordtusadmin.php' );
  //echo '<script>alert("USER NAME AND/OR PASSWORD IS CORRECT for adminstration")</script>';
              $_SESSION['login'] = 1;
            }
          }
          else if($_SESSION['usertype']==1)
          {
            $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='1'");
            if($q){
             header( 'Location: http://localhost/dtu/smics/studentadmin/student_service_admin.php' );
  //echo "<script>alert('USER NAME AND/OR PASSWORD IS CORRECTforuser')</script>";
             $_SESSION['login'] = 1;
           }
         }
         else if($_SESSION['usertype']==2)
         {
          $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='2'");
          if($q){header( 'Location: http://localhost/dtu/smics/student_service_support.php' );
  //echo "<script>alert('USER NAME AND/OR PASSWORD IS CORRECTforuser')</script>";
          $_SESSION['login'] = 1;
        }
      }
      else if($_SESSION['usertype']==3)
      {
        $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='3'");
        if($q){
          header( 'Location: http://localhost/dtu/smics/staffadmin/dtu_staff_admin.php' );
  //echo "<script>alert('USER NAME AND/OR PASSWORD IS CORRECTforuser')</script>";
          $_SESSION['login'] = 1;
        }
      }
      else if($_SESSION['usertype']==4)
      {
        $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='4'");
        if($q){
          header( 'Location: http://localhost/dtu/smics/staff_admin_support.php' );
  //echo "<script>alert('USER NAME AND/OR PASSWORD IS CORRECTforuser')</script>";
          $_SESSION['login'] = 1;
        }
      }
      else if($_SESSION['usertype']==5)
      {
        $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='5'");
        if($q){
          header( 'Location: http://localhost/dtu/smics/cafeadmin/dtu_cafe_adminpage.php' );
  //echo "<script>alert('USER NAME AND/OR PASSWORD IS CORRECTforuser')</script>";
          $_SESSION['login'] = 1;
        }
      }
      else if($_SESSION['usertype']==6)
      {
        $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='6'");
        if($q){
          header( 'Location: http://localhost/dtu/smics/cafeadmin/dtu_cafe_meal.php' );
  //echo "<script>alert('USER NAME AND/OR PASSWORD IS CORRECTforuser')</script>";
          $_SESSION['login'] = 1;
        }
      }
      else if($_SESSION['usertype']==7)
      {
        $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='7'");
        if($q){
          header( 'Location: http://localhost/dtu/smics/securityadmin/stupc_control_and_registration.php' );
  //echo "<script>alert('USER NAME AND/OR PASSWORD IS CORRECTforuser')</script>";
          $_SESSION['login'] = 1;
        }
      }
      else if($_SESSION['usertype']==8)
      {
        $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='7'");
        if($q){
          header( 'Location: http://localhost/dtu/smics/outgoing_control.php' );
  //echo "<script>alert('USER NAME AND/OR PASSWORD IS CORRECTforuser')</script>";
          $_SESSION['login'] = 1;
        }
      }
      else if($_SESSION['usertype']==9)
      {
        $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='9'");
        if($q){
          header( 'Location: http://localhost/dtu/smics/libraryadmin/dtu_library_admin.php' );
  //echo "<script>alert('USER NAME AND/OR PASSWORD IS CORRECTforuser')</script>";
          $_SESSION['login'] = 1;
        }
      }
      else if($_SESSION['usertype']==10)
      {
        $q=mysqli_query($conn,"SELECT * FROM user_acount WHERE password='".hash_password($pass)."' AND usertype='10'");
        if($q){
          header( 'Location: http://localhost/dtu/smics/library/dtulibrary_bookborrowing.php' );
  //echo "<script>alert('USER NAME AND/OR PASSWORD IS CORRECTforuser')</script>";
          $_SESSION['login'] = 1;
        }
      }
      else {
        echo '<script>alert( "Oops  There is no Correct User")</script>';
      }
    }
    else if($st['status']==0){
      echo '<script>alert("Your status is not Activated You have to Ask your Admin")</script>';
    }
    else
      echo '<script>alert("The User Are Not Found")</script>';
  }
}
}
}
else{
 echo '<script> alert ( "Oops  Invalid User " )</script>';
}

$_SESSION['login'] = 0;
}
      //  $passs = "{SSHA}sNPmYlrgdn2ilaU7ByklSuXNlclqdQ==";
function hash_password($pass)
{
  $salt='dtu';
  return '{SSHA}'.base64_encode(sha1($pass.$salt,TRUE).$salt);
}
?>
<head>
  <title>ደብረ ታቦር ዩኒቨርሲቲ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="img/dtu_logo.png" rel="icon">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- MetisMenu CSS -->
  <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="dist/css/sb-admin-2.css" rel="stylesheet">
  <!-- Morris Charts CSS -->
  <link href="vendor/morrisjs/morris.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/datatables-plugins/dataTables.bootstrap.css"  rel="stylesheet">
  <link href="vendor/datatables-responsive/dataTables.responsive.css"  rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap-fileupload.min.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src=vendor/jquery/jquery.min.js></script>
  <script type="text/javascript" src=lang_translate.js></script>
  <!-- Start WOWSlider.com HEAD section -->
  <link rel="stylesheet" type="text/css" href="engine1/style.css" />
  <script type="text/javascript" src="engine1/jquery.js"></script>
  <!-- End WOWSlider.com HEAD section -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style type="text/css">
    .header{
      height:100px;
    }
  </style>
</head>
<body style="background-color:#ebebe0">
  <!--..................................LANGUAGE TRANSLATOR................................................-->
  <div id="google_translate_element"></div>
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
    }
  </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <!--..................................LANGUAGE TRANSLATOR................................................??????-->
  <!--container-->

  <div style="padding-top:14px" class="container">
    <!--HEADER 1-->
    <nav style="max-heigt:100px;background-color:#20416c;color:white" class="navbar navbar-default ">
      <div class="container-fluid"></div>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a ><img class="img-round img-responsive" style="max-height:60px;padding-top:2px" src="img/dtu_cafe_logo.png" /></a>

        
      </div>

      <div  class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul style="margin-right:9px;display:block" class="nav navbar-nav navbar-right">
          <li class=""><a style="color:white;font-size:16px;font-family:italic" href=""><p><b>
            <?php
                /*date_default_timezone_set("Africa/Addis_ababa");
                echo "<em>".date('Y/m/d ')."</em><br><br>";*/
                echo "<b class='lang' key='date'>Date :-</b>  ";
                $Today=date('y:m:d');
                $new=date('l, F d, Y',strtotime($Today));
                echo $new;
                ?>
              </b></p></a></li>
              <li ><a class="lang" key="login" style="color:white;font-size:16px;font-family:italic" href="#loginModal" data-toggle="modal"><p>Login</p></a></li>

              <li style="margin-top: 13px" class="dropdown">
                <button type="button" class="btn dropdown-toggle" id="dropdownMenu1"
                data-toggle="dropdown"><b class="lang" key="select language">Select Langauge</b>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="">
                  <button class="btn btn-primary btn-block"><em class="translate" id="am">አማርኛ</em></button>
                </li>
                <li style="background-color: blue" role="presentation" class="divider"></li>
                <li role="">
                  <button class="btn btn-primary btn-block"><em class="translate" id="gz">ግዕዝ</em></button>
                </li>
                <li style="background-color: blue" role="presentation" class="divider"></li>
                <li role="">
                  <button class="btn btn-primary btn-block"><em class="translate" id="en">English</em></button>
                </li>
              </ul>
            </li>              
          </ul>
        </div>
      </nav>
      <div class="panel panel-primary">
        <div class="panel-heading">
         <center> <h3 class="panel-title"><div class="lang" key="welcome">Welcome to Debre Tabor University Smart Id Card System to start please press Login </div></h3></center>
       </div>
       <div style="background-color:#ccddff" class="panel-body">
        <center>
          <div class="col-lg-5">
            <h3 style="color:#ff0066; padding-top: 25px"> <div class="lang" key="smart">Smart ID Card System for</div> </h3>
          </div>
          <div class="col-lg-2">
            <img src="img/dtu_logo.png">
          </div>
          <div class="col-lg-5">
           <h3 style="color:#ff0066;padding-top: 25px"> <div class="lang" key="dt"> Debre Tabor University (SMICS)</div></h3>
         </div>
       </center>
     </div>
     <div style="margin-top:10px" class="row">
       <aside style="display:block">
         <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><div class="lang" key="list">Basic Lists</div></h3>
            </div>
            <div class="panel-body">
              <button  data-target="#vModal" class="btn btn-primary btn-md btn-block" data-toggle="modal"><div class="lang" key="vision">Vision</div><button>
                <button  data-target="#mModal" class="btn btn-primary btn-md btn-block" data-toggle="modal"><div class="lang" key="mission">Mission</div><button>
                  <button  data-target="#valueModal" class="btn btn-primary btn-md btn-block" data-toggle="modal"><div class="lang" key="value">Value</div><button>
                    <button  data-target="#mottoModal" class="btn btn-primary btn-md btn-block" data-toggle="modal"><div class="lang" key="motto">Motto</div><button>
                      <button  data-target="#helpModal" class="btn btn-primary btn-md btn-block" data-toggle="modal"><div class="lang" key="help">Help</div><button>
                        <button  data-target="#developerModal" class="btn btn-primary btn-md btn-block" data-toggle="modal"><div class="lang" key="developer">Developer</div><button>
                        </div>
                      </div>
                    </aside>
                    <!-- ///////////////////////////////////////////////////////// Modal Developer ///////////////////////////////////////////////-->
                    <div class="modal fade" id="developerModal" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><div class="lang" key="about">About Developers</div></h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-lg-4">
                                <center>
                                  <p><b  class="lang" key="name">Name:</b> Misganaw Aguate (ምሲጋናዉ አጓተ)<br><br>
                                    <p><b class="lang" key="email">Email:</b> ethiomisgie@gmail.com<br><br>
                                      <p><b class="lang" key="phone">Phone No:</b> +251923065189<br>
                                        <p><b class="lang" key="phone">Study Field:</b> Electrical and Computer Engineering<br>
                                          <img style="height:250px;width:225px " class="img-circle" src="img/img3.jpg">
                                        </center>
                                      </div>
                                      <div class="col-lg-4">
                                        <center>
                                          <p><b  class="lang" key="name">Name:</b> Anduamlak Abebe (አንዱአምላክ አበበ)<br><br>
                                            <p><b class="lang" key="email">Email:</b> anduamlak09@gmail.com<br><br>
                                              <p><b class="lang" key="phone">Phone No:</b> +251923217130<br>
                                               <p><b class="lang" key="phone">Study Field:</b> Computer Science<br>
                                                <img style="height:250px;width:225px " class="img-circle" src="img/andu.jpg">
                                              </center>
                                            </div>
                                            <div class="col-lg-4">
                                              <center>
                                                <p><b  class="lang" key="name">Name:</b> Biks Alebachew (ቢክስ አለባቸው )<br><br>
                                                  <p><b class="lang" key="email">Email:</b> bik0197@gmail.com<br><br>
                                                    <p><b class="lang" key="phone">Phone No:</b> +251910410185<br>
                                                     <p><b class="lang" key="phone">Study Field:</b> Electrical and Computer Engineering<br>
                                                      <img style="height:250px;width:225px " class="img-circle" src="img/bikis.jpg">
                                                    </center>
                                                  </div>                          
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><b class="lang" key="close">Close</b></button>
                                              </div>
                                            </div>

                                          </div>
                                        </div>
                                        <!-- ///////////////////////////////////////////////////////// Modal Developer ///////////////////////////////////////////////-->


                                        <!-- ///////////////////////////////////////////////////////// Modal vission ///////////////////////////////////////////////-->
                                        <div class="modal fade" id="vModal" role="dialog">
                                          <div class="modal-dialog modal-lg">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><div class="lang" key="vision">Vision</div></h4>
                                              </div>
                                              <div class="modal-body">
                                                <p><div class="lang" key="vision">Vision:</div><br><br>
                                                  <div class="lang" key="fdescription">Debre Tabor University tries hard to become one of the top universities in the country in quality education in 2020 (2012 E.C)</div> </p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal"><b class="lang" key="close">Close</b></button>
                                                </div>
                                              </div>

                                            </div>
                                          </div>
                                          <!-- ///////////////////////////////////////////////////////// Modal vission ///////////////////////////////////////////////-->

                                          <!-- ///////////////////////////////////////////////////////// Modal value ///////////////////////////////////////////////-->
                                          <div class="modal fade" id="mModal" role="dialog">
                                            <div class="modal-dialog modal-lg">

                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"><div class="lang" key="mission">Mission</div></h4>
                                                </div>
                                                <div class="modal-body">
                                                  <p><div class="lang" key="mission">Mission:</div><br><br>
                                                   Debre Tabor University aspires to generate self reliant, competent, problem solving, research oriented and innovative transformation agents who
                                                   can actively participate in the teaching learning, research doing and community services that basically enhance the technological advancement 
                                                   of the society as a whole. </p>
                                                 </div>
                                                 <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal"><b class="lang" key="close">Close</b></button>
                                                </div>
                                              </div>

                                            </div>
                                          </div>

                                          <!-- ///////////////////////////////////////////////////////// Modal mission ///////////////////////////////////////////////-->

                                          <!-- ///////////////////////////////////////////////////////// Modal value ///////////////////////////////////////////////-->
                                          <div class="modal fade" id="valueModal" role="dialog">
                                            <div class="modal-dialog modal-lg">

                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title"><div class="lang" key="val">Values</div></h4>
                                                </div>
                                                <div class="modal-body">
                                                  <p><div class="lang" key="val">Values</div><br>
                                                   <div class="lang" key="first"> Customer First</div> 
                                                   <div class="lang" key="quality">Quality oriented</div> 
                                                   <div class="lang" key="teamwork">Cutting edge research</div> 
                                                   <div class="lang" key="inovation">Escalating success</div> 
                                                   <div class="lang" key="scalup">Team spirit</div> 
                                                   <div class="lang" key="ethics">Promoting commitment</div>
                                                   <div class="lang" key="ethics">Green for All</div>
                                                   <div class="lang" key="ethics">High Moral and Ethical standard</div>
                                                   <div class="lang" key="ethics">Sense of Responsible Citizenship</div>

                                                 </p>
                                               </div>
                                               <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><b class="lang" key="close">Close</b></button>
                                              </div>
                                            </div>

                                          </div>
                                        </div>
                                        <!-- ///////////////////////////////////////////////////////// Modal value ///////////////////////////////////////////////-->
                                        <!-- ///////////////////////////////////////////////////////// Modal motto ///////////////////////////////////////////////-->
                                        <div class="modal fade" id="mottoModal" role="dialog">
                                          <div class="modal-dialog modal-lg">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><div class="lang" key="val">MOTTO</div></h4>
                                              </div>
                                              <div class="modal-body">
                                                <p><div class="lang" key="val">MOTTO</div><br>
                                                 <div class="lang" key="motto"> Debre Tabor University has A historical duty to answer Tewodros's quest for knowledge</div>                           

                                               </p>
                                             </div>
                                             <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal"><b class="lang" key="close">Close</b></button>
                                            </div>
                                          </div>

                                        </div>
                                      </div>
                                      <!-- ///////////////////////////////////////////////////////// Modal value ///////////////////////////////////////////////-->
                                      <div class="col-md-8" style="margin-right:0px;">
                                        <!-- Start WOWSlider.com BODY section -->
                                        <div id="wowslider-container1">
                                          <div class="ws_images"><ul>
                                            <li><img src="data1/image/cafe1.jpg" alt="cafe1" title="cafe1" id=""/></li>
                                            <li><img src="data1/image/cafe2.jpg" alt="cafe2" title="cafe2" id=""/></li>
                                            <li><img src="data1/image/cafe3.jpg" alt="cafe3" title="cafe3" id=""/></li>
                                            <li><img src="data1/image/DTU cafe.jpg" alt="DTU cafe" title="DTU cafe" id=""/></li>
                                            <li><img src="data1/image/slide6.jpg" alt="slide6" title="slide6" id=""/></li>
                                            <li><img src="data1/image/main.jpg" alt="DTU main library" title="DTU main library" id=""/></li>
                                            <li><img src="data1/image/dorm.jpg" alt="DTU student Dormitary" title="DTU student Dormitary" id=""/></li>
                                            <li><img src="data1/image/Graguation.jpg" alt="Graguation" title="Graguation" id=""/></li>
                                          </ul></div>
                                          <div class="ws_bullets"><div>
                                            <a href="#" title="IMG_20170925_200409"><span><img src="data1/tooltips/cafe1.jpg" alt="IMG_20170925_200409"/>1</span></a>
                                            <a href="#" title="IMG_20170925_200430"><span><img src="data1/tooltips/cafe2.jpg" alt="IMG_20170925_200430"/>3</span></a>
                                            <a href="#" title="IMG_20170925_200433"><span><img src="data1/tooltips/cafe3.jpg" alt="IMG_20170925_200433"/>4</span></a>
                                            <a href="#" title="IMG_20170925_200421"><span><img src="data1/tooltips/DTU cafe.jpg" alt="IMG_20170925_200421"/>2</span></a>
                                            <a href="#" title="IMG_20170926_183037"><span><img src="data1/tooltips/slide6.jpg" alt="IMG_20170926_183037"/>6</span></a>
                                            <a href="#" title="IMG_20170926_183044"><span><img src="data1/tooltips/slide7.jpg" alt="IMG_20170926_183044"/>7</span></a>
                                            <a href="#" title="IMG_20170926_183058"><span><img src="data1/tooltips/slide8.jpg" alt="IMG_20170926_183058"/>8</span></a>
                                            <a href="#" title="IMG_20170926_183105"><span><img src="data1/tooltips/slide9.jpg" alt="IMG_20170926_183105"/>9</span></a>
                                          </div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com">slideshow javascript</a> by WOWSlider.com v8.2</div>
                                          <div class="ws_shadow"></div>
                                        </div>  
                                        <script type="text/javascript" src="engine1/wowslider.js"></script>
                                        <script type="text/javascript" src="engine1/script.js"></script>
                                        <!-- End WOWSlider.com BODY section -->
                                      </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div style="background-color:#00ff80" class="modal-header">
                                          <button type="button" class="close"
                                          data-dismiss="modal" aria-hidden="true">
                                          &times;
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">
                                         <div class="lang" key="please"> Please Enter your Userename and Password</div>
                                       </h4>
                                     </div>
                                     <div class="modal-body">
                                      <!--login form-->
                                      <form class="form-horizontal" method="POST" action="index.php">
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="email"><div class="lang" key="ema">Email(User Name):</div></label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" id="email" placeholder="Enter email or username" name="username" autofocus="autofocus" >
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-sm-2" for="pwd"><div class="lang" key="password">Password:</div></label>
                                          <div class="col-sm-8">          
                                            <input type="password" class="form-control" id="pwd" autocomplete="none" placeholder="Enter password" name="password" 
                                            id="password">
                                          </div>
        <!--div class="col-sm-8">          
          <progress class=" col-sm-offset-3" max="100" min="0" id="strength" style="width:360px"></progress>
        </div -->        
      </div>     
      <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label><input type="checkbox" name="remember"> <div class="lang" key="remember">Remember me</div></label>
          </div>
        </div>
      </div>
      <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-12">
          <button type="submit" name="login" class="btn btn-success"><i class="fa fa-sign-in"></i>&nbsp;<div class="lang" key="login">login</div></button>
          <button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove">&nbsp;</span><div class="lang" key="close">Cancle</div></button>
        </div>
      </div>
    </form>
    <!--login form-->
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default"
    data-dismiss="modal"><div class="lang" key="close"> Close</div>
  </button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal -->
</div>

</div>
<center>      


  <div class="footer-social">
    <a href="http://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
    <a href="http://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
    <a href="http://www.youtube.com" target="_blank"><i class="fa fa-youtube"></i></a>
    <a href="http://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
  </div>
</center>
</div>
</div>
</div>
</div>
</div>
<div class="footer-bottom-area">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="copyright">
          <p align="right">&copy; 2010   ደብረ ታቦር ዩኒቨርሲቲ | All Rights are Reserved </p>
        </div>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="vendor/morrisjs/morris.css" rel="stylesheet">
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="vendor/bootstrap/css/bootstrap-fileupload.min.css" rel="stylesheet" type="text/css">
<!-- End WOWSlider.com HEAD section -->
<script type="text/javascript"> 
  var pass=document.getElementById("password")
  pass.addEventListener('keyup', function(){
    checkPassword(pass.value)
  })
  function checkPassword(password){
    var strengthbar=ducument.getElementById("strength")
    var strength=0;
    if(password.match(/[a-zA-Z0-9][a-zA-Z0-9]+/)){
      strength +=1
    }
    if(password.match(/[~<>?]+/){
     strength +=1
   }
   if(password.match(/[!@$%^&()#<>?]+/){
     strength +=1
   }
   if(password.length>)
    strength +=1
  switch(strength){
    case 0:
    strengthbar.value=20;
    break
    case 1:
    strengthbar.value=40;
    break
    case 2:
    strengthbar.value=60;
    break  
    case 3:
    strengthbar.value=80;
    break
    case 4:
    strengthbar.value=100;
    break      
  }
}
</script>
</body>

</html>