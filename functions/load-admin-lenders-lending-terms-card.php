<?php
include '../php/admin-session.php';
include '../php/admin-lenders-lending-terms-functions.php';

	$searchLendingTerms = isset($_GET['searchLendingTerms']) ? $_GET['searchLendingTerms'] : '';
	$lending = getLendingTerms($connection, $adminId, $searchLendingTerms = '');
											
	$hasLending = false;
									
	if (empty($lending)) {
		echo '<p class="empty" id="loading"><span class="animated-dots">Lend Manager is currently empty<span class="dots"></span></span></p>';
	} else {

		foreach ($lending as $lending) {
		$lendingTermsId = $lending['id'];

		$hasLending = true;
	?>
						
	<div class="card swiper-slide">
						
		<div class="profile-pic">	
			<div class="image-content">
				<span class="overlay"></span>
										
				<div class="card-image">
					<div class="card-img">
					<?php
						if (!empty($lending['picture'])) {
							$profilePicturePath = './/' . htmlspecialchars($lending['picture']);
							echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
						} else {
							echo '<img src="pictures/logo.png" alt="No Profile Picture">';
						}
					?>
					</div>
				</div>
				
				<div class="lendername">
					<?php echo htmlspecialchars($lending['lendername']); ?>
				</div>
			</div>
								
			<div class="lend-date">
				<label> <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($lending['created_at']))); ?> </label>
			</div>
		</div>
							
							
		<div class="card-details">
			<div class="card-content">
									
				<div class="details">
					<label>Amount : </label><input type="text" placeholder="<?php echo htmlspecialchars($lending['amount']); ?>" disabled>
				</div>
									
				<div class="details">
					<label>Interest Rate :</label><input type="text" placeholder="<?php echo htmlspecialchars($lending['interest']); ?>" disabled>
				</div>
									
				<div class="details">
					<label>Payment Term : </label><input type="text" placeholder="<?php echo htmlspecialchars($lending['term']); ?>" disabled>
				</div>
									
				<div class="details">
					<label>Collateral : </label><input type="text" placeholder="<?php echo htmlspecialchars($lending['collateral']); ?>" disabled>
				</div>
									
				<div class="details">
					<label>Monthly Interest : </label><input type="text" placeholder="<?php echo htmlspecialchars($lending['monthly']); ?>" disabled>
				</div>	
								
			</div>
		</div>
							
			<div class="applicants">
				<div class="applicants-form">
				<h2>Borrower Applications</h2>

				<div class="applicants-content" id="applicants-content<?php echo htmlspecialchars($lending['id']); ?>">
										
				<?php
					$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
					$applications = getApplications($connection, $lendingTermsId, $searchApplications = '');
																	
					if (empty($applications)) {
						echo '<p class="empty" id="loading"><span class="animated-dots">Applications is currently empty<span class="dots"></span></span></p>';
					} else {
						foreach ($applications as $application) {
						$lendingTermsId = $application['lending_terms_id'];
												
					if ($application['status'] == 'Pending') {
				?>

					<div class="application-history">
						<div class="pending"></div>
						<span><i class='bx bxs-alarm-exclamation'></i></span>				
						<input type="hidden" placeholder="" disabled>						
						<input type="hidden" placeholder="" disabled>						
							<p><?php echo htmlspecialchars($application['borrowername']); ?> has <?php echo htmlspecialchars($application['status']); ?> application.<br>Applied at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>	
						<div class="view-button">
							<div class="view" onclick="showApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
													
					</div>
												
				<?php
					} elseif ($application['status'] == 'Approved') {
				?>

					<div class="application-history">
						<div class="approved"></div>
						<span><i class='bx bxs-check-circle'></i></span>			
						<input type="hidden" placeholder="" disabled>						
						<input type="hidden" placeholder="" disabled>						
							<p>You <?php echo htmlspecialchars($application['status']); ?> <?php echo htmlspecialchars($application['borrowername']); ?>'s application.<br><?php echo htmlspecialchars($application['status']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>			
						<div class="view-button">
							<div class="view" onclick="showApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
													
					</div>
												
				<?php
					} elseif ($application['status'] == 'Rejected') {
				?>

					<div class="application-history">
						<div class="rejected"></div>
						<span><i class='bx bxs-x-circle'></i></span>			
						<input type="hidden" placeholder="" disabled>						
						<input type="hidden" placeholder="" disabled>						
							<p>You <?php echo htmlspecialchars($application['status']); ?> <?php echo htmlspecialchars($application['borrowername']); ?>'s application.<br><?php echo htmlspecialchars($application['status']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>				
						<div class="view-button">
							<div class="view" onclick="showApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
													
					</div>
												
				<?php
					} elseif ($application['status'] == 'Cancelled') {
				?>

					<div class="application-history">
						<div class="rejected"></div>
						<span><i class='bx bxs-x-circle'></i></span>			
						<input type="hidden" placeholder="" disabled>						
						<input type="hidden" placeholder="" disabled>						
							<p><?php echo htmlspecialchars($application['borrowername']); ?>'s application was <?php echo htmlspecialchars($application['status']); ?>.<br><?php echo htmlspecialchars($application['status']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>				
						<div class="view-button">
							<div class="view" onclick="showApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
													
					</div>
												
				<?php
					} elseif ($application['status'] == 'Funded') {
				?>

					<div class="application-history">
						<div class="funded"></div>
						<span class="funded-application"><i class='bx bxs-check-circle'></i></span>			
						<input type="hidden" placeholder="" disabled>						
						<input type="hidden" placeholder="" disabled>						
							<p>You <?php echo htmlspecialchars($application['status']); ?> <?php echo htmlspecialchars($application['borrowername']); ?>'s application.<br><?php echo htmlspecialchars($application['status']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>	
						<div class="view-button">
							<div class="view" onclick="showApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
													
					</div>
												
				<?php
					} elseif ($application['status'] == 'Paid') {
				?>

					<div class="application-history">
						<div class="funded"></div>
						<span class="funded-application"><i class='bx bxs-check-circle'></i></span>						
						<input type="hidden" placeholder="" disabled>						
						<input type="hidden" placeholder="" disabled>						
							<p><?php echo htmlspecialchars($application['borrowername']); ?> has a <?php echo htmlspecialchars($application['status']); ?> application.<br><?php echo htmlspecialchars($application['status']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>				
						<div class="view-button">
							<div class="view" onclick="showApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
													
					</div>
												
				<?php
						}
					}
				}
				?>
										
				</div>
								
				</div>
			</div>
									
		</div>
						
				<?php
					}
				if (!$hasLending) {
					echo '<p class="empty-users" id="loading"><span class="animated-dots">Lend Manager is empty<span class="dots"></span></span></p>';
					}
				}
				?>