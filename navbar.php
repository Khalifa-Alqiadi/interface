<nav class="topnav">
    <a class="active" href="index.php">Home</a>
    <a href="#about">About</a>
    <a href="#contact">Contact</a>
    <a href="appointment.php">Appointment</a>
    <?php 
    if(isset($_SESSION['userid'])){
        echo '<a href="patient.php">Patient</a>';
    }
    ?>
    
    <div class="search_container">
        <form action="search.php" method="POST">
            <input type="text" placeholder="Search.." name="search">
            <button class="search" type="submit"><i class="fa fa-search"></i> Search</button>
        </form>
    </div>

</nav>
