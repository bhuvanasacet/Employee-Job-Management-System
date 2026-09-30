<?php
include 'database/dbconn.php';

$message = "";

/* =========================
   ADD DEPARTMENT
========================= */

if (isset($_POST['add_department'])) {

    $department = trim($_POST['department']);

    if (!empty($department)) {

        $sql = "INSERT INTO settings (department) VALUES (?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $department);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Department added successfully.";
        } else {
            $message = "Error adding department: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}


/* =========================
   ADD ROLE
========================= */

if (isset($_POST['add_role'])) {

    $role = trim($_POST['role']);

    if (!empty($role)) {

        $sql = "INSERT INTO settings (role) VALUES (?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $role);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Role added successfully.";
        } else {
            $message = "Error adding role: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}


/* =========================
   GET DEPARTMENTS
========================= */

$department_sql = "
    SELECT DISTINCT department
    FROM settings
    WHERE department IS NOT NULL
    AND department != ''
    ORDER BY department ASC
";

$department_result = mysqli_query($conn, $department_sql);


/* =========================
   GET ROLES
========================= */

$role_sql = "
    SELECT DISTINCT role
    FROM settings
    WHERE role IS NOT NULL
    AND role != ''
    ORDER BY role ASC
";

$role_result = mysqli_query($conn, $role_sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<meta name="description"
      content="adminHMD Settings">

<title>Settings | adminHMD</title>


<!-- Bootstrap -->

<link rel="stylesheet"
      href="../assets/css/bootstrap.min.css">


<!-- Bootstrap Icons -->

<link rel="stylesheet"
      href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">


<!-- AdminHMD CSS -->

<link rel="stylesheet"
      href="../assets/css/style.css">


<!-- Font Awesome -->

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

<div class="admin-shell">

<!-- =====================================
     SIDEBAR BACKDROP
====================================== -->

<div class="sidebar-backdrop"
     data-sidebar-close>
</div>



<!-- =====================================
     SIDEBAR
====================================== -->

<aside class="admin-sidebar"
       id="adminSidebar"
       aria-label="Main navigation">


    <!-- SIDEBAR HEADER -->

    <div class="sidebar-header">

        <a class="brand-mark"
           href="index.php"
           aria-label="adminHMD dashboard">

            <span class="brand-icon">

                <i class="bi bi-grid-1x2-fill"
                   aria-hidden="true">
                </i>

            </span>


            <span class="brand-copy">

                <span class="brand-title">
                    adminHMD
                </span>

                <span class="brand-subtitle">
                    Admin Template
                </span>

            </span>

        </a>

    </div>



    <!-- =====================================
         SIDEBAR NAVIGATION
    ====================================== -->

    <nav class="sidebar-nav">


        <!-- Dashboard -->

        <a class="nav-link"
           href="index.php">

            <span class="nav-icon">

                <i class="bi bi-speedometer2"
                   aria-hidden="true">
                </i>

            </span>

            <span class="nav-text">
                Dashboard
            </span>

        </a>



        <!-- Employee Details -->

        <a class="nav-link"
           href="employees.php">

            <span class="nav-icon">

                <i class="bi bi-people"
                   aria-hidden="true">
                </i>

            </span>

            <span class="nav-text">
                Employee details
            </span>

        </a>



        <!-- Job Allotment -->

        <a class="nav-link"
           href="job_allot.php">

            <span class="nav-icon">

                <i class="bi bi-table"
                   aria-hidden="true">
                </i>

            </span>

            <span class="nav-text">
                Job Allotment
            </span>

        </a>



        <!-- Attendance -->

        <div class="nav-item">

            <a class="nav-link"
               href="attendance.php">

                <span class="nav-icon">

                    <i class="bi bi-calendar-check">
                    </i>

                </span>

                <span class="nav-text">
                    Attendance
                </span>

            </a>


            <!-- Attendance Submenu -->

            <div class="ms-3">

                <a class="nav-link submenu-link"
                   href="empmon_sal.php">

                    <span class="nav-icon">

                        <i class="bi bi-calendar-month">
                        </i>

                    </span>

                    <span class="nav-text">
                        Monthly Employee Salary
                    </span>

                </a>


                <a class="nav-link submenu-link"
                   href="empind_salary.php">

                    <span class="nav-icon">

                        <i class="bi bi-person-vcard">
                        </i>

                    </span>

                    <span class="nav-text">
                        Individual Salary
                    </span>

                </a>

            </div>

        </div>



        <!-- Settings -->

        <a class="nav-link active"
           href="settings.php"
           aria-current="page">

            <span class="nav-icon">

                <i class="bi bi-gear-fill"
                   aria-hidden="true">
                </i>

            </span>

            <span class="nav-text">
                Settings
            </span>

        </a>


    </nav>



    <!-- =====================================
         SIDEBAR USER
    ====================================== -->

    <div class="sidebar-user">

        <img class="avatar-img avatar-md sidebar-user-avatar"
             src="../assets/images/avatar/avatar.jpg"
             alt="Bhuvaneswari">

        <strong>
            Bhuvaneswari B
        </strong>

        <small>
            Active Workspace
        </small>

    </div>



    <!-- SIDEBAR FOOTER -->

    <div class="sidebar-footer">

        <span class="status-dot">
        </span>

        <span class="sidebar-footer-text">
            System running smoothly
        </span>

    </div>


</aside>



<!-- =====================================
     MAIN CONTENT
====================================== -->

<div class="admin-main">



    <!-- =====================================
         TOP NAVBAR
    ====================================== -->

    <nav class="navbar admin-navbar navbar-expand bg-white">

        <div class="container-fluid px-3 px-lg-4">


            <!-- Sidebar Toggle -->

            <button class="sidebar-toggle"
                    type="button"
                    data-sidebar-toggle
                    aria-controls="adminSidebar"
                    aria-expanded="true"
                    aria-label="Toggle sidebar">

                <span></span>
                <span></span>
                <span></span>

            </button>



            <!-- Navbar Actions -->

            <div class="navbar-actions ms-auto">


                <!-- Theme -->

                <button class="icon-button theme-toggle"
                        type="button"
                        data-theme-toggle
                        aria-label="Switch color theme"
                        title="Switch color theme">

                    <i class="bi bi-moon-stars"
                       data-theme-icon
                       aria-hidden="true">
                    </i>

                </button>



                <!-- Profile -->

                <div class="dropdown">

                    <button class="profile-button dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                        <span class="profile-name d-none d-sm-inline">
                            Bhuvaneswari B
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



    <!-- =====================================
         PAGE CONTENT
    ====================================== -->

    <main class="dashboard-content">


        <div class="container-fluid px-3 px-lg-4 py-4">


            <!-- =====================================
                 PAGE HEADING
            ====================================== -->

            <div class="page-heading">


                <div class="page-heading-copy">


                    <span class="page-icon">

                        <i class="bi bi-gear-fill"
                           aria-hidden="true">
                        </i>

                    </span>


                    <div>

                        <p class="eyebrow mb-1">
                            Administration
                        </p>

                        <h1 class="h3 mb-1">
                            Settings
                        </h1>

                        <p class="text-muted mb-0">
                            Manage department and employee role settings.
                        </p>

                    </div>


                </div>


            </div>



            <!-- =====================================
                 MESSAGE
            ====================================== -->

            <?php if (!empty($message)) { ?>

                <div class="alert alert-<?php echo $message_type; ?> mt-3">

                    <?php echo htmlspecialchars($message); ?>

                </div>

            <?php } ?>



            <!-- =====================================
                 SETTINGS CARDS
            ====================================== -->

            <div class="row g-4 mt-1">



                <!-- =================================
                     DEPARTMENT CARD
                ================================== -->

                <div class="col-12 col-xl-6">


                    <section class="panel">


                        <!-- Card Header -->

                        <div class="panel-header">


                            <div>

                                <h2 class="h5 mb-1 section-title">

                                    <i class="bi bi-building"
                                       aria-hidden="true">
                                    </i>

                                    <span>
                                        Department Settings
                                    </span>

                                </h2>


                                <p class="text-muted mb-0">
                                    Add and manage employee departments.
                                </p>

                            </div>


                        </div>



                        <!-- Card Body -->

                        <div class="p-3">


                            <!-- Add Department -->

                            <form method="POST">


                                <label class="form-label">
                                    Department Name
                                </label>


                                <div class="input-group">


                                    <input
                                        type="text"
                                        name="department"
                                        class="form-control"
                                        placeholder="Enter department"
                                        required
                                    >


                                    <button
                                        type="submit"
                                        name="add_department"
                                        class="btn btn-primary">

                                        <i class="bi bi-plus-lg">
                                        </i>

                                        Add Department

                                    </button>


                                </div>


                            </form>



                            <!-- Department Table -->

                            <div class="table-responsive mt-4">


                                <table class="table align-middle mb-0">


                                    <thead>

                                        <tr>

                                            <th>
                                                #
                                            </th>

                                            <th>
                                                Department
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>


                                    <?php

                                    $i = 1;

                                    if ($department_result &&
                                        mysqli_num_rows($department_result) > 0) {

                                        while ($row = mysqli_fetch_assoc($department_result)) {

                                    ?>


                                        <tr>

                                            <td>
                                                <?php echo $i++; ?>
                                            </td>


                                            <td>

                                                <i class="bi bi-building me-2">
                                                </i>

                                                <?php
                                                echo htmlspecialchars(
                                                    $row['department']
                                                );
                                                ?>

                                            </td>


                                        </tr>


                                    <?php

                                        }

                                    } else {

                                    ?>


                                        <tr>

                                            <td colspan="2"
                                                class="text-center text-muted py-4">

                                                <i class="bi bi-inbox fs-4 d-block mb-2">
                                                </i>

                                                No departments found.

                                            </td>

                                        </tr>


                                    <?php } ?>


                                    </tbody>


                                </table>


                            </div>


                        </div>


                    </section>


                </div>



                <!-- =================================
                     ROLE CARD
                ================================== -->

                <div class="col-12 col-xl-6">


                    <section class="panel">


                        <!-- Card Header -->

                        <div class="panel-header">


                            <div>

                                <h2 class="h5 mb-1 section-title">

                                    <i class="bi bi-person-badge"
                                       aria-hidden="true">
                                    </i>

                                    <span>
                                        Role Settings
                                    </span>

                                </h2>


                                <p class="text-muted mb-0">
                                    Add and manage employee roles.
                                </p>

                            </div>


                        </div>



                        <!-- Card Body -->

                        <div class="p-3">


                            <!-- Add Role -->

                            <form method="POST">


                                <label class="form-label">
                                    Role Name
                                </label>


                                <div class="input-group">


                                    <input
                                        type="text"
                                        name="role"
                                        class="form-control"
                                        placeholder="Enter role"
                                        required
                                    >


                                    <button
                                        type="submit"
                                        name="add_role"
                                        class="btn btn-primary">

                                        <i class="bi bi-plus-lg">
                                        </i>

                                        Add Role

                                    </button>


                                </div>


                            </form>



                            <!-- Role Table -->

                            <div class="table-responsive mt-4">


                                <table class="table align-middle mb-0">


                                    <thead>

                                        <tr>

                                            <th>
                                                #
                                            </th>

                                            <th>
                                                Role
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>


                                    <?php

                                    $i = 1;

                                    if ($role_result &&
                                        mysqli_num_rows($role_result) > 0) {

                                        while ($row = mysqli_fetch_assoc($role_result)) {

                                    ?>


                                        <tr>

                                            <td>
                                                <?php echo $i++; ?>
                                            </td>


                                            <td>

                                                <i class="bi bi-person-badge me-2">
                                                </i>

                                                <?php
                                                echo htmlspecialchars(
                                                    $row['role']
                                                );
                                                ?>

                                            </td>


                                        </tr>


                                    <?php

                                        }

                                    } else {

                                    ?>


                                        <tr>

                                            <td colspan="2"
                                                class="text-center text-muted py-4">

                                                <i class="bi bi-inbox fs-4 d-block mb-2">
                                                </i>

                                                No roles found.

                                            </td>

                                        </tr>


                                    <?php } ?>


                                    </tbody>


                                </table>


                            </div>


                        </div>


                    </section>


                </div>


            </div>



            <!-- =====================================
                 BACK BUTTON
            ====================================== -->

            <div class="d-flex justify-content-end mt-4">


                <a href="index.php"
                   class="btn btn-primary">

                    <i class="bi bi-arrow-left me-1">
                    </i>

                    Back to Dashboard

                </a>


            </div>


        </div>


    </main>



    <!-- =====================================
         FOOTER
    ====================================== -->

    <footer class="admin-footer">


        <div class="container-fluid px-3 px-lg-4">


            <span>

                Copyright 2026 adminHMD.

                <br>

                Developed by

                <a target="_blank"
                   class="fw-bold text-success"
                   href="https://github.com/HasanMahmudDev">

                    Md. Hasan Mahmud

                </a>

                • Distributed by

                <a target="_blank"
                   class="fw-bold text-success"
                   href="https://themewagon.com/">

                    ThemeWagon

                </a>

            </span>


            <span>
                Professional dashboard template.
            </span>


            <span>
                Settings management.
            </span>


        </div>


    </footer>


</div>

</div>




<!-- ===================================== JAVASCRIPT ====================================== -->

<script src="../assets/js/bootstrap.bundle.min.js"> </script>

<script src="../assets/js/main.js"> </script>

</body>

</html>