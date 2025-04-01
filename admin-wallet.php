<?php
include 'php/admin-session.php';
include 'php/admin-wallet-functions.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Prime LendRow Admin Wallet</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/admin-wallet.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css/swiper-bundle.min.css">
</head>

<body>

<div class="overlay-bg" id="overlayBg"></div>
<div class="overlay-bg2" id="overlayBg2"></div>



<?php
	if ($admin['usertype'] == 'Admin') {
?>
	<div class="admin-wallet-button" onclick="history.back(0)">-<span class="back">Return</span></div>
	
		<div class="admin-wallet-form" id="adminWalletForm">
			<div class="admin-wallet-info">
				
				<div class="admin-wallet-account">
						
					<div class="admin-balance">
						<h2>Account Balance</h2>
						<div class="inputBox">
							<label>PHP</label>
							<div id="adminWalletBalance"></div>
						</div>	
					</div>
					
					<div class="admin-account-buttons">
						<div class="transfer" onclick="showAdminSendMoney()">Send Money</div>
						<div class="cashin" onclick="showAdminCashIn()">Cash In</div>
						<div class="cashout" onclick="showAdminCashOut()">Cash Out</div>
					</div>
					
				</div>
				
				<div class="admin-transaction-history active" id="adminTransactionHistory">
					<h2>Transaction History<div class="admin-history-button" onclick="showRequest()"><div id="adminRequestHistoryNotifications"></div>Requests</div></h2>
					<div class="admin-history-form">
							
						<div class="admin-history-content" id="adminTransactionsHistory"/>
						
							
						</div>
						
					</div>
				</div>
				
				
				<div class="admin-request-history" id="adminRequestHistory">
					<h2>Request History<div class="admin-history-button" onclick="showTransaction()">Transactions</div></h2>
					<div class="admin-history-form">
							
						<div class="admin-history-content" id="adminRequestsHistory">
							
						
							
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
		
		
		<div class="admin-send-money-form" id="adminSendMoneyForm">
			<h2>Send Money</h2>
			
				<div class="admin-cashin-input-file">
					<p class="admin-cashin-label">Lv. 5</p>
					<i class='bx bx-image-add'></i>
					<input class="file" type="text" placeholder="Only Available for Lv.5 & Above Users" readonly>
				</div>
		
			<div class="admin-cashin-buttons">
				<div class="close" onclick="hideAdminSendMoney()">Close</div>
			</div>
		</div>
		
		
		<div class="admin-cashin-form" id="adminCashInForm">
			<h2>Cash In Form</h2>
			<form action="php/admin-wallet-cashin" method="POST" id="admin-cashin-form" enctype="multipart/form-data" novalidate>
			
			<input type="hidden" name="id" value="<?php echo htmlspecialchars($adminData['id']); ?>">
			<input type="hidden" name="fullname" value="<?php echo htmlspecialchars($adminData['firstname']); ?> <?php echo htmlspecialchars($adminData['middlename']); ?> <?php echo htmlspecialchars($adminData['lastname']); ?>">
			<input type="hidden" name="mobile" value="<?php echo htmlspecialchars($adminData['mobile']); ?>">
			
				<div class="admin-cashin-input">
					<i class='bx bx-credit-card'></i>
					<p class="admin-cashin-label">Payment Method</p>
					<label class="custom-radio">
						<input type="radio" name="admin-cashin-method" value="Maya" oninput="validateRadioButtons()">
						<span><img src="pictures/maya-logo.jpg" alt="Maya"></span>
					</label>
					<label class="custom-radio">
						<input type="radio" name="admin-cashin-method" value="Gcash" oninput="validateRadioButtons()">
						<span><img src="pictures/gcash-logo.jpg" alt="Gcash"></span>
					</label>
					
					<div class="payment-method-error" id="payment-method-error"></div>
				</div>
				
				<div class="admin-cashin-input">
					<i class='bx bxl-product-hunt'></i>
					<p class="admin-cashin-label">Cash In Amount</p>
					<div class="slide-container swiper" id="cashinAmountSlide">
						<div class="slide-content">
							<div class="card-wrapper swiper-wrapper">
							
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="20" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱20.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="50" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱50.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="100" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱100.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="200" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱200.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="500" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱500.00</span>
									</label>
								</div>
									
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
										<span class="admin-cashin-amount">₱4,000.00</span
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashin-amount" value="5000" onclick="validateRadioButtons()">
										<span class="admin-cashin-amount">₱5,000.00</span>
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="swiper-button-next swiper-navBtn"></div>
						<div class="swiper-button-prev swiper-navBtn"></div>
						
					</div>
					<div class="payment-amount-error" id="payment-amount-error"></div>
				</div>
				
				<div class="admin-cashin-input-file">
					<p class="admin-cashin-label">Insert Cash In Receipt (less than 2MB)</p>
					<i class='bx bx-image-add'></i>
					<input class="file" type="file" placeholder="Cash In Receipt" name="cashin-receipt" id="receipt" oninput="validateReceipt()">
					<span class="receipt-error" id="receipt-error"></span>
				</div>
					
					<div class="cashin-empty-error" id="cashin-empty-error"></div>
				<div class="admin-cashin-buttons">
					<div class="close" onclick="hideAdminCashIn()">Close</div>
					<button type="submit" onclick="showCashinConfirm()" class="create">Submit</button>
				</div>
			</form>
		</div>
		
		
		
		<div class="admin-cashout-form" id="adminCashOutForm">
			<h2>Cash Out Form</h2>
			<form action="php/admin-wallet-cashout" method="POST" id="admin-cashout-form" enctype="multipart/form-data" novalidate>
			
			<input type="hidden" name="id" value="<?php echo htmlspecialchars($adminData['id']); ?>">
			<input type="hidden" name="fullname" value="<?php echo htmlspecialchars($adminData['firstname']); ?> <?php echo htmlspecialchars($adminData['middlename']); ?> <?php echo htmlspecialchars($adminData['lastname']); ?>">
			<input type="hidden" name="mobile" value="<?php echo htmlspecialchars($adminData['mobile']); ?>">
			
				<div class="admin-cashout-input">
					<i class='bx bx-credit-card'></i>
					<p class="admin-cashout-label">Cash Out Method</p>
					<label class="custom-radio">
						<input type="radio" name="admin-cashout-method" value="Maya">
						<span><img src="pictures/maya-logo.jpg" alt="Maya"></span>
					</label>
					<label class="custom-radio">
						<input type="radio" name="admin-cashout-method" value="Gcash">
						<span><img src="pictures/gcash-logo.jpg" alt="Gcash"></span>
					</label>
					
					<div class="cashout-method-error" id="cashout-method-error"></div>
				</div>
				
				<div class="admin-cashout-input">
					<i class='bx bxl-product-hunt'></i>
					<p class="admin-cashout-label">Cash Out Amount</p>
					<div class="slide-container swiper" id="cashoutAmountSlide">
						<div class="slide-content">
							<div class="card-wrapper swiper-wrapper">
							
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashout-amount" value="30" data-value="20" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="admin-cashout-amount">₱20.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashout-amount" value="60" data-value="50" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="admin-cashout-amount">₱50.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashout-amount" value="110" data-value="100" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="admin-cashout-amount">₱100.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashout-amount" value="210" data-value="200" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="admin-cashout-amount">₱200.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashout-amount" value="510" data-value="500" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="admin-cashout-amount">₱500.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashout-amount" value="1010" data-value="1000" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="admin-cashout-amount">₱1,000.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashout-amount" value="2010" data-value="2000" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="admin-cashout-amount">₱2,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashout-amount" value="3010" data-value="3000" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="admin-cashout-amount">₱3,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashout-amount" value="4010" data-value="4000" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="admin-cashout-amount">₱4,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="admin-cashout-amount" value="5010" data-value="5000" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="admin-cashout-amount">₱5,000.00</span>
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="swiper-button-next swiper-navBtn"></div>
						<div class="swiper-button-prev swiper-navBtn"></div>
						
					</div>

					<div class="cashout-amount-error" id="cashout-amount-error"></div>
				</div>

				<div class="admin-cashout-input">
					<p class="admin-cashout-label">Transaction fee</p>
					<i class='bx bxl-product-hunt'></i>
					<span class="admin-cashout-fee">₱0</span> = <span class="admin-cashout-total">₱0</span>
				</div>
					
					<div class="cashout-empty-error" id="cashout-empty-error"></div>
				<div class="admin-cashin-buttons">
					<div class="close" onclick="hideAdminCashOut()">Close</div>
					<button type="submit" class="create">Submit</button>
				</div>
			</form>
		</div>
		
		
		<div id="requestCardContainer">
		
		</div>
		
				<div class="admin-wallet-error">
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
						
						else if ($_GET["error"] == "invalidpaymentmethod") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Payment Method! Please select a valid payment method.</p>";
						}
						
						else if ($_GET["error"] == "cashoutinsufficientbalance") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Insufficient Balance, cannot proceed for Cash Out!</p>";
						}
						
						else if ($_GET["error"] == "existingcashout") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Cash Out failed! since you still have previous cashout request!</p>";
						}

						else if ($_GET["error"] == "existingcashin") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Cash In failed! since you still have previous cashin request!</p>";
						}
						
						else if ($_GET["error"] == "fileuploadfailed") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Receipt field must not be empty, please attach a receipt to proceed!</p>";
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

					}
					if(isset($_GET["success"])) {						
						if ($_GET["success"] == "cashedin") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>Congratulations! Your Cash In Request has been successful.</p>";
						}
						
						else if ($_GET["success"] == "cashedout") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>Congratulations! Your Cash Out Request has been successful.</p>";
						}
					}
				?>
			</div>

<?php
	}
?>
	
	<script src="js/swiper-bundle.min.js"></script>
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="js/admin-wallet.js"></script>
</body>

</html>