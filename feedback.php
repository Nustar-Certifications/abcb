<?php
$pageTitle = 'AB-CB';
$currentPage = 'feedback';
$extraScripts = '';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
?>
<div class="container">
				<div class="span4" style="margin-top:100px;">
					<h3> Feedback </h3>

				</div>
			</div>
		
	<div class="landing-wide nop">
		
		<div class="container">
			<p style="margin-top:16px; font-weight:800; color:#333;"> Please feedback us</p>
			<div id="newsletter" class="wide-newsletter gray opacity-none fadeInRight1">
         	<form  action="form.php" method="post">
				<style>
                .special input{width:50%;height:50px;border:none;height:35px;border-radius:2px;}
                </style>
				<div class="row special" style="color:#333 !important;width:100%;">
					<input type="text" name="name" value="Your Name" style="color:#333;" required placeholder="Your Name" class="span5"/>
										
				
				
					<input type="email" name="email" value="E-mail" required placeholder="E-mail" class="span5"/>
										
			
					
					<input type="text" name="phone" value="Phone" required placeholder="Phone" class="span5"/>
					
					
			
					
					<input type="textarea" name="comment" value="Message" required placeholder="Message" style="height:100px;" class="span5"/><br></br>
                    
				<button class="btn btn-success btn-large" name="feedback">Submit</button>
                    
					</div>
				</form>
                
              
			</div>
		</div>
	</div>
<?php require __DIR__ . '/includes/footer.php'; require __DIR__ . '/includes/scripts.php'; ?>
