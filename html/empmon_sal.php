<?php
include 'database/dbconn.php';

// Get selected month
$month = $_GET['month'] ?? date('Y-m');

/*
   Get attendance and salary details
   directly from emp_attendance
*/
$sql = "SELECT
            empid,
            empname,
            role,
            salary,
            total_no_of_workingdays,
            leave_days,
            net_salary
        FROM emp_attendance
        ORDER BY empname ASC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monthly Employee Salary</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="admin-shell">

    <!-- SIDEBAR -->
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar">

        <div class="sidebar-header">

            <a class="brand-mark" href="index.php">

                <span class="brand-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </span>

                <span class="brand-copy">
                    <span class="brand-title">adminHMD</span>
                    <span class="brand-subtitle">Admin Template</span>
                </span>

            </a>

        </div>


        <nav class="sidebar-nav">

            <a class="nav-link" href="index.php">

                <span class="nav-icon">
                    <i class="bi bi-speedometer2"></i>
                </span>

                <span class="nav-text">Dashboard</span>

            </a>


            <a class="nav-link" href="employees.php">

                <span class="nav-icon">
                    <i class="bi bi-people"></i>
                </span>

                <span class="nav-text">Employee Details</span>

            </a>


            <a class="nav-link" href="job_allot.php">

                <span class="nav-icon">
                    <i class="bi bi-table"></i>
                </span>

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

            <span class="sidebar-footer-text">
                System running smoothly
            </span>

        </div>

    </aside>


    <!-- MAIN -->

    <div class="admin-main">

        <nav class="navbar admin-navbar navbar-expand bg-white">

            <div class="container-fluid px-3 px-lg-4">

                <button class="sidebar-toggle"
                        type="button"
                        data-sidebar-toggle>

                    <span></span>
                    <span></span>
                    <span></span>

                </button>


                <div class="navbar-actions ms-auto">

                    <div class="dropdown">

                        <button class="profile-button dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown">

                            <img class="avatar-img avatar-sm"
                                 src="../assets/images/avatar/avatar.jpg">

                            <span class="profile-name">
                                Bhuvaneswari
                            </span>

                        </button>


                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a class="dropdown-item"
                                   href="login.php">
                                    Sign out
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </nav>


        <!-- CONTENT -->

        <main class="dashboard-content">

            <div class="container-fluid px-3 px-lg-4 py-4">
<div class="col-4">
				<div class="d-flex justify-content-end gap-2 mt-4">

        <!-- Back to Main Menu -->
				<a href="attendance.php"class="btn btn-primary"> <i class="bi bi-arrow-left"></i>Back</a>

                                </div>

                                    </div>
									

                <div class="page-heading">

                    <div class="page-heading-copy">

                        <span class="page-icon">
                            <i class="bi bi-calendar-month"></i>
                        </span>

                        <div>

                            <p class="eyebrow mb-1">
                                Attendance
                            </p>

                            <h1 class="h3 mb-1">
                                Monthly Employee Salary
                            </h1>

                        </div>

                    </div>

                </div>


                <!-- MONTH SELECTION -->

                <div class="panel mb-4">

                    <div class="panel-header">

                        <h2 class="h5 mb-0">
                            Select Month
                        </h2>

                    </div>


                    <div class="row g-3">

                        <div class="col-md-4">

                            <label class="form-label">
                                Month
                            </label>

                            <input type="month"
                                   id="month"
                                   class="form-control"
                                   value="<?php echo $month; ?>"
                                   onchange="changeMonth()">

                        </div>

                    </div>

                </div>


                <!-- SALARY TABLE -->

                <div class="panel">

                    <div class="panel-header">

                        <h2 class="h5 mb-0">
                            Employee Monthly Salary
                        </h2>

                    </div>


                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th>S.No</th>

                                    <th>Employee ID</th>

                                    <th>Employee Name</th>

                                    <th>Role</th>

                                    <th>Monthly Salary</th>

                                    <th>Working Days</th>

                                    <th>Leave Days</th>

                                    <th>Net Salary</th>

                                </tr>

                            </thead>


                            <tbody>

<?php

$count = 1;
$totalSalary = 0;
$totalNetSalary = 0;

while ($row = mysqli_fetch_assoc($result)) {

    $salary = (float)$row['salary'];

    // Get attendance details from emp_attendance
    $workingDays = (int)$row['total_no_of_workingdays'];

    $leaveDays = (int)$row['leave_days'];

    $netSalary = (float)$row['net_salary'];

    $totalSalary += $salary;
    $totalNetSalary += $netSalary;

?>

<tr>

    <!-- S.No -->
    <td>
        <?php echo $count++; ?>
    </td>

    <!-- Employee ID -->
    <td>
        <?php echo htmlspecialchars($row['empid']); ?>
    </td>

    <!-- Employee Name -->
    <td>
        <?php echo htmlspecialchars($row['empname']); ?>
    </td>

    <!-- Role -->
    <td>
        <?php echo htmlspecialchars($row['role']); ?>
    </td>

    <!-- Monthly Salary -->
    <td>
        ₹ <?php echo number_format($salary, 2); ?>
    </td>

    <!-- Working Days -->
    <td>
        <?php echo $workingDays; ?>
    </td>

    <!-- Leave Days -->
    <td>
        <?php echo $leaveDays; ?>
    </td>

    <!-- Net Salary -->
    <td>
        <strong>
            ₹ <?php echo number_format($netSalary, 2); ?>
        </strong>
    </td>

</tr>

<?php

}

?>

</tbody>
                            <!-- TOTAL -->

                            <tfoot>

                                <tr>

                                    <th colspan="4"
                                        class="text-end">

                                        TOTAL

                                    </th>

                                    <th>

                                        ₹ <?php
                                        echo number_format(
                                            $totalSalary,
                                            2
                                        );
                                        ?>

                                    </th>

                                    <th colspan="2"></th>

                                    <th>

                                        ₹ <?php
                                        echo number_format(
                                            $totalNetSalary,
                                            2
                                        );
                                        ?>

                                    </th>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                </div>

            </div>

        </main>


        <footer class="admin-footer">

            <div class="container-fluid px-3 px-lg-4">

                <span>
                    Copyright 2026 adminHMD.
                </span>

            </div>

        </footer>

    </div>

</div>


<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/js/main.js"></script>


<script>

function changeMonth() {

    let month =
        document.getElementById("month").value;

    if (month !== "") {

        window.location.href =
            "empmon_sal.php?month=" + month;

    }

}

</script>

</body>

</html>