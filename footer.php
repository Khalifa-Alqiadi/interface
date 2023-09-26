<?php
include 'connect.php';
echo time();
 if(isset($_POST['question'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $email = $_POST['email'];
     $message = $_POST['message'];
     $stmt = $con->prepare("INSERT INTO question(`date`, question, email)
                                        VALUES(now(), :zquestion, :zemail)");
    $stmt->execute(array('zquestion' => $message, 'zemail' => $email));
    }
 }

?>

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

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <input type="email" name="email" placeholder="Email">
            <textarea name="message" placeholder="Message"></textarea>
            <input type="submit" name="question" value="Send">

        </form>

    </div>

</footer>