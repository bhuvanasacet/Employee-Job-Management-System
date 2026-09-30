<?php

include 'database/dbconn.php';

/* Get only Active employees */
$sql = "SELECT empid, empname, role, salary, date_of_joining
        FROM employeedetails
        WHERE status = 'Active'
        ORDER BY empname ASC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Employee Query Error: " . mysqli_error($conn));
}

$employees = [];

while ($row = mysqli_fetch_assoc($result)) {
    $employees[] = $row;
}


/* Save salary */
if (isset($_POST['save_salary'])) {

    $empid = $_POST['empid'];
    $empname = $_POST['empname'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];
    $working_years = $_POST['working_years'];
    $working_months = $_POST['working_months'];
    $salary_month = $_POST['salary_month'];

    $insert = "INSERT INTO empind_salary
               (empid, empname, role, salary, working_years, working_months, salary_month)
               VALUES
               ('$empid', '$empname', '$role', '$salary',
                '$working_years', '$working_months', '$salary_month')";

    if (mysqli_query($conn, $insert)) {
        $message = "Salary details saved successfully.";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="adminHMD professional admin dashboard template">

    <title>Individual Salary | adminHMD</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <link rel="stylesheet"
          href="../assets/css/style.css">

</head>

<body>

<div class="admin-shell">

    <!-- Sidebar backdrop -->
    <div class="sidebar-backdrop" data-sidebar-close></div>


    <!-- ================= SIDEBAR ================= -->
    <aside class="admin-sidebar"
           id="adminSidebar"
           aria-label="Main navigation">

        <!-- Your existing sidebar header/logo here -->


        <nav class="sidebar-nav">

            <!-- Dashboard -->
            <a class="nav-link"
               href="index.php">

                <span class="nav-icon">
                    <i class="bi bi-speedometer2"></i>
                </span>

                <span class="nav-text">
                    Dashboard
                </span>

            </a>


            <!-- Employee Details -->
            <a class="nav-link"
               href="employees.php">

                <span class="nav-icon">
                    <i class="bi bi-people"></i>
                </span>

                <span class="nav-text">
                    Employee Details
                </span>

            </a>


            <!-- Job Allotment -->
            <a class="nav-link"
               href="job_allot.php">

                <span class="nav-icon">
                    <i class="bi bi-briefcase"></i>
                </span>

                <span class="nav-text">
                    Job Allotment
                </span>

            </a>


            <!-- ================= ATTENDANCE ================= -->

            <div class="nav-item">

                <a class="nav-link"
                   href="attendance.php">

                    <span class="nav-icon">
                        <i class="bi bi-calendar-check"></i>
                    </span>

                    <span class="nav-text">
                        Attendance
                    </span>

                </a>


                <!-- Salary Options -->

                <div class="attendance-submenu">

                    <!-- Monthly Employee Salary -->

                    <a class="nav-link submenu-link"
                       href="empmon_sal.php">

                        <span class="nav-icon">
                            <i class="bi bi-calendar-month"></i>
                        </span>

                        <span class="nav-text">
                            Monthly Employee Salary
                        </span>

                    </a>


                    <!-- Individual Salary -->

                    <a class="nav-link submenu-link active"
                       href="empind_salary.php">

                        <span class="nav-icon">
                            <i class="bi bi-person-vcard"></i>
                        </span>

                        <span class="nav-text">
                            Individual Salary
                        </span></a></div></div>
						
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

    <!-- ================= MAIN ================= -->
        <!-- Header -->

        <header class="admin-header">

            <div class="container-fluid px-3 px-lg-4">

                <!-- Keep your existing header code here -->

            </div>

        </header>


        <!-- ================= CONTENT ================= -->

        <main class="dashboard-content">

		<div class="container-fluid px-3 px-lg-4 py-4">


                <!-- Page Heading -->

                <div class="page-heading">

                    <div class="page-heading-copy">

                        <span class="page-icon">

                            <i class="bi bi-person-vcard"></i>

                        </span>


                        <div>

                            <p class="eyebrow mb-1">
                                Salary Management
                            </p>

                            <h1 class="h3 mb-1">
                                Individual Salary
                            </h1>

                        </div>

                    </div>

                </div>


                <!-- ================= FORM ================= -->

                <section class="row ">

                    <div class="col-12 col-xl-12">

                        <form class="panel"
                              method="POST">


                            <!-- Panel Header -->

                            <div class="panel-header">

                                <div>

                                    <h2 class="h5 mb-1 section-title">

                                        <i class="bi bi-person-vcard"></i>

                                        <span>
                                            Individual Employee Salary
                                        </span>

                                    </h2>

                                    <p class="text-muted mb-0">
                                        View and store employee salary details
                                    </p>

                                </div>

                            </div>


                            <!-- ================= FORM FIELDS ================= -->

                            <div class="row g-3">


                                <!-- Employee Name Dropdown -->

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Employee Name
                                    </label>


                                    <select
                                        class="form-select"
                                        id="employee"
                                        name="employee"
                                        onchange="getEmployeeDetails()"
                                        required>

                                        <option value="">
                                            Select Employee
                                        </option>


                                        <?php foreach ($employees as $employee) { ?>

                                            <option
                                                value="<?php echo htmlspecialchars($employee['empid']); ?>"
                                                data-empid="<?php echo htmlspecialchars($employee['empid']); ?>"
                                                data-empname="<?php echo htmlspecialchars($employee['empname']); ?>"
                                                data-role="<?php echo htmlspecialchars($employee['role']); ?>"
                                                data-salary="<?php echo htmlspecialchars($employee['salary']); ?>"
                                                data-joining="<?php echo htmlspecialchars($employee['date_of_joining']); ?>">

                                                <?php
                                                echo htmlspecialchars(
                                                    $employee['empname']
                                                );
                                                ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>


                                <!-- Employee ID -->

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Employee ID
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="empid"
                                        name="empid"
                                        readonly>

                                </div>


                                <!-- Employee Name -->

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Employee Name
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="empname"
                                        name="empname"
                                        readonly>

                                </div>


                                <!-- Role -->

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Role
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="role"
                                        name="role"
                                        readonly>

                                </div>


                                <!-- Date of Joining -->

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Date of Joining
                                    </label>

                                    <input
                                        type="date"
                                        class="form-control"
                                        id="date_of_joining"
                                        name="date_of_joining"
                                        readonly>

                                </div>


                                <!-- Monthly Salary -->

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Monthly Salary
                                    </label>

                                    <input
                                        type="number"
                                        class="form-control"
                                        id="salary"
                                        name="salary"
                                        readonly>

                                </div>


                                <!-- Overall Working Years -->

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Overall Working Years
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="working_years"
                                        name="working_years"
                                        readonly>

                                </div>


                                <!-- Working Months -->

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Remaining Working Months
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="working_months"
                                        name="working_months"
                                        readonly>

                                </div>


                               


                                <!-- Buttons -->

                                <div class="col-8">

                                    <div class="d-flex justify-content-end mt-4">

                                       
										<div class="col-4">
				<div class="d-flex justify-content-end gap-2 mt-4">

        <!-- Back to Main Menu -->
				<a href="attendance.php"class="btn btn-primary"> <i class="bi bi-arrow-left"></i>Back</a>

                                </div>

                                    </div>
									
</div>
    

                            

                        </form>

                    </div>

                </section>

            </div>

        </main>

    </div>

</div>


<!-- Bootstrap -->

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- Main JS -->

<script src="../assets/js/main.js"></script>


<!-- ================= JAVASCRIPT ================= -->

<script>

function getEmployeeDetails()
{

    var select =
        document.getElementById("employee");

    var option =
        select.options[select.selectedIndex];


    if (option.value !== "")
    {

        var empid =
            option.getAttribute("data-empid");

        var empname =
            option.getAttribute("data-empname");

        var role =
            option.getAttribute("data-role");

        var salary =
            option.getAttribute("data-salary");

        var joining =
            option.getAttribute("data-joining");


        document.getElementById("empid").value =
            empid;

        document.getElementById("empname").value =
            empname;

        document.getElementById("role").value =
            role;

        document.getElementById("salary").value =
            salary;

        document.getElementById("date_of_joining").value =
            joining;


        calculateWorkingYears(joining);

    }
    else
    {

        document.getElementById("empid").value = "";

        document.getElementById("empname").value = "";

        document.getElementById("role").value = "";

        document.getElementById("salary").value = "";

        document.getElementById("date_of_joining").value = "";

        document.getElementById("working_years").value = "";

        document.getElementById("working_months").value = "";

    }

}


/* Calculate Overall Working Years */

function calculateWorkingYears(joiningDate)
{

    if (!joiningDate)
    {
        return;
    }


    var joining =
        new Date(joiningDate);

    var today =
        new Date();


    var years =
        today.getFullYear() -
        joining.getFullYear();


    var months =
        today.getMonth() -
        joining.getMonth();


    var days =
        today.getDate() -
        joining.getDate();


    if (days < 0)
    {
        months--;
    }


    if (months < 0)
    {

        years--;

        months += 12;

    }


    document.getElementById("working_years").value =
        years + " Years";


    document.getElementById("working_months").value =
        months + " Months";

}

</script>

</body>

</html>