<?php

include 'database/dbconn.php';

$employee_sql = "SELECT empname 
                 FROM employeedetails 
                 WHERE status = 'Active'
                 ORDER BY empname ASC";

$employee_result = mysqli_query($conn, $employee_sql);

if (!$employee_result) {
    die("Employee query error: " . mysqli_error($conn));
}

if (isset($_POST['click'])) {

    $jobid = $_POST['jobid'] ?? '';
    $allotment_date = $_POST['allotment_date'] ?? '';
    $job_descripition = $_POST['job_descripition'] ?? '';
    $empname = $_POST['empname'] ?? '';
    $jobstatus = $_POST['jobstatus'] ?? '';

    $sql = "INSERT INTO job_allotment
            (jobid, allotment_date, job_descripition, empname, jobstatus)
            VALUES
            ('$jobid', '$allotment_date', '$job_descripition', '$empname', '$jobstatus')";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Job allotted successfully');
                window.location='job_allot.php';
              </script>";

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/php;charset=utf-8" />
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
        <a class="nav-link" href="attendance.php">
          <span class="nav-icon"><i class="bi bi-ui-checks-grid" aria-hidden="true"></i></span>
          <span class="nav-text">Attendance</span>
        </a>
        <a class="nav-link" href="components.php">
          <span class="nav-icon"><i class="bi bi-grid-3x3-gap" aria-hidden="true"></i></span>
          <span class="nav-text">Components</span>
        </a>
        <a class="nav-link" href="alerts.php">
          <span class="nav-icon"><i class="bi bi-exclamation-triangle" aria-hidden="true"></i></span>
          <span class="nav-text">Alerts</span>
        </a>
       
        
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
            <div class="heading-actions"><a class="btn btn-outline-secondary btn-sm" href="job_allot.php"><i class="bi bi-arrow-left" aria-hidden="true"></i> Back to Users</a></div>
          </div>

          <section class="row g-3">
            <div class="col-12 col-xl-12">
              <form method="POST" action="" class="panel needs-validation">
                <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-person-plus" aria-hidden="true"></i><span>Job Information</span></h2><p class="text-muted mb-0">Create a user account with validated fields.</p></div></div>
                <div class="row g-3">
				
				
				 <div class="col-md-6"><label class="form-label" for="jobid">Job id</label><input class="form-control" id="jobid" type="text" name="jobid" required><div class="invalid-feedback">Job id is required.</div></div>
				 <div class="col-md-6"><label class="form-label" for="allotment_date">Allotment Date</label>
				 <input class="form-control" id="allotment_date" type="date" name="allotment_date" required>

				<div class="invalid-feedback"> Allotment date is required.</div></div>
				 
				 
				 <div class="col-6"><label class="form-label" for="job_descripition">Job description</label><textarea class="form-control" id="job_descripition" rows="5" name="job_descripition" required ></textarea></div>
				<div class="col-md-6">
    <label class="form-label" for="empname">Employee Name</label>

    <select class="form-select" id="empname" name="empname" required>
        <option value="">Select Employee</option>

        <?php while ($row = mysqli_fetch_assoc($employee_result)) { ?>
            
            <option value="<?php echo htmlspecialchars($row['empname']); ?>">
                <?php echo htmlspecialchars($row['empname']); ?>
            </option>

        <?php } ?>

    </select>

    <div class="invalid-feedback">
        Please select an employee.
    </div>
</div>
						  
				  <div class="col-md-6"><label class="form-label" for="jobstatus">Job Status</label><select class="form-select" id="jobstatus" name="jobstatus" required><option value="" required>Select Status</option><option>Completed</option><option>Inprocess</option><option>Pending</option></select><div class="invalid-feedback">Select Status.</div></div>
                </div>
                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4"><a class="btn btn-outline-secondary" href="index.php">Cancel</a><button name="click" class="btn btn-primary" type="submit"><i class="bi bi-person-check" aria-hidden="true"></i> Create Job</button></div>
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
</html>
