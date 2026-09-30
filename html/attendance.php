<?php
include 'database/dbconn.php';

$message = "";
$message_type = "";

/* Save Attendance */
if (isset($_POST['save_attendance'])) {

    $empid = $_POST['empid'] ?? '';
    $empname = $_POST['empname'] ?? '';
    $role = $_POST['role'] ?? '';

    $salary = (float)($_POST['salary'] ?? 0);
    $total_no_of_workingdays = (int)($_POST['working_days'] ?? 0);
    $leave_days = (int)($_POST['leave_days'] ?? 0);
    $net_salary = (float)($_POST['net_salary'] ?? 0);


    /* Validation */
    if (
        empty($empid) ||
        empty($empname) ||
        $total_no_of_workingdays <= 0
    ) {

        $message = "Please select employee and enter working days.";
        $message_type = "danger";

    } else {

        $sql_insert = "INSERT INTO emp_attendance
        (
            empid,
            empname,
            role,
            salary,
            total_no_of_workingdays,
            leave_days,
            net_salary
        )
        VALUES (?, ?, ?, ?, ?, ?, ?)";


        /* Prepare statement */
        $stmt = mysqli_prepare($conn, $sql_insert);

        if (!$stmt) {
            die("Prepare Error: " . mysqli_error($conn));
        }


        /* Bind values */
        mysqli_stmt_bind_param(
            $stmt,
            "sssdiid",
            $empid,
            $empname,
            $role,
            $salary,
            $total_no_of_workingdays,
            $leave_days,
            $net_salary
        );


        /* Execute */
        if (mysqli_stmt_execute($stmt)) {

            $message = "Attendance and salary saved successfully.";
            $message_type = "success";

        } else {

            $message = "Error saving attendance: "
                     . mysqli_stmt_error($stmt);

            $message_type = "danger";
        }


        mysqli_stmt_close($stmt);
    }
}
/* Get active employees */
$sql = "SELECT empid, empname, role, salary 
        FROM employeedetails 
        WHERE status = 'Active'
        ORDER BY empname ASC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}

$employees = [];

while ($row = mysqli_fetch_assoc($result)) {
    $employees[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Forms | adminHMD</title>

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
        <a class="nav-link " href="index.php" aria-current="page">
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
                <img class="avatar-img avatar-sm" src="../assets/images/avatar/avatar.jpg" alt="Admin Hasan">
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
              <span class="page-icon"><i class="bi bi-ui-checks-grid" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Management</p>
                <h1 class="h3 mb-1">Attendance Form</h1>
                
              </div>
			  <div class="col-12">
				<div class="d-flex justify-content-end mt-4">

        <!-- Back to Main Menu -->
				<a href="index.php"class="btn btn-primary"> <i class="bi bi-arrow-left"></i>Back</a>

                                </div>

                                    </div>
									
            </div>
            
          </div>

          <section class="row g-3">
            <div class="col-12 col-xl-12">
              <form class="panel needs-validation" method="POST" novalidate>
                <div class="panel-header"><div><h2 class="h5 mb-1 section-title"><i class="bi bi-ui-checks-grid" aria-hidden="true"></i><span>Validation Form</span></h2><p class="text-muted mb-0"></p></div></div>
                <div class="row g-3">
				<div class="col-md-6">
    <label class="form-label">Employee Name</label>

    <select
        class="form-select"
        id="empname"
        name="empname"
        onchange="getEmployeeDetails()"
        required>

        <option value="">Select Employee</option>

        <?php foreach ($employees as $employee) { ?>

            <option
                value="<?php echo htmlspecialchars($employee['empname']); ?>"
                data-empid="<?php echo htmlspecialchars($employee['empid']); ?>"
                data-role="<?php echo htmlspecialchars($employee['role']); ?>"
                data-salary="<?php echo htmlspecialchars($employee['salary']); ?>">

                <?php echo htmlspecialchars($employee['empname']); ?>

            </option>

        <?php } ?>

    </select>
</div>

<div class="col-md-6">
    <label class="form-label">Employee ID</label>
    <input type="text" class="form-control" id="empid" name="empid" readonly>
</div>

<div class="col-md-6">
    <label class="form-label">Role</label>
    <input class="form-control" id="role" name="role" readonly>
</div>

<div class="col-md-6">
    <label class="form-label">Salary</label>
    <input class="form-control" id="salary"  name="salary" readonly>
</div>
				<div class="col-md-6">
    <label class="form-label" for="workingdays">
        Total number of working days
    </label>

    <input
        type="number"
        class="form-control"
        id="workingdays"
        name="working_days"
        oninput="calculateSalary()"
        min="0"
        max="30"
        required>
</div>

<div class="col-md-6">
    <label class="form-label" for="leave">
        Leave Days
    </label>

    <input
        type="number"
        class="form-control"
        id="leave"
        name="leave_days"
        readonly>
</div>

<div class="col-md-6">
    <label class="form-label" for="netsalary">
        Net Salary
    </label>

    <input
        type="text"
        class="form-control"
        id="netsalary"
        name="net_salary"
        readonly>
</div>
<div class="col-md-6">
    <label class="form-label">
        Attendance Month/Date
    </label>

    <input
        type="date"
        class="form-control"
        name="attendance_date"
        value="<?php echo date('Y-m-d'); ?>"
        required>
</div>
<div class="d-flex justify-content-end mt-4">
    <button
        class="btn btn-primary"
        type="button"
        onclick="calculateSalary()">

        <i class="bi bi-calculator"></i>
        Calculate
    </button>
</div>
<div class="d-flex justify-content-end mt-3">
    <button
        class="btn btn-success"
        type="submit"
        name="save_attendance">

        <i class="bi bi-save"></i>
        Save Attendance
    </button>
</div>
              </form>
            </div>
            
          </section>
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Bhuvaneswari</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com/">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>Form component examples.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
  
  <script>
function getEmployeeDetails() {

    var select = document.getElementById("empname");
    var option = select.options[select.selectedIndex];

    if (option.value !== "") {

        document.getElementById("empid").value =
            option.getAttribute("data-empid");

        document.getElementById("role").value =
            option.getAttribute("data-role");

        document.getElementById("salary").value =
            option.getAttribute("data-salary");

    } else {

        document.getElementById("empid").value = "";
        document.getElementById("role").value = "";
        document.getElementById("salary").value = "";
    }
}
</script>
<script>
function calculateSalary() {

    // Get working days from input
    var workingDays = parseInt(
        document.getElementById("workingdays").value
    ) || 0;

    // Get employee salary
    var salary = parseFloat(
        document.getElementById("salary").value
    ) || 0;

    // Validate working days
    if (workingDays < 0 || workingDays > 30) {
        alert("Working days must be between 0 and 30.");
        return;
    }

    // Calculate leave days
    var leaveDays = 30 - workingDays;

    // Calculate one day salary
    var oneDaySalary = salary / 30;

    // Calculate leave deduction
    var leaveSalary = leaveDays * oneDaySalary;

    // Calculate net salary
    var netSalary = salary - leaveSalary;

    // Show results
    document.getElementById("leave").value = leaveDays;
    document.getElementById("netsalary").value = netSalary.toFixed(2);
}
</script>
</body>

</html>
