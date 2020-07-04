<script>var base_url_js = '<?=base_url();?>';</script>
<!-- <script src="<?=base_url()?>public/assets/plugins/jquery/jquery.min.js"></script> -->

<link href="<?=base_url()?>public/assets/css/notification.css" rel="stylesheet">

<script src="<?php echo base_url();?>public/assets/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="<?php echo base_url();?>public/assets/js/pages/ui/notifications.js"></script>
<!-- <script src="<?php echo base_url();?>public/assets/js/soundmanager2.js"></script> -->
<!-- Open chrome://flags/#autoplay-policy
Setting No user gesture is required
Relaunch Chrome -->
<?php
	if(isset($_SESSION["THONGBAO"])){
		// print_r($_SESSION["THONGBAO"]); return;
?>
<script>
var base_url_js = '<?=base_url();?>';
$(function(){
	var icon = "<?= $_SESSION["THONGBAO"]['icon']; ?>";

	var title = "<?= $_SESSION["THONGBAO"]['title']; ?>";
	var message = "<?= $_SESSION["THONGBAO"]['message']; ?>";
	var url = "<?= $_SESSION["THONGBAO"]['url']; ?>"; //url noti
	var type = "<?= $_SESSION["THONGBAO"]['type']; ?>";//success, danger, info, warning
	shownoti(icon,title,message,url,type);

});

</script>
<?php
	unset($_SESSION["THONGBAO"]);
} ?>
