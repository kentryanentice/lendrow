<?php
include '../php/admin-session.php';
include '../php/admin-borrowers-lending-terms-functions.php';

	$searchLendingTerms = isset($_GET['searchLendingTerms']) ? $_GET['searchLendingTerms'] : '';
	$lender = getLendingTerms($connection, $searchLendingTerms = '');
						
		$hasLender = false;
					
		if (empty($lender)) {
			echo '<p class="empty" id="loading"><span class="animated-dots">Lending terms is currently empty<span class="dots"></span></span></p>';
		} else {

			foreach ($lender as $lender) {
			$id = $lender['id'];

			$hasLender = true;
		?>
						
			<div class="card swiper-slide">
						
				<div class="image-content">
					<span class="overlay"></span>
								
						<div class="card-image">
							<div class="card-img">
								<?php
									if (!empty($lender['picture'])) {
										$profilePicturePath = './/' . htmlspecialchars($lender['picture']);
											echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
									} else {
										echo '<img src="pictures/logo.png" alt="No Profile Picture">';
									}
								?>
							</div>
						</div>

						<div class="lendername">
							<?php echo htmlspecialchars($lender['lendername']); ?>
						</div>
				</div>
							
					<div class="card-content">
					
						<div class="details">
							<label><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($lender['created_at']))); ?> </label>
						</div>
							
						<div class="details">
							<label>Amount : </label><input type="text" placeholder="<?php echo htmlspecialchars($lender['amount']); ?>" readonly>
						</div>
									
						<div class="details">
							<label>Interest Rate :</label><input type="text" placeholder="<?php echo htmlspecialchars($lender['interest']); ?>" readonly>
						</div>
									
						<div class="details">
							<label>Payment Term : </label><input type="text" placeholder="<?php echo htmlspecialchars($lender['term']); ?>" readonly>
						</div>
									
						<div class="details">
							<label>Collateral : </label><input type="text" placeholder="<?php echo htmlspecialchars($lender['collateral']); ?>" readonly>
						</div>
									
						<div class="details">
							<label>Monthly Interest : </label><input type="text" placeholder="<?php echo htmlspecialchars($lender['monthly']); ?>" readonly>
						</div>	
						
						<?php 
						if ($lender['status'] === 'Open') { 
						?>
						<div class="card-button">
							<div class="apply" onclick="showApplyCard(<?php echo htmlspecialchars($lender['id']); ?>)">Apply</div>
						</div>
						<?php 
							}
						?>
						
						<?php 
						if ($lender['status'] === 'Closed') { 
						?>
						<div class="card-button">
							<div class="close">Closed</div>
						</div>
						<?php 
						} 
						?>
							
					</div>
						
			</div>
						
		<?php
		}
			if (!$hasLender) {
				echo '<p class="empty" id="loading"><span class="animated-dots">Loading Lending terms<span class="dots"></span></span></p>';
			}
		}
		?>
					
