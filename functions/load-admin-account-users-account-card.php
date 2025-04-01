<?php
include '../php/admin-session.php';
include '../php/admin-account-user-functions.php';

	$searchUsers = isset($_GET['searchUsers']) ? $_GET['searchUsers'] : '';
	$usersData = getUsers($searchUsers);
						
		$hasPendingOrVerifying = false;
					
		if (empty($usersData)) {
			echo '<p class="empty-users" id="loading"><span class="animated-dots">No Users Account<span class="dots"></span></span></p>';
		} else {

			foreach ($usersData as $userData) {
				$id = $userData['id'];
									
		if ($userData['usertype'] == 'Pending' || $userData['usertype'] == 'Verifying') {
			$hasPendingOrVerifying = true;
		?>
						
			<div class="card swiper-slide">
						
				<div class="image-content">
					<span class="overlay"></span>
								
						<div class="card-image">
							<div class="card-img">
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

						<div class="fullname">
							<?php echo htmlspecialchars($userData['firstname']); ?> <?php echo htmlspecialchars($userData['middlename']); ?> <?php echo htmlspecialchars($userData['lastname']); ?>
						</div>
				</div>
							
					<div class="card-content">
							
						<div class="details">
							<label> Created at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($userData['created_at']))); ?> </label>
						</div>
						
									
						<div class="details">
							<label>Username </label><input type="text" placeholder="<?php echo htmlspecialchars($userData['username']); ?>" disabled>
						</div>
						
						<div class="details">
							<label>Mobile No. </label><input type="text" placeholder="<?php echo htmlspecialchars($userData['mobile']); ?>" disabled>
						</div>
								
						<div class="details">
							<label>Account Status </label><input type="text" placeholder="<?php echo htmlspecialchars($userData['usertype']); ?>" disabled>
						</div>
								
						<div class="details">
							<label>User Level </label><input type="text" placeholder="<?php echo htmlspecialchars($userData['userlevel']); ?>" disabled>
						</div>
						
								
						<div class="card-view">
							<button class="view" onclick="showAccountsCard(<?php echo htmlspecialchars($userData['id']); ?>)">View</button>
						</div>
							
					</div>
						
			</div>
						
		<?php
			}
		}
			if (!$hasPendingOrVerifying) {
				echo '<p class="empty-users" id="loading"><span class="animated-dots">No Users Account<span class="dots"></span></span></p>';
			}
		}
		?>
					
