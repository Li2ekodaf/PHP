
<?php include 'header.php'?>
<?php   error_reporting(0); ?> 

    <!-- Start Breadcrumb 
    =====================1,900 X 1,267======================== -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center padding-xl text-light" style="background-image: url(assets/img/banner/aboutbreadcrumb.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 text-left">
                    <h1>CENSUS</h1>
                </div>
                <div class="col-md-6 col-sm-6 text-right">
                    <ul class="breadcrumb">
                        <li><a href=".">Home</a></li>
                        <li class="active">CENSUS</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start History
    ============================================= -->
    <section class="history-area">
        <div class="container">
            <h3 style="text-align: center;">DATA CAPTURE CENTER</h3>






          
<?php
require_once 'connection1.php';
                

error_reporting(0);


if(isset($_POST['btn_insert']))
{
  try
  {

    function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Save image 
    imagejpeg($image, $destination, $quality); 
     
    // Return compressed image 
    return $destination; 
}


    $passport  = explode(".", $_FILES["passport"]["name"]);
    $type   = $_FILES["passport"]["type"]; //file name "txt_file"
    $size   = $_FILES["passport"]["size"];
    $temp   = $_FILES["passport"]["tmp_name"];
    

    $newfilename = round(microtime(true)) . '.' . end($passport);

    $path="admin-panel/img/census/".$newfilename; //set upload folder path

    $imageUploadPath = $path . $fileName; 
    $compressedImage = compressImage($temp, $imageUploadPath, 10);

    



    $url = $_POST['url'];
    $surname = $_POST['surname'];
    $firstname = $_POST['firstname'];
    $othername = $_POST['othername'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $marital = $_POST['marital'];
    $phydis = $_POST['phydis'];
    $community = $_POST['community'];
    $uheri = $_POST['uheri'];
    $ezede = $_POST['ezede'];
    $uweye = $_POST['uweye'];
    $occu = $_POST['occu'];
    $EduBackground = $_POST['EduBackground'];
    $SchoolLevel = $_POST['SchoolLevel'];
    $course = $_POST['course'];
    $qualification = $_POST['qualification'];
    $EduStatus = $_POST['EduStatus'];
    $SchoolAttended = $_POST['SchoolAttended'];
    
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];
    $NotHashed = $password;
    $recorddate = $_POST['recorddate'];
    $RegBy = $_POST['RegBy'];
    $url = $_POST['url'];

    if(strlen($_POST['surname']) < 2 ){
        $error[] = 'Surname cannot be one character.';
    }
    if(strlen($_POST['firstname']) < 2 ){
        $error[] = 'Firstname cannot be one character.';
    }
    

    if($_POST['password'] != $_POST['rpassword']){
            $error[] = 'Passwords do not match.';
        }


        $stmt = $db->prepare('SELECT email FROM people WHERE email = :email');
        $stmt->execute(array(':email' => $email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['email'])){
            $error[] = 'Email provided already exists.';
        }

        $stmt = $db->prepare('SELECT phoneno FROM people WHERE phoneno = :phoneno');
        $stmt->execute(array(':phoneno' => $phoneno));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['phoneno'])){
            $error[] = 'Phone number provided already exists.';
        }


    if($passport)
    {
      if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png') //check file extension
      { 




        
            if(!$error){
            //unlink($directory.$row['passport']); //unlink function remove previous file
            move_uploaded_file($temp, "admin-panel/img/census/" .$compressedImage); //move upload file temperory directory to your upload folder
          }else{

            }
          
        
      }
      else
      {
        $error[]="Upload Image With; JPG, JPEG & PNG File Formate"; //error message file extension

      }
    }
    else
    {
      $passport=$row['passport']; //if you not select new image than previous image sam it is it.
    }
    

   
    if(!$error)
    {

        


      $pwd = md5("$password");

      $update_stmt=$db->prepare('INSERT INTO people (surname,firstname,othername,sex,age,marital,phydis,community,uheri,ezede,uweye, occu, EduBackground, SchoolLevel,course,qualification,EduStatus,SchoolAttended,email,phoneno,password,NotHashed,passport,recorddate,RegBy,url) VALUES (:surname, :firstname, :othername, :sex, :age, :marital, :phydis, :community, :uheri, :ezede, :uweye, :occu, :EduBackground, :SchoolLevel, :course, :qualification, :EduStatus, :SchoolAttended, :email, :phoneno, :pwd, :NotHashed, :newfilename, :recorddate, :RegBy, :url)'); //sql update query
      $update_stmt->bindParam(':surname',$surname);
      $update_stmt->bindParam(':firstname',$firstname);
      $update_stmt->bindParam(':othername',$othername);
      $update_stmt->bindParam(':sex',$sex);
      $update_stmt->bindParam(':age',$age);
      $update_stmt->bindParam(':marital',$marital);
      $update_stmt->bindParam(':phydis',$phydis);
      $update_stmt->bindParam(':community',$community);
      $update_stmt->bindParam(':uheri',$uheri);
      $update_stmt->bindParam(':ezede',$ezede);
      $update_stmt->bindParam(':uweye',$uweye);
      $update_stmt->bindParam(':occu',$occu);
      $update_stmt->bindParam(':EduBackground',$EduBackground);
      $update_stmt->bindParam(':SchoolLevel',$SchoolLevel);
      $update_stmt->bindParam(':course',$course);
      $update_stmt->bindParam(':qualification',$qualification);
      $update_stmt->bindParam(':EduStatus',$EduStatus);
      $update_stmt->bindParam(':SchoolAttended',$SchoolAttended);
      
      $update_stmt->bindParam(':email',$email);
      $update_stmt->bindParam(':phoneno',$phoneno);
      $update_stmt->bindParam(':pwd',$pwd);
      $update_stmt->bindParam(':NotHashed',$NotHashed);
      $update_stmt->bindParam(':newfilename',$newfilename);
      $update_stmt->bindParam(':recorddate',$recorddate);
      $update_stmt->bindParam(':RegBy',$RegBy);
      $update_stmt->bindParam(':url',$url);


       
      if($update_stmt->execute())
      {
        $updateMsg = "Your record has been successfully added to census! Please do not add again. Thank you!</p>";
      }
    }
  }
  catch(PDOException $e)
  {
    $error[] = "Failed To Capture Data!";
  }
  
}

