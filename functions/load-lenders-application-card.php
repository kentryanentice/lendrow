<?php
include '../php/user-session.php';
include '../php/lenders-lending-terms-functions.php';

function encodeId($data, $secret_key) {
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $secret_key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

	$searchLendingTerms = isset($_GET['searchLendingTerms']) ? $_GET['searchLendingTerms'] : '';
	$lending = getLendingTerms($connection, $userId, $searchLendingTerms = '');

		foreach ($lending as $lending) {
		$userId = $lending['users_id'];
		$lendingTermsId = $lending['id'];
		$picture = $lending['picture'];
		$lendername = $lending['lendername'];
		$amount = $lending['amount'];
		$interest = $lending['interest'];
		$collateral = $lending['collateral'];
		$term = $lending['term'];
		$monthly = $lending['monthly'];
		
		$encodedLendingTermsUsersId = encodeId($userId, $secret_key);
		$encodedLendingTermsId = encodeId($lendingTermsId, $secret_key);
		$encodedPicture = encodeId($picture, $secret_key);
		$encodedLenderName = encodeId($lendername, $secret_key);
		$encodedAmount = encodeId($amount, $secret_key);
		$encodedInterest = encodeId($interest, $secret_key);
		$encodedCollateral = encodeId($collateral, $secret_key);
		$encodedTerm = encodeId($term, $secret_key);
		$encodedMonthly= encodeId($monthly, $secret_key);
	
	?>
	
	<?php
	$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
	$applications = getApplications($connection, $lendingTermsId, $searchApplications = '');

		foreach ($applications as $application) {
		$applicationsId = $application['id'];
		$lendingTermsId = $application['lending_terms_id'];
		$applicationsUsersId = $application['users_id'];
		$borrowername = $application['borrowername'];
		$mobile = $application['mobile'];
		
		$encodedApplicationId = encodeId($applicationsId, $secret_key);
		$encodedApplicationUsersId = encodeId($applicationsUsersId, $secret_key);
		$encodedBorrowerName = encodeId($borrowername, $secret_key);
		$encodedMobile = encodeId($mobile, $secret_key);								
	?>
	
		<div class="application-card" id="applicationCard<?php echo htmlspecialchars($application['id']); ?>">
		<form action="php/lenders-application-approval" method="POST">
		
						<div class="application-card-image-content">
							<span class="application-card-overlay"></span>
								
								<div class="application-card-image">
									<div class="application-card-img">
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
								<div class="borrowername">
									<?php echo htmlspecialchars($application['borrowername']); ?>
								</div>
						</div>
						
							
							
							<div class="application-card-content">

								<div class="application-card-details">
								
								<input type="hidden" name="lending_terms_users_id" value="<?php echo htmlspecialchars($encodedLendingTermsUsersId); ?>" readonly>
								
								<input type="hidden" name="lendername" value="<?php echo htmlspecialchars($encodedLenderName); ?>" readonly>
								
								<input type="hidden" name="borrowername" value="<?php echo htmlspecialchars($encodedBorrowerName); ?>" readonly>
								
								<input type="hidden" name="mobile" value="<?php echo htmlspecialchars($encodedMobile); ?>" readonly>
								
								<input type="hidden" name="amount" value="<?php echo htmlspecialchars($encodedAmount); ?>" readonly>
								
								<input type="hidden" name="interest" value="<?php echo htmlspecialchars($encodedInterest); ?>" readonly>
								
								<input type="hidden" name="term" value="<?php echo htmlspecialchars($encodedTerm); ?>" readonly>
								
								<input type="hidden" name="monthly" value="<?php echo htmlspecialchars($encodedMonthly); ?>" readonly>
								
								<input type="hidden" name="collateral" value="<?php echo htmlspecialchars($encodedCollateral); ?>" readonly>
								
								<input type="hidden" name="applications_id" value="<?php echo htmlspecialchars($encodedApplicationId); ?>" readonly>
								
								<input type="hidden" name="lending_terms_id" value="<?php echo htmlspecialchars($encodedLendingTermsId); ?>" readonly>
								
								<input type="hidden" name="users_id" value="<?php echo htmlspecialchars($encodedApplicationUsersId); ?>" readonly>
								
									<label> <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['created_at']))); ?> </label>
								</div>
									
								<div class="application-card-details">
									<label>Mobile No: </label><input type="text" placeholder="Mobile No." value="<?php echo htmlspecialchars($application['mobile']); ?>" readonly>
								</div>
								
								<div class="application-card-details">
									<label>Collateral : </label>
								</div>
								<div class="collateral" onclick="showCollateral(<?php echo htmlspecialchars($application['id']);?>)">
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
							
							<div class="overlaycollateral" id="overlayCollateral<?php echo htmlspecialchars($application['id']); ?>"></div>
			
							<div class="collateral-picture" id="collateralPicture<?php echo htmlspecialchars($application['id']);?>">
								<div class="collateral-picture-title">Collateral<i class='bx bxs-message-square-x' onclick="hideCollateral(<?php echo htmlspecialchars($application['id']);?>)"></i></div>
									<?php
										if (!empty($application['collateral'])) {
										$collateralPath = './/' . htmlspecialchars($application['collateral']);
											echo '<img src="' . $collateralPath . '" alt="Collateral">';
										} else {
											echo '<img src="pictures/logo.png" alt="No Collateral">';
										}
									?>
							</div>
							
							<div class="credit-history">
							<div class="credit-history-form">
								<h2>Credit History</h2>

								<div class="credit-history-content" id="credit-history-content<?php echo htmlspecialchars($application['id']); ?>">
									<?php
									$searchFinancialDetails = isset($_GET['searchFinancialDetails']) ? $_GET['searchFinancialDetails'] : '';
									$financials = getFinancialDetails($connection, $borrowername, $searchFinancialDetails = '');
														
										$hasFinancial = false;
													
										if (empty($financials)) {
											echo '<p class="empty" id="loading"><span class="animated-dots">Credit History is currently empty<span class="dots"></span></span></p>';
										} else {

											foreach ($financials as $financial) {
											
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
												echo '<p class="empty" id="loading"><span class="animated-dots">Loading Credit History<span class="dots"></span></span></p>';
											}
										}
										?>
										
								</div>
								
							</div>
						</div>
		
						<?php
							if ($application['status'] === 'Pending') {
						?>
						<div class="application-card-button">
							<div class="close" onclick="hideApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="reject" onclick="showRejectCard(<?php echo htmlspecialchars($application['id']); ?>)">Reject</div>
							<div class="approve" onclick="showApproveCard(<?php echo htmlspecialchars($application['id']); ?>)">Approve</div>
						</div>
						<?php 
							} elseif ($application['status'] === 'Rejected') {
						?>
						<div class="application-card-button">
							<div class="close" onclick="hideApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
						</div>
						<?php
							} elseif ($application['status'] === 'Cancelled') {
						?>
						<div class="application-card-button">
							<div class="close" onclick="hideApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
						</div>
						<?php
							} elseif ($application['status'] === 'Approved') {
						?>
						<div class="application-card-button2">
							<div class="close" onclick="hideApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div class="approve" onclick="showAgreementCard(<?php echo htmlspecialchars($application['id']); ?>)">Fund</div>
						</div>
						
						<?php
							} elseif ($application['status'] === 'Funded') {
						?>
						<div class="application-card-button2">
							<div class="close" onclick="hideApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div name="approve" class="approve" onclick="showAgreementCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						<?php
							}  elseif ($application['status'] === 'Paid') {
						?>
						<div class="application-card-button2">
							<div class="close" onclick="hideApplicationCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<div name="approve" class="approve" onclick="showAgreementCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
						<?php
							}
						?>
					
					<div class="confirmation-card" id="rejectCard<?php echo htmlspecialchars($application['id']); ?>">
						<h2>Application Confirmation</h2>
									
							<h3>Are you sure you want to reject this application?</h3>

						<div class="confirmation-card-buttons">
							<div class="close" onclick="hideRejectCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<button type="submit" name="reject" class="confirm">Reject</button>
						</div>
					</div>
					
					<div class="confirmation-card" id="approveCard<?php echo htmlspecialchars($application['id']); ?>">
						<h2>Application Confirmation</h2>
									
							<h3>Are you sure you want to approve this application?</h3>

						<div class="confirmation-card-buttons">
							<div class="close" onclick="hideApproveCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
							<button type="submit" name="approve" class="confirm">Approve</button>
						</div>
					</div>
		
			<?php
			$searchAgreements = isset($_GET['searchAgreements']) ? $_GET['searchAgreements'] : '';
			$agreements = getAgreements($connection, $lendingTermsId, $applicationsId, $searchAgreements = '');

				foreach ($agreements as $agreement) {
				$agreementsId = $agreement['id'];
				$applicationsId = $agreement['applications_id'];
				$lendingTermsId = $agreement['lending_terms_id'];
				
				$encodedAgreementsId = encodeId($agreementsId, $secret_key);
												
			?>
		
			<div class="overlayagreement" id="overlayAgreement<?php echo htmlspecialchars($application['id']); ?>"></div>

			<div class="agreement-card" id="agreementCard<?php echo htmlspecialchars($application['id']); ?>">
            <i onclick="showPrint(<?php echo htmlspecialchars($application['id']); ?>)" class='bx bx-printer'></i>
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
					
					<input type="hidden" name="picture" value="<?php echo htmlspecialchars($encodedPicture); ?>" readonly>
					
					<input type="hidden" name="lendername" value="<?php echo htmlspecialchars($encodedLenderName); ?>" readonly>
								
					<input type="hidden" name="borrowername" value="<?php echo htmlspecialchars($encodedBorrowerName); ?>" readonly>
								
					<input type="hidden" name="mobile" value="<?php echo htmlspecialchars($encodedMobile); ?>" readonly>
								
					<input type="hidden" name="amount" value="<?php echo htmlspecialchars($encodedAmount); ?>" readonly>
								
					<input type="hidden" name="interest" value="<?php echo htmlspecialchars($encodedInterest); ?>" readonly>
								
					<input type="hidden" name="term" value="<?php echo htmlspecialchars($encodedTerm); ?>" readonly>
								
					<input type="hidden" name="monthly" value="<?php echo htmlspecialchars($encodedMonthly); ?>" readonly>
								
					<input type="hidden" name="collateral" value="<?php echo htmlspecialchars($encodedCollateral); ?>" readonly>
								
					<input type="hidden" name="application_id" value="<?php echo htmlspecialchars($encodedApplicationId); ?>" readonly>
								
					<input type="hidden" name="lending_terms_id" value="<?php echo htmlspecialchars($encodedLendingTermsId); ?>" readonly>
								
					<input type="hidden" name="users_id" value="<?php echo htmlspecialchars($encodedApplicationUsersId); ?>" readonly>
					
					<input type="hidden" name="agreements_id" value="<?php echo htmlspecialchars($encodedAgreementsId); ?>" readonly>
					
					<?php
						if ($application['status'] === 'Approved') {
					?>
					<p>This Lending Agreement is effective as of <span class="blue-text"><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($agreement['created_at']))); ?></span>. This will serve as a proof that I, <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span> will be lending an amount of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['amount']); ?></span> to <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> with <span class="blue-text"><?php echo htmlspecialchars($agreement['interest']); ?> Interest</span>, and a monthly interest rate of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['monthly']); ?></span> which to be paid within <span class="blue-text"><?php echo htmlspecialchars($agreement['term']); ?></span>. In the event that <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> fails to pay or default his/her financial obligations, then the agreed collateral's possession will be transferred to <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span>.</p>
					<?php 
						} elseif ($application['status'] === 'Funded') {
					?>
					<p>This Lending Agreement is effective as of <span class="blue-text"><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($agreement['created_at']))); ?></span>. This serves as a proof that I, <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span> was lending an amount of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['amount']); ?></span> to <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> with <span class="blue-text"><?php echo htmlspecialchars($agreement['interest']); ?> Interest</span>, and a monthly interest rate of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['monthly']); ?></span> which to be paid within <span class="blue-text"><?php echo htmlspecialchars($agreement['term']); ?></span>. In the event that <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> fails to pay or default his/her financial obligations, then the agreed collateral's possession will be transferred to <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span>.</p>
					<?php
						} elseif ($application['status'] === 'Paid') {
					?>
					<p>This Closure Agreement is effective as of <span class="blue-text"><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($agreement['created_at']))); ?></span>. This serves as a proof that the amount of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['amount']); ?></span> borrowed by <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> from <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span> with <span class="blue-text"><?php echo htmlspecialchars($agreement['interest']); ?> Interest</span>, and a monthly interest rate of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['monthly']); ?></span> has been <span class="blue-text"><?php echo htmlspecialchars($application['status']); ?></span> within the span of <span class="blue-text"><?php echo htmlspecialchars($agreement['term']); ?></span>.</p>
					<?php 
						}
					?>
					</div>
					
					<div class="fund-card-buttons">
					<?php
						if ($application['status'] === 'Approved') {
					?>
						<div class="close" onclick="hideAgreementCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
						<div class="fund" onclick="showConfirmation(<?php echo htmlspecialchars($agreement['id']); ?>)">Fund</div>
					<?php 
						} elseif ($application['status'] === 'Funded') {
					?>
						<div class="close" onclick="hideAgreementCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
					<?php
						} elseif ($application['status'] === 'Paid') {
					?>
						<div class="close" onclick="hideAgreementCard(<?php echo htmlspecialchars($application['id']); ?>)">Close</div>
					<?php 
						}
					?>
					</div>
					
					<div class="overlayconfirmation" id="overlayConfirmation<?php echo htmlspecialchars($agreement['id']); ?>"></div>
					
					<div class="fund-card" id="fundCard<?php echo htmlspecialchars($agreement['id']); ?>">
						<h2>Disbursement Confirmation</h2>
									
							<h3>Are you sure you want to fund this application?</h3>

						<div class="confirm-fund-card-buttons">
							<div class="close" onclick="hideConfirmation(<?php echo htmlspecialchars($agreement['id']); ?>)">Close</div>
							<button type="submit" name="disburse" class="confirm">Disburse</button>
						</div>
					</div>
					
			</div>
            
            
            	

			</form>
		</div>


        <div class="printoverlay" id="printoverlay<?php echo htmlspecialchars($application['id']); ?>"></div>
            <div class="print-card" id="printCard<?php echo htmlspecialchars($application['id']); ?>">
            <i onclick="hidePrint(<?php echo htmlspecialchars($application['id']); ?>)" class='bx bxs-x-square'></i>
            <i onclick="print()" class='bx bx-printer'></i>
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
					
					<div class="print-agreement">
					
					<?php
						if ($application['status'] === 'Approved') {
					?>
					<p>This Lending Agreement is effective as of <span class="blue-text"><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($agreement['updated_at']))); ?></span>. This will serve as a proof that I, <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span> will be lending an amount of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['amount']); ?></span> to <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> with <span class="blue-text"><?php echo htmlspecialchars($agreement['interest']); ?> Interest</span>, and a monthly interest rate of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['monthly']); ?></span> which to be paid within <span class="blue-text"><?php echo htmlspecialchars($agreement['term']); ?></span>. In the event that <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> fails to pay or default his/her financial obligations, then the agreed collateral's possession will be transferred to <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span>.</p>
					<?php 
						} elseif ($application['status'] === 'Funded') {
					?>
					<p>This Lending Agreement is effective as of <span class="blue-text"><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($agreement['updated_at']))); ?></span>. This serves as a proof that I, <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span> was lending an amount of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['amount']); ?></span> to <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> with <span class="blue-text"><?php echo htmlspecialchars($agreement['interest']); ?> Interest</span>, and a monthly interest rate of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['monthly']); ?></span> which to be paid within <span class="blue-text"><?php echo htmlspecialchars($agreement['term']); ?></span>. In the event that <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> fails to pay or default his/her financial obligations, then the agreed collateral's possession will be transferred to <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span>.</p>
					<?php
						} elseif ($application['status'] === 'Paid') {
					?>
					<p>This Closure Agreement is effective as of <span class="blue-text"><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($agreement['updated_at']))); ?></span>. This serves as a proof that the amount of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['amount']); ?></span> borrowed by <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span> from <span class="blue-text"><?php echo htmlspecialchars($agreement['lendername']); ?></span> with <span class="blue-text"><?php echo htmlspecialchars($agreement['interest']); ?> Interest</span>, and a monthly interest rate of <span class="blue-text">PHP <?php echo htmlspecialchars($agreement['monthly']); ?></span> has been <span class="blue-text"><?php echo htmlspecialchars($application['status']); ?></span> within the span of <span class="blue-text"><?php echo htmlspecialchars($agreement['term']); ?></span>.</p>
					<?php 
						}
					?>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <span class="blue-text"><?php echo htmlspecialchars($agreement['borrowername']); ?></span>
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