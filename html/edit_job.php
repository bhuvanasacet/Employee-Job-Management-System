<?php

include 'database/dbconn.php';

if (!isset($_GET['id'])) {
    die("Job ID not found");
}

$jobid = $_GET['id'];

/* Get job details */
$sql = "SELECT * FROM job_allotment WHERE jobid='$jobid'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    die("Job not found");
}

$row = mysqli_fetch_assoc($result);


/* Update data */
if (isset($_POST['update'])) {

    $allotment_date = $_POST['allotment_date'];
    $job_descripition = $_POST['job_descripition'];
    $empname = $_POST['empname'];
    $jobstatus = $_POST['jobstatus'];

    $update_sql = "UPDATE job_allotment SET
                    allotment_date='$allotment_date',
                    job_descripition='$job_descripition',
                    empname='$empname',
                    jobstatus='$jobstatus'
                   WHERE jobid='$jobid'";

    if (mysqli_query($conn, $update_sql)) {

        header("Location: job_allot.php");
        exit();

    } else {
        echo "Update Error: " . mysqli_error($conn);
    }
}


/* Get employees for dropdown */
$employee_sql = "SELECT empname FROM employeedetails ORDER BY empname ASC";
$employee_result = mysqli_query($conn, $employee_sql);


?>
<!DOCTYPE html>
<html lang="en">

<<meta http-equiv="content-type" content="text/php;charset=utf-8" />
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Job Allotment | adminHMD</title>

  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
      <div class="sidebar-header">
        <a class="brand-mark" href="index.php" aria-label="adminHMD dashboard">
          <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
          <span class="brand-copy">
            <span class="brand-title">adminHMD</span>
            <span class="brand-subtitle">Admin Template</span>
          </span>
        </a>
      </div>

      <nav class="sidebar-nav">
        <a class="nav-link" href="index.php">
          <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
          <span class="nav-text">Dashboard</span>
        </a>
        <a class="nav-link" href="employees.php">
          <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
          <span class="nav-text">Employee Details</span>
        </a>
        
       
        <a class="nav-link" href="job_allot.php">
          <span class="nav-icon"><i class="bi bi-table" aria-hidden="true"></i></span>
          <span class="nav-text">Job Allotment</span>
        </a>
       <div class="nav-item">

    <!-- Attendance main menu -->
    <a class="nav-link"
       href="attendance.php">

        <span class="nav-icon">
            <i class="bi bi-calendar-check"></i>
        </span>

        <span class="nav-text">Attendance</span>

    </a>

    <!-- Attendance submenu -->
    <div class="ms-3">

        <!-- Monthly Employee Salary -->
        <a class="nav-link submenu-link"
           href="empmon_sal.php">

            <span class="nav-icon">
                <i class="bi bi-calendar-month"></i>
            </span>

            <span class="nav-text">Monthly Employee Salary</span>

        </a>

        <!-- Individual Salary -->
        <a class="nav-link submenu-link"
           href="empind_salary.php">

            <span class="nav-icon">
                <i class="bi bi-person-vcard"></i>
            </span>

            <span class="nav-text">Individual Salary</span>

        </a>

    </div>

</div>
      <a class="nav-link" href="settings.php">

			<span class="nav-icon"> <i class="bi bi-gear"></i></span>

			<span class="nav-text"> Settings</span></a>  
        
      </nav>

      <div class="sidebar-user">
       
        <strong>Bhuvaneswari</strong>
        <small>Active Workspace</small>
      </div>

      <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">System running smoothly</span>
      </div>
    </aside>

    <div class="admin-main">
      <nav class="navbar admin-navbar navbar-expand bg-white">
        <div class="container-fluid px-3 px-lg-4">
          <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar" aria-expanded="true" aria-label="Toggle sidebar">
            <span></span>
            <span></span>
            <span></span>
          </button>

          <form class="d-none d-md-flex ms-3 flex-grow-1" role="search">
            <input class="form-control search-input" type="search" placeholder="Search users, orders, reports" aria-label="Search">
          </form>

          <div class="navbar-actions ms-auto">
            <button class="icon-button theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
              <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
            </button>
            

            <div class="dropdown">
              <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
               
                <span class="profile-name d-none d-sm-inline">Bhuvaneswari</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                
                <li><a class="dropdown-item" href="login.php">Sign out</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Management</p>
                <h1 class="h3 mb-1">Job Allotment</h1>
                <p class="text-muted mb-0">Create a new user account.</p>
              </div>
            </div>
            <div class="heading-actions"><a class="btn btn-outline-secondary btn-sm" href="index.php"><i class="bi bi-arrow-left" aria-hidden="true"></i> Back to Users</a></div>
          </div>

          <section class="row g-3">
            <div class="col-12 col-xl-12">
              <form method="POST">

    <!-- Job ID -->
    <div class="mb-3">
        <label class="form-label">Job ID</label>

        <input type="text"
               class="form-control"
               value="<?php echo htmlspecialchars($row['jobid']); ?>"
               readonly>
    </div>


    <!-- Allotment Date -->
    <div class="mb-3">
        <label class="form-label">Allotment Date</label>

        <input type="date"
               class="form-control"
               name="allotment_date"
               value="<?php echo htmlspecialchars($row['allotment_date']); ?>"
               required>
    </div>


    <!-- Job Description -->
    <div class="mb-3">
        <label class="form-label">Job Description</label>

        <textarea class="form-control"
                  name="job_descripition"
                  rows="5"
                  required><?php echo htmlspecialchars($row['job_descripition']); ?></textarea>
    </div>


    <!-- Employee Name -->
    <div class="mb-3">
        <label class="form-label">Employee Name</label>

        <select class="form-select"
                name="empname"
                required>

            <option value="">Select Employee</option>

            <?php
            while ($emp = mysqli_fetch_assoc($employee_result)) {
            ?>

                <option value="<?php echo htmlspecialchars($emp['empname']); ?>"
                    <?php
                    if ($emp['empname'] == $row['empname']) {
                        echo "selected";
                    }
                    ?>>
                    <?php echo htmlspecialchars($emp['empname']); ?>
                </option>

            <?php
            }
            ?>

        </select>
    </div>


    <!-- Job Status -->
    <div class="mb-3">
        <label class="form-label">Job Status</label>

        <select class="form-select"
                name="jobstatus"
                required>

            <option value="">Select Status</option>

            <option value="Completed"
                <?php if ($row['jobstatus'] == 'Completed') echo 'selected'; ?>>
                Completed
            </option>

            <option value="Inprocess"
                <?php if ($row['jobstatus'] == 'Inprocess') echo 'selected'; ?>>
                Inprocess
            </option>

            <option value="Pending"
                <?php if ($row['jobstatus'] == 'Pending') echo 'selected'; ?>>
                Pending
            </option>

        </select>
    </div>


    <button type="submit" name="update" class="btn btn-primary"> Update Job</button>

    <a href="job_allot.php" class="btn btn-secondary">Cancel</a>

</form>
            
			 
            </div>
            
          </section>
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="">Bhuvaneswari</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com/">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>Validated user creation form.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

<</html>
