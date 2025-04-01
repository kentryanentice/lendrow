<?php
include 'php/admin-session.php';
include 'php/admin-account-user-functions.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Prime LendRow Admin Accounts</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/admin-accounts.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css/swiper-bundle.min.css">
</head>

<body>

<?php include ('admin-sidebar.php') ?>

<?php
	if ($admin['usertype'] == 'Admin') {
?>
<div class="overlay-bg" id="overlayBg"></div>

	<div class="accounts">
	
		<div class="accounts-content">
			<div class="slide-container swiper" id="accountSlide">
				<div class="slide-content">
					<div class="card-wrapper swiper-wrapper" id="cardContainer">
	
					</div>
				</div>
		
				<div class="swiper-button-next swiper-navBtn"></div>
				<div class="swiper-button-prev swiper-navBtn"></div>
				<div class="swiper-pagination"></div>
			</div>
	
		</div>
		
	</div>
	
	<div id="idContainer">
	
	</div>
						
			<div class="accounts-error">
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
						else if ($_GET["error"] == "stmtfailed") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>No Connection!</p>";
						}
						
						else if ($_GET["error"] == "nouploadedid") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Verification Failed, since the user hasn't uploaded any id's yet!</p>";
						}

					}
					if(isset($_GET["success"])) {						
						if ($_GET["success"] == "verified") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>Congratulations! You successfully verified a user.</p>";
						}
					}
				?>
			</div>

<?php
	}
?>
			
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="js/swiper-bundle.min.js"></script>
	<script src="js/admin-accounts.js"></script>
</body>

</html>