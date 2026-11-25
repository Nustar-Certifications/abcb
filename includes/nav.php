<?php

require_once __DIR__ . '/init.php';
?>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span><span class="icon-bar"></span>
				<span class="icon-bar"></span></a>
				<a class="brand" href="<?php echo site_url('index'); ?>"><img src="img/logo.png" alt="logo"/></a>
				<div class="nav-collapse collapse">
					<div id="cssmenu">
						<ul>
							<li class="<?php echo nav_home_class(); ?>"><a href="<?php echo site_url('index'); ?>">Home</a></li>
							<li class="<?php echo nav_li_class('aboutus'); ?>"><a href="<?php echo site_url('aboutus'); ?>"><span>About Us</span></a></li>
							<li class="active has-sub"><a href="#"><span>Accreditation</span></a>
								<ul>
									<li><a href="<?php echo site_url('Benefits'); ?>"><span>Benefits</span></a></li>
									<li><a href="<?php echo site_url('Howto_become_accredited'); ?>"><span>How to become accredited</span></a></li>
									<li><a href="<?php echo site_url('Accredited_Body'); ?>"><span>Accredited Body</span></a></li>
									<li><a href="<?php echo site_url('fee_structure'); ?>"><span>Fees</span></a></li>
								</ul>
							</li>
							<li class="<?php echo nav_li_class('certifiedorganization'); ?>"><a href="<?php echo site_url('certifiedorganization'); ?>"><span>Certified organisation</span></a></li>
							<li class="<?php echo nav_use_of_logo_class(); ?>"><a href="<?php echo site_url('useof_logo'); ?>"><span>Use of Logo</span></a></li>
							<li class="<?php echo nav_li_class('feedback'); ?>"><a href="<?php echo site_url('feedback'); ?>"><span>Feedback</span></a></li>
							<li class="<?php echo nav_li_class('contactus'); ?>"><a href="<?php echo site_url('contactus'); ?>"><span>Contact us</span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>