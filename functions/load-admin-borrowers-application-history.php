<?php
include '../php/admin-session.php';
include '../php/admin-borrowers-lending-terms-functions.php';

					$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
					$applications = getApplications($connection, $adminId, $searchApplications = '');
																	
					if (empty($applications)) {
						echo '<p class="empty" id="loading"><span class="animated-dots">My Applications is currently empty<span class="dots"></span></span></p>';
					} else {
						foreach ($applications as $application) {
						$adminId = $application['users_id'];
												
					if ($application['status'] == 'Pending') {
				?>

					<div class="application-history">
						<div class="pending"></div>
						<span><i class='bx bxs-alarm-exclamation'></i></span>				
						<input type="hidden" placeholder="" disabled>						
						<input type="hidden" placeholder="" disabled>						
							<p>Your application is currently <?php echo htmlspecialchars($application['status']); ?>. <br>Applied at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>	
						<div class="view-button">
							<div class="view" onclick="showLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
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
							<p>Your application has already been <?php echo htmlspecialchars($application['status']); ?>.<br><?php echo htmlspecialchars($application['status']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>			
						<div class="view-button">
							<div class="view" onclick="showLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
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
							<p>Your application has been <?php echo htmlspecialchars($application['status']); ?>.<br><?php echo htmlspecialchars($application['status']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>				
						<div class="view-button">
							<div class="view" onclick="showLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
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
							<p>You <?php echo htmlspecialchars($application['status']); ?> your application.<br><?php echo htmlspecialchars($application['status']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>				
						<div class="view-button">
							<div class="view" onclick="showLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
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
							<p>Your application has already been <?php echo htmlspecialchars($application['status']); ?>.<br><?php echo htmlspecialchars($application['status']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>
						<div class="view-button">
							<div class="view" onclick="showLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
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
							<p>Your application has already been <?php echo htmlspecialchars($application['status']); ?>.<br><?php echo htmlspecialchars($application['status']); ?> at <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($application['updated_at']))); ?></p>
						<div class="view-button">
							<div class="view" onclick="showLenderCard(<?php echo htmlspecialchars($application['id']); ?>)">View</div>
						</div>
													
					</div>
												
				<?php
						}
					}
				}
				?>