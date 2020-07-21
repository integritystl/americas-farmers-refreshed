<?php
namespace AmericasFarmers;

use GuzzleHttp\Client;

class SalesforceAPICalls
{	
	public static function setSalesforceACFFields()
	{
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5b200da3bbda8',
				'title' => 'Salesforce API Config',
				'fields' => array(
					array(
						'key' => 'field_5b200daab2b2d',
						'label' => 'Client ID',
						'name' => 'client_id',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5b200db9b2b2e',
						'label' => 'Client Secret',
						'name' => 'client_secret',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5b200dc1b2b2f',
						'label' => 'Environment',
						'name' => 'environment',
						'type' => 'radio',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'test' => 'Test',
							'prod' => 'Production',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => '',
						'layout' => 'vertical',
						'return_format' => 'value',
					),
					array(
						'key' => 'field_5b29654af33f4',
						'label' => 'Nomination Info Link',
						'name' => 'nomination_info_link',
						'type' => 'page_link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'post_type' => array(
							0 => 'page',
						),
						'taxonomy' => array(
						),
						'allow_null' => 0,
						'allow_archives' => 1,
						'multiple' => 0,
					),
					array(
						'key' => 'field_5b296dbb87384',
						'label' => 'Nomination Fulfillment Link',
						'name' => 'nomination_fulfillment_link',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'salesforce_api_config',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));

