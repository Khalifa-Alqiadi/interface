<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="HomePage.css">
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://kit.fontawesome.com/ec292494c9.js" crossorigin="anonymous"></script>
</head>

<body class="container">

<?php  include('navbar.php'); ?>
<!--first part-->

<div class="First_Part">

<!--<nav class="Menu_Bar">
    <ul>
        <li> <a>Contact us</a></li>
        <li> <a>Clinics</a></li>
        <li> <a>About us</a></li>
        <li> <a>Home</a></li>

    </ul>
</nav>-->
    <img class="Fsvg" src="undraw_medicine.svg" c>

<section class="Title">

        <h1>To Make Patient Life Better</h1>

         <p>Provide a link between Patient and all dental clinic in the area
         </p>

</section>





    <!--sign in button-->
    <?php 
        if(isset($_SESSION['userid'])){?>
            <a href="logout.php"><button class="sign1_button" onclick="document.getElementById('id01').style.display='block'" >Logout</button></a>
    <?php }else{?>
            <a href="login.php"><button class="sign1_button" onclick="document.getElementById('id01').style.display='block'" >Sign Up & Login</button></a>
    <?php }?>

   <!-- <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form  class="modal-content" action="/action_page.php" method="post">
            <div class="container">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <label><b>Email</b></label>
                <input class="input_button" type="text" placeholder="Enter Email" name="email" required>

                <label ><b>Password</b></label>
                <input class="input_button" type="password" placeholder="Enter Password" name="psw" required>

                <label><b>Repeat Password</b></label>
                <input class="input_button" type="password" placeholder="Repeat Password" name="psw-repeat" required>

                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                <div class="clearfix">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                    <button type="submit" class="sign_button">Sign Up</button>
                </div>
            </div>
        </form>
    </div>-->
<!--
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>-->

    <!----------------->
<br>
    <br>
    <!--Login-->
   <!-- <button style="background-color: #69BAA5" class="sign1_button" onclick="document.getElementById('id02').style.display='block'">Login</button>-->

   <!-- <div id="id02" class="modalLog">

        <form class="modal-contentLog animate" action="/action_page.php" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id02').style.display='none'" class="closelog" title="Close Modal">&times;</span>
                <img src="undraw_medicine.svg" alt="Avatar" class="avatar">
            </div>

            <div class="containerlog">
                <label ><b>Email</b></label>
                <input class="login" type="text" placeholder="Enter Email" name="email" required>

                <label ><b>Password</b></label>
                <input class="login" type="password" placeholder="Enter Password" name="psw" required>

                <button class="login_button" type="submit">Login</button>
                <label>
                    <input  type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>

            <div class="containerlog" style="background-color:#f1f1f1">
                <button  type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelLog">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>

    <script>
        // Get the modal
        let modal = document.getElementById('id02');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>-->

    <!--<section class="Sign_up">
        <form action="" method="post">

            <input type="text" placeholder="Email" id="email">
            <input type="password" placeholder="Password" id="password">
            <br>
            <br>
            <input type="submit" value="Sign up" class="sign_button" >

        </form>
    </section>-->


</div>

<!--second part-->

<!--<img  class="Doctor_Second" src="Doctor-rafiki.svg">-->
<div class="second_part">
<section class="cards" id="services">
    <h2 class="titleS">Services</h2>
    <div class="content">
        <div class="cardS">
            <div class="icon">
                <i class="fa-solid fa-house-chimney"></i>
            </div>
            <div class="info">
                <h3>Make an appointment at home</h3>
                <p>Book a faster appointment</p>
            </div>
        </div>
        <div class="cardS">
            <div class="icon">
                <i class="fa-brands fa-searchengin"></i>
            </div>
            <div class="info">
                <h3>Search for all dental clinic in the area</h3>
                <p>all dental clinic in the area in your hand</p>
            </div>
        </div>
        <div class="cardS">
            <div class="icon">
                <i class="fas fa-edit"></i>
            </div>
            <div class="info">
                <h3>Customer can see people's opinions</h3>
                <p>Opinions about the doctor, and his evaluation, and number of years of experience.</p>
            </div>
        </div>
        <div class="cardS">
            <div class="icon">
                <i class="fa-solid fa-globe"></i>
            </div>
            <div class="info">
                <h3>communicate with the doctor</h3>
                <p>The patient can communicate with the doctor from home</p>
            </div>
        </div>
    </div>
