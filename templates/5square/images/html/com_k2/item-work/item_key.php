<div class="content-work-pass-title">
	<p>Please input password to view our portfolio or send us a message to request for accessibility</p>
</div>
<div class="row content-work-pass-detail">
	<div class="col-md-6 col-xs-6 key">
		<div class="more-key">
			<input class="password" type="password" name="password" placeholder="input code">
			<input class="submit" type="submit" name="submit" value="">
		</div>
	</div>
	<div class="col-md-6 col-xs-6 pass">
		<div class="more-pass">
			<p><a href="index.php?option=com_rsform&view=rsform&formId=3&Itemid=128">request password</a>  </p>
		</div>
	</div>
	<p class="error-key">You have entered the wrong password !</p>
	
	<?php if (isset($_POST['submit']) && chec_pass($pass_late)<=0): ?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		jQuery('.content-work-pass-detail .error-key').css("display","block");
		jQuery('.content-work-pass').css("display","block");
	});	
	</script>
	
	<?php endif ?>
</div>