?>


<?php 

$url = '0123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM';
$url = str_shuffle($url);

$url = substr($url,0,20);

?>


<?php

    include ("config/db.php");
    $id = $_SESSION['id'];
    $update_query = "SELECT * FROM people WHERE id = '$id'";
    $update_result = mysqli_query($conn, $update_query) or die("error");
    if(mysqli_num_rows($update_result) > 0){
      while ($update = mysqli_fetch_assoc($update_result)) {
          $id = $update['id'];
          $email = $update['email'];
          
     
      }
    }
  ?>




<!--Input Sanitizing Script-->
<script type="text/JavaScript">
function valid(f) {
!(/[A-z-]\\^$/i).test(f.value)?f.value = f.value.replace(/[^A-z-]/ig,''):null;
} 
</script>
<script type="text/javascript">
      $(document).ready(function(){
          $("#textbox").keypress(function (e) {
            var key = e.keyCode || e.which;       
            $("#error_msg").html("");
            //Regular Expression
            var reg_exp = /^[A-Z-a-z ]+$/;
            //Validate Text Field value against the Regex.
            var is_valid = reg_exp.test(String.fromCharCode(key));
            if (!is_valid) {
              $("#error_msg").html("No special characters Please!");
            }
            return is_valid;
          });
        });
</script>

<script type="text/JavaScript">
function valid1(f) {
!(/[A-z-, ]\\^$/i).test(f.value)?f.value = f.value.replace(/[^A-z-, ]/ig,''):null;
} 
</script>
<script type="text/javascript">
      $(document).ready(function(){
          $("#textbox1").keypress(function (e) {
            var key = e.keyCode || e.which;       
            $("#error_msg").html("");
            //Regular Expression
            var reg_exp = /^[A-Z-,a-z ]+$/;
            //Validate Text Field value against the Regex.
            var is_valid = reg_exp.test(String.fromCharCode(key));
            if (!is_valid) {
              $("#error_msg").html("No special characters Please!");
            }
            return is_valid;
          });
        });
