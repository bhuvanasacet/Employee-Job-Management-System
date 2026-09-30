<?php

include 'database/dbconn.php';

/* Get departments */
$department_sql = "
    SELECT DISTINCT department
    FROM settings
    WHERE department IS NOT NULL
    AND department != ''
    ORDER BY department ASC
";

$department_result = mysqli_query($conn, $department_sql);


/* Get roles */
$role_sql = "
    SELECT DISTINCT role
    FROM settings
    WHERE role IS NOT NULL
    AND role != ''
    ORDER BY role ASC
";

$role_result = mysqli_query($conn, $role_sql);



if (isset($_POST['click'])) {
	
	// Get last employee ID
$result = mysqli_query($conn, "SELECT empid FROM employeedetails ORDER BY id DESC LIMIT 1");

if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    // Example: EMP001
    $lastEmpid = $row['empid'];

    // Get number part
    $number = (int)substr($lastEmpid, 3);

    // Increase number
    $number++;

} else {

    $number = 1;
}

// Create new employee ID
$empid = "EMP" . str_pad($number, 3, "0", STR_PAD_LEFT);

//    $empid = $_POST['empid'] ?? '';

    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';

    // Combine first name and last name
    $empname = trim($firstname . ' ' . $lastname);

    $dept = $_POST['dept'] ?? '';
    $experience = $_POST['experience'] ?? '';
    $role = $_POST['role'] ?? '';
    $date_of_birth = $_POST['date_of_birth'] ?? '';
    $email = $_POST['email'] ?? '';
    $qualification = $_POST['qualification'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
    $status = $_POST['status'] ?? '';
    $salary = $_POST['salary'] ?? '';
    $date_of_joining = $_POST['date_of_joining'] ?? '';
    $referenceby = $_POST['referenceby'] ?? '';

    $sql = "INSERT INTO employeedetails
    (empid, empname, dept, experience, role, date_of_birth,
     email, qualification, mobile, address, status, salary,
     date_of_joining, referenceby)
    VALUES
    ('$empid', '$empname', '$dept', '$experience', '$role',
     '$date_of_birth', '$email', '$qualification', '$mobile',
     '$address', '$status', '$salary', '$date_of_joining',
     '$referenceby')";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Employee added successfully');
                window.location='index.php';
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
  <title>Add User | adminHMD</title>

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
                <h1 class="h3 mb-1">Add User</h1>
                <p class="text-muted mb-0">Create a new user account.</p>
              </div>
            </div>
            <div class="heading-actions"><a class="btn btn-outline-secondary btn-sm" href="index.php"><i class="bi bi-arrow-left" aria-hidden="true"></i> Back to Users</a></div>
          </div>

          <section class="row g-3">
            <div class="col-12 col-xl-12">
              <form method="POST" action="" class="panel needs-validation">
                <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-person-plus" aria-hidden="true"></i><span>User Information</span></h2><p class="text-muted mb-0">Create a user account with validated fields.</p></div></div>
                <div class="row g-3">
				
				 
				<div class="col-md-6"><label class="form-label" for="firstName">First name</label><input class="form-control" id="firstName" type="text" name="firstname" required><div class="invalid-feedback">First name is required.</div></div>
                  <div class="col-md-6"><label class="form-label" for="lastName">Last name</label><input class="form-control" id="lastName" type="text" name="lastname" required><div class="invalid-feedback">Last name is required.</div></div>
				   <div class="col-md-6">
    <label class="form-label">Department</label>

    <select name="dept" class="form-select" required>
        <option value="">Select Department</option>

        <?php while ($department = mysqli_fetch_assoc($department_result)) { ?>
            <option value="<?php echo htmlspecialchars($department['department']); ?>">
                <?php echo htmlspecialchars($department['department']); ?>
            </option>
        <?php } ?>

    </select>
</div>
				    <div class="col-md-6"><label class="form-label" for="experience">Experience</label><input class="form-control" id="experience" type="text" name="experience" required><div class="invalid-feedback">Experience is required.</div></div>
					<div class="col-md-6">
    <label class="form-label">Role</label>

    <select name="role" class="form-select" required>
        <option value="">Select Role</option>

        <?php while ($role = mysqli_fetch_assoc($role_result)) { ?>
            <option value="<?php echo htmlspecialchars($role['role']); ?>">
                <?php echo htmlspecialchars($role['role']); ?>
            </option>
        <?php } ?>

    </select>
</div>
					<div class="col-md-6"><label class="form-label" for="date_of_birth">Date of Birth</label><input class="form-control" id="date_of_birth" type="text" name="date_of_birth" required><div class="invalid-feedback">Date of Birth is required.</div></div>
                  <div class="col-md-6"><label class="form-label" for="email">Email</label><input class="form-control" id="email" type="email" name="email" required><div class="invalid-feedback">Enter a valid email.</div></div>
				  <div class="col-md-6"><label class="form-label" for="firstName">Qualification</label><input class="form-control" id="qualification" type="text" name="qualification" required><div class="invalid-feedback">Qualification is required.</div></div>
                  <div class="col-md-6"><label class="form-label" for="mobile">Mobile</label><input class="form-control" id="mobile" type="tel" name="mobile" required><div class="invalid-feedback">Phone number is required.</div></div>
                  <div class="col-6"><label class="form-label" for="address">Address</label><textarea class="form-control" id="address" rows="10" name="address" required ></textarea></div>
				  <div class="col-md-6"><label class="form-label" for="status">Status</label><select class="form-select" id="status" name="status" required><option value="" required>Select Status</option><option>Active</option><option>InActive</option></select><div class="invalid-feedback">Select Status.</div></div>
				  <div class="col-md-6"><label class="form-label" for="salary">Salary</label><input class="form-control" id="salary" name="salary" type="text" required><div class="invalid-feedback">Salary is required.</div></div>
				  <div class="col-md-6"><label class="form-label" for="date_of_joining">Date of joining</label><input class="form-control" id="date_of_joining" type="text" name="date_of_joining" required><div class="invalid-feedback">Date of joining is required.</div></div>
				  <div class="col-md-6"><label class="form-label" for="referenceby">Reference by</label><input class="form-control" id="referenceby" type="text" name="referenceby" ><div class="invalid-feedback">Reference by is required.</div></div>
                </div>
                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4"><a class="btn btn-outline-secondary" href="index.php">Cancel</a><button name="click" class="btn btn-primary" type="submit"><i class="bi bi-person-check" aria-hidden="true"></i> Create User</button></div>
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
