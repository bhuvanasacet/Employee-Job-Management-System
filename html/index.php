<?php
include 'database/dbconn.php';

$sql = "SELECT COUNT(*) AS total FROM employeedetails";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$total_employees = $row['total'];

$sql = "SELECT COUNT(*) AS total_jobs FROM job_allotment";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$total_jobs = $row['total_jobs'];

// Count Pending Jobs
$pending_sql = "SELECT COUNT(*) AS pending_jobs
                FROM job_allotment
                WHERE jobstatus = 'Pending'";

$pending_result = mysqli_query($conn, $pending_sql);

if (!$pending_result) {
    die("Pending Job Query Error: " . mysqli_error($conn));
}

$pending_row = mysqli_fetch_assoc($pending_result);

$total_pending_jobs = $pending_row['pending_jobs'] ?? 0;

// Count Completed Jobs
$completed_sql = "SELECT COUNT(*) AS completed_jobs
                  FROM job_allotment
                  WHERE jobstatus = 'Completed'";

$completed_result = mysqli_query($conn, $completed_sql);

if (!$completed_result) {
    die("Completed Job Query Error: " . mysqli_error($conn));
}

$completed_row = mysqli_fetch_assoc($completed_result);

$total_completed_jobs = $completed_row['completed_jobs'] ?? 0;

$salary_sql = "SELECT SUM(salary) AS total_salary 
               FROM employeedetails 
               WHERE status = 'Active'";

$salary_result = mysqli_query($conn, $salary_sql);

if (!$salary_result) {
    die("Salary Query Error: " . mysqli_error($conn));
}

$salary_row = mysqli_fetch_assoc($salary_result);

$total_salary = $salary_row['total_salary'] ?? 0;

// Get total Net Salary from emp_attendance
$net_salary_sql = "SELECT SUM(net_salary) AS total_net_salary
                   FROM emp_attendance";

$net_salary_result = mysqli_query($conn, $net_salary_sql);

if (!$net_salary_result) {
    die("Net Salary Query Error: " . mysqli_error($conn));
}

$net_salary_row = mysqli_fetch_assoc($net_salary_result);

$total_net_salary = $net_salary_row['total_net_salary'] ?? 0;

$sql = "SELECT * FROM employeedetails";


if (isset($_POST['search_btn']) && !empty($_POST['search_text'])) {

    $search = $_POST['search_text'];

    $sql1 = "SELECT * FROM employeedetails 
             WHERE empname LIKE '%$search%'
             OR dept LIKE '%$search%'
             OR mobile LIKE '%$search%'
             OR email LIKE '%$search%'";
			 
}
			 $result = $conn->query($sql);
			 
			 
?>
<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/php;charset=utf-8" />
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Dashboard | adminHMD</title>

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
        <a class="nav-link active" href="index.php" aria-current="page">
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
        <img class="avatar-img avatar-md sidebar-user-avatar" src="../assets/images/avatar/avatar.jpg" alt="Bhuvaneswari">
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
            <input class="form-control search-input" type="search" placeholder="Search employeedetails" aria-label="Search">
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
              <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Overview</p>
                <h1 class="h3 mb-1">Dashboard</h1>
                <p class="text-muted mb-0">Monitor Employee information from one clean workspace.</p>
              </div>
            </div>
           
          </div>

          <section class="row g-3 mt-1" aria-label="Dashboard metrics">
            <div class="col-12 col-sm-6 col-xl-2">
              <article class="metric-card metric-primary">
                <div class="metric-top">
                  <span class="metric-label">Total_no_of_Employees</span>
                  
                </div>
                <div class="metric-value" align="center"><h2><?php echo $total_employees; ?></h2></div>
                
              </article>
            </div>

            <div class="col-12 col-sm-6 col-xl-2">
              <article class="metric-card metric-success">
                <div class="metric-top">
                  <span class="metric-label">Job Allotment</span>
                  
                </div>
                <div class="metric-value" align="center"><h2><?php echo $total_jobs; ?></h2></div>
                
              </article>
            </div>
			<div class="col-12 col-sm-6 col-xl-2">
              <article class="metric-card metric-success">
                <div class="metric-top">
                  <span class="metric-label">Job Pending</span>
                  
                </div>
                <div class="metric-value" align="center"><h2><?php echo $total_pending_jobs; ?></h2></div>
                
              </article>
            </div>
			
			<div class="col-12 col-sm-6 col-xl-2">
    <article class="metric-card metric-success">

        <div class="metric-top">
            <span class="metric-label">Job Completed</span>
        </div>

        <div class="metric-value" align="center">
            <h2><?php echo $total_completed_jobs; ?></h2>
        </div>

    </article>
</div>

            <div class="col-12 col-sm-6 col-xl-2">
    <article class="metric-card metric-success">
        <div class="metric-top">
            <span class="metric-label">Total Salary</span>
        </div>

        <div class="metric-value" align="center">
            <h2>₹ <?php echo number_format($total_salary, 2); ?></h2>
        </div>
    </article>
</div>
			
			<div class="col-12 col-sm-6 col-xl-2">
              <article class="metric-card metric-success">
                <div class="metric-top">
                  <span class="metric-label">Monthly Salary</span>
                  
                </div>
                <div class="metric-value" align="center"><h2>₹ <?php echo number_format($total_net_salary, 2); ?></h2></div>
                
              </article>
            </div>
            
          </section>
          <section class="panel mt-3">
            <div class="panel-header">
              <div>
                <h2 class="h5 mb-1 section-title"><i class="bi bi-people" aria-hidden="true"></i><span>Recent Users</span></h2>
                <p class="text-muted mb-0">Latest account activity across the workspace.</p>
              </div>
              
            </div>
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead><tr>
				<th scope="col">id</th>
				<th scope="col">empid</th>
				<th scope="col">empname</th>
				<th scope="col">dept</th>

				<th scope="col" class="text-end">role</th>
				
				<th scope="col" class="text-end">email</th>

				<th scope="col" class="text-end">mobile</th>
				<th scope="col" class="text-end">address</th>

				
				</tr></thead>
               <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['empid']; ?></td>
				<td><?php echo $row['empname']; ?></td>
                <td><?php echo $row['dept']; ?></td>
				<td><?php echo $row['role']; ?></td>
				<td><?php echo $row['email']; ?></td>
				 <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['address']; ?></td>
               
				
				</tr>

        <?php
            }
        } else {
            echo "<tr><td colspan='9' class='text-center'>No Employee found</td></tr>";
        }
        ?>
				
	              </table>
            </div>
          </section>
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Bhuvaneswari</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com/">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>


</html>
