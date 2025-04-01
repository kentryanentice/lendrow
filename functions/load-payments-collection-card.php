<?php
include '../php/user-session.php';
include '../php/payments-functions.php';

	$searchLendingTerms = isset($_GET['searchLendingTerms']) ? $_GET['searchLendingTerms'] : '';
	$lending = getLendingTerms($connection, $userId, $searchLendingTerms = '');

	$hasCollection = false;

		foreach ($lending as $lending) {
		$userId = $lending['users_id'];
		$lendingTermsId = $lending['id'];
		$lendername = $lending['lendername'];

	?>
	
	<?php
	$searchCollectionFinancialDetails = isset($_GET['searchCollectionFinancialDetails']) ? $_GET['searchCollectionFinancialDetails'] : '';
	$collections = getCollectionFinancialDetails($connection, $lendername, $lendingTermsId, $searchCollectionFinancialDetails = '');
									
	if (!empty($collections)) {
		
	$hasCollection = true;

		foreach ($collections as $collection) {
		$collectionId = $collection['id'];
		$lendername = $collection['lendername'];
		$lendingTermsId = $collection['lending_terms_id'];

		$hasCollection = true;
	?>
						
	<div class="card swiper-slide">
						
		<div class="profile-pic">	
			<div class="image-content">
				<span class="overlay"></span>
										
				<div class="card-image">
					<div class="card-img">
					<?php
						if (!empty($collection['picture'])) {
							$profilePicturePath = './/' . htmlspecialchars($collection['picture']);
							echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
						} else {
							echo '<img src="pictures/logo.png" alt="No Profile Picture">';
						}
					?>
					</div>
				</div>
				
				<div class="lendername">
					<?php echo htmlspecialchars($collection['lendername']); ?>
				</div>
			</div>
								
			<div class="lend-date">
				<label> <?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($collection['created_at']))); ?> </label>
			</div>
		</div>
							
							
		<div class="card-details">
			<div class="card-content">
									
				<div class="details">
					<label>Amount : </label><input type="text" placeholder="<?php echo htmlspecialchars($collection['amount']); ?>" disabled>
				</div>
									
				<div class="details">
					<label>Interest Rate :</label><input type="text" placeholder="<?php echo htmlspecialchars($collection['interest']); ?>" disabled>
				</div>
									
				<div class="details">
					<label>Payment Term : </label><input type="text" placeholder="<?php echo htmlspecialchars($collection['term']); ?>" disabled>
				</div>
									
				<div class="details">
					<label>Monthly Interest : </label><input type="text" placeholder="<?php echo htmlspecialchars($collection['monthly']); ?>" disabled>
				</div>
				
				<div class="details">
					<label>Status : </label><input type="text" placeholder="<?php echo htmlspecialchars($collection['status']); ?>" disabled>
				</div>	
								
			</div>
		</div>
							
			<div class="collections">
				<div class="collections-form">
				<h2>Monthly Collections</h2>

				<div class="collections-content" id="collections-content<?php echo htmlspecialchars($lending['id']); ?><?php echo htmlspecialchars($collection['id']); ?>">
				
				<?php
				if ($collection['term'] === '1 Month') {
					for ($month = 1; $month <= 1; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
					
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '2 Months') {
					for ($month = 1; $month <= 2; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
						
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '3 Months') {
					for ($month = 1; $month <= 3; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
						
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '4 Months') {
					for ($month = 1; $month <= 4; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
						
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '5 Months') {
					for ($month = 1; $month <= 5; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
					
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '6 Months') {
					for ($month = 1; $month <= 6; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
					
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '7 Months') {
					for ($month = 1; $month <= 7; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
					
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '8 Months') {
					for ($month = 1; $month <= 8; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
					
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '9 Months') {
					for ($month = 1; $month <= 9; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
						
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '10 Months') {
					for ($month = 1; $month <= 10; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
						
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '11 Months') {
					for ($month = 1; $month <= 11; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
					
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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
				if ($collection['term'] === '12 Months') {
					for ($month = 1; $month <= 12; $month++) {
					$dueDate = date("F d, Y", strtotime($collection['created_at'] . ' +' . $month . ' month'));
					$statusKey = 'month_' . $month;
					$status = $collection[$statusKey];
				?>
					<div class="collection-card">
						<div class="collection-date">
							<label><?php echo htmlspecialchars($month); ?></label>
						</div>
						
					<div class="month">
						<?php echo htmlspecialchars($dueDate); ?>
					</div>
					
					<div class="interest">
						₱<?php echo htmlspecialchars($collection['monthly']); ?>
					</div>
					
						<?php 
							if ($collection[$statusKey] === 'Paid') { 
						?>
							<div class="status-paid">
								<i class='bx bxs-check-circle'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
							</div>
														
						<?php 
							} elseif ($collection[$statusKey] === 'UnPaid') { 
						?>
							<div class="status-unpaid">
								<i class='bx bxs-alarm-exclamation'></i><p><?php echo htmlspecialchars($collection[$statusKey]); ?></p>
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

if (!$hasCollection) {
    echo '<p class="empty" id="loading"><span class="animated-dots">Collection Manager is currently empty<span class="dots"></span></span></p>';
}
?>