</script>



<script type="text/JavaScript">
function valid2(f) {
!(/[0-9-+-]\\^$/i).test(f.value)?f.value = f.value.replace(/[^0-9-+-]/ig,''):null;
} 
</script>
<script type="text/javascript">
      $(document).ready(function(){
          $("#textbox2").keypress(function (e) {
            var key = e.keyCode || e.which;       
            $("#error_msg").html("");
            //Regular Expression
            var reg_exp = /^[0-9-+-]+$/;
            //Validate Text Field value against the Regex.
            var is_valid = reg_exp.test(String.fromCharCode(key));
            if (!is_valid) {
              $("#error_msg").html("No special characters Please!");
            }
            return is_valid;
          });
        });
</script>





<!--Email Input Sanitizing Script-->
<script type="text/JavaScript">
function valid4(f) {
!(/[.A-z-A-z-0-9-@-]\\^$/i).test(f.value)?f.value = f.value.replace(/[^.A-z-0-9-@-]/ig,''):null;
} 
</script>
<script type="text/javascript">
      $(document).ready(function(){
          $("#textbox4").keypress(function (e) {
            var key = e.keyCode || e.which;       
            $("#error_msg").html("");
            //Regular Expression
            var reg_exp = /^[.A-z-0-9-@- ]+$/;
            //Validate Text Field value against the Regex.
            var is_valid = reg_exp.test(String.fromCharCode(key));
            if (!is_valid) {
              $("#error_msg").html("No special characters Please!");
            }
            return is_valid;
          });
        });
</script>








<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" required>

  <input type="hidden" name="recorddate"  value="<?php echo "" . date("F j, Y h:i sa") . "";?>" class="form-control">
  <input type="hidden" name="url"  placeholder="" value="<?php echo "$url"; ?>" class="form-control">
  <input type="hidden" name="RegBy"  placeholder="" value="<?php $email; ?>" class="form-control">
  <fieldset>
    <center><legend>CENSUS || <a href="census" class="btn btn-theme effect btn-sm"> <b>VIEW RECORD</b> </a></legend></center>

<!--<center><span style="color: red;">Headshot Size: 80KB Or Less</span></center>-->
<div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-6">
      <div class="form-group">
    <?php
                //check for any errors
                if(isset($error)){
                    foreach($error as $error){
                      ?>
                      <center><div class="alert-dismissible  alert-danger">
                        <span class="ml-4"><strong><img src="admin-panel/img/error.png" width="20" height="20"> <?php echo $error; ?></strong></span><br><br>
                        </div></center>
                        <?php
                    }
                }
?>

<?php
    if(isset($updateMsg)){
    ?>
      <center><div class="alert-dismissible text-center alert alert-success" style="background-color: #DFF0D8;">
        <strong><img src="admin-panel/img/success.png" width="20" height="20"> <?php echo $updateMsg; ?></strong>
      </div></center>
        <?php
    }
    ?>

  </div>
</div>
</div>

<div class="bg-success" style="opacity: ; border-left: outset; border-width: 8px; border-color: #BF3654; ">
    <p class="text-success" style="margin-left: 4px;"><b> <img src="admin-panel/img/info.png" width="20" height="20"> Your information will not be submitted if Surname, Firstname, Sex, Age, Marital Status, Physical Disability, Community, Occupation, Educational Background and passport is empty. We advise students and those who may need job employment opportunity to fill all details accordingly and never to leave phone number and email field empty, because someone may need to contact you. Any field left blank would be assumed you never want to disclose. You can edit your information anytime if you provide your email and password or you may need to contact us.</b></p>
  </div>
