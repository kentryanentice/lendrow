<?php
include 'php/home-session.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Prime LendRow SignIn/SignUp</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

	<div class="lendrow-title"><p>PRIME LENDROW</p></div>
	
    <div class="wrapper">
        <div class="form sign-up">
            <form action="php/signup" method="POST" id="signup-form" novalidate>
                <h2>Sign Up</h2>
				<div class="inputBox">
					<i class='bx bxs-user-rectangle' ></i>
                    <input type="text" name="firstname" id="firstname" placeholder="Enter your Firstname" oninput="validateFirstname()">
					<span id="firstname-error" class="error-message"></span>
                </div>
				<div class="inputBox">
					<i class='bx bxs-user-badge'></i>
                    <input type="text" name="middlename" id="middlename" placeholder="Enter your Middlename" oninput="validateMiddlename()">
					<span id="middlename-error" class="error-message"></span>
                </div>
				<div class="inputBox">
					<i class='bx bxs-user-account' ></i>
                    <input type="text" name="lastname" id="lastname" placeholder="Enter your Lastname" oninput="validateLastname()">
					<span id="lastname-error" class="error-message"></span>
                </div>
                <div class="inputBox">
					<i class='bx bxs-user'></i>
                    <input type="text" name="username" id="username" placeholder="Enter your Username" oninput="validateUsername()">
					<span id="username-error" class="error-message"></span>
                </div>
				<div class="inputBox">
					<i class='bx bxs-phone'></i>
                    <input type="text" name="mobile" id="mobile" placeholder="Enter your Mobile No." oninput="validateMobile()">
					<span id="mobile-error" class="error-message"></span>
                </div>
                <div class="inputBox">
					<i id="toggle1" class='bx bxs-lock'></i>
                    <input type="password" name="pass" id="pass1" placeholder="Enter a Password" oninput="validatePassword()">
					<span id="password-error" class="error-message"></span>
                </div>
				<div class="inputBox">
					<i id="toggle2" class='bx bxs-lock'></i>
                    <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm your Password" oninput="validatePassword()">
					<span id="password-error2" class="error-message"></span>
                </div>
                <button type="submit" class="btn">Register</button>
				<span id="empty-error" class="empty-error-message"></span>
                <div class="link">
                    <p>Already have an account?<a href="#" class="signin-link"> Sign In</a></p>
                </div>
            </form>
        </div>

        <div class="form sign-in">
            <form action="php/signin" method="POST" id="signin-form" novalidate>
                <h2>Sign In</h2>
                <div class="inputBox">
					<i class='bx bxs-user'></i>
                    <input type="text" name="username" id="signinusername" placeholder="Enter your Username" oninput="validateSigninUsername()">
					<span id="signinusername-error" class="error-message"></span>
                </div>
                <div class="inputBox">
					<i id="toggle" class='bx bxs-lock'></i>
                    <input type="password" name="pass" id="signinpassword" placeholder="Enter your Password" oninput="validateSigninPassword()">
					<span id="signinpassword-error" class="error-message"></span>
                </div>
                <button type="submit" class="btn">Log In</button>
				<span id="signin-empty-error" class="empty-error-message"></span>
                <div class="link">
                    <p>Don't have an account yet?<a href="#" class="signup-link"> Sign Up</a></p>
                </div>
            </form>
			
			<div class="errors">
				<?php
					if(isset($_GET["error"])) {
						if ($_GET["error"] == "duplicate_submission") {
							$resubmitTime = $_SESSION['last_submission_time'] + 5;

							$remainingTime = max(0, $resubmitTime - time());

							$minutes = floor($remainingTime / 60);
							$seconds = $remainingTime % 60;

							echo "<i class='bx bxs-error-circle'></i><p class='red'>Duplicate Submission, please wait for ";
							echo $seconds . "s before resubmitting.</p>";
						}
						
						else if ($_GET["error"] == "invalidcredentials") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Incorrect Sign In Information!</p>";
						}
						
						else if ($_GET["error"] == "stmtfailed") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Connection Error!</p>";
						}
						
						else if ($_GET["error"] == "fullnametaken") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Fullname has already been taken, Please choose another one!</p>";
						}
						
						else if ($_GET["error"] == "usernametaken") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Username has already been taken, Please choose another one!</p>";
						}
						
						else if ($_GET["error"] == "mobiletaken") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Mobile No. has already been taken, Please use another mobile no.!</p>";
						}
						
						else if ($_GET["error"] == "unauthorizedaccess") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Unauthorized access has been detected, your session has been destroyed!</p>";
						}
						
						else if ($_GET["error"] == "stmtfailed") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Connection Error!</p>";
						}
						
					}
					if(isset($_GET["success"])) {
						if ($_GET["success"] == "registered") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>Congratulations! Your information has been registered successfully.</p>";
						}
					}
				?>
		</div>
		
        </div>
    </div>
	
	<?php include 'lendrow-logo.php'; ?>
	
    <script src="js/home.js"></script>
	
</body>

</html>