<?php
include 'php/user-session.php';
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Prime LendRow</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/sidebar.css">
</head>

<body>

	<div class="h1-profile"><p>PRIME LENDROW</p></div>

		<div class="profile-container">
			<div class="picture">
				<div class="prof">
				<a href="profile">
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
				Welcome!<br><?php echo htmlspecialchars($user['username']); ?>
					<?php	
						if ($user['usertype'] == 'User') { 
					?> 
						<span class="icon"><i class='bx bxs-check-circle'></i></span>
						<p class="blue">
					
					<?php
						echo htmlspecialchars($user['userbadge']); ?> User 
					<?php 
					} 
					?> 
				</p>
			</div>
		</div>

		<div class="menu">
		  <div id="btn"></div>
		</div>
		
		<div class="navigation">
		
		<?php
			if ($user['usertype'] == 'User') {
		?>
			<li class="list" id="lenders">
				<a href="lenders">
				<span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>
				<span class="text">Lend</span>
				
					<div id="lendersNotification"></div>
					
				</a>
			</li>
			
			<li class="list" id="borrowers">
				<a href="borrowers">
				<span class="icon"><ion-icon name="person-remove-outline"></ion-icon></span>
				<span class="text">Borrow</span>
				
					<div id="borrowersNotification"></div>
				
				</a>
			</li>
			
			<li class="list" id="payments">
				<a href="payments">
				<span class="icon"><ion-icon name="card-outline"></ion-icon></span>
				<span class="text">Pay</span>
				
					<div id="paymentsNotification"></div>
					
				</a>
			</li>
		<?php
			}
		?>
			
		</div>
		
	<?php include 'lendrow-logo.php'; ?>
	
	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	
	<script src="js/jquery-3.7.1.min.js"></script>	
	<script src="js/sidebar.js"></script>
</body>

</html>