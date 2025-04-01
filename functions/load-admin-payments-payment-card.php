<?php
include '../php/admin-session.php';
include '../php/admin-payments-functions.php';

	$searchApplications = isset($_GET['searchApplications']) ? $_GET['searchApplications'] : '';
	$applications = getApplications($connection, $adminId, $searchApplications = '');

	$hasPayment = false;

		foreach ($applications as $application) {
		$adminId = $application['users_id'];
		$applicationsId = $application['id'];
		$borrowername = $application['borrowername'];

	?>
	
	<?php
	$searchPaymentsFinancialDetails = isset($_GET['searchPaymentsFinancialDetails']) ? $_GET['searchPaymentsFinancialDetails'] : '';
	$payments = getPaymentsFinancialDetails($connection, $borrowername, $applicationsId, $searchPaymentsFinancialDetails = '');
									
	if (!empty($payments)) {
		
	$hasPayment = true;

		foreach ($payments as $payment) {
		$paymentsId = $payment['id'];
		$borrowername = $payment['borrowername'];
		$applicationsId = $payment['applications_id'];

		$hasPayment = true;
	?>
						
	<div class="card swiper-slide">
						
		<div class="profile-pic">	
			<div class="image-content">
				<span class="overlay"></span>
										
				<div class="card-image">
					<div class="card-img">
					<?php
						if (!empty($payment['picture'])) {
							$profilePicturePath = './/' . htmlspecialchars($payment['picture']);
							echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
						} else {
							echo '<img src="pictures/logo.png" alt="No Profile Picture">';
						}
					?>
					</div>
				</div>
				
				<div class="lendername">
					<?php echo htmlspecialchars($payment['lendername']); ?>
				</div>
			</div>
								
			<div class="lend-date">
				<label> <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($payment['created_at']))); ?> </label>
			</div>
		</div>
							
							
		<div class="card-details">
			<div class="card-content">
									
				<div class="details">
					<label>Amount : </label><input type="text" placeholder="<?php echo htmlspecialchars($payment['amount']); ?>" disabled>
				</div>
									
				<div class="details">
					<label>Interest Rate :</label><input type="text" placeholder="<?php echo htmlspecialchars($payment['interest']); ?>" disabled>
				</div>
									
				<div class="details">
					<label>Payment Term : </label><input type="text" placeholder="<?php echo htmlspecialchars($payment['term']); ?>" disabled>
				</div>
									
				<div class="details">
					<label>Monthly Interest : </label><input type="text" placeholder="<?php echo htmlspecialchars($payment['monthly']); ?>" disabled>
				</div>
				
				<div class="details">
					<label>Status : </label><input type="text" placeholder="<?php echo htmlspecialchars($payment['status']); ?>" disabled>
				</div>	
								
			</div>
		</div>
							
			<div class="payments">
				<div class="payments-form">
				<h2>Monthly Payments</h2>

				<div class="payments-content" id="payments-content<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>">
				
				<?php
				if ($payment['term'] === '1 Month') {
					for ($month = 1; $month <= 1; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '2 Months') {
					for ($month = 1; $month <= 2; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '3 Months') {
					for ($month = 1; $month <= 3; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '4 Months') {
					for ($month = 1; $month <= 4; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '5 Months') {
					for ($month = 1; $month <= 5; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '6 Months') {
					for ($month = 1; $month <= 6; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '7 Months') {
					for ($month = 1; $month <= 7; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '8 Months') {
					for ($month = 1; $month <= 8; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '9 Months') {
					for ($month = 1; $month <= 9; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '10 Months') {
					for ($month = 1; $month <= 10; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '11 Months') {
					for ($month = 1; $month <= 11; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
				
				
				<?php
				if ($payment['term'] === '12 Months') {
					for ($month = 1; $month <= 12; $month++) {
					$dueDate = date("F d, Y", strtotime($payment['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $payment[$statusKey];
				?>
					<div class="payment-card">
						<div class="paydate">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($payment['monthly']); ?>
					</div>
					
						<?php 
							if ($status === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p class='blue'>Paid</p>
							</div>
														
						<?php 
							} elseif ($status === 'UnPaid') { 
						?>
							<div class="pay" onclick="showPayment(<?php echo htmlspecialchars($month); ?><?php echo htmlspecialchars($application['id']); ?><?php echo htmlspecialchars($payment['id']); ?>)">
								Pay
							</div>
						<?php 
						} 
						?>
					</div>
				<?php
					}
				}
				?>
			
										
				</div>
								
				</div>
			</div>
									
		</div>
						
	<?php
        }
    }
}

if (!$hasPayment) {
    echo '<p class="empty" id="loading"><span class="animated-dots">Payment Manager is currently empty<span class="dots"></span></span></p>';
}
?>