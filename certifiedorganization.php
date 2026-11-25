<?php
$pageTitle = 'AB-CB';
$currentPage = 'certifiedorganization';
$extraScripts = '

<script>
    $(document).ready(function () {
        $(\'#searchCertification\').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: \'process/search.php\',
                type: \'POST\',
                dataType: \'json\',
                data: $(\'#searchCertification\').serializeArray(),
                beforeSend: function () {
                    $(\'input[type="text"], textarea\').val(\'\');
                },
                success: function (resp) {
                    $(\'.overlay\').addClass(\'hidden\');
                    if (resp.status) {
                        $(\'#certificationNoResult\').addClass(\'hidden\');
                        $(\'#certificationDetail\').removeClass(\'hidden\');
                        var data = resp.message;
                        $(\'.certificationNumber\').html(data.certificationNumber);
                        $(\'.companyName\').html(data.companyName);
                        $(\'.address\').html(data.address);
                        $(\'.scheme\').html(data.scheme);
                        $(\'.validTill\').html(data.validTill);
                    } else {
                        $(\'#certificationNoResult\').removeClass(\'hidden\');
                        $(\'#certificationDetail\').addClass(\'hidden\');
                        $(\'#certificationNoResult\').html(resp.message);
                    }
                }
            });
        });
    });
</script>';
require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/nav.php';
?>
<div class="landing-wides">
		<div class="container">
			<div class="row">
				<div id="about" class="span3 about-us">
					<h2 style="margin-top:-20px; margin-bottom:15px;">Navigation</h2>
					<div class="about"> 
                    <ul>
                    <li>&gt;<a href="index.php"> Home</a></li>
                    <li>&gt; <a href="aboutus.php"> About us </a></li>
                    <li style="padding-left:14px;"><strong>Accreditation</strong></li>
                    <li style="padding-left:13px;"> <a href="Benefits.php">Benefits </a></li>
                    <li style="padding-left:13px;"> <a href="Howto_become_accredited.php">  How to become accredited</a></li>   
                     <li style="padding-left:13px;"><a href="Accredited_Body.php"> Accredited Body </a></li>       
                    <li style="padding-left:13px;"><a href="fee_structure.php"> Fees</a></li>
                    
                    
                    <li>&gt; <a href="certifiedorganization.php"> Certified organisation</a></li>
                    <li>&gt; <a href="useof_logo.php"> Use of Logo</a></li>
                    <li>&gt; <a href="feedback.php">Feedback</a></li>
                    <li>&gt; <a href="contactus.php">Contact Us</a></li>
                    </ul>
                    </div>
                    
				</div>
					<div id="reviews" class="span9 reviews-prods fadeInRight5">
						<h2>Certified organization</h2>
						<ul>
                        <li>  Check out the certificate to Verify the Detail of Certified organization </li>
                               
						</ul>
                                               
                       <p> 
                       <form id='searchCertification'>
                      <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="25%" style="font-size:15px; font-weight:600;">Country</td>
    <td width="75%"> <select class = "form-control">
         <option> </option>

      </select></td>
  </tr>
   <tr>
    <td width="25%" style="font-size:15px; font-weight:600;">Certificate No.  <span style="color:#C03;">*</span></td>
    <td width="75%"> <input style="height:27px;" class= "form-control"  name="certificationNumber" type="text"></td>
  </tr>
    <tr>
    <td width="25%" style="font-size:15px; font-weight:600;">Name</td>
    <td width="75%"> <input style="height:27px;" class= "form-control"  name="companyName" type="text"></td>
  </tr>
</table>
<input type="hidden" name="accredited" value="0">
 <button type="submit" class="btn btn-default">Submit</button>
 
                       </form>
                        <p>
        <p>If you can not verify the desired Certified organization <strong><a href="contactus.php">info@ab-cb.org</a></strong>  </p>
					
                            
                            
                            
                            
                            <div class='panel panel-primary text-center hidden' id='certificationNoResult'></div>
                                <div class="panel panel-primary text-center hidden" id="certificationDetail">
                                    <div class="panel-heading certificationNumber">Certification Number</div>
                                    <div class="panel-body">
                                        <table class="table">
                                                <tr>
                                                    <th>Certification Number</th>
                                                    <th class='certificationNumber'></th>
                                                    
                                                </tr>
                                            
                                                <tr>
                                                    <th>Company Name</th>
                                                    <th class='companyName'></th>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <th class='address'></th>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>Scheme</th>
                                                    <th class='scheme'></th>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>Valid Till</th>
                                                    <th class='validTill'></th>
                                                    
                                                </tr>
                                            
                                        </table>

                                    </div>
                                </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                          </div>  
			</div>
		</div>
            
	</div>
<?php require __DIR__ . '/includes/footer.php'; require __DIR__ . '/includes/scripts.php'; ?>
