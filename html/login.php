<?php

session_start();

include 'database/dbconn.php';
/*if ($conn->connect_error) 
{
	die("Database connection failed: " . $conn->connect_error);
	}
*/
if (isset($_POST['signin'])) {
	$username = $_POST['empname']; 
	$pwd = $_POST['password'];
	$sql = "SELECT * FROM adminlogin WHERE username='$username' AND password='$pwd'";
	
	$result = $conn->query($sql); 
	
	if ($result->num_rows > 0) 
	{ 
		$row = $result->fetch_assoc();

           
            
            $_SESSION['username'] = $row['admin'];
			
		         
  echo "<script> alert('Login Successful');
  window.location.href = 'index.php';
  </script>"; 
  
  exit(); } 
  
  else { 
  echo "<script> alert('Invalid Username or Password'); 
  window.history.back(); </script>";
  exit();
  }
  } 
  
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themewagon.github.io/adminhmd/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Sep 2026 06:07:36 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD authentication page">
  <title>Login | adminHMD</title>

  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="auth-body">
  <button class="icon-button theme-toggle auth-theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
    <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
  </button>
  <main class="auth-page">
    <section class="auth-card">
      <a class="auth-brand" href="index.html"><span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span><span><strong>adminHMD</strong><small>Sign in to your admin workspace.</small></span></a>
      
      <form method="POST" action="" novalidate>
        <div class="mb-4">
          <p class="eyebrow mb-1">Secure Access</p>
          <h1 class="h3 mb-1">Login</h1>
          <p class="text-muted mb-0">Sign in to your admin workspace.</p>
        </div>
        <div class="mb-3"><label class="form-label"  for="loginEmail">Admin</label><input class="form-control" name="empname"required><div class="invalid-feedback">Enter the name.</div></div>
        <div class="mb-3"><div class="d-flex justify-content-between" ><label class="form-label" for="loginPassword" required>Password</label><a class="small fw-semibold" href="forgot-password.html">Forgot?</a></div><input class="form-control" id="loginPassword" type="password" name="password" required><div class="invalid-feedback">Password must be at least 6 characters.</div></div>
        
        <button class="btn btn-primary w-100" type="submit" name="signin"><i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> Sign In</button>
      </form>
      
     
    </section>
  </main>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

<!-- Mirrored from themewagon.github.io/adminhmd/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Sep 2026 06:07:37 GMT -->
</html>
