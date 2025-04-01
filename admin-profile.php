<?php
include 'php/admin-session.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Prime LendRow Admin Profile</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/admin-profile.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<div class="overlay-bg" id="overlayBg"></div>

<?php include ('admin-sidebar.php') ?>

			<div class="signout" onclick="signOut()">Sign Out</div>
			
			<div class="signout-form" id="signOutForm">
				<form action="php/signout">
				<h2>Sign Out Form</h2>
				
					<p>Are you sure you want to Sign Out?</p>
					
					<div class="buttons">
						<div class="cancel" onclick="cancelSignOut()">Cancel</div>
						<button type="submit" class="confirm">Confirm</button>
					</div>
				</form>
			</div>
			
			<div class="admin-prof-picture">
				<div class="admin-profile">
						<?php
							if (!empty($admin['picture'])) {
								$profilePicturePath = './/' . $admin['picture'];
								echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
							} else {
								echo 'No profile picture available';
							}
						?>
				</div>
					<div class="admin-edit-pic" onclick="showAdminPictureForm()" id="adminEditPic">Edit</div>
			</div>		
			
			 <div class="overlay-bg" id="overlayBg"></div>
			
			<div class="admin-picture-form" id="adminPictureForm">
				<h2>Update Profile Form</h2>
				<div class="admin-picture-form-info">	
					 <form action="php/update-profile" method="POST" id="admin-picture-form" enctype="multipart/form-data" novalidate>
					 
						<input type="hidden" name="id" value="<?php echo htmlspecialchars($admin['id']); ?>">
						
						<div class="inputBox">
							<label>Insert Profile Picture (less than 2MB)</label>
							<i class='bx bxs-image-add' ></i>
							<input class="file" type="file" placeholder="Profile Picture" name="profile" id="profile" oninput="validateProfile()">
							<span id="profile-error" class="error-message"></span>
						</div>
						<div class="error">
							<span id="empty-error" class="empty-error-message"></span>
						</div>
						<div class="admin-picture-buttons">
							<div class="close" onclick="hideAdminPictureForm()">Close</div>
							<button type="submit" class="upload">Upload</button>
						</div>
					</form>
				</div>
			</div>
	
			<div class="admin-info">
				<div class="admin-profile-info">
					<h2>Profile Information</h2>
					<div>
						<input type="hidden" placeholder="Admin ID" value="<?php echo htmlspecialchars($admin['id']); ?>" disabled>
						
						<div class="users-error">
						<?php
							
							if ($admin['usertype'] == 'Admin') {
						?>
							<i class='bx bxs-check-circle'></i><p class='blue'><?php echo htmlspecialchars($admin['userbadge']); ?> Account!</p>
							
						<?php
							}
						?>
						</div>
						
						<div class="primary-ids">
						
						<span class="id-text">Primary ID</span>
						<div class="primary-id" onclick="showPrimaryID(<?php echo htmlspecialchars($admin['id']);?>)">
							<?php
							if (!empty($admin['primaryid'])) {
								$profilePicturePath = './/' . htmlspecialchars($admin['primaryid']);
								echo '<img src="' . $profilePicturePath . '" alt="Primary ID">';
							} else {
								echo '<img src="pictures/logo.png" alt="No Primary ID">';
							}
							?>
						</div>
						
						<span class="id-text2">Primary ID2</span>
						<div class="primary-id2" onclick="showPrimaryID2(<?php echo htmlspecialchars($admin['id']);?>)">
							<?php
							if (!empty($admin['primaryid2'])) {
								$profilePicturePath = './/' . htmlspecialchars($admin['primaryid2']);
								echo '<img src="' . $profilePicturePath . '" alt="Primary ID2">';
							} else {
								echo '<img src="pictures/logo.png" alt="No Primary ID2">';
							}
							?>
						</div>
						
						</div>
						
						<div class="inputBox">
							<i class='bx bxs-user-rectangle' ></i>
							<input type="text" placeholder="Full Name" value="<?php echo htmlspecialchars($admin['firstname']); ?> <?php echo htmlspecialchars($admin['middlename']); ?> <?php echo htmlspecialchars($admin['lastname']); ?>" disabled>
						</div>
						<div class="inputBox">
							<i class='bx bxs-user'></i>
							<input type="text" placeholder="Username" value="<?php echo htmlspecialchars($admin['username']); ?>" disabled>
						</div>
						<div class="inputBox">
							<i class='bx bxs-phone'></i>
							<input type="text" placeholder="Mobile No." value="<?php echo htmlspecialchars($admin['mobile']); ?>" disabled>
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
								}
								
								if(isset($_GET["success"])) {
									if ($_GET["success"] == "uploaded") {
										echo "<i class='bx bxs-check-circle'></i><p class='blue'>Profile has been uploaded successfully!</p>";
									}
								}
							?>
						</div>
						
						<button class="update">Request Update</button>
					</div>
				</div>
			</div>
						
						<div class="id" id="primaryID<?php echo htmlspecialchars($admin['id']);?>">
						<div class="title">Primary ID<i class='bx bxs-message-square-x' onclick="hidePrimaryID(<?php echo htmlspecialchars($admin['id']);?>)"></i></div>
							<?php
							if (!empty($admin['primaryid'])) {
								$profilePicturePath = './/' . htmlspecialchars($admin['primaryid']);
								echo '<img src="' . $profilePicturePath . '" alt="Primary ID">';
							} else {
								echo '<img src="pictures/logo.png" alt="No Primary ID">';
							}
							?>
						</div>
					
						<div class="id" id="primaryID2<?php echo htmlspecialchars($admin['id']);?>">
						<div class="title">Primary ID2<i class='bx bxs-message-square-x' onclick="hidePrimaryID2(<?php echo htmlspecialchars($admin['id']);?>)"></i></div>
							<?php
							if (!empty($admin['primaryid2'])) {
								$profilePicturePath = './/' . htmlspecialchars($admin['primaryid2']);
								echo '<img src="' . $profilePicturePath . '" alt="Primary ID2">';
							} else {
								echo '<img src="pictures/logo.png" alt="No Primary ID2">';
							}
							?>
						</div>
	
    <script src="js/admin-profile.js"></script>
	
</body>

</html>