<?php
    require_once('ripcord/ripcord.php');

	//$url = "http://host.docker.internal:8070";
	$url = "http://web:8069";
	// $url = "http://host.docker.odoo:8070";
	$db = "odoo_v16";
	$username = "api@admin.fr";
	// $username = "admin@admin.fr";
	$password = "734c4ecee6c4c1f29186b1da48a333d1cb04745d";
	// $password = "16e4be8b034172e4703c5f6c46e4bba2422e1f99";


	$common = ripcord::client($url."/xmlrpc/2/common");
	$common->version();
	$uid = $common->authenticate($db, $username, $password, array());
	if(!empty($uid)){
        echo "<p>Successfully sign in Odoo API with the user id of : " . $uid . '</p>';
 
        $models = ripcord::client("$url/xmlrpc/2/object");
 
        // an example of how to call 'search' the public method
        // $partners = $models->execute_kw($db, $uid, $password, 'rentcars.vehicle', 'search', [[]]);
		 $domain = [
			// ['email', 'ilike', 'gmail'],
			// ['city', '=', 'Surabaya']
		];
		$kwargs = ['order' => 'model desc', 'domain' => $domain, 'fields' => ['model', 'immatriculation', 'date_purchased', 'state']];
		$partners = $models->execute_kw($db, $uid, $password, 'rentcars.vehicle', 'search_read', [], $kwargs);
        echo "<pre>" . print_r($partners, true) . "</pre>";
 
    }else{
        echo "Failed to sign in";
    }

	
	
	
 ?>