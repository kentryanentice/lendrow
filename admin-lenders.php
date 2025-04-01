<?php
include 'php/admin-session.php';
include 'php/admin-lenders-lending-terms-functions.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Prime LendRow Admin Lenders</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/admin-lenders.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css/swiper-bundle.min.css">
</head>

<body>

<?php include ('admin-sidebar.php') ?>

<div class="overlay-bg" id="overlayBg"></div>

<?php
	if ($admin['usertype'] === 'Admin') {
?>

<div class="admin-lenders-content">
	<div class="admin-lenders-form">
	
		<div class="admin-lenders-buttons">
			<div class="lend-form-button active" id="lendFormButton" onclick="showLendForm()">Lend Form</div>
			<div class="lend-manager-button" id="lendManagerButton" onclick="showLendManager()"><div id="adminLendManagerNotification"></div>Lend Manager</div>
		</div>
		
		<div class="admin-lend-form active" id="adminLendForm">
			<div class="lend-form-info">
				<form action="php/admin-lenders-lend" id="admin-lend-form" method="POST" novalidate>
					
					<div class="calculate">
						<div class="monthly">
							<div class="inputBox">
								<h2>Monthly Interest Rate</h2>
								<label>PHP</label>
								<input type="text" name="monthly" id="monthly" placeholder="0.00" value="" readonly>
							</div>
						</div>
					</div>
			
				<div class="admin-lend-input">
					<i class='bx bxl-product-hunt'></i>
					<p class="admin-lend-label">Lend Amount</p>
						<div class="slide-container swiper" id="paymentLendSlide">
							<div class="slide-content">
								<div class="card-wrapper swiper-wrapper">
								
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="500" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()" readonly>
											<span class="admin-lend-amount">₱500.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="1000" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱1,000.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="1500" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱1,500.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="2000" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱2,000.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="2500" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱2,500.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="3000" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱3,000.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="3500" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱3,500.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="4000" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱4,000.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="4500" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱4,500.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="5000" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱5,000.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="6000" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱6,000.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="7000" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱7,000.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="8000" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱8,000.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="9000" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱9,000.00</span>
										</label>
									</div>
									
									<div class="card swiper-slide">
										<label class="lend-custom-radio">
											<input type="radio" name="admin-lend-amount" value="10000" onchange="calculateMonthlyPayment()" oninput="validateLendButtons()">
											<span class="admin-lend-amount">₱10,000.00</span>
										</label>
									</div>
									
									</div>
								</div>
								
								<div class="swiper-button-next swiper-navBtn"></div>
								<div class="swiper-button-prev swiper-navBtn"></div>
								
							</div>
						<span class="lend-error-message" id="lend-amount-error"></span>
					</div>
				
				<div class="admin-interest-input">
					<i class='bx bxs-calculator' ></i>
					<p class="admin-interest-label">Interest Rate</p>
						<div class="interest-wrapper">
							<label class="interest-custom-radio">
								<input type="radio" name="admin-interest-amount" value="10% Monthly" onchange="calculateMonthlyPayment(); toggleFirstTerm(true);" oninput="validateInterestButtons()">
								<span class="admin-interest-amount">10%<br/>Monthly</span>
							</label>
							<label class="interest-custom-radio">
								<input type="radio" name="admin-interest-amount" value="5% Monthly" onchange="calculateMonthlyPayment(); toggleSecondTerm(true);" oninput="validateInterestButtons()">
								<span class="admin-interest-amount">5%<br/>Monthly</span>
							</label>
						</div>
					<span class="lend-error-message" id="interest-amount-error"></span>
				</div>
						
						
				<div class="admin-collateral-input">
				<i class='bx bxs-check-shield'></i>
					<p class="admin-collateral-label">Collateral</p>	
						<div class="collateral-wrapper">
							<label class="collateral-custom-radio">
								<input type="radio" name="admin-collateral-amount" id="admin-collateral-amount" value="Property" oninput="validateCollateralButtons()">
								<span class="admin-collateral-amount">Property</span>
							</label>
							<label class="collateral-custom-radio">
								<input type="radio" name="admin-collateral-amount" id="admin-collateral-amount" value="Cars" oninput="validateCollateralButtons()">
								<span class="admin-collateral-amount">Cars</span>
							</label>
							<label class="collateral-custom-radio">
								<input type="radio" name="admin-collateral-amount" id="admin-collateral-amount" value="Items" oninput="validateCollateralButtons()">
								<span class="admin-collateral-amount">Items</span>
							</label>
						</div>
					<span class="lend-error-message" id="collateral-amount-error"></span>
				</div>
				
				
				<div class="admin-term-input">
					<i class='bx bxs-calendar' ></i>
					<p class="admin-term-label">Payment Term</p>
					<div class="slide-container swiper" id="paymentTermSlide">
						<div class="slide-content">
							<div class="card-wrapper swiper-wrapper">
							
								<div class="card swiper-slide first-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="1 Month" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">1<br/>Month</span>
									</label>
								</div>
								
								<div class="card swiper-slide first-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="2 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">2<br/>Months</span>
									</label>
								</div>
								
								<div class="card swiper-slide first-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="3 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">3<br/>Months</span>
									</label>
								</div>
									
								<div class="card swiper-slide first-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="4 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">4<br/>Months</span>
									</label>
								</div>
									
								<div class="card swiper-slide first-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="5 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">5<br/>Months</span>
									</label>
								</div>
									
								<div class="card swiper-slide first-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="6 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">6<br/>Months</span>
									</label>
								</div>

								<div class="card swiper-slide second-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="7 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">7<br/>Months</span>
									</label>
								</div>
									
								<div class="card swiper-slide second-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="8 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">8<br/>Months</span>
									</label>
								</div>
									
								<div class="card swiper-slide second-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="9 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">9<br/>Months</span>
									</label>
								</div>
									
								<div class="card swiper-slide second-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="10 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">10<br/>Months</span>
									</label>
								</div>
									
								<div class="card swiper-slide second-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="11 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">11<br/>Months</span>
									</label>
								</div>
									
								<div class="card swiper-slide second-term">
									<label class="term-custom-radio">
										<input type="radio" name="admin-term-amount" value="12 Months" onchange="calculateMonthlyPayment()" oninput="validateTermButtons()">
										<span class="admin-term-amount">12<br/>Months</span>
									</label>
								</div>
								
							</div>
						</div>
						
						<div class="swiper-button-next swiper-navBtn"></div>
						<div class="swiper-button-prev swiper-navBtn"></div>
						
					</div>
					<span class="lend-error-message" id="term-amount-error"></span>
				</div>
				
				<div class="lend-buttons">
					<div class="lend-create" id="lend-create" onclick="showLend()">Create</div>
				</div>
				
					<div class="overlaylendbg" id="overlayLend"></div>
						
					<div class="submit-lend" id="lending-terms">
						<h2>Lending Terms Creation</h2>
							
						<h3>Are you sure you want to create this Lending Informations?</h3>
						
						
						<span class="empty-error-message" id="empty-amount-error"></span>
						<div class="submit-lend-buttons">
							<div class="close" onclick="hideLend()">Close</div>
							<button type="submit" name="lend" class="lend">Create</button>
						</div>
					</div>
				
				</form>
			</div>
		</div>
		
		<div class="admin-lend-manager" id="adminLendManager">
		
			<div class="slide-container swiper" id="lendingSlide">
				<div class="slide-content">
					<div class="card-wrapper swiper-wrapper" id="lendingTermsCardContainer">

					
			
					</div>
				</div>
		
				<div class="swiper-button-next swiper-navBtn"></div>
				<div class="swiper-button-prev swiper-navBtn"></div>
				<div class="swiper-pagination"></div>
			</div>
			
		</div>
		
		
		<div id="applicationCardContainer">
		
		</div>

	</div>
	
	<div class="admin-lenders-wallet">
	
		<?php include ('admin-wallet.php') ?>
	
	</div>


</div>

			<div class="admin-lenders-error">
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
						
						else if ($_GET["error"] == "lendinsufficientbalance") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Insufficient Balance! Please Cash In first to continue.</p>";
						}
						
						else if ($_GET["error"] == "invalidlendamount") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Amount! Please select a valid amount.</p>";
						}
						
						else if ($_GET["error"] == "invalidinterest") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Interest! Please select a valid interest rate.</p>";
						}
						
						else if ($_GET["error"] == "invalidcollateral") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Collateral! Please select a valid collateral.</p>";
						}
						
						else if ($_GET["error"] == "invalidterm") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Payment Term! Please select a valid payment term.</p>";
						}

						else if ($_GET["error"] == "stmtfailed") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Connection failed, please try again!</p>";
						}
						
						else if ($_GET["error"] == "existingapproved") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Approval failed due to applicants existing approved application.</p>";
						}
						
						else if ($_GET["error"] == "existingdebt") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Approval failed due to applicants existing unpaid debt.</p>";
						}


					}
					if(isset($_GET["success"])) {						
						if ($_GET["success"] == "lendcreated") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>Your Lending Information has been created successfully.</p>";
						}
						
						else if ($_GET["success"] == "approved") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>You successfully approved a Borrower's Application!</p>";
						}
						
						else if ($_GET["success"] == "rejected") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>You successfully rejected a Borrower's Application!</p>";
						}
						
						else if ($_GET["success"] == "funded") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>You successfully funded a Borrower's Application!</p>";
						}
					}
				?>
			</div>

<?php
	}
?>

	<script src="js/swiper-bundle.min.js"></script>
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="js/admin-lenders.js"></script>
</body>

</html>