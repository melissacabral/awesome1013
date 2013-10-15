<?php 
/*
Sidebar for Standard Pages
To load this file, use
get_sidebar('page')
*/
?>
<aside id="sidebar"> 
	<?php 
	//display the widget area registered in functions.php
	dynamic_sidebar('page-sidebar'); ?>	
</aside><!-- end #sidebar -->