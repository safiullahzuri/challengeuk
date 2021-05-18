<html>
<head>

<title>ChallengeUK!</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="">ChallengeUK!</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if($_SESSION['title']=='home'){echo 'active'; } ?>">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php if($_SESSION['title']=='hostel'){echo 'active'; } ?>">
        <a class="nav-link" href="hostel.php">Hostels</a>
      </li>
      <li class="nav-item <?php if($_SESSION['title']=='course'){echo 'active'; } ?>">
        <a class="nav-link" href="course.php">Courses</a>
      </li>
      <li class="nav-item <?php if($_SESSION['title']=='customer'){echo 'active'; } ?>">
        <a class="nav-link" href="customer.php">Customers</a>
      </li>
      <li class="nav-item <?php if($_SESSION['title']=='booking'){echo 'active'; } ?>">
        <a class="nav-link" href="booking.php">Course Bookings</a>
      </li>
      <li class="nav-item <?php if($_SESSION['title']=='course_schedule'){echo 'active'; } ?>">
        <a class="nav-link" href="course_schedule.php">Course Schedule</a>
      </li>
      <li class="nav-item <?php if($_SESSION['title']=='hostel_bookings'){echo 'active'; } ?>">
        <a class="nav-link" href="hostel_bookings.php">Hostel Bookings</a>
      </li>
    </ul>
  </div>
</nav>