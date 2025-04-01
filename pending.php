<?php
include 'php/users-pending-session.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Prime LendRow Pending Account</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/pending.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<div class="overlay-bg" id="overlayBg"></div>

		<div class="h1-profile"><p>PRIME LENDROW</p></div>
			<div class="picture">
				<div class="prof">
				<a href="#">
					<?php
					if (!empty($user['picture'])) {
						$profilePicturePath = './/' . htmlspecialchars($user['picture']);
						echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
					} else {
						echo '<img src="pictures/logo.png" alt="No Profile Picture">';
					}
					?>
					</a>
				</div>
				
			</div>
			
			<div class="name">
			Welcome!<br>  <?php echo htmlspecialchars($user['username']); ?>
			</div>
		
			<div class="signout" onclick="signOut()">Sign Out</div>
			
			<div class="signout-form" id="signOutForm">
				<form action="php/signout">
				<h2>Sign Out Form</h2>
				
					<p>Are you sure you want to Sign Out?</p>
					
					<div class="buttons">
						<div class="close" onclick="cancelSignOut()">Cancel</div>
						<button type="submit" class="create">Confirm</button>
					</div>
				</form>
			</div>
	
			<div class="my-info">
				<div class="profile-info">
					<h2>Profile Information</h2>
					<div>
						<input type="hidden" placeholder="User ID" value="<?php echo htmlspecialchars($user['id']); ?>" disabled>
						
						<div class="primary-ids">
						
						<span class="id-text">Primary ID</span>
						<div class="primary-id" onclick="showPrimaryID(<?php echo htmlspecialchars($user['id']);?>)">
							<?php
							if (!empty($user['primaryid'])) {
								$profilePicturePath = './/' . htmlspecialchars($user['primaryid']);
								echo '<img src="' . $profilePicturePath . '" alt="Primary ID">';
							} else {
								echo '<img src="pictures/logo.png" alt="No Primary ID">';
							}
							?>
						</div>
						
						<span class="id-text2">Primary ID2</span>
						<div class="primary-id2" onclick="showPrimaryID2(<?php echo htmlspecialchars($user['id']);?>)">
							<?php
							if (!empty($user['primaryid2'])) {
								$profilePicturePath = './/' . htmlspecialchars($user['primaryid2']);
								echo '<img src="' . $profilePicturePath . '" alt="Primary ID2">';
							} else {
								echo '<img src="pictures/logo.png" alt="No Primary ID2">';
							}
							?>
						</div>
						
						</div>
						
						<div class="inputBox">
							<i class='bx bxs-user-rectangle' ></i>
							<input type="text" placeholder="Full Name" value="<?php echo htmlspecialchars($user['firstname']); ?> <?php echo htmlspecialchars($user['middlename']); ?> <?php echo htmlspecialchars($user['lastname']); ?>" disabled>
						</div>
						<div class="inputBox">
							<i class='bx bxs-user'></i>
							<input type="text" placeholder="Username" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
						</div>
						<div class="inputBox">
							<i class='bx bxs-phone'></i>
							<input type="text" placeholder="Mobile No." value="<?php echo htmlspecialchars($user['mobile']); ?>" disabled>
						</div>
						
						<div class="submission-errors">
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
									
									else if ($_GET["error"] == "emptypicture") {
										echo "<i class='bx bxs-error-circle'></i><p class='red'>Primary ID field must not be empty, please attach a valid id to proceed!</p>";
									}
									
									else if ($_GET["error"] == "invalidsize") {
										echo "<i class='bx bxs-error-circle'></i><p class='red'>Please attach a valid id picture 2MB or below!</p>";
									}

									else if ($_GET["error"] == "invalidformat") {
										echo "<i class='bx bxs-error-circle'></i><p class='red'>Please attach a correct valid id picture format!</p>";
									}
								}
								
								if(isset($_GET["success"])) {
									if ($_GET["success"] == "uploaded") {
										echo "<i class='bx bxs-check-circle'></i><p class='blue'>Your ID's has been uploaded successfully!</p>";
									}
									elseif ($_GET["success"] == "verified") {
										echo "<i class='bx bxs-check-circle'></i><p class='blue'>You are already verified! No further action needed.</p>";
									}
								}
							?>
						</div>
						
						<div class="error-and-button" id="usersErrorAndButton">

						
						</div>
						
					</div>
				</div>
			</div>
						
						<div class="id" id="primaryID<?php echo htmlspecialchars($user['id']);?>">
						<div class="title">Primary ID<i class='bx bxs-message-square-x' onclick="hidePrimaryID(<?php echo htmlspecialchars($user['id']);?>)"></i></div>
							<?php
							if (!empty($user['primaryid'])) {
								$profilePicturePath = './/' . htmlspecialchars($user['primaryid']);
								echo '<img src="' . $profilePicturePath . '" alt="Primary ID">';
							} else {
								echo '<img src="pictures/logo.png" alt="No Primary ID">';
							}
							?>
						</div>
					
						<div class="id" id="primaryID2<?php echo htmlspecialchars($user['id']);?>">
						<div class="title">Primary ID2<i class='bx bxs-message-square-x' onclick="hidePrimaryID2(<?php echo htmlspecialchars($user['id']);?>)"></i></div>
							<?php
							if (!empty($user['primaryid2'])) {
								$profilePicturePath = './/' . htmlspecialchars($user['primaryid2']);
								echo '<img src="' . $profilePicturePath . '" alt="Primary ID2">';
							} else {
								echo '<img src="pictures/logo.png" alt="No Primary ID2">';
							}
							?>
						</div>
			
			<div class="update-form" id="updateForm">
				<h2>Update Form</h2>
				<div class="update-form-info">	
					 <form action="php/pending-update" method="POST" id="pending-form" enctype="multipart/form-data" novalidate>
					 
						<input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
						
						<div class="inputBox">
							<label>Insert Primary ID (less than 2MB)</label>
							<i class='bx bx-image-add'></i>
							<input class="file" type="file" placeholder="Valid Primary ID" name="primaryid" id="primaryid" oninput="validatePrimaryID()">
							<span id="primaryid-error" class="error-message"></span>
						</div>
						<div class="inputBox">
							<label>Insert Secondary ID (less than 2MB)</label>
							<i class='bx bxs-image-add' ></i>
							<input class="file" type="file" placeholder="Valid Secondary ID" name="primaryid2" id="primaryid2" oninput="validatePrimaryID2()">
							<span id="primaryid2-error" class="error-message"></span>
						</div>
						<div class="error">
							<span id="empty-error" class="empty-error-message"></span>
						</div>
						<div class="buttons">
							<div class="close" onclick="hideUpdateForm()">Close</div>
							<button type="submit" class="create">Submit</button>
						</div>
					</form>
				</div>
			</div>
	
	
	<div class="copyright">
		<p>©2023 LendRow Official</p>
	</div>
	
	<script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/pending.js"></script>
</body>

</html>