<br>

  <div class="row">
    
    <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Surname</label>
          <div class="col-lg-9">


            <input name="surname" class="form-control" type="text" placeholder="Surname" onkeyup="valid(this)" onblur="valid(this)" id="textbox" maxlength="20" required="">
          </div>
      </div>        
      </div>
      
    </div>

  <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Firstname</label>
          <div class="col-lg-9">

            <input name="firstname" class="form-control" type="text" placeholder="Firstname" onkeyup="valid(this)" onblur="valid(this)" id="textbox" required="" maxlength="20">
          </div>
      </div>        
      </div>
    </div>

    

    <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Other Name</label>
          <div class="col-lg-9">
          


            <input name="othername" class="form-control" type="text" placeholder="Othername N/A" onkeyup="valid(this)" onblur="valid(this)" id="textbox" maxlength="20">
          </div>
      </div>        
      </div>
    </div>

    <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Sex</label>
          <div class="col-lg-9">
          <select name="sex" id="sex" class="form-control" required="">
            <option value="">Select...</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select> 
          </div>
      </div>        
      </div>
    </div>

    <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Age</label>
          <div class="col-lg-9">
          <select name="age" class="form-control" required="">
            <option value="">Select...</option>
              <option value="0-17">0-17</option>
              <option value="18-29">18-29</option>
              <option value="30-40">30-40</option>
              <option value="41-59">41-59</option>
              <option value="60-Above">60-Above</option>
            </select> 
          </div>
      </div>        
      </div>
    </div>

    <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Marital Status</label>
          <div class="col-lg-9">
          <select name="marital" class="form-control" required="">
            <option value="">Select...</option>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
            </select> 
          </div>
      </div>        
      </div>
    </div>


    <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Physical Disability</label>
          <div class="col-lg-9">
          <select name="phydis" class="form-control" required="">
            <option value="">Select...</option>
              <option value="No">No</option>
              <option value="Yes">Yes</option>
            </select> 
          </div>
      </div>        
      </div>
    </div>

    <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Community</label>
          <div class="col-lg-9">
            <?php
    if(isset($errorUheri))
    {
      ?>
            <center><span class="alert-dismissible text-center alert ">
              <span style="color: red;">* <?php echo $errorUheri; ?></span>
            </span></center>
            <?php
    }
    ?>

    <?php
    if(isset($errorEzede))
    {
      ?>
            <center><span class="alert-dismissible text-center alert ">
              <span style="color: red;">* <?php echo $errorEzede; ?></span>
            </span></center>
            <?php
    }
    ?>
            <script type="text/javascript">
        function ShowHideDivCom() {
            var community = document.getElementById("community");
            var uheriCommunity = document.getElementById("uheriCommunity");
            var ezedeCommunity = document.getElementById("ezedeCommunity");
            var uweyeCommunity = document.getElementById("uweyeCommunity");
            uheriCommunity.style.display = community.value == "Uheri" ? "block" : "none";
            ezedeCommunity.style.display = community.value == "Ezede" ? "block" : "none";
            uweyeCommunity.style.display = community.value == "Uweye" ? "block" : "none";

                function validateForm() {
      var x = document.forms["myForm"]["sex"].value;
      if (x == "") {
        alert("Name must be filled out");
        return false;
      }
    } 
        }
    </script>

    <div  onchange="ShowHideDivCom()" >
    <select name="community" id="community" class="form-control" required="">
        <option value="">Select...</option>
        <option value="Uheri">Uheri</option>
        <option value="Ezede">Ezede</option>
        <option value="Uweye">Uweye</option>
        
    </select>
  </div>
  
    
    <div id="uheriCommunity" style="display: none"><br>
      <label>Qarter</label>
        <select name="uheri" class="form-control">
        <option value="">Select...</option>
        <option value="Agbaza">Agbaza</option>
        <option value="Otebiere">Otebiere</option>
        <option value="Obughe">Obughe</option>
        <option value="Otuluho">Otuluho</option>
        <option value="Ekrethu">Ekrethu</option>
    </select>
    </div>

    <div id="ezedeCommunity" style="display: none"><br>
      <label>Qarter</label>
        <select name="ezede" class="form-control">
        <option value="">Select...</option>
        <option value="Uruehe">Uruehe</option>
        <option value="Eteri">Eteri</option>
        <option value="Paris">Paris</option>
    </select>
    </div>

    <div id="uweyeCommunity" style="display: none"><br>
      <label>Qarter</label>
        <select name="uweye" class="form-control">
        <option value="">Select...</option>
        <option value="Uruehe">Araya</option>
        <option value="Uyekere">Uyekere</option>
    </select>
    </div>



