<?php 

		$absolute_path = __FILE__;
		$path_to_file = explode( 'wp-content', $absolute_path );
		$path_to_wp = $path_to_file[0];
		require_once( $path_to_wp.'/wp-load.php' );
        global  $wpdb;
        jigoshop_cart::empty_cart();
        global $woocommerce; 
		$woocommerce->cart->empty_cart(); 
		$firstname  = 	$wpdb->escape($_POST['firstName']);
		$lastname	=	$wpdb->escape($_POST['lastName']);
        $email		=	$wpdb->escape($_POST['email']);
        $password	=	$wpdb->escape($_POST['password']);
        $dbirth		=	$wpdb->escape($_POST['displayDate']);
        if($dbirth!='')
        {
        $bdate 		= 	strtotime($dbirth);
        $dateofbirth= 	date( 'Y-m-d', $bdate);
        }
        $today		=	date('Y-m-d');
        $address1	=	$wpdb->escape($_POST['firstAddress']);
        $address2	=	$wpdb->escape($_POST['secondAddress']);
        $city		=	$wpdb->escape($_POST['city']);
        $state		=	$wpdb->escape($_POST['state']);
        $country	=	$wpdb->escape($_POST['country']);
        $zipcode	=	$wpdb->escape($_POST['zipCode']);
		$telephone	=	$wpdb->escape($_POST['telephoneNumber']);
		$mobile		=	$wpdb->escape($_POST['mobileNumber']);
		$salute  	= 	$_POST['salute'];
		$first_qry=$wpdb->get_results("SELECT count(*) as idcount FROM USER_PROFILE where email='$email'");	
        foreach ($first_qry as $query)  {            			
        $idc=$query->idcount;
        }
        if($idc>0){
        $exist="exist";
          }
		else{
		$exist="notexist";
		}
		if(!preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $email))
		{
		echo "email";	
		}
		else if($exist=="exist"){
			
		echo "exist";	
		}
		
		else if(!preg_match("/^[a-zA-Z.'&]+$/i",$firstname))
		{
		echo "fnam";
		}
		else if(!preg_match("/^[a-zA-Z.'&]+$/i",$lastname))
		{
		echo "lnam";
		}
		else if($address1!='' && !ereg("^[[:alpha:][:space:][:digit:]/:\']+$",$address1))
		{
		echo "adr1";
		}
		else if($address2!='' && !ereg("^[[:alpha:][:space:][:digit:]/:\']+$",$address2))
		{
		echo "adr2";
		}
		else if($city!='' && (!ereg("^[[:alpha:][:space:][:digit:]\']+$",$city)))
		{
		echo "city";
		}
		else if($state!='' && (!ereg("^[[:alpha:][:space:][:digit:]\']+$",$state)))
		{
		echo "state";
		}
		else if($country!='' && (!ereg("^[[:alpha:][:space:][:digit:]\']+$",$country)))
		{
		echo "cntry";
		}
		else if($zipcode!='' && (!ereg("^[[:digit:]\']+$",$zipcode)))
		{
		echo "zip";
		}
		else if($telephone!='' && (!ereg("^[[:digit:]\']+$",$telephone)))
		{
		echo "tele";
		}
		else if($mobile!='' && (!ereg("^[[:digit:]\']+$",$mobile)))
		{
		echo "mob";
		}

		else {
		$role="2";
		echo "success";
		if($dateofbirth!=""){
		$data = array('salutation' => $salute,
		'firstname' => $firstname,
		'lastname' => 	$lastname,
		'email' => 		$email,
		'password' =>	$password,
		'dateofbirth' =>$dateofbirth,
		'createddate' =>$today,
		'lastupdated' =>$today,
		'address1' =>	$address1,
		'address2' =>	$address2,
		'city' =>		$city,
		'state' =>		$state,
		'country' =>	$country,
		'zipcode' =>	$zipcode,
		'telephone' =>	$telephone,
		'mobile' =>		$mobile,
		'role_id' =>    $role
		);
		}
		else{
		$data = array('salutation' => $salute,
		'firstname' => $firstname,
		'lastname' => 	$lastname,
		'email' => 		$email,
		'password' =>	$password,
		'createddate' =>$today,
		'lastupdated' =>$today,
		'address1' =>	$address1,
		'address2' =>	$address2,
		'city' =>		$city,
		'state' =>		$state,
		'country' =>	$country,
		'zipcode' =>	$zipcode,
		'telephone' =>	$telephone,
		'mobile' =>		$mobile,
		'role_id' =>    $role
		);
		}
		$_SESSION['databank']=$data;
		$_SESSION['table_name']='USER_PROFILE';
		}
?>
