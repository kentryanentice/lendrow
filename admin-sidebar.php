<?php
include 'php/admin-session.php';
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Prime LendRow</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/admin-sidebar.css">
</head>

<body>

	<div class="h1-profile"><p>PRIME LENDROW</p></div>

		<div class="profile-container">
			<div class="picture">
				<div class="prof">
				<a href="admin-profile">
					<?php
					if (!empty($admin['picture'])) {
						$profilePicturePath = './/' . htmlspecialchars($admin['picture']);
						echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
					} else {
						echo '<img src="pictures/logo.png" alt="No Profile Picture">';
					}
					?>
					</a>
				</div>
				
			</div>
			
			<div class="name">
				Welcome!<br><?php echo htmlspecialchars($admin['username']); ?>
					<?php	
						if ($admin['usertype'] == 'Admin') { 
					?> 
						<span class="icon"><i class='bx bxs-check-circle'></i></span>
						<p class="blue">
					
					<?php
						echo htmlspecialchars($admin['userbadge']); ?> Admin 
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
			if ($admin['usertype'] == 'Admin') {
		?>
			<li class="list" id="admin-accounts">
				<a href="admin-accounts">
				<span class="icon"><ion-icon name="people-outline"></ion-icon></span>
				<span class="text">Accounts</span>
				
					<div id="adminAccountsNotification"></div>
						
				</a>
			</li>
			
			<li class="list" id="admin-account-wallet">
				<a href="admin-account-wallet">
				<span class="icon"><ion-icon name="wallet-outline"></ion-icon></span>
				<span class="text">Admin</span>
				
					<div id="adminAccountWalletNotification"></div>
				
				</a>
			</li>

			<li class="list" id="admin-lenders">
				<a href="admin-lenders">
				<span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>
				<span class="text">Lend</span>
				
					<div id="adminLendersNotification"></div>
					
				</a>
			</li>
			
			<li class="list" id="admin-borrowers">
				<a href="admin-borrowers">
				<span class="icon"><ion-icon name="person-remove-outline"></ion-icon></span>
				<span class="text">Borrow</span>
				
					<div id="adminBorrowersNotification"></div>
				
				</a>
			</li>
			
			<li class="list" id="admin-payments">
				<a href="admin-payments">
				<span class="icon"><ion-icon name="card-outline"></ion-icon></span>
				<span class="text">Pay</span>
				
					<div id="adminPaymentsNotification"></div>
					
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
	<script src="js/admin-sidebar.js"></script>
</body>

</html>