			endif;
	}
	/**
	* Authenticates with the SF API
	* @return Object containing an 'access_token' which is used to auth other endpoints
	* Currently just returns false on error
	**/
	public static function authenticate()
	{
		//Create a guzzle client
		$client = new Client();
		
		/**
		* @todo place this data somewhere better than in src control
		**/
		
		//Check the environment and grab the right endpoint
		$environment = get_field('environment', 'options');
		if($environment == 'test'){
			$authUrl = 'https://test.amp.monsanto.com/as/token.oauth2?grant_type=client_credentials';
		} else if ($environment == 'prod') {
			$authUrl = 'https://amp.monsanto.com/as/token.oauth2?grant_type=client_credentials';
		}
		//Grab our client id and secret
		$client_id = get_field('client_id', 'options');
		$client_secret = get_field('client_secret', 'options');
		$request_info = [
			'form_params' => [
				'client_id' => $client_id,
				'client_secret' => $client_secret
			]
		];

		try {
			$response = $client->post($authUrl, $request_info);
			$status = $response->getStatusCode();

			$returnData = json_decode($response->getBody());

			return $returnData;
		}
		catch (Exception $e) {
		    return false;
		}
	}

	/**
	* Gets winner data for programs
	* 'category' is which program to pull, valid keys are GrowAgLeaders, GrowCommunities, and GrowRuralEduction
	* Just returns false on error for now
	* @todo store varables not like an idiot
	**/
	public static function getWinners($program, $year, $state)
	{
		//Call auth and get the token back
		$authorization = self::authenticate();

		if($authorization) {
			$access_token = $authorization->access_token;
		}
		else {
			return false;
		}
		
		$client = new Client();

		//Check the environment and grab the right endpoint
		$environment = get_field('environment', 'options');
		if($environment == 'test'){
			$endpoint = 'https://mongateway-t.monsanto.com:443/AmericasFarmersWinnerUpdate';
		} else if ($environment == 'prod') {
			$endpoint = 'https://mongateway.monsanto.com:443/AmericasFarmersWinnerUpdate';
		}

		try {
			$headers = array(
				'Authorization' => 'Bearer ' . $access_token,
				'category' => $program,
				'year' => $year,
				'state' => $state
			);

			//they have added additional headers for retrieving GrowAgLeaders winners. idk why
			//add additional headers if necessary
			//GrowAgLeaders is not using API call anymore
//			if($program === 'GrowAgLeaders'){
//				$headers['scholarshipname'] = "America's Farmers Grow Ag Leaders Scholarship Program";
//				$headers['winner'] = $year;
//			}

			$response = $client->get($endpoint, [
				'headers' => $headers
			]);
			
			$returnData = json_decode($response->getBody());
			
			return $returnData;
		}
		catch (Exception $e) {
		    return false;
		}
	}

	public static function getNominationSchoolsList($state)
	{
		//Call auth and get the token back
		$authorization = self::authenticate();

		if($authorization) {
			$access_token = $authorization->access_token;
		}
		else {
			return false;
		}
		
		$client = new Client();

		//Check the environment and grab the right endpoint
		$environment = get_field('environment', 'options');
		if($environment == 'test'){
			$endpoint = 'https://mongateway-t.monsanto.com/GREnominationCount';
		} else if ($environment == 'prod') {
			$endpoint = 'https://mongateway.monsanto.com/GREnominationCount';
		}

		try {
			$response = $client->get($endpoint, [
				'headers' => [
					'Authorization' => 'Bearer ' . $access_token,
					'content-type' => 'application/json',
					'state' => $state
				]
			]);
			$status = $response->getStatusCode();
		
			$returnData = json_decode($response->getBody());
			return $returnData;
		}
		catch (Exception $e) {
		    return false;
		}

	}

	/**
	* Pass a school ID pulled from getNominationSchoolsList and this will return you the # of nominations, or that there are none.
	**/
	public static function getNominationCount($schoolId)
	{
		//Call auth and get the token back
		$authorization = self::authenticate();
		
		if($authorization) {
			$access_token = $authorization->access_token;
		}
		else {
			return false;
		}
		
		$client = new Client();

		//Check the environment and grab the right endpoint
		$environment = get_field('environment', 'options');
		if($environment == 'test'){
			$endpoint = 'https://mongateway-t.monsanto.com/GREnominationCount';
		} else if ($environment == 'prod') {
			$endpoint = 'https://mongateway.monsanto.com/GREnominationCount';
		}

		try {
			$response = $client->get($endpoint, [
				'headers' => [
					'Authorization' => 'Bearer ' . $access_token,
					'content-type' => 'application/json',
					'schoolId' => $schoolId
				]
			]);

			$returnData = json_decode($response->getBody());
			return $returnData;
		}
		catch (Exception $e) {
		    return false;
		}
	}

	public static function GetGCEnrollmentByCode($code){
		//Call auth and get the token back
		$authorization = self::authenticate();
		
		if($authorization) {
			$access_token = $authorization->access_token;
		}
		else {
			return false;
		}
		
		$client = new Client();

		//Check the environment and grab the right endpoint
		$environment = get_field('environment', 'options');
		if($environment == 'test'){
			$endpoint = 'https://mongateway-t.monsanto.com:443/AmericasFarmersEnrollment?EnrollmentCode=' . $code;
		} else if ($environment == 'prod') {
			$endpoint = 'https://mongateway.monsanto.com:443/AmericasFarmersEnrollment?EnrollmentCode=' . $code;
		}

		try {
			$response = $client->get($endpoint, [
				'headers' => [
					'Authorization' => 'Bearer ' . $access_token,
					'content-type' => 'application/json',
				]
			]);

			$returnData = json_decode($response->getBody());
			return $returnData;
		}
		catch (Exception $e) {
		    return false;
		}
	}

	public static function GetRuralEnrollmentByCode($code){
		//Call auth and get the token back
		$authorization = self::authenticate();
		
		if($authorization) {
			$access_token = $authorization->access_token;
		}
		else {
			return false;
		}
		
		$client = new Client();

		//Check the environment and grab the right endpoint
		$environment = get_field('environment', 'options');
		if($environment == 'test'){
			$endpoint = 'https://mongateway-t.monsanto.com:443/AmericasFarmersGRE?EnrollmentCode=' . $code;
		} else if ($environment == 'prod') {
			$endpoint = 'https://mongateway.monsanto.com:443/AmericasFarmersGRE?EnrollmentCode=' . $code;
		}

		try {
			$response = $client->get($endpoint, [
				'headers' => [
					'Authorization' => 'Bearer ' . $access_token,
					'content-type' => 'application/json',
				]
			]);

			$returnData = json_decode($response->getBody());
			return $returnData;
		}
		catch (Exception $e) {
		    return false;
		}
	}

	public static function GCEnrollmentSubmission(){
		//First set up the object we will submit
		$submissionData = array(
			"ErrorDetails" => '',
			"RequestStatus" => "",
			"Agrees_to_Official_Rules" => true,
			"city"=> $_POST['city'],
			"County_ID" => $_POST['enroll_county'],
			"County_Name" => $_POST['enroll_county'],
			"Email" => $_POST['email'],
			"Facebook_Username" => '',
			"First_Name" => $_POST['first_name'],
			"Is_21_or_older" => true,
			"Is_Seed_Dealer" => false,
			"Is_Spouse_Seed_Dealer" => false,
			"Last_Name" => $_POST['last_name'],
			"Organization_Name" => '',
			"Organization_Type" => '',
			"Organization_Type_Id" => '',
			"Phone" => $_POST['phone'],
			"Prefix" => '',
			"State" => $_POST['enroll_state'],
			"Status" => '',
			"Street_1" => $_POST['address'],
			"Street_2" => $_POST['apartment'],
			"Twitter_Username" => "",
			"Uses_Social_Media" => false,
			"Zip_Postal_Code" => $_POST['zip']
		);

		//Save this submission to the DB, if that plugin is enabled
		if ( function_exists( 'save_communities_enrollment' ) ) {
			$ID = save_communities_enrollment($submissionData);
		}

		$submissionPayload = json_encode($submissionData);

		// Cool beans lets send it
		//Call auth and get the token back
		$authorization = self::authenticate();
		
		if($authorization) {
			$access_token = $authorization->access_token;
		}
		else {
			return false;
		}
		
		$client = new Client();

		//Check the environment and grab the right endpoint
		$environment = get_field('environment', 'options');
		if($environment == 'test'){
			$endpoint = 'https://mongateway-t.monsanto.com:443/AmericasFarmersEnrollment';
		} else if ($environment == 'prod') {
			$endpoint = 'https://mongateway.monsanto.com:443/AmericasFarmersEnrollment';
		}

		try {
			$response = $client->post($endpoint, [
				'headers' => [
					'Authorization' => 'Bearer ' . $access_token,
					'content-type' => 'application/json',
				],
				'body' => $submissionPayload,
			]);

			$returnData = json_decode($response->getBody());

			//Looks like we are good to go, so flip that submission to successful
			if ( function_exists('update_communities_enrollment_success') ) {
				update_communities_enrollment_success($ID);
			}

			return $returnData;
		}
		catch (Exception $e) {
		    return false;
		}
	}

	public static function RuralEnrollmentSubmission(){
		//First set up the object we will submit
		$submissionData = array(
			"ErrorDetails" => '',
			"Agrees_to_Official_Rules" => true,
			"city"=> $_POST['city'],
			"County_ID" => $_POST['enroll_school_county_id'],
			"County_Name" => $_POST['enroll_county'],
			"Email" => $_POST['email'],
			"First_Name" => $_POST['first_name'],
			"Is_21_or_older" => true,
			"Last_Name" => $_POST['last_name'],
			"Phone" => $_POST['phone'],
			"Cell_Phone" => $_POST['mobile'],
			"Prefix" => '',
			"State" => $_POST['enroll_state'],
			"Status" => '',
			"NCES_ID" => $_POST['enroll_school_district'],
			"Street_1" => $_POST['address'],
			"Street_2" => $_POST['apartment'],
			"Eligible_School_District_County" => $_POST['enroll_school_county'],
			"School_District" => $_POST['enroll_school_district_name'],
			"Twitter_Username" => "",
			"Uses_Social_Media" => null,
			"Zip_Postal_Code" => $_POST['zip'],
			"Is_Seed_Dealer" => false
		);
		$submissionPayload = json_encode($submissionData);
		//wp_die($submissionPayload);
		//Save this submission to the DB, if that plugin is enabled
		if ( function_exists( 'save_rural_education_enrollment' ) ) {
			$ID = save_rural_education_enrollment($submissionData);
		}
		// Cool beans lets send it
		//Call auth and get the token back
		$authorization = self::authenticate();
		
		if($authorization) {
			$access_token = $authorization->access_token;
		}
		else {
			return false;
		}
		
		$client = new Client();

		//Check the environment and grab the right endpoint
		$environment = get_field('environment', 'options');
		if($environment == 'test'){
			$endpoint = 'https://mongateway-t.monsanto.com:443/AmericasFarmersGRE';
		} else if ($environment == 'prod') {
			$endpoint = 'https://mongateway.monsanto.com:443/AmericasFarmersGRE';
		}

		try {
			$response = $client->post($endpoint, [
				'headers' => [
					'Authorization' => 'Bearer ' . $access_token,
					'content-type' => 'application/json',
				],
				'body' => $submissionPayload,
			]);

			$returnData = json_decode($response->getBody());

			//Looks like we are good to go, so flip that submission to successful
			if ( function_exists('update_rural_education_enrollment_success') ) {
				update_rural_education_enrollment_success($ID);
			}
			return $returnData;
		}
		catch (Exception $e) {
		    return false;
		}
	}
}