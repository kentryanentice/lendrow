<?php
include 'php/user-session.php';
include 'php/borrowers-lending-terms-functions.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Prime LendRow Borrowers</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/borrowers.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css/swiper-bundle.min.css">
</head>

<body>

<?php include ('sidebar.php') ?>

<div class="overlay-bg" id="overlayBg"></div>

<div class="user-borrowers-content">
	<div class="view-lending-info" onclick="showLendingInfo()"><i class='bx bx-question-mark'></i></div>
	
	<div class="lending-info" id="lendingInfo">
	<h2>Lending Information</h2>
		<i class="bx bxs-message-square-x" onclick="hideLendingInfo()"></i>
			<div class="lending-border">
				<table class="lending-table">
						<tr class="lending-header-row">
							<th class="lending-header">Month</th>
							<th class="lending-header">Total Loan Listings</th>
							<th class="lending-header">Total Open Loan</th>
							<th class="lending-header">Total Loan Approvals</th>
							<th class="lending-header">Loan Approval Rate</th>
						</tr>
					<tbody class="lending-tbody" id="lendingInfoContainer">
						
						
						
					</tbody>
				</table>
			</div>
	</div>
	
	<div class="user-borrowers-form">
		
		<div class="user-borrowers-buttons">
			<div class="lender-form-button active" id="lenderFormButton" onclick="showLenderForm()">Lenders</div>
			<div class="application-manager-button" id="applicationManagerButton" onclick="showApplicationManager()"><div id="applicationManagerNotification"></div>Applications</div>
		</div>
	
		<div class="user-lenders active" id="userLenderForm">
			<div class="slide-container swiper" id="lenderSlide">
				<div class="slide-content">
					<div class="card-wrapper swiper-wrapper" id="lenderCardContainer">
	
					</div>
				</div>
				
				<div class="swiper-button-next swiper-navBtn"></div>
				<div class="swiper-button-prev swiper-navBtn"></div>
				<div class="swiper-pagination"></div>
				
			</div>
			
		</div>

		<div id="applicationCardContainer">
		
		</div>
		
		<div class="user-application-manager" id="userApplicationManager">
		
			<div class="application-manager-card">
				<div class="application-manager-card-image-content">
					<span class="application-manager-card-overlay"></span>
								
						<div class="application-manager-card-image">
							<div class="application-manager-card-img">
								<?php
								if (!empty($user['picture'])) {
									$profilePicturePath = './/' . htmlspecialchars($user['picture']);
									echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
								} else {
									echo '<img src="pictures/logo.png" alt="No Profile Picture">';
								}
								?>
							</div>
						</div>
						<div class="application-manager-borrowername"> 
							<?php echo htmlspecialchars($user['firstname']); ?> <?php echo htmlspecialchars($user['middlename']); ?> <?php echo htmlspecialchars($user['lastname']); ?>
						</div>
				</div>

					<div class="application-manager-card-content">
					
						<div class="application-manager-card-details">
						</div>
									
						<div class="application-manager-card-details">
							<label>Mobile No: </label><input type="text" placeholder="Mobile No." value="<?php echo htmlspecialchars($user['mobile']); ?>" readonly>
						</div>
								
					</div>
							
					<div class="application-manager-history">
						<div class="application-manager-history-form">
							<h2>Application History</h2>

							<div class="application-manager-history-content" id="applicationManagerHistory">
									
									
										
							</div>
								
						</div>
					</div>
			</div>

		</div>
		
		<div id="lendingTermsApplicationCardContainer">
		
		</div>

	</div>
	
			<div class="user-borrowers-error">
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
						
						else if ($_GET["error"] == "fundedapplication") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Your application has already been funded.</p>";
						}
						
						else if ($_GET["error"] == "rejectedapplication") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Your application has already been rejected.</p>";
						}
						
						else if ($_GET["error"] == "closedlending") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Lending has already been closed</p>";
						}
						
						else if ($_GET["error"] == "ownlending") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You cannot apply to your own lending.</p>";
						}
						
						else if ($_GET["error"] == "existingapproved") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You currently have an existing approved applications.</p>";
						}
						
						else if ($_GET["error"] == "existingapplication") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You already applied for this Lending.</p>";
						}
						
						else if ($_GET["error"] == "existingdebt") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You currently have an existing unpaid debt.</p>";
						}

						else if ($_GET["error"] == "stmtfailed") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Connection failed, please try again!</p>";
						}

					}
					if(isset($_GET["success"])) {
						if ($_GET["success"] == "applied") {
							echo "<i class='bx bxs-check-circle'></i><p class='blue'>Congratulations! Your application has been added successfully.</p>";
						}
					}
					
					if(isset($_GET["success"])) {
						if ($_GET["success"] == "cancelled") {
							echo "<i class='bx bxs-check-circle'></i><p class='blue'>You cancelled your application successfully.</p>";
						}
					}
				?>
			</div>
	
	<div class="user-borrowers-wallet">
	
		<?php include ('wallet.php') ?>
	
	</div>

</div>
	
	<script src="js/swiper-bundle.min.js"></script>
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="js/borrowers.js"></script>
</body>

</html>