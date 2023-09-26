<?php
session_start();
 include 'connect.php';
 include 'functions.php';

 if($_SERVER['REQUEST_METHOD'] == 'POST'){

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="HomePage.css">
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php  include('navbar.php'); ?>



<!--card1-->
<div class="Second_part">
    <?php
        $rows = getAllTable('*', 'doctor', '', '', 'doctorId', 'ASC');
        foreach($rows as $row){
    ?>
    <a href="card.php?doctorid=<?php echo $row['doctorId']?>" class="link" >

        <div class="card" >
            <img src="undraw_doctor.svg" style="width: 100%">
            <h1><?php echo $row['Name'] ?></h1>
            <p class="Dr_title"><?php echo $row['bio'] ?></p>
            <p><?php echo $row['University'] ?></p>
            <div style="margin: 24px 0">
                <a href="#" class="Dr_link"><i class="fa fa-twitter"></i></a>
                <a href="#" class="Dr_link"><i class="fa fa-linkedin"></i></a>
                <a href="#" class="Dr_link"><i class="fa fa-facebook"></i></a>

            </div>
            <p><button class="Dr_button">Book an appointment</button></p>
        </div>
    </a>
    <?php }?>
    <!--card2-->
    
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



        <div class="footer-icons">

            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>

        </div>

    </div>

    <div class="footer-right">

        <p>Contact Us</p>

        <form action="#" method="post">

            <input type="text" name="email" placeholder="Email">
            <textarea name="message" placeholder="Message"></textarea>
            <button>Send</button>

        </form>

    </div>

</footer>

</body>
</html>