<?php
include 'php/user-session.php';
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Prime LendRow Payments</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="pictures/logo.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/payments.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css/swiper-bundle.min.css">
</head>

<body>

<?php include ('sidebar.php') ?>

<div class="overlay-bg" id="overlayBg"></div>

<?php
	if ($user['usertype'] === 'User') {
?>


<div class="user-payments-content">
	<div class="view-payment-info active" id="paymentInfoButton" onclick="showPaymentInfo()"><i class='bx bx-question-mark'></i></div>
	
	<div class="payment-info" id="paymentInfo">
	<h2>Payment Information</h2>
		<i class="bx bxs-message-square-x" onclick="hidePaymentInfo()"></i>
			<div class="payment-border">
				<table class="payment-table">
						<tr class="payment-header-row">
							<th class="payment-header">Lender</th>
							<th class="payment-header">Amount</th>
							<th class="payment-header">Interest Rate</th>
							<th class="payment-header">Payment Term</th>
							<th class="payment-header">Monthly Interest</th>
							<th class="payment-header">Lend Date</th>
							<th class="payment-header">Expacted Paid Date</th>
							<th class="payment-header">Month<br/>1</th>
							<th class="payment-header">Month<br/>2</th>
							<th class="payment-header">Month<br/>3</th>
							<th class="payment-header">Month<br/>4</th>
							<th class="payment-header">Month<br/>5</th>
							<th class="payment-header">Month<br/>6</th>
							<th class="payment-header">Month<br/>7</th>
							<th class="payment-header">Month<br/>8</th>
							<th class="payment-header">Month<br/>9</th>
							<th class="payment-header">Month<br/>10</th>
							<th class="payment-header">Month<br/>11</th>
							<th class="payment-header">Month<br/>12</th>
                            <th class="payment-header">Payment<br/>Rate</th>
							<th class="payment-header">Status</th>
						</tr>
					<tbody class="payment-tbody" id="paymentInfoContainer">
						
						
						
					</tbody>
				</table>
			</div>
	</div>
	
	<div class="view-collection-info" id="collectionInfoButton" onclick="showCollectionInfo()"><i class='bx bx-question-mark'></i></div>
	
	<div class="collection-info" id="collectionInfo">
	<h2>Collection Information</h2>
		<i class="bx bxs-message-square-x" onclick="hideCollectionInfo()"></i>
			<div class="collection-border">
				<table class="collection-table">
						<tr class="collection-header-row">
							<th class="collection-header">Borrower</th>
							<th class="collection-header">Amount</th>
							<th class="collection-header">Interest Rate</th>
							<th class="collection-header">Payment Term</th>
							<th class="collection-header">Monthly Interest</th>
							<th class="collection-header">Lend Date</th>
							<th class="collection-header">Expacted Paid Date</th>
							<th class="collection-header">Month<br/>1</th>
							<th class="collection-header">Month<br/>2</th>
							<th class="collection-header">Month<br/>3</th>
							<th class="collection-header">Month<br/>4</th>
							<th class="collection-header">Month<br/>5</th>
							<th class="collection-header">Month<br/>6</th>
							<th class="collection-header">Month<br/>7</th>
							<th class="collection-header">Month<br/>8</th>
							<th class="collection-header">Month<br/>9</th>
							<th class="collection-header">Month<br/>10</th>
							<th class="collection-header">Month<br/>11</th>
							<th class="collection-header">Month<br/>12</th>
                            <th class="collection-header">Collection<br/>Rate</th>
							<th class="collection-header">Status</th>
						</tr>
					<tbody class="collection-tbody" id="collectionInfoContainer">
						
						
						
					</tbody>
				</table>
			</div>
	</div>

	<div class="user-payments-form">
		<div class="user-payments-buttons">
			<div class="payments-manager-button active" id="paymentsManagerButton" onclick="showPaymentsManager()"><div id="userPaymentsManagerNotification"></div>Payments</div>
			<div class="collect-manager-button" id="collectManagerButton" onclick="showCollectManager()">Collections</div>
		</div>
	
		<div class="user-payment-manager active" id="userPaymentManager">
			
			<div class="slide-container swiper" id="paymentSlide">
				<div class="slide-content">
					<div class="card-wrapper swiper-wrapper" id="paymentCardContainer">

					
			
					</div>
				</div>
		
				<div class="swiper-button-next swiper-navBtn"></div>
				<div class="swiper-button-prev swiper-navBtn"></div>
				<div class="swiper-pagination"></div>
			</div>
			
		</div>
		
		
		<div id="monthlyPaymentCardContainer">
		
		</div>
		
		<div class="user-collect-manager" id="userCollectManager">
		
			<div class="slide-container swiper" id="collectionSlide">
				<div class="slide-content">
					<div class="card-wrapper swiper-wrapper" id="collectionCardContainer">

					
			
					</div>
				</div>
		
				<div class="swiper-button-next swiper-navBtn"></div>
				<div class="swiper-button-prev swiper-navBtn"></div>
				<div class="swiper-pagination"></div>
			</div>
		
		</div>
	</div>
	
	<div class="user-payments-wallet">
	
		<?php include ('wallet.php') ?>
	
	</div>

</div>

		<div class="user-payments-error">
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
						
						else if ($_GET["error"] == "insufficientbalance") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Insufficient Balance! Please Cash In first to continue.</p>";
						}

						else if ($_GET["error"] == "stmtfailed") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Connection failed, please try again!</p>";
						}
						
						else if ($_GET["error"] == "balancenotfound") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Balance! Please try again.</p>";
						}
						
						else if ($_GET["error"] == "walletidnotfound") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Receiver! Please try again.</p>";
						}
						
						else if ($_GET["error"] == "senderidnotfound") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Invalid Sender! Please try again.</p>";
						}
						
						else if ($_GET["error"] == "unpaid") {
							echo "<i class='bx bxs-error-circle'></i><p class='red'>Please pay your previous unpaid interest to proceed.</p>";
						}

					}
					if(isset($_GET["success"])) {						
						if ($_GET["success"] == "paid") {
							echo "<i class='bx bxs-check-circle' ></i><p class='blue'>You successfully paid your monthly interest.</p>";
						}
					}
				?>
			</div>
	
<?php
	}
?>
	
	<script src="js/swiper-bundle.min.js"></script>
	<script src="js/jquery-3.7.1.min.js"></script>
	<script src="js/payments.js"></script>
</body>

</html>