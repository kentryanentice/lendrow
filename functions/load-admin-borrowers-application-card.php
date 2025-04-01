<?php
include '../php/admin-session.php';
include '../php/admin-borrowers-lending-terms-functions.php';

		$searchLendingTerms = isset($_GET['searchLendingTerms']) ? $_GET['searchLendingTerms'] : '';
		$lender = getLendingTerms($connection, $searchLendingTerms = '');
						
			foreach ($lender as $lender) {
			$id = $lender['id'];
		?>
		
			<div class="application-card" id="applyCard<?php echo htmlspecialchars($lender['id']); ?>">
			<h2>Lending Terms</h2>
			<form action="php/admin-borrowers-borrow" id="admin-borrow" method="POST" enctype="multipart/form-data">
			
			<input type="hidden" name="lending-terms-id" value="<?php echo htmlspecialchars($lender['id']); ?>" readonly>
			
			<div class="agreement">
			<p>The terms below is effective as of <span class="blue-text"><?php echo htmlspecialchars(date("F d, Y h:i A", strtotime($lender['created_at']))); ?></span>. This will serve as a proof that I, <span class="blue-text"><?php echo htmlspecialchars($admin['firstname']); ?> <?php echo htmlspecialchars($admin['middlename']); ?> <?php echo htmlspecialchars($admin['lastname']); ?></span> will be borrowing an amount of <span class="blue-text">PHP <?php echo htmlspecialchars($lender['amount']); ?></span> with a <span class="blue-text"><?php echo htmlspecialchars($lender['interest']); ?></span> Interest from <span class="blue-text"><?php echo htmlspecialchars($lender['lendername']); ?></span>, which to be paid within <span class="blue-text"><?php echo htmlspecialchars($lender['term']); ?></span>, a monthly interest rate of <span class="blue-text">PHP <?php echo htmlspecialchars($lender['monthly']); ?></span> and fully disclose my <span class="blue-text">credit history.</span></p>
			
			</div>
			
			<div class="apply-card-input-file">
			
			<?php 
			if ($lender['collateral'] === 'Property') { 
			?>
				<label class="apply-card-label">Attach a Proof of any Property Ownership (less than 2MB)
					<span class="icon"><i class='bx bx-question-mark'></i></span>
					
					<p class="collateral-list"><span class="enhance">Property Collateral Lists</span><br/>
					
					Required Proof for Authenticity<br/>
					
					Transfer Certificate of Title (TCT)<br/>
					&nbsp;- For titled land and properties.<br/>
					Tax Declaration<br/>
					&nbsp;- For untitled properties or additional verification.<br/>
					Deed of Sale or Lease Agreement<br/>
					&nbsp;- For recently acquired or leased properties.<br/>
					Real Property Tax Receipts<br/>
					&nbsp;- To show the property is tax-compliant.</p>
				</label>
			<?php 
			} elseif ($lender['collateral'] === 'Cars') { 
			?>
				<label class="apply-card-label">Attach a Proof of any Car Ownership (less than 2MB)
					<span class="icon"><i class='bx bx-question-mark'></i></span>
					
					<p class="collateral-list"><span class="enhance">Cars Collateral Lists</span><br/>
					
					Required Proof for Authenticity<br/>
					
					Certificate of Registration (CR)<br/>
					&nbsp;- For registered vehicles.<br/>
					Original Receipt (OR)<br/>
					&nbsp;- Proof of payment for vehicle registration.<br/>
					Deed of Sale<br/>
					&nbsp;- For newly purchased or owned vehicles.<br/>
					Franchise or Permit<br/>
					&nbsp;- Authorization for public utility vehicles.</p>
				</label>
			<?php
			} elseif ($lender['collateral'] === 'Items') { 
			?>
				<label class="apply-card-label">Attach a Proof of any Item Ownership (less than 2MB)
					<span class="icon"><i class='bx bx-question-mark'></i></span>
					
					<p class="collateral-list"><span class="enhance">Items Collateral Lists</span><br/>
					
					Required Proof for Authenticity<br/>
					
					Purchase Receipt<br/>
					&nbsp;- A formal receipt from the store or seller.<br/>
					Certificate of Authenticity<br/>
					&nbsp;- A document confirming the item is genuine..<br/>
					Warranty Card<br/>
					&nbsp;- Proof of repairs or replacements protections.<br/>
					Appraisal Certificate<br/>
					&nbsp;- Item’s value and authenticity verification.</p>
				</label>
			<?php
			}
			?>
				
				<i class='bx bx-image-add'></i>
				<input class="file" type="file" placeholder="Collateral" name="collateral" id="collateral-<?php echo htmlspecialchars($lender['id']); ?>" oninput="validateCollateral(<?php echo htmlspecialchars($lender['id']); ?>)">
				<span class="collateral-error" id="collateral-error-<?php echo htmlspecialchars($lender['id']); ?>"></span>
			</div>
			
			<div class="check">
			<input type="checkbox" required><label>I agree with the above terms and conditions.</label>
			</div>
			
			
			<span class="apply-empty-error" id="apply-empty-error-<?php echo htmlspecialchars($lender['id']); ?>"></span>
			<div class="apply-card-buttons">
				
				<?php
					
				if ($lender['status'] === 'Open') { 
				?>	
				
				<div class="close" onclick="hideApplyCard(<?php echo htmlspecialchars($lender['id']); ?>)">Close</div>
				<button type="submit" class="apply">Apply</button>
				
				<?php 
					} elseif ($lender['status'] === 'Closed') { 
				?>
				
				<div class="close" onclick="hideApplyCard(<?php echo htmlspecialchars($lender['id']); ?>)">Close</div>
				
				<?php
					}
				?>
				
			</div>
			
			</form>
			</div>
		
		<?php
			}
		?>