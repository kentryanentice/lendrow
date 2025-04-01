<?php
include '../php/user-session.php';
include '../php/borrowers-lending-terms-functions.php';

	$searchLendingTerms = isset($_GET['searchLendingTerms']) ? $_GET['searchLendingTerms'] : '';
	$lenders = getLendingTerms($connection, $searchLendingTerms = '');
	
	$hasLender = false;
	
	$monthlyData = [];
							
	foreach ($lenders as $lender) {
		$hasLender = true;
		
		$monthYear = date("Y-m", strtotime($lender['created_at']));
		if (!isset($monthlyData[$monthYear])) {
		$monthlyData[$monthYear] = [
		'total' => 0,
		'open' => 0,
		'closed' => 0,
		'approvals' => 0,
		];
	}

	$monthlyData[$monthYear]['total']++;
	
	if ($lender['status'] === 'Open') {
		
		$monthlyData[$monthYear]['open']++;
		
	} elseif ($lender['status'] === 'Closed') {
			
			$monthlyData[$monthYear]['closed']++;
			$monthlyData[$monthYear]['approvals']++;
		}
	}

	foreach ($monthlyData as $monthYear => $data) {
		$totalLoans = $data['total'];
		$openCount = $data['open'];
		$closedCount = $data['closed'];
		$approvalCount = $data['approvals'];

		$approvalRate = $totalLoans > 0 ? ($approvalCount / $totalLoans) * 100 : 0;
		$formattedApprovalRate = number_format($approvalRate, 2);

		$formattedDate = date("F Y", strtotime($monthYear));

	?>
	<tr>
		<td class='lending-td lending-month'><?php echo htmlspecialchars($formattedDate); ?></td>
		<td class='lending-td lending-total-loans'><?php echo htmlspecialchars($totalLoans); ?></td>
		<td class='lending-td lending-open-loans'><?php echo htmlspecialchars($openCount); ?></td>
		<td class='lending-td lending-approvals'><?php echo htmlspecialchars($approvalCount); ?></td>
		<td class='lending-td lending-approval-rate'><?php echo htmlspecialchars($formattedApprovalRate); ?>%</td>
	</tr>
<?php
	}
	if (!$hasLender) {
		echo '<p class="empty" id="loading"><span class="animated-dots">Lending terms is currently empty<span class="dots"></span></span></p>';
	}
?>