</div>
      </div>        
      </div>
    </div>


    <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Occupation</label>
          <div class="col-lg-9">
          <select name="occu" class="form-control" required="">
            <option value="">Select...</option>
              <option value="Civil Servant">Civil Servant</option>
              <option value="Self Employed">Self Employed</option>
              <option value="Unemploy">Unemploy</option>
            </select> 
          </div>
      </div>        
      </div>
    </div>


    <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Educational Background</label>
          <div class="col-lg-9">

<script type="text/javascript">
        function ShowHideDiv() {
            var eduLevel = document.getElementById("eduLevel");
            var haveEdu = document.getElementById("haveEdu");
            haveEdu.style.display = eduLevel.value == "Yes" ? "block" : "none";
        }
    </script>

    <script type="text/javascript">
        function ShowHideDiv1() {
            var schoolAttended = document.getElementById("schoolAttended");
            var course = document.getElementById("course");
            course.style.display = schoolAttended.value == "Tertiary" ? "block" : "none";
        }
    </script>

    <script type="text/javascript">
        function ShowHideDiv2() {
            var qualification = document.getElementById("qualification");
            var haveQualification = document.getElementById("haveQualification");
            haveQualification.style.display = qualification.value == "Computer Science" || qualification.value == "Computer Engineering" || qualification.value == "Nursing And Nursing Science" ? "block" : "none";
        }
    </script>

    <script type="text/javascript">
        function ShowHideDiv3() {
            var tertiary = document.getElementById("tertiary");
            var haveTertiary = document.getElementById("haveTertiary");
            haveTertiary.style.display = tertiary.value == "Professor" || tertiary.value == "PhD" || tertiary.value == "Msc" || tertiary.value == "BSc" || tertiary.value == "HND" || tertiary.value == "ND" ? "block" : "none";
        }
    </script>

    <script type="text/javascript">
        function ShowHideDiv4() {
            var specify = document.getElementById("specify");
            var haveSpecify = document.getElementById("haveSpecify");
            haveSpecify.style.display = specify.value == "Specify" ? "block" : "none";
        }
    </script>

    <script type="text/javascript">
        function ShowHideDiv5() {
            var graduation = document.getElementById("graduation");
            var graduationStatus = document.getElementById("graduationStatus");
            graduationStatus.style.display = graduation.value == "Graduate" || graduation.value == "Undergraduate" ? "block" : "none";
        }
    </script>


        <select name="EduBackground" id="eduLevel" class="form-control" onchange="ShowHideDiv()" required="">
        <option value="">Select...</option>
        <option value="No">No</option>
        <option value="Yes">Yes</option>
    </select><br>


    <div id="haveEdu" style="display: none">
      <label>School Level</label>
        <select name="SchoolLevel" id="schoolAttended" class="form-control" onchange="ShowHideDiv1()">
        <option value="">Select...</option>
        <option value="Primary">Primary</option>
        <option value="Secondary">Secondary</option>
        <option value="Tertiary">Tertiary</option>
    </select>
    </div><br>

    <div id="course" style="display: none">
      <div>
      <label>Course Studied</label>
        <input type="text" name="course" class="form-control" id="textbox1" onkeyup="valid1(this)" onblur="valid1(this)" placeholder="(Optional)">
    </div><br>

    <div>
      <label>Qualification</label>
        <input type="text" name="qualification" class="form-control" id="textbox1" onkeyup="valid1(this)" onblur="valid1(this)" placeholder="(Optional)">
    </div><br>


    <div>
      <label>School Attended</label>
        <input type="text" name="SchoolAttended" class="form-control" id="textbox1" onkeyup="valid1(this)" onblur="valid1(this)" placeholder="(Optional)">
    </div><br>

    <div>
      <label>Education Status</label>
      <select name="EduStatus" class="form-control" onchange="ShowHideDiv()">
          <option value="">Select...</option>
          <option value="Graduate">Graduate</option>
          <option value="Undergraduate">Undergraduate</option>
      </select>
    </div><br>


    </div><br>







