<?php
include '../php/user-session.php';
include '../php/borrowers-lending-terms-functions.php';

function encodeId($data, $secret_key) {
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $secret_key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

	$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
	$applications = getApplications($connection, $userId, $searchApplications = '');

		foreach ($applications as $application) {
		$applicationsId = $application['id'];
		$userId = $application['users_id'];
		$lendingTermsId = $application['lending_terms_id'];
		$borrowername = $application['borrowername'];

		$encodedApplicationId = encodeId($applicationsId, $secret_key);
		$encodedLendingTermsId = encodeId($lendingTermsId, $secret_key);
		$encodedApplicationUsersId = encodeId($userId, $secret_key);

	$searchLendingTermsApplications = isset($_GET['searchLendingTermsApplications']) ? $_GET['searchLendingTermsApplications'] : '';
	$lendingTermsApplications = getLendingTermsByApplications($connection, $lendingTermsId, $searchLendingTermsApplications = '');
						

		foreach ($lendingTermsApplications as $lending) {
		$lendingTermsId = $lending['id'];

		?>
						
		<div class="lending-card" id="lendingTermsApplicationsCard<?php echo htmlspecialchars($application['id']); ?>">
			<form action="php/borrowers-borrow" method="POST">	
				<div class="lending-image-content">
					<span class="lending-overlay"></span>
								
						<div class="lending-card-image">
							<div class="lending-card-img">
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

						<div class="lending-lendername">
							<?php echo htmlspecialchars($lending['lendername']); ?>
						</div>
				</div>
							
					<div class="lending-card-content">
					
						<input type="hidden" name="application_id" value="<?php echo htmlspecialchars($encodedApplicationId); ?>" readonly>
								
						<input type="hidden" name="lending_terms_id" value="<?php echo htmlspecialchars($encodedLendingTermsId); ?>" readonly>
								
						<input type="hidden" name="users_id" value="<?php echo htmlspecialchars($encodedApplicationUsersId); ?>" readonly>
							
						<div class="lending-details">
							<label>Amount : </label><input type="text" placeholder="<?php echo htmlspecialchars($lending['amount']); ?>" readonly>
						</div>
									
						<div class="lending-details">
							<label>Interest Rate :</label><input type="text" placeholder="<?php echo htmlspecialchars($lending['interest']); ?>" readonly>
						</div>
									
						<div class="lending-details">
							<label>Payment Term : </label><input type="text" placeholder="<?php echo htmlspecialchars($lending['term']); ?>" readonly>
						</div>
									
						<div class="lending-details">
							<label>Collateral : </label><input type="text" placeholder="<?php echo htmlspecialchars($lending['collateral']); ?>" readonly>
						</div>
									
						<div class="lending-details">
							<label>Monthly Interest : </label><input type="text" placeholder="<?php echo htmlspecialchars($lending['monthly']); ?>" readonly>
						</div>	
						
							
					</div>
					
					<?php
							if ($application['status'] === 'Pending') {
						?>
						<div class="lending-card-button">
							<div class="close" onclick="hideLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="cancel" onclick="showCancel(<?php echo htmlspecialchars($application['id']); ?>)">Cancel</div>
							<div class="view" onclick="showCredit(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						<?php 
							} elseif ($application['status'] === 'Rejected') {
						?>
						<div class="lending-card-button2">
							<div class="close" onclick="hideLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="view" onclick="showCredit(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						<?php
							} elseif ($application['status'] === 'Cancelled') {
						?>
						<div class="lending-card-button2">
							<div class="close" onclick="hideLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="view" onclick="showCredit(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						<?php
							} elseif ($application['status'] === 'Approved') {
						?>
						<div class="lending-card-button2">
							<div class="close" onclick="hideLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="view" onclick="showCredit(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						
						<?php
							} elseif ($application['status'] === 'Funded') {
						?>
						<div class="lending-card-button2">
							<div class="close" onclick="hideLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="view" onclick="showCredit(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						<?php
							}  elseif ($application['status'] === 'Paid') {
						?>
						<div class="lending-card-button2">
							<div class="close" onclick="hideLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="view" onclick="showCredit(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						<?php
							}
						?>
				
				<div class="lendingapplicationcardoverlay" id="lendingApplicationCardBg<?php echo htmlspecialchars($application['id']); ?>"></div>
				
				<div class="confirmation-card" id="approveCard<?php echo htmlspecialchars($application['id']); ?>">
					<h2>Application Cancellation</h2>
									
					<h3>Are you sure you want to cancel this application?</h3>

					<div class="confirmation-card-buttons">
						<div class="close" onclick="hideCancel(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
						<button type="submit" name="cancel" class="confirm">Cancel</button>
					</div>
				</div>
				
			</form>
		</div>

			
			<div class="lending-application-card" id="lendingApplicationCard<?php echo htmlspecialchars($application['id']); ?>">

						<div class="lending-application-card-image-content">
							<span class="lending-application-card-overlay"></span>
								
								<div class="lending-application-card-image">
									<div class="lending-application-card-img">
											<?php
											if (!empty($application['picture'])) {
												$profilePicturePath = './/' . htmlspecialchars($application['picture']);
												echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
											} else {
												echo '<img src="pictures/logo.png" alt="No Profile Picture">';
											}
										?>
									</div>
								</div>
								<div class="lending-borrowername">
									<?php echo htmlspecialchars($application['borrowername']); ?>
								</div>
						</div>
						
							
							
							<div class="lending-application-card-content">

								<div class="lending-application-card-details">
								
									<label> <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['created_at']))); ?> </label>
								</div>
									
								<div class="lending-application-card-details">
									<label>Mobile No: </label><input type="text" placeholder="Mobile No." value="<?php echo htmlspecialchars($application['mobile']); ?>" readonly>
								</div>
								
								<div class="lending-application-card-details">
									<label>Collateral : </label>
								</div>
								<div class="lending-collateral" onclick="showCollateral(<?php echo htmlspecialchars($application['id']);?>)">
								<?php
									if (!empty($application['collateral'])) {
									$collateralPath = './/' . htmlspecialchars($application['collateral']);
										echo '<img src="' . $collateralPath . '" alt="Collateral">';
									} else {
										echo '<img src="pictures/logo.png" alt="No Collateral">';
									}
								?>
								</div>
								
							</div>
							
							<div class="overlaylendingcollateral" id="overlayLendingCollateral<?php echo htmlspecialchars($application['id']); ?>"></div>
			
							<div class="lending-collateral-picture" id="lendingCollateralPicture<?php echo htmlspecialchars($application['id']);?>">
								<div class="lending-collateral-picture-title">Collateral<i class='bx bxs-message-square-x' onclick="hideCollateral(<?php echo htmlspecialchars($application['id']);?>)"></i></div>
									<?php
										if (!empty($application['collateral'])) {
										$collateralPath = './/' . htmlspecialchars($application['collateral']);
											echo '<img src="' . $collateralPath . '" alt="Collateral">';
										} else {
											echo '<img src="pictures/logo.png" alt="No Collateral">';
										}
									?>
							</div>
							
							<div class="lending-credit-history">
							<div class="lending-credit-history-form">
								<h2>My Credit History</h2>

								<div class="lending-credit-history-content" id="lending-credit-history-content<?php echo htmlspecialchars($financial['id']); ?><?php echo htmlspecialchars($application['id']); ?>">
									<?php
									$searchFinancialDetails = isset($_GET['searchFinancialDetails']) ? $_GET['searchFinancialDetails'] : '';
									$financials = getFinancialDetails($connection, $borrowername, $searchFinancialDetails = '');
														
										$hasFinancial = false;
													
										if (empty($financials)) {
											echo '<p class="empty" id="loading"><span class="animated-dots">My Credit History is currently empty<span class="dots"></span></span></p>';
										} else {

											foreach ($financials as $financial) {
											$financialId = $financial['id'];
											$borrowername = $financial['borrowername'];

											$hasFinancial = true;
											
											if ($financial['borrowername'] === $application['borrowername']) {
										?>
										
										<div class="financial-history">
											
											<div class="updatedatoverlay" id="updatedAtBg<?php echo htmlspecialchars($financial['id']); ?><?php echo htmlspecialchars($application['id']); ?>"></div>
											
											<i class='bx bx-question-mark' onclick="showUpdatedAt(<?php echo htmlspecialchars($financial['id']); ?><?php echo htmlspecialchars($application['id']); ?>)"></i>
											
											<i class='bx bxs-x-circle' id="hideUpdatedAt<?php echo htmlspecialchars($financial['id']); ?><?php echo htmlspecialchars($application['id']); ?>" onclick="hideUpdatedAt(<?php echo htmlspecialchars($financial['id']); ?><?php echo htmlspecialchars($application['id']); ?>)"></i>
											
											<div class="updated-at" id="updatedAt<?php echo htmlspecialchars($financial['id']); ?><?php echo htmlspecialchars($application['id']); ?>"><p>Latest Payment made on <?php echo htmlspecialchars(date("F d, Y", strtotime($financial['updated_at']))); ?></p></div>
											
											<div class="financial-amount"><p>₱<?php echo htmlspecialchars($financial['amount']); ?></p></div>
											
											<div class="financial-term"><p><?php echo htmlspecialchars($financial['term']); ?></p></div>
											
											<?php 
												if ($financial['status'] === 'UnPaid'){
											?>
											<div class="status-unpaid">
												<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($financial['status']); ?></p>
											</div>
											<?php 
												} elseif ($financial['status'] === 'Paid'){
											?>
											
											<div class="status-paid">
												<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($financial['status']); ?></p>
											</div>
											<?php 
												}
											?>
										</div>
										
										<?php
											}
										}
											if (!$hasFinancial) {
												echo '<p class="empty" id="loading"><span class="animated-dots">Loading My Credit History<span class="dots"></span></span></p>';
											}
										}
										?>
										
								</div>
								
							</div>
						</div>
						
						<?php
							if ($application['status'] === 'Pending') {
						?>
						<div class="lending-card-button">
							<div class="close" onclick="hideCredit(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
						</div>
						<?php 
							} elseif ($application['status'] === 'Rejected') {
						?>
						<div class="lending-card-button2">
							<div class="close" onclick="hideCredit(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
						</div>
						<?php
							} elseif ($application['status'] === 'Cancelled') {
						?>
						<div class="lending-card-button2">
							<div class="close" onclick="hideCredit(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
						</div>
						<?php
							} elseif ($application['status'] === 'Approved') {
						?>
						<div class="lending-card-button2">
							<div class="close" onclick="hideCredit(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="view" onclick="showAgreementCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						
						<?php
							} elseif ($application['status'] === 'Funded') {
						?>
						<div class="lending-card-button2">
							<div class="close" onclick="hideCredit(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="view" onclick="showAgreementCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						<?php
							}  elseif ($application['status'] === 'Paid') {
						?>
						<div class="lending-card-button2">
							<div class="close" onclick="hideCredit(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="view" onclick="showAgreementCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						<?php
							}
						?>
						
					</div>
					
			<?php
			$searchAgreements = isset($_GET['searchAgreements']) ? $_GET['searchAgreements'] : '';
			$agreements = getAgreementsByApplications($connection, $lendingTermsId, $applicationsId, $searchAgreements = '');

				foreach ($agreements as $agreement) {
				$agreementsId = $agreement['id'];
				$applicationsId = $agreement['applications_id'];
				$lendingTermsId = $agreement['lending_terms_id'];
												
			?>
		
			<div class="overlayagreement" id="overlayAgreement<?php echo htmlspecialchars($application['id']); ?>"></div>

			<div class="agreement-card" id="agreementCard<?php echo htmlspecialchars($application['id']); ?>">
				<?php
					if ($application['status'] === 'Approved') {
				?>
					<h2>Lending Agreement</h2>
				<?php 
					} elseif ($application['status'] === 'Funded') {
				?>
					<h2>Lending Agreement</h2>	
				<?php
					} elseif ($application['status'] === 'Paid') {
				?>
					<h2>Closure Agreement</h2>
				<?php 
					}
				?>
					
					<div class="agreement">
					
					<?php
						if ($application['status'] === 'Approved') {
					?>
					<p>This Lending Agreement is effective as of <span class="blue-text"><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($agreement['updated_at']))); ?></span>. This will serve as a proof that I, <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span> will be lending an amount of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['amount']); ?></span> to <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> with <span class="blue-text"><?php echo htmlspecialchars($agreement['interest']); ?> Interest</span>, and a monthly interest rate of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['monthly']); ?></span> which to be paid within <span class="blue-text"><?php echo htmlspecialchars($agreement['term']); ?></span>. In the event that <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> fails to pay or default his/her financial obligations, then the agreed collateral's possession will be transferred to <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span>.</p>
					<?php 
						} elseif ($application['status'] === 'Funded') {
					?>
					<p>This Lending Agreement is effective as of <span class="blue-text"><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($agreement['updated_at']))); ?></span>. This serves as a proof that I, <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> was borrowing an amount of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['amount']); ?></span> from <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span> with <span class="blue-text"><?php echo htmlspecialchars($agreement['interest']); ?> Interest</span>, and a monthly interest rate of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['monthly']); ?></span> which to be paid within <span class="blue-text"><?php echo htmlspecialchars($agreement['term']); ?></span>. In the event that I, <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> fails to pay or default my financial obligations, then the agreed collateral's possession will be transferred to <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span>.</p>
					<?php
						} elseif ($application['status'] === 'Paid') {
					?>
					<p>This Closure Agreement is effective as of <span class="blue-text"><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($agreement['updated_at']))); ?></span>. This serves as a proof that the amount of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['amount']); ?></span> borrowed by <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> from <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span> with <span class="blue-text"><?php echo htmlspecialchars($agreement['interest']); ?> Interest</span>, and a monthly interest rate of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['monthly']); ?></span> has been <span class="blue-text"><?php echo htmlspecialchars($application['status']); ?></span> within the span of <span class="blue-text"><?php echo htmlspecialchars($agreement['term']); ?></span>.</p>
					<?php 
						}
					?>
					</div>
					
					<div class="fund-card-buttons">
						<div class="close" onclick="hideAgreementCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
					</div>
					
			</div>
			
			<?php
				}
			?>	
						
		<?php
			}
		?>
					
	<?php
		}
	?>