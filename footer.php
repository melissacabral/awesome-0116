	<footer class="clearfix" id="colophon" role="contentinfo">

		<!-- menu maybe? -->

		
		<?php dynamic_sidebar( 'Footer Area' ); //registered in functions.php ?>		
	</footer><!-- end footer -->
</div><!-- closes #wrapper opened in header.php -->
<?php 
//must call wp_footer right before </body> for JS and plugins to run!
wp_footer();  ?>
</body>
</html>