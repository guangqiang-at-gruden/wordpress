<?php
fEnv::registerComponent( 'Contact Form', 'componentContactForm');
class componentContactForm extends  componentBasic {
	protected $options = array(
	
		'modulename' => array(  'id' =>'html_name',
				'description' => 'Contact Form',
				'type' => 'html_name'),
			
		'title' => array(  'id' => 'title',
				'description' => 'Title',
				'type' => 'text',
				'default' => 'Title'),			
	
        'contact_form_id' => array(  'id' => 'contact_form_id',
                'description' => 'Contact Form 7 Form',
                'type' => 'select',
                'callback_function' => 'components_cf_callback',
                'default' => 'default'),                
     );
	 
	 public function printComponent( $options ) {
     echo '<h2>' . $options['title'] . '</h2>';
	 	$cfID = $options['contact_form_id'];
	 	if( 'nocf7' == $cfID ) {
	 		echo 'You will need to install Contact Form 7 plugin';
	 		return;
	 	}
	 	$shortcode = '[contact-form-7 id="'.$cfID.'"]';
	 	echo do_shortcode( $shortcode );
	 }
}
// EMAIL SENDING
/*if( isset($_POST['contact_form_send_to'] ) && isset($_POST['contact_form_send_title'] ) )  {
	
	$name = $_POST['contact_form_name'];
	$email = $_POST['contact_form_email'];
	$text = $_POST['contact_form_text'];
	
	$message =  "Name : ".$name . "\n";
	$message .= "Email : " . $email . "\n\n";
	$message .= $text;
	
	$headers = 'From: '.$name.' '.$email.'' . "\r\n";
	
	$send_to = $_POST['contact_form_send_to'];
	$send_title = $_POST['contact_form_send_title'];
	
	wp_mail( $send_to, $send_title, $message, $headers );
}*/

function components_cf_callback() {
	$formList = array();
	
	$formsAsWpPosts = get_posts( array( 
										'post_type' => 'wpcf7_contact_form',
										'numberposts' => -1 
								) );
	
	if( empty( $formsAsWpPosts ) )  return array( array('name'=>'You need to install Contact Form 7 Plugin', 'value'=>'nocf7' ) );
	
	foreach( $formsAsWpPosts as $oneForm ) {
		$newForm = array();
		$newForm['name'] = $oneForm->post_title;
		$newForm['value'] = $oneForm->ID;
		$formList[] = $newForm;
	}

	return $formList;
}


?>