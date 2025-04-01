<?php
include 'php/user-session.php';
include 'php/wallet-functions.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Prime LendRow Wallet</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/wallet.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css/swiper-bundle.min.css">
</head>

<body>

<div class="overlay-bg" id="overlayBg"></div>
<div class="overlay-bg2" id="overlayBg2"></div>



<?php
	if ($user['usertype'] == 'User') {
?>
	<div class="user-wallet-button" onclick="history.back(0)">-<span class="back">Return</span></div>
	
		<div class="user-wallet-form" id="userWalletForm">
			<div class="user-wallet-info">
				
				<div class="user-wallet-account">
						
					<div class="user-balance">
						<h2>Account Balance</h2>
						<div class="inputBox">
							<label>PHP</label>
							<div id="userWalletBalance"></div>
						</div>	
					</div>
					
					<div class="user-account-buttons">
						<div class="transfer" onclick="showSendMoney()">Send Money</div>
						<div class="cashin" onclick="showCashIn()">Cash In</div>
						<div class="cashout" onclick="showCashOut()">Cash Out</div>
					</div>
					
				</div>
				
				<div class="user-transaction-history active" id="userTransactionHistory">
					<h2>Transaction History<div class="user-history-button" onclick="showRequest()"><div id="userRequestHistoryNotifications"></div>Requests</div></h2>
					<div class="user-history-form">
							
						<div class="user-history-content" id="userTransactionsHistory">
						
							
						</div>
						
					</div>
				</div>
				
				
				<div class="user-request-history" id="userRequestHistory">
					<h2>Request History<div class="user-history-button" onclick="showTransaction()">Transactions</div></h2>
					<div class="user-history-form">
							
						<div class="user-history-content" id="userRequestsHistory">
							
						
							
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
		
		
		<div class="user-send-money-form" id="userSendMoneyForm">
			<h2>Send Money</h2>
			
				<div class="user-cashin-input-file">
					<p class="user-cashin-label">Lv. 5</p>
					<i class='bx bx-image-add'></i>
					<input class="file" type="text" placeholder="Only Available for Lv.5 & Above Users" readonly>
				</div>
		
			<div class="user-cashin-buttons">
				<div class="close" onclick="hideSendMoney()">Close</div>
			</div>
		</div>
		
		
		<div class="user-cashin-form" id="userCashInForm">
			<h2>Cash In Form</h2>
			<form action="php/wallet-cashin" method="POST" id="user-cashin-form" enctype="multipart/form-data" novalidate>
			
			<input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
			<input type="hidden" name="fullname" value="<?php echo htmlspecialchars($user['firstname']); ?> <?php echo htmlspecialchars($user['middlename']); ?> <?php echo htmlspecialchars($user['lastname']); ?>">
			<input type="hidden" name="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>">
			
				<div class="user-cashin-input">
					<i class='bx bx-credit-card'></i>
					<p class="user-cashin-label">Payment Method</p>
					<label class="custom-radio">
						<input type="radio" name="user-cashin-method" value="Maya" oninput="validateRadioButtons()">
						<span><img src="pictures/maya-logo.jpg" alt="Maya"></span>
					</label>
					<label class="custom-radio">
						<input type="radio" name="user-cashin-method" value="Gcash" oninput="validateRadioButtons()">
						<span><img src="pictures/gcash-logo.jpg" alt="Gcash"></span>
					</label>
					
					<div class="payment-method-error" id="payment-method-error"></div>
				</div>
				
				<div class="user-cashin-input">
					<i class='bx bxl-product-hunt'></i>
					<p class="user-cashin-label">Cash In Amount</p>
					<div class="slide-container swiper" id="cashinAmountSlide">
						<div class="slide-content">
							<div class="card-wrapper swiper-wrapper">
							
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashin-amount" value="20" onclick="validateRadioButtons()">
										<span class="user-cashin-amount">₱20.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashin-amount" value="50" onclick="validateRadioButtons()">
										<span class="user-cashin-amount">₱50.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashin-amount" value="100" onclick="validateRadioButtons()">
										<span class="user-cashin-amount">₱100.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashin-amount" value="200" onclick="validateRadioButtons()">
										<span class="user-cashin-amount">₱200.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashin-amount" value="500" onclick="validateRadioButtons()">
										<span class="user-cashin-amount">₱500.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashin-amount" value="1000" onclick="validateRadioButtons()">
										<span class="user-cashin-amount">₱1,000.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashin-amount" value="2000" onclick="validateRadioButtons()">
										<span class="user-cashin-amount">₱2,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashin-amount" value="3000" onclick="validateRadioButtons()">
										<span class="user-cashin-amount">₱3,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashin-amount" value="4000" onclick="validateRadioButtons()">
										<span class="user-cashin-amount">₱4,000.00</span
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashin-amount" value="5000" onclick="validateRadioButtons()">
										<span class="user-cashin-amount">₱5,000.00</span>
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="swiper-button-next swiper-navBtn"></div>
						<div class="swiper-button-prev swiper-navBtn"></div>
						
					</div>
					<div class="payment-amount-error" id="payment-amount-error"></div>
				</div>
				
				<div class="user-cashin-input-file">
					<p class="user-cashin-label">Insert Cash In Receipt (less than 2MB)</p>
					<i class='bx bx-image-add'></i>
					<input class="file" type="file" placeholder="Cash In Receipt" name="cashin-receipt" id="receipt" oninput="validateReceipt()">
					<span class="receipt-error" id="receipt-error"></span>
				</div>
					
					<div class="cashin-empty-error" id="cashin-empty-error"></div>
				<div class="user-cashin-buttons">
					<div class="close" onclick="hideCashIn()">Close</div>
					<button type="submit" onclick="showCashinConfirm()" class="create">Submit</button>
				</div>
			</form>
		</div>
		
		
		
		<div class="user-cashout-form" id="userCashOutForm">
			<h2>Cash Out Form</h2>
			<form action="php/wallet-cashout" method="POST" id="user-cashout-form" enctype="multipart/form-data" novalidate>
			
			<input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
			<input type="hidden" name="fullname" value="<?php echo htmlspecialchars($user['firstname']); ?> <?php echo htmlspecialchars($user['middlename']); ?> <?php echo htmlspecialchars($user['lastname']); ?>">
			<input type="hidden" name="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>">
			
				<div class="user-cashout-input">
					<i class='bx bx-credit-card'></i>
					<p class="user-cashout-label">Cash Out Method</p>
					<label class="custom-radio">
						<input type="radio" name="user-cashout-method" value="Maya">
						<span><img src="pictures/maya-logo.jpg" alt="Maya"></span>
					</label>
					<label class="custom-radio">
						<input type="radio" name="user-cashout-method" value="Gcash">
						<span><img src="pictures/gcash-logo.jpg" alt="Gcash"></span>
					</label>
					
					<div class="cashout-method-error" id="cashout-method-error"></div>
				</div>
				
				<div class="user-cashout-input">
					<i class='bx bxl-product-hunt'></i>
					<p class="user-cashout-label">Cash Out Amount</p>
					<div class="slide-container swiper" id="cashoutAmountSlide">
						<div class="slide-content">
							<div class="card-wrapper swiper-wrapper">
							
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashout-amount" value="30" data-value="20" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="user-cashout-amount">₱20.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashout-amount" value="60" data-value="50" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="user-cashout-amount">₱50.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashout-amount" value="110" data-value="100" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="user-cashout-amount">₱100.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashout-amount" value="210" data-value="200" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="user-cashout-amount">₱200.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashout-amount" value="510" data-value="500" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="user-cashout-amount">₱500.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashout-amount" value="1010" data-value="1000" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="user-cashout-amount">₱1,000.00</span>
									</label>
								</div>
								
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashout-amount" value="2010" data-value="2000" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="user-cashout-amount">₱2,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashout-amount" value="3010" data-value="3000" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="user-cashout-amount">₱3,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashout-amount" value="4010" data-value="4000" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="user-cashout-amount">₱4,000.00</span>
									</label>
								</div>
									
								<div class="card swiper-slide">
									<label class="amount-custom-radio">
										<input type="radio" name="user-cashout-amount" value="5010" data-value="5000" data-fee="10" onclick="validateRadioButtons2(this)">
										<span class="user-cashout-amount">₱5,000.00</span>
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="swiper-button-next swiper-navBtn"></div>
						<div class="swiper-button-prev swiper-navBtn"></div>
						
					</div>

					<div class="cashout-amount-error" id="cashout-amount-error"></div>
				</div>

				<div class="user-cashout-input">
					<p class="user-cashout-label">Transaction fee</p>
					<i class='bx bxl-product-hunt'></i>
					<span class="user-cashout-fee">₱0</span> = <span class="user-cashout-total">₱0</span>
				</div>
					
					<div class="cashout-empty-error" id="cashout-empty-error"></div>
				<div class="user-cashin-buttons">
					<div class="close" onclick="hideCashOut()">Close</div>
					<button type="submit" class="create">Submit</button>
				</div>
			</form>
		</div>
		
		
		<div id="requestCardContainer">
		
		</div>
		
				<div class="user-wallet-error">
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
	<script src="js/wallet.js"></script>
</body>

</html>