</div>
      </div>        
      </div>
    </div>


    <!--<div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
        <span style="color: red;">It is important to add a username and password to your information,<br> to enable you edit this information in future time.</span>
      <div class="form-group">

            <label for="description" class="col-lg-6 col-form-label">Username</label>
            
          <div class="col-lg-9">
            <input name="username" class="form-control" type="text" placeholder="Username" id="textbox" onkeyup="valid(this)" onblur="valid(this)" maxlength="20">
          </div>
      </div>        
      </div>
    </div>-->



    <div class="row">

      <div class="col-md-3">

    </div>
      <div class="col-md-8">
      <div class="form-group">
          <div class="col-lg-9">
            <div class="bg-success" style="opacity: ; margin-left: 3px; border-left: outset; border-width: 8px; border-color: #BF3654; "><p style="margin-left: 3px;" class=" text-success"><b>Please enter your email & password to enable you update your information by yourself or you may need to contact us.</b></p></div><br><br>

            <label>Email</label>
            <input name="email" class="form-control" type="email"  onkeyup="valid4(this)" onblur="valid4(this)" id="textbox4" placeholder="(Optional)">
          </div>
      </div>        
      </div>
    </div>


    <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Phone Number</label>
          <div class="col-lg-9">
            <input name="phoneno" class="form-control" type="text" placeholder="(Optional)" id="textbox2" onkeyup="valid2(this)" onblur="valid2(this)" maxlength="20">
          </div>
      </div>        
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Password</label>
          <div class="col-lg-9">
            <input name="password" class="form-control" type="password" minlength="6"  placeholder="(Optional)">
          </div>
      </div>        
      </div>
    </div>

    <div class="row">

      <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
            <label for="description" class="col-lg-6 col-form-label">Re-enter Password</label>
          <div class="col-lg-9">
            <input name="rpassword" class="form-control" type="password"  placeholder="(Optional)" >
          </div>
      </div>        
      </div>
    </div>
    

    <div class="row">
    <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">
        
            <label for="featuredimage" class="col-lg-6 col-form-label">Passport Photograph</label>
          <div class="col-lg-9">
            <input name="passport" class="form-control" type="file" placeholder="Upload Passport" accept="image/*" required="">
          </div>
      </div>        
    </div>
    </div>



    <div class="row">
    <div class="col-md-3">
    </div>
      <div class="col-md-8">
      <div class="form-group">

          <div class="col-lg-9">
<button type="button" value="Add Post" class="btn btn-theme effect btn-sm" data-toggle="modal" data-target="#myModal"><b> Submit</b></button>

<button type="reset" class="btn btn-default btn-sm"><b>Cancel</b></button>


            
      <!-- Trigger the modal with a button -->

      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              
              <h4 class="modal-title text-success">Confirmation<img src="admin-panel/img/info.png" width="20" height="20"></h4>
            </div>
            <div class="bg-success modal-body" style="opacity: ; border-left: outset; border-width: 8px; border-color: #BF3654; ">
              <p class="text-success" style="margin-left: 3px;">
                Your information will not be submitted if Surname, Firstname, Sex, Age, Marital Status, Physical Disability, Community, Occupation, Educational Background and passport is empty. We advise students and those who may need job employment opportunity to fill all details accordingly and never to leave phone number and email field empty, because someone may need to contact you. Any field left blank would be assumed you never want to disclose. For password reset, you will need to provide your email & password to enable you update your information by yourself or you may need to contact us. <br><br><b>Would you like to continue?</b>
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default text-success" data-dismiss="modal">Close</button>

              <button type="submit" name="btn_insert" value="Add Post" class="btn btn-theme effect btn-sm text-success"><i class="fa fa-plus"></i> OK</button>
            </div>
          </div>
        </div>
      </div>


    <!--<div class="row">
      <div class="form-group">
      <div class="col-md-6">
        // if(isset($_POST['btn_insert'])):?>
          <div class="alert alert-dismissable alert-warning">
            <p> echo "$msg"; ?></p>
          </div>

        // endif; ?>
      </div>
    </div>
    </div>-->
 

</fieldset>
</form>

















        </div>
    </section>
    <!--End  History -->










</div><br><br>

<?php include 'footer.php'?>