<?php
include '../php/admin-session.php';
include '../php/admin-account-user-functions.php';
				
	$searchUsers = isset($_GET['searchUsers']) ? $_GET['searchUsers'] : '';
	$usersData = getUsers($searchUsers);

		foreach ($usersData as $userData) {
			$id = $userData['id'];
								
		if ($userData['usertype'] == 'Pending' || $userData['usertype'] == 'Verifying') {
	?>

						
	<div class="accounts-card" id="accountsCard<?php echo htmlspecialchars($userData['id']); ?>">
		<form action="php/verify-user" method="POST">
								
			<div class="accounts-image">
				<div class="accounts-overlay">
					<div class="accounts-image-content">

						<?php
							if (!empty($userData['picture'])) {
							$profilePicturePath = './/' . htmlspecialchars($userData['picture']);
								echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
							} else {
								echo '<img src="pictures/logo.png" alt="No Profile Picture">';
							}
						?>
					</div>
				</div>
				<div class="accounts-fullname">
					<?php echo htmlspecialchars($userData['firstname']); ?> <?php echo htmlspecialchars($userData['middlename']); ?> <?php echo htmlspecialchars($userData['lastname']); ?>
				</div>
			</div>
								
				<div class="accounts-card-content">
				
					<input type="hidden" name="id" value="<?php echo htmlspecialchars($userData['id']); ?>">
							
					<div class="accounts-detail">
						<label> Updated at <?php echo date("F d, Y h:i A", strtotime($userData['updated_at'])); ?> </label>
					</div>
										
					<div class="accounts-detail">
						<label>Username </label><input type="text" placeholder="<?php echo htmlspecialchars($userData['username']); ?>" disabled>
					</div>
									
					<div class="accounts-detail">
						<label>Mobile No </label><input type="text" placeholder="<?php echo htmlspecialchars($userData['mobile']); ?>" disabled>
					</div>
									
					<div class="accounts-detail">
						<label>Account Status </label><input type="text" placeholder="<?php echo htmlspecialchars($userData['usertype']); ?>" disabled>
					</div>
									
					<div class="accounts-primary-ids">
						
						<span class="accounts-id-text">Primary ID</span>
							<div class="accounts-primary-id" onclick="showPrimaryID(<?php echo htmlspecialchars($userData['id']);?>)">
								<?php
									if (!empty($userData['primaryid'])) {
										$profilePicturePath = './/' . htmlspecialchars($userData['primaryid']);
										echo '<img src="' . $profilePicturePath . '" alt="Primary ID">';
									} else {
										echo '<img src="pictures/logo.png" alt="No Primary ID">';
									}
								?>
							</div>
									
							<span class="accounts-id-text2">Primary ID2</span>
							<div class="accounts-primary-id2" onclick="showPrimaryID2(<?php echo htmlspecialchars($userData['id']);?>)">
								<?php
									if (!empty($userData['primaryid2'])) {
										$profilePicturePath = './/' . htmlspecialchars($userData['primaryid2']);
										echo '<img src="' . $profilePicturePath . '" alt="Primary ID2">';
									} else {
										echo '<img src="pictures/logo.png" alt="No Primary ID2">';
									}
								?>
							</div>
									
					</div>
							
				</div>
							
				<div class="accounts-button">
					<div class="close" onclick="hideAccountsCard(<?php echo htmlspecialchars($userData['id']);?>)">Close</div>
					<div class="verify" onclick="showVerify(<?php echo htmlspecialchars($userData['id']);?>)">Verify</div>
				</div>
								
				<div class="overlayaccountsbg" id="overlayAccountsBg<?php echo htmlspecialchars($userData['id']);?>"></div>
						
				<div class="verify-account" id="verifyAcccount<?php echo htmlspecialchars($userData['id']);?>">
					<h2 class="verify-account-h2">Account Verification</h2>
									
					<p class="verify-account-p">Are you sure you want to verify this Account?</p>
									
					<div class="verify-account-buttons">
						<div class="verify-close" onclick="hideVerify(<?php echo htmlspecialchars($userData['id']);?>)">Close</div>
						<button type="submit" name="verify" id="verify" class="verify-button">Verify</button>
					</div>
				</div>
								
		</form>
	</div>
						
	<?php
		}
	}
	?>
						
						
						
		<?php
			$searchUsers = isset($_GET['searchUsers']) ? $_GET['searchUsers'] : '';
			$usersData = getUsers($searchUsers);

				foreach ($usersData as $userData) {
					$id = $userData['id'];
								
				if ($userData['usertype'] == 'Pending' || $userData['usertype'] == 'Verifying') {
			?>
						
				<div class="accounts-id" id="primaryID<?php echo htmlspecialchars($userData['id']);?>">
				<div class="accounts-title">Primary ID<i class='bx bxs-message-square-x' onclick="hidePrimaryID(<?php echo htmlspecialchars($userData['id']);?>)"></i></div>
					<?php
						if (!empty($userData['primaryid'])) {
							$profilePicturePath = './/' . htmlspecialchars($userData['primaryid']);
								echo '<img src="' . $profilePicturePath . '" alt="Primary ID">';
						} else {
							echo '<img src="pictures/logo.png" alt="No Primary ID">';
						}
					?>
				</div>
					
				<div class="accounts-id" id="primaryID2<?php echo htmlspecialchars($userData['id']);?>">
				<div class="accounts-title">Primary ID2<i class='bx bxs-message-square-x' onclick="hidePrimaryID2(<?php echo htmlspecialchars($userData['id']);?>)"></i></div>
					<?php
						if (!empty($userData['primaryid2'])) {
							$profilePicturePath = './/' . htmlspecialchars($userData['primaryid2']);
							echo '<img src="' . $profilePicturePath . '" alt="Primary ID2">';
						} else {
							echo '<img src="pictures/logo.png" alt="No Primary ID2">';
						}
					?>
				</div>
						
				<?php
					}
				}
				?>
						