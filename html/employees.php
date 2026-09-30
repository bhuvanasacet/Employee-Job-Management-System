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


<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Employees | adminHMD</title>

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
        <a class="nav-link active" href="employees.php" aria-current="page">
          <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
          <span class="nav-text">Employee details</span>
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
              <span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Management</p>
                <h1 class="h3 mb-1">Employees</h1>
                <p class="text-muted mb-0">Review accounts, roles, account status, and team ownership.</p>
              </div>
            </div>
            <div class="heading-actions"><a class="btn btn-primary btn-sm" href="add-user.php"><i class="bi bi-person-plus" aria-hidden="true"></i> Add User</a></div>
          </div>

          
          <section class="panel mt-3">
            <div class="panel-header">
              <div>
                <h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Employee List</span></h2>
                <p class="text-muted mb-0">Search, review, and manage team member accounts.</p>
              </div>
              <div class="d-flex flex-wrap gap-2">
                <input class="form-control form-control-sm table-search" type="search" placeholder="Search users" data-table-search="usersTable" aria-label="Search users">
                
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-middle mb-0" id="usersTable" data-searchable-table>
                 <thead><tr>
				
				<th scope="col">empid</th>
				<th scope="col">empname</th>
				<th scope="col">dept</th>
				<th scope="col">experience</th>
				<th scope="col" class="text-end">role</th>
				<th scope="col" class="text-end">date_of_birth</th>
				<th scope="col" class="text-end">email</th>
				<th scope="col" class="text-end">qualification</th>
				<th scope="col" class="text-end">mobile</th>
				<th scope="col" class="text-end">address</th>
				<th scope="col" class="text-end">status</th>
				<th scope="col" class="text-end">salary</th>
				<th scope="col" class="text-end">date_of_joining</th>
				<th scope="col" class="text-end">referenceby</th>
				<th>Edit</th>
			<th>Delete</th>
				</tr></thead>
               <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>

            <tr>
               
                <td><?php echo $row['empid']; ?></td>
				<td><?php echo $row['empname']; ?></td>
                <td><?php echo $row['dept']; ?></td>
				<td><?php echo $row['experience']; ?></td>
				<td><?php echo $row['role']; ?></td>
				<td><?php echo $row['date_of_birth']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['qualification']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['status']; ?></td>
				<td><?php echo $row['salary']; ?></td>
				<td><?php echo $row['date_of_joining']; ?></td>
				<td><?php echo $row['referenceby']; ?></td>
				
				<td class="text-center">
                <a href="edit_emp.php?id=<?php echo urlencode($row['empid']); ?>"
				class="btn btn-primary btn-sm">
				<i class="fa fa-pencil"></i>
				</a>
            </td>

            <td class="text-center">
                <a href="delete_emp.php?id=<?php echo $row['empid']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this job?');">
                    <i class="fa fa-trash-o"></i>
                </a>
            </td>
				
				</tr>

        <?php
            }
        } else {
            echo "<tr><td colspan='15' class='text-center'>No Employee found</td></tr>";
        }
        ?>
				
              </table>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
              <p class="text-muted small mb-0">Showing 1 to 5 of 124 users</p>
              <nav aria-label="Users pagination"><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#">Previous</a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">Next</a></li></ul></nav>
            </div>
          </section>
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com/">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>User management dashboard.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>