</section>
</div>





<!--
&lt;!&ndash;card1&ndash;&gt;
<div class="Second_part">
    <a href="card1.html" class="link" >
 <div class="card" >
     <img src="undraw_doctor.svg" style="width: 100%">
     <h1>Mohammed Alsukayt</h1>
     <p class="Dr_title">Dentist Specialized in Periodontics</p>
     <p>Qassim University</p>
     <div style="margin: 24px 0">
         <a href="#" class="Dr_link"><i class="fa fa-twitter"></i></a>
         <a href="#" class="Dr_link"><i class="fa fa-linkedin"></i></a>
         <a href="#" class="Dr_link"><i class="fa fa-facebook"></i></a>

     </div>
     <p><button class="Dr_button">Book an appointment</button></p>
 </div>
    </a>
&lt;!&ndash;card2&ndash;&gt;
    <a href="card2.html" class="link">
<div class="card" style="margin-top: 110px">
    <img src="undraw_doctor.svg" style="width: 100%">
    <h1>Ryan Alzabin</h1>
    <p class="Dr_title">Specialized in Pediatric Dentistry</p>
    <p>Qassim University </p>
    <div style="margin: 24px 0">
        <a href="#" class="Dr_link"><i class="fa fa-twitter"></i></a>
        <a href="#" class="Dr_link"><i class="fa fa-linkedin"></i></a>
        <a href="#" class="Dr_link"><i class="fa fa-facebook"></i></a>


    </div>
    <p><button class="Dr_button">Book an appointment</button></p>

</div>
    </a>
    <br>
    &lt;!&ndash;card3&ndash;&gt;
    <div class="card3">
        <img src="undraw_doctor.svg" style="width: 100%">
        <h1>Saleh ahmed</h1>
        <p class="Dr_title">Specialized in Implantology</p>
        <p>Qassim University</p>
        <div style="margin: 24px 0">
            <a href="#" class="Dr_link"><i class="fa fa-twitter"></i></a>
            <a href="#" class="Dr_link"><i class="fa fa-linkedin"></i></a>
            <a href="#" class="Dr_link"><i class="fa fa-facebook"></i></a>


        </div>
        <p><button class="Dr_button">Book an appointment</button></p>

</div>

    &lt;!&ndash;card4&ndash;&gt;
    <div class="card4">
        <img src="undraw_doctor.svg" style="width: 100%">
        <h1>Ali Yousif</h1>
        <p class="Dr_title">Specialized in Prosthodontics,</p>
        <p>Qassim University</p>
        <div style="margin: 24px 0">
            <a href="#" class="Dr_link"><i class="fa fa-twitter"></i></a>
            <a href="#" class="Dr_link"><i class="fa fa-linkedin"></i></a>
            <a href="#" class="Dr_link"><i class="fa fa-facebook"></i></a>


        </div>
        <p><button class="Dr_button">Book an appointment</button></p>

    </div>
</div>-->
<br>
<br>
<!--third part-->

<!--
<div class="Contact_container">
    <h3>Contact Form</h3>
    <form action="/action_page.php">
        <br>
        <label>Email</label>

        <input class="contact" type="text" id="fname" name="firstname" placeholder="Your name..">

        <label > Name</label>
        <input class="contact" type="text" id="lname" name="lastname" placeholder="Your last name..">

        <label >City</label>
        <select  class="contact" id="City" name="City"  >
            <option></option>
            <option value="Buraydah">Buraydah</option>
            <option value="Albukayriyah">Albukayriyah</option>
            <option value="Unaizah">Unaizah</option>
        </select>

        <label >Subject</label>
        <textarea class="contact" id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

        <input class="contact" id="submit" type="submit" value="Submit">
    </form>
</div>-->


<!--footer-->


<?php include('footer.php'); ?>
</body>
</html>