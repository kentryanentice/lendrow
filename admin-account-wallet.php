<?php
include 'php/admin-session.php';
include 'php/admin-virtual-wallet-functions.php';
include 'php/admin-account-wallet-cashin-request-functions.php';
include 'php/admin-account-wallet-cashout-request-functions.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Prime LendRow Admin Account Wallet</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/admin-account-wallet.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css/swiper-bundle.min.css">
</head>

<body>

<?php include ('admin-sidebar.php') ?>

<div class="overlay-bg" id="overlayBg"></div>

<?php
	if ($admin['usertype'] === 'Admin') {
?>

	<div class="admin-account-wallet-buttons">
		<div class="virtual-money-manager-button active" id="virtualMoneyManagerButton" onclick="showVirtualMoneyManager()"><div id="adminVirtualMoneyNotification"></div>Virtual Money</div>
		<div class="cashin-manager-button" id="virtualCashinManagerButton" onclick="showVirtualCashinManager()"><div id="adminVirtualCashinNotification"></div>Cash In Manager</div>
		<div class="cashout-manager-button" id="virtualCashoutManagerButton" onclick="showVirtualCashoutManager()"><div id="adminVirtualCashoutNotification"></div>Cash Out Manager</div>
	</div>
	
	<div class="admin-account-wallet-content">
		
		<div class="admin-virtual-money-form active" id="virtualMoneyManager">
			<div class="admin-virtual-wallet-account">
						
				<div class="admin-virtual-balance active" id="adminVirtualBalance">
					<h2>Virtual Balance</h2>
					<span class="virtual-icon"><i class='bx bx-toggle-left' onclick="showSystemBalance()"></i></span>
					<div class="inputBox">
						<label>PHP</label>
						
							<div id="virtualBalance"></div>
					</div>
				</div>
				
				<div class="admin-system-balance" id="adminSystemBalance">
					<h2>System Balance</h2>
					<span class="virtual-icon"><i class='bx bx-toggle-right' onclick="showVirtualBalance()"></i></span>
					<div class="inputBox">
						<label>PHP</label>
						
							<div id="systemBalance"></div>
							
					</div>
				</div>
				<?php
					$searchRequest = isset($_GET['searchRequest']) ? $_GET['searchRequest'] : '';
					$adminWalletData = getAdminWallet($connection, $searchRequest);
						
					if (empty($adminWalletData)) {
					echo '	
						<div class="admin-virtual-account-buttons">
						<div class="virtual-cashin" onclick="showVirtualSetUp()">Set Up Account</div>
						</div>';
					} else {
					foreach ($adminWalletData as $wallet) {
					?>
						<div class="admin-virtual-account-buttons">
						<div class="virtual-cashin" onclick="showVirtualCashInForm()">Add Virtual Money</div>
						</div>		
				<?php
					}
				}
				?>
					
			</div>
			
			<div class="admin-virtual-transaction-history">
				<h2>Virtual Transaction History</h2>
				<div class="admin-virtual-history-form">
				
				<?php
					$searchRequest = isset($_GET['searchRequest']) ? $_GET['searchRequest'] : '';
					$adminWalletData = getAdminWallet($connection, $searchRequest);
						
					if (empty($adminWalletData)) {
					echo '<div class="admin-virtual-transaction-history-content"><p class="empty" id="loading"><span class="animated-dots">Virtual Transaction History is currently empty<span class="dots"></span></span></p></div>';
					} else {
					foreach ($adminWalletData as $wallet) {
					?>
							
					<div class="admin-virtual-transaction-history-content" id="adminVirtualTransactionHistory">
							
							
					</div>
					
					<?php
						}
					}
					?>	
						
				</div>
			</div>
		
		</div>
		
		<div class="virtual-setup-form" id="virtualSetUpForm">
			<h2>Set Up Virtual Account</h2>
			<form action="php/admin-account-wallet-setup" method="POST" enctype="multipart/form-data" novalidate>
			
				<div class="admin-virtual-setup-input">
					<p class="admin-virtual-setup-label">Account Name</p>
					<i class='bx bxs-user'></i>
					<input type="text" placeholder="Enter an Account Name" name="adminwalletname" id="adminWalletName" value="" oninput="validateName()">
					<span class="error-message" id="name-error"></span>
				</div>
		
				<span class="empty-error-message" id="empty-error"></span>
				<div class="virtual-cashin-buttons">
					<div class="close" onclick="hideVirtualSetUp()">Close</div>
					<button type="submit" class="create">Submit</button>
				</div>
			</form>
		</div>
		
		
		<div class="virtual-cashin-form" id="virtualCashInForm">
		<h2>Add Virtual Money Form</h2>
			<form action="php/admin-account-wallet-virtual-cashin" id="virtual-cashin-form" method="POST" enctype="multipart/form-data" novalidate>
			<?php
				$searchRequest = isset($_GET['searchRequest']) ? $_GET['searchRequest'] : '';
				$adminWalletData = getAdminWallet($connection, $searchRequest);
						
				if (empty($adminWalletData)) {
				echo '	
					<div class="admin-virtual-cashin-input">
						<input type="text" value="Not Set Up" readonly>
					</div>';
				} else {
					foreach ($adminWalletData as $wallet) {
				?>
					<input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($wallet["id"]); ?>" readonly>
					
					<div class="admin-virtual-cashin-input">
						<i class="bx bxs-user"></i>
						<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($wallet["admin_wallet_name"]); ?>" readonly>
					</div>
					
					<div class="admin-cashin-input">
					<i class='bx bxl-product-hunt'></i>
					<p class="admin-cashin-label">Virtual Cash In Amount</p>
					<div class="slide-container swiper" id="virtualAmountSlide">
						<div class="slide-content">
							<div class="card-wrapper swiper-wrapper">
							
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="1000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱1,000.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="2000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱2,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="3000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱3,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="4000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱4,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="5000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱5,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="6000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱6,000.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="7000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱7,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="8000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱8,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="9000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱9,000.00</span
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="10000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱10,000.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="15000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱15,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="20000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱20,000.00</span
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="25000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱25,000.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="30000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱30,000.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="35000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱35,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="40000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱40,000.00</span
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="45000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱45,000.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="50000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱50,000.00</span
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="swiper-button-next swiper-navBtn"></div>
						<div class="swiper-button-prev swiper-navBtn"></div>
						
					</div>
					<span class="error-message" id="amount-error"></span>
				</div>
					
				<?php
					}
				}
				?>
					<span class="empty-error-message" id="virtual-empty-error"></span>
					<div class="virtual-cashin-buttons">
						<div class="close" onclick="hideVirtualMoneyForm()">Close</div>
						<button type="submit" class="create">Submit</button>
					</div>
			</form>
		</div>

		
		<div id="virtualCashInCardContainer">
		
		</div>
		
		
		<div class="admin-virtual-cashin-form" id="virtualCashinManager">
		
			<div class="admin-virtual-cashin-content">
			<h2>Cash In Request</h2>
							
				<div class="admin-virtual-history-content" id="adminCashinRequests">
							
						
							
				</div>
						
			</div>
			
		</div>
		
		
		<div id="cashinRequestCardContainer">
		
		</div>

		
		<div class="admin-virtual-cashout-form" id="virtualCashoutManager">
			
			<div class="admin-virtual-cashout-content">
			<h2>Cash Out Request</h2>
							
				<div class="admin-virtual-history-content" id="adminCashoutRequests">
							
						
							
				</div>
						
			</div>
		
		</div>
	
	</div>
	
	
		<div id="cashoutRequestCardContainer">
		
		</div>
	
	
			<div class="account-wallet-error">
				<?php
					if(isset($_GET["error"])) {
						if ($_GET["error"] == "duplicate_submission") {
							$resubmitTime = $_SESSION['last_submission_time'] + 5;

							$remainingTime = max(0, $resubmitTime - time());

							$minutes = floor($remainingTime / 60);
							$seconds = $remainingTime % 60;

							echo "<i class='bx bxs-error-circle'></i><p class='red'>Duplicate Submission, please wait for ";
							echo $seconds . "s before resubmitting.</p>";
						}
						
						else if ($_GET["error"] == "invalidamount") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Amount! Please select a valid amount.</p>";
						}
						
						else if ($_GET["error"] == "virtualwalletidnotfound") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You haven't set up your Virtual Account yet!</p>";
						}
						
						else if ($_GET["error"] == "virtualbalancenotfound") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You haven't set up your Virtual Account yet!</p>";
						}
						
						else if ($_GET["error"] == "systembalancenotfound") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You haven't set up your Virtual Account yet!</p>";
						}
						
						else if ($_GET["error"] == "fileuploadfailed") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Receipt field must not be empty, please attach a receipt to cash out!</p>";
						}
						
						else if ($_GET["error"] == "emptyreceipt") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Receipt field must not be empty, please attach a receipt to proceed!</p>";
						}
						
						else if ($_GET["error"] == "invalidsize") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Please attach a receipt file 2MB or below!</p>";
						}

						else if ($_GET["error"] == "invalidformat") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Please attach a correct reciept file format!</p>";
						}
						
						else if ($_GET["error"] == "insufficientbalance") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Insufficient Balance, cannot proceed for Cash Out!</p>";
						}
						
						else if ($_GET["error"] == "insufficientvirtualbalance") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Insufficient Virtual Balance, please add virtual balance first!</p>";
						}
						
						else if ($_GET["error"] == "insufficientuserbalance") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Insufficient User Balance, you cannot approve the Cash Out Request!</p>";
						}
						
						else if ($_GET["error"] == "rejected") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Cash In Request Approval Failed, since it has already been rejected!</p>";
						}
						else if ($_GET["error"] == "existingcashinapproval") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You approved another Cash In Request, please Cash In it first!</p>";
						}
						
						else if ($_GET["error"] == "existingcashoutapproval") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You approved another Cash Out Request, please Cash Out it first!</p>";
						}

						else if ($_GET["error"] == "existingvirtualcashin") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Virtual Cash In Failed, since you still have pending history!</p>";
						}

					}
					if(isset($_GET["success"])) {						
						if ($_GET["success"] == "setup") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>Congratulations! You Set Up your Virtual Account successfully.</p>";
						}
						
						else if ($_GET["success"] == "virtualcashedin") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>Congratulations! Your Virtual Cash In has been  successful.</p>";
						}
						
						else if ($_GET["success"] == "confirmed") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>You confirmed your Virtual Cash In!</p>";
						}
						
						else if ($_GET["success"] == "cancelled") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You cancelled your Virtual Cash In!</p>";
						}
						
						else if ($_GET["success"] == "rejectedcashin") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You rejected a Cash In Request!</p>";
						}
						
						else if ($_GET["success"] == "approvedcashin") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>You approved a Cash In Request!</p>";
						}
						
						else if ($_GET["success"] == "cashin") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>Congratulations! You Cashed In the money successfully.</p>";
						}
						
						else if ($_GET["success"] == "rejectedcashout") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You rejected a Cash Out Request!</p>";
						}
						
						else if ($_GET["success"] == "approvedcashout") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>You approved a Cash Out Request!</p>";
						}
						
						else if ($_GET["success"] == "cashout") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>Congratulations! You Cashed Out the money successfully.</p>";
						}
						
						else if ($_GET["success"] == "moneyadded") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>Congratulations! You added the money successfully.</p>";
						}
					}
				?>
			</div>
	
<?php
	}
?>
	
	<script src="js/swiper-bundle.min.js"></script>
	<script src="js/admin-account-wallet.js"></script>
</body>

</html>