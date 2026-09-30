<?php

include 'database/dbconn.php';

$sql = "SELECT 
            j.jobid,
            j.allotment_date,
            j.job_descripition,
            j.empname,
            j.jobstatus,
            e.empid,
            e.status
        FROM job_allotment j
        LEFT JOIN employeedetails e 
        ON j.empname = e.empname
        ORDER BY j.jobid DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Job Allotment | adminHMD</title>

  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
      <div class="sidebar-header">
        <a class="brand-mark" href="index.html" aria-label="adminHMD dashboard">
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
        
        
        <a class="nav-link active" href="job_allot.php" aria-current="page">
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
        <strong>Bhuvaneswari B</strong>
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
                
                <span class="profile-name d-none d-sm-inline">Bhuvaneswari B</span>
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
              <span class="page-icon"><i class="bi bi-table" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Data</p>
                <h1 class="h3 mb-1">Job Allotment</h1>
                <p class="text-muted mb-0">Use responsive, searchable tables for operational records.</p>
              </div>
            </div>
            <div class="heading-actions"><a class="btn btn-primary btn-sm" href="job.php"><i class="bi bi-person-plus" aria-hidden="true"></i> Create New Job</a></div>
          </div>

          <section class="panel">
            <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Advanced Table</span></h2><p class="text-muted mb-0">Searchable responsive table for orders and customer data.</p></div><input class="form-control form-control-sm table-search" type="search" placeholder="Search orders" data-table-search="ordersTable" aria-label="Search orders"></div>
            <div class="table-responsive"><table class="table align-middle mb-0" id="ordersTable" data-searchable-table>
			<thead><tr>
			<th>Empid</th>
			<th>Jobid</th>
			<th>Allotment_Date</th>
			<th>Job description</th>
			<th>Emp Name</th>
			<th>Status</th>
			<th>Job Status</th>
			<th>Edit</th>
			<th>Delete</th>
			</tr>
			</thead>
			<tbody>
<?php
if ($result && mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <td><?php echo htmlspecialchars($row['empid'] ?? ''); ?></td>

            <td><?php echo htmlspecialchars($row['jobid'] ?? ''); ?></td>

            <td><?php echo htmlspecialchars($row['allotment_date'] ?? ''); ?></td>

            <td><?php echo htmlspecialchars($row['job_descripition'] ?? ''); ?></td>

            <td><?php echo htmlspecialchars($row['empname'] ?? ''); ?></td>

            <td><?php echo htmlspecialchars($row['status'] ?? ''); ?></td>

            <td><?php echo htmlspecialchars($row['jobstatus'] ?? ''); ?></td>

			
    
            <td class="text-center">
                <a href="edit_job.php?id=<?php echo urlencode($row['jobid']); ?>"
				class="btn btn-primary btn-sm">
				<i class="fa fa-pencil"></i>
				</a>
            </td>

            <td class="text-center">
                <a href="delete_job.php?id=<?php echo $row['jobid']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this job?');">
                    <i class="fa fa-trash-o"></i>
                </a>
            </td>
        </tr>

<?php
    }

} else {
?>
    <tr>
        <td colspan="9" class="text-center">No Job Allotment found</td>
    </tr>
<?php
}
?>

			   
            </tbody></table></div>
          </section>
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Bhuvaneswari</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com/">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>Responsive table examples.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>
</html>
