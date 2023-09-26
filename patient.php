<?php
session_start();
 include 'connect.php';
 include 'functions.php';
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $userid        = $_POST['userid'];
     $firstname     = $_POST['firstname'];
     $lastname      = $_POST['lastname'];
     $email      = $_POST['email'];
     $phone      = $_POST['phone'];
     $gender      = $_POST['gender'];
     $pirthDate      = $_POST['pirthdate'];
     $stmt = $con->prepare("UPDATE patient SET 
                                    email = ?,
                                    firstName = ?,
                                    lastName = ?,
                                    phoneNum = ?,
                                    gender = ?,
                                    pirth_date = ?
                            WHERE userId = ?");
    $stmt->execute(array($email, $firstname, $lastname, $phone, $gender, $pirthDate, $userid));
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="HomePage.css">
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://kit.fontawesome.com/ec292494c9.js" crossorigin="anonymous"></script>

</head>
<body>


<?php  include('navbar.php'); 
$stmt = $con->prepare("SELECT * FROM patient WHERE userId = ?");
$stmt->execute(array($_SESSION['userid']));
$row = $stmt->fetch();
?>
<h1>r</h1>
<div class="profile_form">

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="header_form">
            <h1>Profile</h1>

        </div>

        <div class="form-body">

            <!-- Firstname and Lastname -->
            <div class="horizontal-group">
                <div class="form-group left">
                    <input type="hidden" name="userid" value="<?php echo $row['userId'] ?>" id="">
                    <label for="firstname" class="label-title">First name *</label>
                    <br>
                    
                    <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstName']?>" class="form-input" placeholder="enter your first name" />
                </div>
                <div class="form-group right">
                    <label for="lastname" class="label-title">Last name</label>
                    <br>
                    <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastName']?>" class="form-input" placeholder="enter your last name" />
                </div>
             </div>

            <!-- Email -->
            <div class="form-group">
                <label  class="label-title">Email*</label>
                <br>
                <input type="email" id="email-form" name="email" value="<?php echo $row['email']?>" class="form-input" placeholder="enter your email" >
            </div>

            <!-- Mobile -->
            <div class="horizontal-group">
                <div class="form-group left">
                    <label class="label-title">Mobile *</label>
                    <br>
                    <input type="text" id="mobile" name="phone" value="<?php echo $row['phoneNum']?>" class="form-input" placeholder="enter your mobile" >
                </div>
            </div>

            <!-- Gender-->
            <div class="horizontal-group">
                <div class="form-group left">
                    <label class="label-title">Gender:</label>
                    <div class="input-group">
                        <label for="male"><input type="radio" name="gender" value="male" id="male"> Male</label>
                        <br>
                        <label for="female"><input type="radio" name="gender" value="female" id="female"> Female</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label  class="label-title">Birth of Date *</label>
                <br>
                <input type="date" id="date" name="pirthdate" class="form-input" >
            </div>


        </div>
        <input class="btn-form" type="submit" value="Save" >
    </form>

</div>

           <div class="Appointment">
               <h1>My Appointment</h1>
                <?php 
                $userid = $row['userId'];
                // $rows = getAllTable('*', 'appointment', 'where userId = "'.$row['userId'] .'"', '', 'appointmentId', 'ASC');
                $stmt = $con->prepare("SELECT
                                            appointment.*,
                                            doctor.Name
                                        FROM appointment
                                        INNER JOIN
                                            doctor
                                        ON doctor.doctorId = appointment.doctorId
                                        WHERE userId = $userid");
                $stmt->execute();
                $rows = $stmt->fetchAll();
                foreach($rows as $row){
                ?>
                    <div class="appoi">
                        <table class="table-profile">
                            <tr class="row">
                                <td>Doctor Name</td>
                                <td>Date</td>
                            </tr>
                            <tr>
                                <td><?php echo $row['Name']?></td>
                                <td><?php echo $row['date']?></td>
                            </tr>
                        </table>
                    </div>
            <?php }?>
           </div>



<!--footer-->


<footer class="footer-distributed">

    <div class="footer-left">

        <h3>Yake<span>System</span></h3>

        <p class="footer-links">
            <a href="HomePage.html">Home</a>
            ·
            <a href="Appointment.html">Appointment</a>
            ·
            <a href="patient.html">Patient</a>
            ·
            <a href="#">About</a>
            ·
            <a href="#">Contact</a>
        </p>



<?php include('footer.php'); ?>


</body>
</html>