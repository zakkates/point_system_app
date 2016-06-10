</div><!-- end container -->
<footer>
    <div class="container">
        Earn a Point!<?php if ($_SESSION['id']): ?> - <a href="index.php?logout=1">Log Out</a><?php endif; ?>
    </div><!-- end container -->
</footer>
<script>
if (window.navigator.standalone) {
    // The app is running in standalone mode.
	$('header').css('padding-top',20);
}
</script>