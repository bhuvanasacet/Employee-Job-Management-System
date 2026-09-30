<?php

include 'database/dbconn.php';

/* Get Employee ID */
if (!isset($_GET['id'])) {
    die("Employee ID not found");
}

$empid = $_GET['id'];

/* Get employee details */
$sql = "SELECT * FROM employeedetails WHERE empid='$empid'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    die("Employee not found");
}

$row = mysqli_fetch_assoc($result);


/* Update Employee */
if (isset($_POST['update'])) {

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


    $update_sql = "UPDATE employeedetails SET

        empname='$empname',
        dept='$dept',
        experience='$experience',
        role='$role',
        date_of_birth='$date_of_birth',
        email='$email',
        qualification='$qualification',
        mobile='$mobile',
        address='$address',
        status='$status',
        salary='$salary',
        date_of_joining='$date_of_joining',
        referenceby='$referenceby'

        WHERE empid='$empid'";


    if (mysqli_query($conn, $update_sql)) {

        echo "<script>
                alert('Employee updated successfully');
                window.location='employees.php';
              </script>";

        exit();

    } else {

        echo "Update Error: " . mysqli_error($conn);
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
                <h1 class="h3 mb-1">Employee Details</h1>
                <p class="text-muted mb-0">Edit user account.</p>
              </div>
            </div>
            <div class="heading-actions"><a class="btn btn-outline-secondary btn-sm" href="employees.php"><i class="bi bi-arrow-left" aria-hidden="true"></i> Back to Users</a></div>
          </div>

          <section class="row g-3">
            <div class="col-12 col-xl-12">
             

    <div class="container mt-5">
	<div class="card">
        <div class="card-header">
            <h3>Edit Employee Details</h3>
</div>


        <div class="card-body">

            <form method="POST">


                <!-- Employee ID -->

                <div class="mb-3">

                    <label class="form-label">Employee ID</label>

                    <input type="text"class="form-control"value="<?php echo htmlspecialchars($row['empid']); ?>"readonly>

                </div>


                <!-- Employee Name -->

                <?php

                $name = explode(' ', $row['empname'], 2);

                $firstname = $name[0] ?? '';
                $lastname = $name[1] ?? '';

                ?>


                <div class="row">
					<div class="col-md-6 mb-3">

                        <label class="form-label">First Name </label>

                        <input type="text"class="form-control"name="firstname"value="<?php echo htmlspecialchars($firstname); ?>"
                               required></div>


                    <div class="col-md-6 mb-3">
					<label class="form-label"> Last Name </label>
                           <input type="text"
                               class="form-control"
                               name="lastname"
                               value="<?php echo htmlspecialchars($lastname); ?>"></div></div>


                <!-- Department -->

                <div class="mb-3">

                    <label class="form-label">Department</label>
					<input type="text"
                           class="form-control"
                           name="dept"
                           value="<?php echo htmlspecialchars($row['dept']); ?>"
                           required></div>


                <!-- Experience -->

                <div class="mb-3">

                    <label class="form-label">Experience</label>

                    <input type="text"
                           class="form-control"
                           name="experience"
                           value="<?php echo htmlspecialchars($row['experience']); ?>"
                           required></div>


                <!-- Role -->

                <div class="mb-3">

                    <label class="form-label"> Role</label>

                    <select class="form-select"name="role"required>

                        <option value="">Choose Role</option>

                        <option value="Admin"
                            <?php if ($row['role'] == 'Admin') echo 'selected'; ?>>
                            Admin
                        </option>

                        <option value="Manager"
                            <?php if ($row['role'] == 'Manager') echo 'selected'; ?>>
                            Manager
                        </option>

                        <option value="Web Designer"
                            <?php if ($row['role'] == 'Web Designer') echo 'selected'; ?>>
                            Web Designer
                        </option>

                        <option value="Software Developer"
                            <?php if ($row['role'] == 'Software Developer') echo 'selected'; ?>>
                            Software Developer
                        </option>

                    </select>

                </div>


                <!-- Date of Birth -->

                <div class="mb-3">

                    <label class="form-label">Date of Birth</label>

                    <input type="date"
                           class="form-control"
                           name="date_of_birth"
                           value="<?php echo htmlspecialchars($row['date_of_birth']); ?>"
                           required></div>


                <!-- Email -->

                <div class="mb-3">

                    <label class="form-label">Email</label>

                    <input type="email"
                           class="form-control"
                           name="email"
                           value="<?php echo htmlspecialchars($row['email']); ?>"
                           required></div>


                <!-- Qualification -->

                <div class="mb-3">

                    <label class="form-label">Qualification</label>

                    <input type="text"
                           class="form-control"
                           name="qualification"
                           value="<?php echo htmlspecialchars($row['qualification']); ?>"
                           required></div>


                <!-- Mobile -->

                <div class="mb-3">

                    <label class="form-label">Mobile</label>

                    <input type="text"
                           class="form-control"
                           name="mobile"
                           value="<?php echo htmlspecialchars($row['mobile']); ?>"
                           required></div>


                <!-- Address -->

                <div class="mb-3">

                    <label class="form-label">Address</label>

                    <textarea class="form-control"
                              name="address"
                              rows="4"
                              required><?php echo htmlspecialchars($row['address']); ?></textarea>

                </div>


                <!-- Status -->

                <div class="mb-3">

                    <label class="form-label">Status</label>

                    <select class="form-select"
                            name="status"
                            required>

                        <option value="">Select Status</option>

                        <option value="Active"
                            <?php if ($row['status'] == 'Active') echo 'selected'; ?>>
                            Active</option>

                        <option value="InActive"
                            <?php if ($row['status'] == 'InActive') echo 'selected'; ?>>
                            InActive</option>

                    </select></div>


                <!-- Salary -->

                <div class="mb-3">

                    <label class="form-label">Salary</label>

                    <input type="text"
                           class="form-control"
                           name="salary"
                           value="<?php echo htmlspecialchars($row['salary']); ?>"
                           required></div>


                <!-- Date of Joining -->

                <div class="mb-3">

                    <label class="form-label">Date of Joining</label>

                    <input type="date"
                           class="form-control"
                           name="date_of_joining"
                           value="<?php echo htmlspecialchars($row['date_of_joining']); ?>"
                           required></div>


                <!-- Reference -->

                <div class="mb-3">

                    <label class="form-label">Reference By</label>

                    <input type="text"
                           class="form-control"
                           name="referenceby"
                           value="<?php echo htmlspecialchars($row['referenceby']); ?>"></div>


                <!-- Buttons -->

                <button type="submit"name="update"class="btn btn-primary">Update Employee</button>


                <a href="employees.php"class="btn btn-secondary">Cancel</a>


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

<!-- Mirrored from themewagon.github.io/adminhmd/php/add-user.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Sep 2026 06:07:34 GMT -->
</html>
