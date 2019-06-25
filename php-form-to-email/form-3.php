<!-- FOR WEBSITE: https://www.nmccentral.com/alula-webinar/ -->

<!-- Start of Webinar Form 3-->

function show_webinar_form_3_func() {
	
	if (isset($_POST['submit-webinar'])) {
		
		$to = "sales@nmccentral.com";
		
		$subject = "An Attendee wants to RSVP for the June 25, 2019 The OPTEX Bridge and Visual Verification";
	
		$message = "From: " . $_POST['your-name'] . " " . $_POST['your-last-name'] . "<br><br>\nEmail: " . $_POST['your-email'] . "<br><br>\nPhone Number: " . $_POST['your-phone'] ."<br><br>\n
		Company: " . $_POST['your-company'] . "<br><br>\nAttend Method: ". $_POST['attend-method'] . "<br><br>\nNumber of Attendees: " . $_POST['attendees'] . "<br><br>\n
		Attendee Names: " . $_POST['names'];
		
		$headers = array("Cc:info@securitydealermarketing.com","Cc:sdmarketingforms@gmail.com");
		
		
		
		$secret = '6LdCjDYUAAAAADdk60PPDpaeeS3vr_qRefxSXqA0';
		$response = $_POST['g-recaptcha-response'];
		
		
		if ($response) {
			$ch = curl_init();
			
			curl_setopt_array($ch, [
				CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => [
					'secret' => $secret,
					'response' => $response,
				],
				CURLOPT_RETURNTRANSFER => true
			]);
			
			$response = curl_exec($ch);
			curl_close($ch);
			
			  $response = json_decode($response, true);
			  if($response["success"] === true){
				  wp_mail($to,$subject,$message,$headers);
				  header("Location:../thank-you-webinar");
				 # return "<p>Success</p>";
			  }else{
				 # return "<p>Failure</p>";
			  }
		}
		else {
			#return "<p>No Response</p>";
		}
		
	
	}
	
	
	$html = "";
	
	$html .= "
	<style>
		#the-form input,textarea{
			width:196px;
		}
		#the-form textarea {
				height:160px;
		}
	</style>
	<script
        src=\"https://code.jquery.com/jquery-3.2.1.min.js\"
        integrity=\"sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=\"
        crossorigin=\"anonymous\"></script>
	<script>
		function validate() {
			var response = grecaptcha.getResponse();
			var error = '';
			
			if ( $('input[name=\"your-name\"]').val() == '') {
				error = 'no name';
				$('input[name=\"your-name\"]').css('border','red solid 2px');
			}
			else {
				$('input[name=\"your-name\"]').css('border','none');
			}
			
			if ( $('input[name=\"your-last-name\"]').val() == '') {
				error = 'no name';
				$('input[name=\"your-last-name\"]').css('border','red solid 2px');
			}
			else {
				$('input[name=\"your-last-name\"]').css('border','none');
			}
			
			if ( $('input[name=\"your-email\"]').val() == '') {
				error = 'no name';
				$('input[name=\"your-email\"]').css('border','red solid 2px');
			}else { $('input[name=\"your-email\"]').css('border','none'); }
			
			if ( $('input[name=\"your-phone\"]').val() == '') {
				error = 'no name';
				$('input[name=\"your-phone\"]').css('border','red solid 2px');
			} else { $('input[name=\"your-phone\"]').css('border','none'); } 
			
			if ( $('input[name=\"your-company\"]').val() == '') {
				error = 'no name';
				$('input[name=\"your-company\"]').css('border','red solid 2px');
			} else { $('input[name=\"your-company\"]').css('border','none'); }
			
			if ( $('select[name=\"attend-method\"]').val() == '') {
				error = 'no name';
				$('select[name=\"attend-method\"]').css('border','red solid 2px');
			} else { $('select[name=\"attend-method\"]').css('border','none'); }
			
			if ( $('select[name=\"attendees\"]').val() == '') {
				error = 'no name';
				$('select[name=\"attendees\"]').css('border','red solid 2px');
			} else { $('select[name=\"attendees\"]').css('border','none'); } 
			
			if ( $('textarea[name=\"names\"]').val() == '') {
				error = 'no name';
				$('textarea[name=\"names\"]').css('border','red solid 2px');
			} else { $('textarea[name=\"names\"]').css('border','none'); }
			
			if (response.length === 0) {
				alert(\"Please verify with Captcha.\");
				error = 'no captcha';
			}
			
			if (error != '') {
				return false;
			}
			else {
				return true;
			}
			
		}
	</script>
	<form method='post' id='the-form' onSubmit='return validate()'>
		<h3>RSVP Below</h3>
		<h4>If you have any questions please contact us at 1-877-353-3031</h4>
		<p><b>*Required Field</b></p>
		<br>
		<p>First Name*</p>
		<input type='text' name='your-name'>
		<p>Last Name*</p>
		<input type='text' name='your-last-name'>
		<p>Email Address*</p>
		<input type='text' name='your-email'>
		<p>Cell Phone Number*</p>
		<input type='text' name='your-phone'>
		<p>Company*</p>
		<input type='text' name='your-company'>
		<p>How Will You Attend?*</p>
		<select name='attend-method'>
			<option value=''>Select</option>
			<option value='NMC Lake Forest,CA Office'>NMC Lake Forest,CA Office</option>
			<option value='Webinar'>Webinar</option>
		</select>
		<p>Number of Attendees?*</p>
		<select name='attendees'>
		<option value=''>Select</option>
		";
		for ($i=1;$i<=10;$i++) {
			$html .= "<option value='".$i."'>".$i."</option>";
		}
		$html .="
		</select>
		<p>Name of Attendees?*</p>
		<textarea name='names'></textarea>
		<br>
		<input type='submit' name='submit-webinar' value='Register' style=' background: #34acf0 !important; color: #fff; font-size: 1.8em; '>
		<div style='width:304px;margin:2em auto;display:block'>
		<div class=\"g-recaptcha\" data-sitekey=\"6LdCjDYUAAAAAFOjd7e4QSccl9m9mk8xeaR2baGI\"></div>
		</div>
	</form>";
	
	return $html;
}

add_shortcode( 'webinar_form_3', 'show_webinar_form_3_func');

//<!-- End of Webinar Form 3-->
