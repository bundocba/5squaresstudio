<?php
 defined('_JEXEC') or die;
$pass_late=isset($_POST['password'])?$_POST['password']:"";
 function chec_pass($pass)
 {
 	// $pass=md5($pass);
 	$db=JFactory::getDbo();
	$query = $db->getQuery(true);
	$query->select("count(*)");
	$query->from($db->quoteName("#__request_password"));
	$query->where($db->quoteName('title').'='.$db->quote($pass));
	$db->setQuery($query);
	$count=$db->loadResult();
	return $count;
 }

?>

<?php if ($_GET['r']==1): ?>

 	<?php echo $this->loadTemplate('content');?>
<?php else:?>
	<form action="index.php?option=com_k2&view=item&id=<?php echo $this->item->id;?>" method="post">
		<div class="content-work-top">
			{module 109}
		</div>
		<div class="container content-work-center">
			
				<div class="row">
					<div class="col-md-6 col-xs-6 more">
						<div class="more-detial">
							<p>More showcase</p>
						</div>
					</div>
					<div class="col-md-6 col-xs-6 view">
						<div class="view-detail">
							<p>view portfolio</p>
						</div>
					</div>
				</div>
		</div>
		<div class="content-work-pass">
			<?php echo $this->loadTemplate('key')?>
			
		</div>
		
		<?php if (isset($_POST['submit']) && chec_pass($pass_late)>0): ?>
		<div class="content-work-bottom-product">
			{module 112}
			<script>
				jQuery(document).ready(function($) {
					$('.content-work-pass').css('display','block');
					$('.content-work-bottom').css('display','none');
					$('.more-detial').css('background-color','#919191');
					$('.view-detail').css('background-color','#87754D');
				});
			</script>
		</div>
		<?php elseif(isset($_POST['submit']) && chec_pass($pass_late)<=0): ?>
			<script>
				jQuery(document).ready(function($) {
					$('.content-work-bottom').css('display','none');
					$('.more-detial').css('background-color','#919191');
					$('.view-detail').css('background-color','#87754D');
				});
			</script>
		<?php endif ?>
		<div class="content-work-bottom">
			{module 110}
			
		</div>
		
	</form>
<?php endif ?>
<script>
	jQuery(document).ready(function($) {
		jQuery('.more-detial').click(function(event) {
			jQuery('.more-detial').css("background-color","#87754D");
			jQuery('.view-detail').css("background-color","#919191");
			jQuery('.content-work-bottom').css("display","block");
			jQuery('.content-work-bottom-product').css("display","none");
			jQuery('.content-work-pass').css("display","none");
			// jQuery('.r-work-bottom-product').css("display","none");
		});
		jQuery('.view-detail').click(function(event) {
			jQuery('.view-detail').css("background-color","#87754D");
			jQuery('.more-detial').css("background-color","#919191");
			jQuery('.content-work-bottom').css("display","none");
			jQuery('.content-work-bottom-product').css("display","block");
			jQuery('.content-work-pass').css("display","block");
			// jQuery('.r-work-bottom-product').css("display","none");
		});
		
		//scroll img top
		$('#horiz_container_outer').horizontalScroll();
		$('#horiz_container_outer').draggable();
	});
</script>
 