<?php

$host = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = "career_hunter";

date_default_timezone_set("UTC");

$db = new PDO("mysql:host=$host;port=$port",
            $username,
            $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("CREATE DATABASE IF NOT EXISTS `$database`");
$db->exec("use `$database`");

function tableExists($dbh, $id) {
    $results = $dbh->query("SHOW TABLES LIKE '$id'");
    if(!$results) {
        return false;
    }
    if($results->rowCount() > 0 ) {
        return true;
    }
    return false;
}

$exists = tableExists($db, "admin");

if (!$exists) {
    //create database
    $db->exec("CREATE TABLE IF NOT EXISTS `admin` ( `admin_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `admin_name` VARCHAR(100) NOT NULL , 
    `admin_contact` INT(12) NOT NULL , 
    `admin_email` VARCHAR(100) NOT NULL , 
    `username` VARCHAR(50) NOT NULL , 
    `password` VARCHAR(15) NOT NULL , 
    PRIMARY KEY (`admin_id`)) ENGINE = InnoDB;");

    $db->exec("CREATE TABLE IF NOT EXISTS `job` ( `job_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `job_title` VARCHAR(100) NOT NULL , 
    `job_type` VARCHAR(100) NOT NULL , 
    `job_salary` VARCHAR(100) NOT NULL , 
    `category_id` INT(11) NOT NULL , 
    `location_id` INT(11) NOT NULL , 
    `company_id` INT(11) NOT NULL , 
    `job_posting_date` DATE NOT NULL , 
    `last_application_date` DATE NOT NULL ,
    `no_of_vacancy` INT(100) NOT NULL ,
    `job_status` VARCHAR(5) NOT NULL , 
    PRIMARY KEY (`job_id`)) ENGINE = InnoDB;");

    $db->exec("CREATE TABLE IF NOT EXISTS `job_category` ( `category_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `category_name` VARCHAR(100) NOT NULL , 
    `admin_id` INT(11) NOT NULL , 
    PRIMARY KEY (`category_id `)) ENGINE = InnoDB;");

    $db->exec("CREATE TABLE IF NOT EXISTS `job_location` ( `location_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `location_name` VARCHAR(100) NOT NULL , 
    `admin_id` INT(11) NOT NULL , 
    PRIMARY KEY (`location_id `)) ENGINE = InnoDB;");

    $db->exec("CREATE TABLE IF NOT EXISTS `company` ( `company_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `company_name` VARCHAR(100) NOT NULL , 
    `company_address` VARCHAR(100) NOT NULL , 
    `company_contact` INT(12) NOT NULL , 
    `company_email` VARCHAR(100) NOT NULL ,
    `company_website` VARCHAR(100) NOT NULL , 
    `username` VARCHAR(50) NOT NULL , 
    `password` VARCHAR(15) NOT NULL , 
    `account_status` VARCHAR(5) NOT NULL , 
    PRIMARY KEY (`company_id `)) ENGINE = InnoDB;");

    $db->exec("CREATE TABLE IF NOT EXISTS `applicant` ( `applicant_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `applicant_name` VARCHAR(100) NOT NULL , 
    `applicant_contact` INT(12) NOT NULL , 
    `applicant_email` VARCHAR(100) NOT NULL , 
    `highest_education` VARCHAR(50) NOT NULL , 
    `gender` VARCHAR(10) NOT NULL , 
    `username` VARCHAR(50) NOT NULL , 
    `password` VARCHAR(15) NOT NULL , 
    PRIMARY KEY (`applicant_id `)) ENGINE = InnoDB;");

    $db->exec("CREATE TABLE IF EXISTS `applicant_credential` ( `credential_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `credential_name` VARCHAR(100) NOT NULL , 
    `file_upload` VARCHAR(100) NOT NULL , 
    `applicant_id` INT(11) NOT NULL , 
    PRIMARY KEY (`credential_id `)) ENGINE = InnoDB;");

    $db->exec("CREATE TABLE IF NOT EXISTS `application_detail` ( `application_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `applicant_id` INT(11) NOT NULL , 
    `job_id` INT(11) NOT NULL , 
    `application_status` VARCHAR(5) NOT NULL , 
    PRIMARY KEY (`application_id `)) ENGINE = InnoDB;");

    $admin = array(
        array('admin_name' => 'admin',
        'admin_contact' => '0177386937',
        'admin_email' => 'admin@gmail.com',
        'username' => 'admin',
        'password' => '1234')
    );

    $insert = "INSERT INTO admin (admin_name, admin_contact, admin_email, username, password ) VALUES (:admin_name, :admin_contact, :admin_email, :username, :password)";
    $stmt = $db->prepare($insert);

    $stmt->bindParam(':admin_name', $admin_name);
    $stmt->bindParam(':admin_contact', $admin_contact);
    $stmt->bindParam(':admin_email', $admin_email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    foreach ($admin as $a) {
        $admin_name = $a['admin_name'];
        $admin_contact = $a['admin_contact'];
        $admin_email = $a['admin_email'];
        $username = $a['username'];
        $password = $a['password'];
        $stmt->execute();
    }

    $company = array(
        array('company_name' => 'UCDesign',
        'company_address' => 'Johor',
        'company_contact' => '078643728',
        'company_email' => 'ucdesign@gmail.com',
        'company_website' => 'ucdesign.weebly.com',
        'username' => 'ucdesign',
        'password' => '1234',
        'account_status' => 'A')
    );

    $insert = "INSERT INTO company (company_name, company_address, company_contact, company_email, company_website, username, password, account_status)
    VALUES (:company_name, :company_address, :company_contact, :company_email, :company_website, :username, :password, :account_status)";
    $stmt = $db->prepare($insert);

    $stmt->bindParam(':company_name', $company_name);
    $stmt->bindParam(':company_address', $company_address);
    $stmt->bindParam(':company_contact', $company_contact); 
    $stmt->bindParam(':company_email', $company_email); 
    $stmt->bindParam(':company_website', $company_website); 
    $stmt->bindParam(':username', $username); 
    $stmt->bindParam(':password', $password); 
    $stmt->bindParam(':account_status', $account_Status); 

    foreach (company as $c) {
        $company_name = $c['company_name'];
        $company_address = $c['company_name'];
        $company_contact = $c['company_address'];
        $company_email = $c['company_email'];
        $company_website = $c['company_website'];
        $username = $c['username'];
        $password = $c['password'];
        $account_Status = $c['account_status'];
        $stmt->execute();
    }

}

?>