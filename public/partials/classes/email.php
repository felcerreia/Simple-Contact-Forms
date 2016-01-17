<?php

class scf_Email {



	private $emailcontent;



	/* 
	 * Constructor functions
	 */
	public function __construct() {

		// Do anything first

	}



	/* 
	 * Add content to the email contents
	 */
	public function addToEmailContents($field) {

        // Set the value to use
        if( $field['type'] == 'checkbox' ) {

            $value = $field['value'] ? 'Yes' : 'No';

        } else {

            $value = isset($field['value']) ? $field['value'] : '';

        }

        // Set email contents from the value
        $this->emailcontent .= $field['title'].': '.$value.'<br />';

	}



	/* 
	 * Send the email
	 */
	public function sendEmail($fields, $options) {

		// Set the subject line
		$subject = $options['email_subject'];

		// Set senders
        $email_recipients = explode(",", trim($options['email_recipients']));
        foreach( $email_recipients as $email ) {
        	$senders[] = array(
        		'email' => $email
    		);
    	};

        // Set the headers
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Determine the from details. Check for name field, then email field, then default to 'Enquirer'
        foreach($fields as $field) {

<<<<<<< HEAD
        	if( $field['type'] == 'name' && isset($field['value']) && !isset($sender_name)) $sender_name = $field['value'];

            if( $field['type'] == 'email' && isset($field['value']) && !isset($sender_email) ) $sender_email = $field['value'];
        }

        // Set the from details
        $headers .= "From: " . (!isset($sender_name) ? $sender_name : 'Enquirer') . (!isset($sender_email) ? ' <' . $sender_email . '>' : '') . "\r\n";
=======
        	if( $field['type'] == 'name' && isset($field['value']) ) $sender_name = $field['value'];

            if( $field['type'] == 'email' && isset($field['value']) ) $sender_email = $field['value'];
        }

        // Set the from details
        $headers .= 'From: ' . (!empty($sender_name) ? $sender_name : 'Enquirer') . ' <' . (!empty($sender_email) ? $sender_email : '') . '>' . "\r\n";
>>>>>>> a5d31d015991a8e83f64b994d6bc76a885c0eb05

        // Set the name checker
        $nameIsAbandon = false;

        // Cycle through the fields
        foreach($fields as $field) {

            // Set the field content
<<<<<<< HEAD
        	if( $field['slug']!=='maths' && !$field['exclude'] ) $this->addToEmailContents($field);
=======
        	if( $field['slug']!=='maths' && $field['exclude'] !== true ) $this->addToEmailContents($field);
>>>>>>> a5d31d015991a8e83f64b994d6bc76a885c0eb05

            // Skip this if the name field contains the words "ABANDON" only
            if( $field['type']=='name' && $field['value'] == "ABANDON" ) $nameIsAbandon = true;

        }

        // See if we need to abandon
        if( $nameIsAbandon === true ) {

            // Dump the contents for analysis
            var_dump(
                $senders,
                $subject, 
<<<<<<< HEAD
                $this->emailcontent,
                $headers
=======
                $this->emailcontent
>>>>>>> a5d31d015991a8e83f64b994d6bc76a885c0eb05
            );

        } else {

<<<<<<< HEAD
            foreach($senders as $sendingemail) {
                $final_senders[] = $sendingemail['email']; 
            };

            if(empty($final_senders)) return false;

            // Send the email for each sender
            wp_mail(
                $final_senders, 
                $subject, 
                $this->emailcontent, 
                $headers
            );

        }

        // Write the data to the database
        $scf_db = new SCF_Data_Management();

        // Insert the data
        $scf_db->insertRow($this->emailcontent, 0);

=======
            // Send the email for each sender
            foreach($senders as $sendingemail) {
                mail(
                	$sendingemail['email'], 
                	$subject, 
                	$this->emailcontent, 
                	$headers
            	);
            };

        }

>>>>>>> a5d31d015991a8e83f64b994d6bc76a885c0eb05
	}



} 

?>