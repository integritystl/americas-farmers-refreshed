<?php
/*
Plugin Name: Monsanto Enrollment Cache
Plugin URI: 
Description: Saves Enrollment attempts for Americas Farmers
Version: 1.0.0
Author: Integrity STL
Author URI: http://www.integritystl.com
*/

/**
*
* Handles adding relevant tables to save enrollments to
*
**/
function enrollment_cache_activate()
{
	global $wpdb;
	
	//Set the name of our first table
	$table_name = $wpdb->prefix . "grow_communities_enrollment";

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		created_at timestamp DEFAULT CURRENT_TIMESTAMP,
		city varchar(255),
		County_ID varchar(255),
		County_Name varchar(255),
		Email varchar(255),
		First_Name varchar(255),
		Last_Name varchar(255),
		Phone varchar(255),
		State varchar(255),
		Street_1 varchar(255),
		Street_2 varchar(255),
		Zip_Postal_Code varchar(255),
		successfully_submitted boolean DEFAULT false,
		PRIMARY KEY (id)
	) $charset_collate;";

	$rural_table_name = $wpdb->prefix . "rural_education_enrollment";
	$ruralSql = "CREATE TABLE $rural_table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		created_at timestamp DEFAULT CURRENT_TIMESTAMP,
		city varchar(255),
		County_ID varchar(255),
		County_Name varchar(255),
		Email varchar(255),
		First_Name varchar(255),
		Last_Name varchar(255),
		Phone varchar(255),
		Cell_Phone varchar(255),
		State varchar(255),
		Street_1 varchar(255),
		Street_2 varchar(255),
		Zip_Postal_Code varchar(255),
		NCES_ID varchar(255),
		Eligible_School_District_County varchar(255),
		School_District varchar(255),
		successfully_submitted boolean DEFAULT false,
		PRIMARY KEY (id)
	) $charset_collate;";

	//Include relevant library and make dat table
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	dbDelta($ruralSql);

	add_option('grow_communities_db_version', '1.0');
	
}

/**
*
* function to save a new Grow Communities Enrollment
*
**/
function save_communities_enrollment($enrollment_data){
	global $wpdb;
	$insertSuccess = $wpdb->insert(
		$wpdb->prefix . 'grow_communities_enrollment',
		array(
			'city' => $enrollment_data['city'],
			'County_ID' => $enrollment_data['County_ID'],
			'County_Name' => $enrollment_data['County_Name'],
			'Email' => $enrollment_data['Email'],
			'First_Name' => $enrollment_data['First_Name'],
			'Last_Name' => $enrollment_data['Last_Name'],
			'Phone' => $enrollment_data['Phone'],
			'State' => $enrollment_data['State'],
			'Street_1' => $enrollment_data['Street_1'],
			'Street_2' => $enrollment_data['Street_2'],
			'Zip_Postal_Code' => $enrollment_data['Zip_Postal_Code']
		)
	);
	if($insertSuccess) {
		$insertID = $wpdb->insert_id;
		return $insertID;
	}
	else {
		return false;
	}
}
/**
*
* Handles updating an enrollment as successfully submitted to SF
*
**/
function update_communities_enrollment_success($id){
	global $wpdb;
	$updateSuccess = $wpdb->update(
		$wpdb->prefix . 'grow_communities_enrollment',
		array(
			'successfully_submitted' => true
		),
		array( 'id' => $id)
	);
	return $updateSuccess;
}

/**
*
* function to save a new Grow Communities Enrollment
*
**/
function save_rural_education_enrollment($enrollment_data){
	global $wpdb;
	$insertSuccess = $wpdb->insert(
		$wpdb->prefix . 'rural_education_enrollment',
		array(
			'city' => $enrollment_data['city'],
			'County_ID' => $enrollment_data['County_ID'],
			'County_Name' => $enrollment_data['County_Name'],
			'Email' => $enrollment_data['Email'],
			'First_Name' => $enrollment_data['First_Name'],
			'Last_Name' => $enrollment_data['Last_Name'],
			'Phone' => $enrollment_data['Phone'],
			'State' => $enrollment_data['State'],
			'Street_1' => $enrollment_data['Street_1'],
			'Street_2' => $enrollment_data['Street_2'],
			'Zip_Postal_Code' => $enrollment_data['Zip_Postal_Code'],
			'School_District' => $enrollment_data['School_District'],
			'Eligible_School_District_County' => $enrollment_data['Eligibile_School_District_County'],
			'NCES_ID' => $enrollment_data['NCES_ID']
		)
	);
	if($insertSuccess) {
		$insertID = $wpdb->insert_id;
		return $insertID;
	}
	else {
		return false;
	}
}
/**
*
* Handles updating an enrollment as successfully submitted to SF
*
**/
function update_rural_education_enrollment_success($id){
	global $wpdb;
	$updateSuccess = $wpdb->update(
		$wpdb->prefix . 'rural_education_enrollment',
		array(
			'successfully_submitted' => true
		),
		array( 'id' => $id)
	);
	return $updateSuccess;
}

/**
*
* Add an admin page
*
**/
function monsanto_enrollment_cache_admin_page(){
	add_menu_page( 'Enrollments Submissions', 'Enrollment Submissions', 'manage_options', 'enrollment-submissions', 'monsanto_enrollment_admin_content', 'dashicons-awards');
}

/**
*
* Content for admin page. Query is very bare bones and manual. When flipping to rural, will need to update this to pull rural enrollments instead. Each year will need to add a select for the relevant year.
*
**/
function monsanto_enrollment_admin_content() {
	global $wpdb;
	$tablename = $wpdb->prefix . 'grow_communities_enrollment';
	buildEnrollmentStats($tablename, 'Grow Communities');

	echo("<br/><br/>");

	$tablename = $wpdb->prefix . 'rural_education_enrollment';
	buildEnrollmentStats($tablename, 'Rural Education');
}

function buildEnrollmentStats($tablename, $program_name){
	global $wpdb;
    date_default_timezone_set('America/Chicago');
	$currentYear = date('Y') . '-01-01 00:00:00';
	$successfulEnrollments = $wpdb->get_results(
		"
		SELECT *
		FROM $tablename
		WHERE successfully_submitted = 1 AND created_at > '$currentYear'
		"
	);
	$failedEnrollments = $wpdb->get_results(
		"
		SELECT *
		FROM $tablename
		WHERE successfully_submitted = 0 AND created_at > '$currentYear'
		"
	);
	echo "<h1>$program_name Current Enrollment</h1>";
	echo "<p>This simply provides an overview of the volume of failures held in the database. To get an export, please contact Integrity</p>";
	echo "<h3>Successful Enrollments: " . count($successfulEnrollments) . "</h3>";
	echo "<h3>Failed Enrollments: " . count($failedEnrollments) . "</h3>";
}

register_activation_hook(__FILE__, 'enrollment_cache_activate');
add_action("admin_menu", "monsanto_enrollment_cache_admin_page");