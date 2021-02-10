<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/incLoadScreen.php 2 2019-06-20 18:03:22Z scottauge $

function LoadScreen ($ScreenName) {
	?>
	<script type="text/javascript">
	window.location="<?php echo $ScreenName; ?>";
	</script>
	<?php
}
?>

<?php
// Unit test
/*
LoadScreen("index.php");
*/
?>
