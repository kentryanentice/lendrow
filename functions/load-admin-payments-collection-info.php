<?php
include '../php/admin-session.php';
include '../php/admin-payments-functions.php';

	$searchLendingTerms = isset($_GET['searchLendingTerms']) ? $_GET['searchLendingTerms'] : '';
	$lending = getLendingTerms($connection, $adminId, $searchLendingTerms = '');

	$hasCollection = false;

		foreach ($lending as $lending) {
		$adminId = $lending['users_id'];
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
		
		$term = (int) filter_var($collection['term'], FILTER_SANITIZE_NUMBER_INT);
		$paymentsId = $collection['id'];
		$borrowername = $collection['borrowername'];
		$applicationsId = $collection['applications_id'];
		$monthlyInterest = $collection['monthly'];
		$lendDate = strtotime($collection['created_at']);
		$expectedPaidDate = strtotime("+{$term} months", $lendDate);
		$expectedPaidDateFormatted = date("F d, Y", $expectedPaidDate);

		$hasCollection = true;
        $paidCount = 0;
            for ($m = 1; $m <= $term; $m++) {
                if (isset($collection["month_{$m}"]) && $collection["month_{$m}"] === "Paid") {
                    $paidCount++;
                }
            }
        $collectionPercentage = ($term > 0) ? round(($paidCount / $term * 100), 2) : 0;
	?>
	
	<tr>
		<td class="collection-td"><?php echo htmlspecialchars($collection['borrowername']); ?></td>
		<td class="collection-td">₱<?php echo htmlspecialchars($collection['amount']); ?></td>
		<td class="collection-td"><?php echo htmlspecialchars($collection['interest']); ?></td>
		<td class="collection-td"><?php echo htmlspecialchars($collection['term']); ?></td>
		<td class="collection-td">₱<?php echo htmlspecialchars($monthlyInterest); ?></td>
		<td class="collection-td"><?php echo htmlspecialchars(date("F d, Y", strtotime($collection['created_at']))); ?></td>
		<td class="collection-td"><?php echo htmlspecialchars($expectedPaidDateFormatted); ?></td>

	<?php
		for ($month = 1; $month <= 12; $month++) {
			if ($month <= $term) {
			$monthStatus = $collection["month_{$month}"];
	?>
	
		<?php if($monthStatus === "Paid") {
		?>
		
			<td class="collection-td paid">₱<?php echo htmlspecialchars($collection['monthly']); ?></td>
		
		<?php 
			} elseif($monthStatus === "UnPaid") {
		?>
		
			<td class="collection-td unpaid">₱<?php echo htmlspecialchars($collection['monthly']); ?></td>
			
		<?php 
			}
		?>
	
	<?php
		} else {
	?>
		<td class="collection-td">*</td>
			
	<?php
		}
	}
	?>

        <?php if($collection['status'] === "Paid") {
		?>
            <td class="collection-td paid">
                <?php echo htmlspecialchars($collectionPercentage) . '%'; ?>
            </td>

        <?php 
			} elseif($collection['status'] === "UnPaid") {
		?>
            <td class="collection-td unpaid">
                <?php echo htmlspecialchars($collectionPercentage) . '%'; ?>
            </td>
        
        <?php 
			}
		?>
	
		<?php if($collection['status'] === "Paid") {
		?>
		
			<td class="collection-td paid"><?php echo htmlspecialchars($collection['status']); ?></td>
		
		<?php 
			} elseif($collection['status'] === "UnPaid") {
		?>
		
			<td class="collection-td unpaid"><?php echo htmlspecialchars($collection['status']); ?></td>
			
		<?php 
			}
		?>
	</tr>
	
		<?php
        }
    }
}

if (!$hasCollection) {
    echo '<p class="empty" id="loading"><span class="animated-dots">Collection Manager is currently empty<span class="dots"></span></span></p>';
}
?>