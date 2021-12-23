<?php 

include 'php/config.php';
require("function.php");

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	$name = $_POST['username'];
	$email = $_POST['email'];
    $no_telpon = $_POST['noHp'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, no_telpon, password, role)
					VALUES ('$name', '$email', '$no_telpon', '$password', 0)";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				// echo "<script>alert('Wow! User Registration Completed.')</script>";                				
                unset($_POST['username']);
                unset($_POST['email']);
                unset($_POST['noHp']);
                unset($_POST['password']);
                unset($_POST['cpassword']);
                echo "<script>
                    setTimeout(function () { new swal({
                        title: \"Success\",
                        text: \"berhasil terdaftar\",
                        type: \"success\"                           
                    }).then((result)=>{
                        if (result.isConfirmed){
                            window.location = \"login.php\";
                        }
                    });}, 1000);
                </script>";
			} else {
				// echo "<script>alert('Woops! Something Wrong Went.')</script>";
                sweetAlert("Error", "Woops! Something Wrong Went.", "error");                
			}
		} else {
			// echo "<script>alert('Woops! Email Already Exists.')</script>";
            sweetAlert("Error", "Woops! Email Already Exists", "error");
		}
		
	} else {
        // var_dump("sddd");
		// echo "<script>alert('Password Not Matched.')</script>";
        sweetAlert("Error", "Password tidak sesuai", "error");
	}
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Register Form - Pure Coding</title>
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $name; ?>" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="No Handphone" name="noHp" value="<?php echo $no_telpon; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>"
                    required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword"
                    value="<?php echo $_POST['cpassword']; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" type="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
        </form>
    </div>
    <script src="js/sweetalert/sweetalert2.all.min.js"></script>
</body>

</html>