<?php
session_start();
include 'connect.php';
 include 'functions.php';
$erroe = '';
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['rating'])){
        if(isset($_SESSION['userid'])){
            $rating = $_POST['rate'];
            $doctorid = $_POST['doctorid'];
            $userid = $_SESSION['userid'];

            $stmt = $con->prepare("INSERT INTO 
                                        rating(rating, userid , doctorid)
                                    VALUES(:zrating, :zuserid, :zdoctorid)");
            $stmt->execute(array(
                'zrating'  => $rating,
                'zuserid'  => $userid,
                'zdoctorid'  => $doctorid
            ));
        }else{
            header('location: login.php');
        }
    }elseif(isset($_POST['book'])){
        if(isset($_SESSION['userid'])){
            $doctorid = $_POST['doctorid'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $username = $_SESSION['user'];
            $userid = $_SESSION['userid'];
            $stmt = $con->prepare("SELECT
                                            appointment.*,
                                            doctor.Name
                                        FROM appointment
                                        INNER JOIN
                                            doctor
                                        ON doctor.doctorId = appointment.doctorId
                                        WHERE appointment.doctorId = ?
                                        AND `date` = ? AND `time` = ?");
            $stmt->execute(array($doctorid, $date, $time));
            $rows = $stmt->fetch();
                $t = $rows['time'] + time();
                if($rows){
                    $erroe = 'sory this is time exsist';
                }else{
                    $stmt = $con->prepare("INSERT INTO 
                                                appointment(patientName, `date`, `time`, doctorId, userId)
                                                VALUES(:zusername, :zdate, :ztime, :zdoctorid, :zuserid)");
                    $stmt->execute(array(
                        'zusername'      => $username,
                        'zdate'     => $date,
                        'ztime'     =>$time,
                        'zdoctorid'       => $doctorid,
                        'zuserid'     => $userid
                    ));
                }
            
            
            
        }else{
            header('location: login.php');
        }
    }elseif(isset($_POST['comm'])){
        if(isset($_SESSION['userid'])){
            $doctorid = $_POST['doctorid'];
            $message = $_POST['message'];
            $username = $_SESSION['user'];
            $userid = $_SESSION['userid'];
            $stmt = $con->prepare("INSERT INTO 
                                        comment(comment, patientName, `date`, patientId, doctorId)
                                        VALUES(:zcomment, :zusername, now(), :zuserid, :zdoctorid)");
            $stmt->execute(array(
                'zcomment'      => $message,
                'zusername'     => $username,
                'zuserid'       => $userid,
                'zdoctorid'     => $doctorid
            ));
        }else{
            header('location: login.php');
        }
    }
    elseif(isset($_POST['question'])){
         $email = $_POST['email'];
         $message = $_POST['message'];
         $stmt = $con->prepare("INSERT INTO question(`date`, question, email)
                                            VALUES(now(), :zquestion, :zemail)");
        $stmt->execute(array('zquestion' => $message, 'zemail' => $email));
     }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="HomePage.css">
    <script src="https://kit.fontawesome.com/ec292494c9.js" crossorigin="anonymous"></script>
    <link href="css/mobiscroll.javascript.min.css" rel="stylesheet" />
    <script src="js/mobiscroll.javascript.min.js"></script>
    <style>
        body {
            background-image: url('Mass Circles.svg');
        }
    </style>
</head>

<body>
<?php  include('navbar.php'); ?>
<?php
$doctorid = isset($_GET['doctorid']) && is_numeric($_GET['doctorid']) ? intval($_GET['doctorid']) : 0;

$stmt = $con->prepare("SELECT * FROM doctor WHERE doctorId = ?");
$stmt->execute(array($doctorid));
$doctor = $stmt->fetch();
?>
<div class="Doctor_pagef">
    
    <img class="Doctor_profile" src="Doctor-rafiki.svg">

  <div class="Doctor_textf">
      <h1><?php echo $doctor['Name'] ?></h1>

      <h2><?php echo $doctor['bio'];?></h2>
      <h3><?php echo $doctor['University'] ?></h3>
  </div>
  <?php 
    if(isset($erroe)){
        echo "<h1 style='color:red'>". $erroe . "</h1>";
    }
    
    ?>
  <form class="form-rating" action="<?php echo $_SERVER['PHP_SELF'] ?>?doctorid=<?php echo $doctor['doctorId']?>" method="POST">
  <input type="hidden" name="doctorid" value="<?php echo $doctor['doctorId']?>">
    <div class="rate">
        <h3>User Rating:</h3>    
            <input type="radio" id="star5" name="rate" value="5" />
            <label for="star5" title="text">5 stars</label>
            <input type="radio" id="star4" name="rate" value="4" />
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" name="rate" value="3" />
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" name="rate" value="2" />
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" name="rate" value="1" />
            <label for="star1" title="text">1 star</label>
    </div>
    <input type="submit" class="btn mt-5" name="rating" value="Rating">
    <?php  
        $where = "where doctorid =" .$doctor['doctorId'];
        
        if(countRating($where)!= 0 && sumRating($where)!=0){
            $total = sumRating($where) / countRating($where);?>
            <h2 class="sum-rating"><?php echo sprintf('%.2f', $total) ?>% Rating</h2>
        <?php }
        else{
            echo '<h2 class="sum-rating">0% Rating</h2>';
        }
    ?>
    
    </form>
    


    <div class="divider">
        
    </div>

    <!--Appointment start here-->

    <div class="Appointment_list">

        <!--<form>
            <h1>Appointment Details</h1>
           &lt;!&ndash; <label>Chose Appointment date </label>&ndash;&gt;
            <div class="cardS">
                <div class="icon">
                    <i class="fa-solid fa-house-chimney"></i>
                </div>
                <div class="info">
                    <h3>Payment</h3>
                    <p>50$</p>
                </div>
            </div>
            <br>
            <input type="datetime-local" value="2022-06-13T13:00" min="2021-08-15" max="2030-08-26">
        </form>
        <br>
        <button class="Dr_button" id="Book_appointment">Book an appointment</button>-->

        <div class="Appointment_card" >
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="13" r="7" />
                    <polyline points="12 10 12 13 14 13" />
                    <line x1="7" y1="4" x2="4.25" y2="6" />
                    <line x1="17" y1="4" x2="19.75" y2="6" />
                </svg>
            </div>
            <h1>Appointment Details</h1>
            <p class="Dr_title">Payment 50$</p>
            <p>Qassim Clinic</p>
            <div style="margin: 24px 0">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>?doctorid=<?php echo $doctor['doctorId']?>" method="POST">
                    <input type="hidden" name="doctorid" value="<?php echo $doctor['doctorId'] ?>">
                    <input class="Appointment_input" type="date" name="date" required min="2021-08-15T01:30" max="2030-08-26T01:30">
                    <input class="Appointment_input" type="time" name="time" required >
                    <p><button name="book" class="Dr_button">Book an appointment</button></p>
                </form>
            </div>
            
        </div>


    </div>

    <!--Patient  Comments-->
<br>
    <div class="Doctor_pageS">

        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-2" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 20l-3 -3h-2a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-2l-3 3" />
            <line x1="8" y1="9" x2="16" y2="9" />
            <line x1="8" y1="13" x2="14" y2="13" />
        </svg>

        <h1>Patient  Comments</h1>




            <div class="footer-right">

                <p>Your comment:</p>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>?doctorid=<?php echo $doctor['doctorId']?>" method="POST">
                    <input type="hidden" name="doctorid" value="<?php echo $doctor['doctorId'] ?>">
                    <textarea name="message" placeholder="Message"></textarea>
                    <input type="submit" name="comm" value="Send">
                </form>
                
            </div>

    </div>
    <div class="commint-show">
        <?php
            $rows = getAllTable('*', 'comment', 'where doctorId = "'.$doctor['doctorId'] .'"', '', 'commentId', 'ASC');
            foreach($rows as $row){
        ?>
                <div class="commints">
                    <h4><?php echo $row['patientName'] ?></h4>
                    <p><?php echo $row['comment'] ?></p>
                </div>
        <?php } ?>
    </div>


        <!-- <div class="Comment_section">
            <label for="newComment" name="newComment">Add your comment below-</label>
            <br>
            <textarea id="newComment"></textarea>
            <button id="addComments">Add Comment</button>
            <div id="allComments"></div>
        </div> -->






<!--


<script>
    const commentContainer = document.getElementById('allComments');
    document.getElementById('addComments').addEventListener('click', function (ev) {
        addComment(ev);
    });

    function addComment(ev) {
        let commentText;
        const textBox = document.createElement('div');
        const replyButton = document.createElement('button');
        replyButton.className = 'reply';
        replyButton.innerHTML = 'Reply';
        const likeButton = document.createElement('button');
        likeButton.innerHTML = 'Like';
        likeButton.className = 'likeComment';
        const deleteButton = document.createElement('button');
        deleteButton.innerHTML = 'Delete';
        deleteButton.className = 'deleteComment';
        const wrapDiv = document.createElement('div');
        wrapDiv.className = 'wrapper';
        wrapDiv.style.marginLeft = 0;
        commentText = document.getElementById('newComment').value;
        document.getElementById('newComment').value = '';
        textBox.innerHTML = commentText;
        wrapDiv.append(textBox, replyButton, likeButton, deleteButton);
        commentContainer.appendChild(wrapDiv);

    }

    function hasClass(elem, className) {
        return elem.className.split(' ').indexOf(className) > -1;
    }
    document.getElementById('allComments').addEventListener('click', function (e) {
        if (hasClass(e.target, 'reply')) {
            const parentDiv = e.target.parentElement;
            const wrapDiv = document.createElement('div');
            wrapDiv.style.marginLeft = (Number.parseInt(parentDiv.style.marginLeft) + 15).toString() + 'px';
            wrapDiv.className = 'wrapper';
            const textArea = document.createElement('textarea');
            textArea.style.marginRight = '20px';
            const addButton = document.createElement('button');
            addButton.className = 'addReply';
            addButton.innerHTML = 'Add';
            const cancelButton = document.createElement('button');
            cancelButton.innerHTML = 'Cancel';
            cancelButton.className='cancelReply';
            wrapDiv.append(textArea, addButton, cancelButton);
            parentDiv.appendChild(wrapDiv);
        } else if(hasClass(e.target, 'addReply')) {
            addComment(e);
        } else if(hasClass(e.target, 'likeComment')) {
            const likeBtnValue = e.target.innerHTML;
            e.target.innerHTML = likeBtnValue !== 'Like' ? Number.parseInt(likeBtnValue) + 1 : 1;
        } else if(hasClass(e.target, 'cancelReply')) {
            e.target.parentElement.innerHTML = '';
        } else if(hasClass(e.target, 'deleteComment')) {
            e.target.parentElement.remove();
        }
    });

    function addComment(ev) {
        let commentText, wrapDiv;
        const textBox = document.createElement('div');
        const replyButton = document.createElement('button');
        replyButton.className = 'reply';
        replyButton.innerHTML = 'Reply';
        const likeButton = document.createElement('button');
        likeButton.innerHTML = 'Like';
        likeButton.className = 'likeComment';
        const deleteButton = document.createElement('button');
        deleteButton.innerHTML = 'Delete';
        deleteButton.className = 'deleteComment';
        if(hasClass(ev.target.parentElement, 'container')) {
            const wrapDiv = document.createElement('div');
            wrapDiv.className = 'wrapper';
            wrapDiv.style.marginLeft = 0;
            commentText = document.getElementById('comment').value;
            document.getElementById('comment').value = '';
            textBox.innerHTML = commentText;
            wrapDiv.append(textBox, replyButton, likeButton, deleteButton);
            commentContainer.appendChild(wrapDiv);
        } else {
            wrapDiv = ev.target.parentElement;
            commentText = ev.target.parentElement.firstElementChild.value;
            textBox.innerHTML = commentText;
            wrapDiv.innerHTML = '';
            wrapDiv.append(textBox, replyButton, likeButton, deleteButton);
        }
    }

    function setOnLocalStorage () {
        localStorage.setItem('template', document.getElementById('allComments').innerHTML);
    }
</script>

</div>


-->


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

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>?doctorid=<?php echo $doctor['doctorId']?>" method="POST">

            <input type="email" name="email" placeholder="Email">
            <textarea name="message" placeholder="Message"></textarea>
            <input type="submit" name="question" value="Send">

        </form>

    </div>

</footer>

</body>
</html>