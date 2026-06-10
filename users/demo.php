<?php include_once("../includes/user_header.php");  ?>

<form method="POST" name="payform" class="pay" action="https://voguepay.com/pay/">
<input type="hidden" name="v_merchant_id" value="demo" />
<input type="hidden" name="merchant_ref" value="67543" />
<input type="hidden" name="memo" value="Payment on Quiz Game" />
<input type="hidden" name="email" value="wasiuonline@gmail.com" />
<input type="hidden" name="notify_url" value="https://quizmoneygame.com/users/success.php" />
<select name="total" class="total" style="width:100%;" required>
<option value="">**Select an amount to pay**</option>
<option value="50">50</option>
<option value="500">500</option>
<option value="1000">1000</option>
<option value="2000">2000</option>
<option value="5000">5000</option>
</select>
<br><br>
<button class="btn btn-danger">Click here to fund your e-wallet with debit/credit card</button>
</form>

<?php include_once("../includes/user_footer.php"); ?>