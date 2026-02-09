<?php

if (!class_exists('ripcord')) {
    require_once('ripcord/ripcord.php');
}


// paramètres de connexion à Odoo


// on déclare les variables comme globales
global $odoo_url, $odoo_db, $odoo_username, $odoo_apikey;


// on récupère les paramètres de connexion à Odoo depuis les options
$odoo_url = get_option('urlOdoo');
$odoo_db = get_option('dbOdoo'); 


//récupération des paramètres de connexion de l'utilisateur courant


$current_user = wp_get_current_user();


$odoo_username = $current_user->user_email;


// et sans oublier de récupérer la clé d'api de l'utilisateur courant
$odoo_apikey = get_user_meta($current_user->ID, 'odooapikey',true); 

function odooConnect() {
    global $odoo_url, $odoo_db, $odoo_username, $odoo_apikey;


    if ($odoo_url == "" || $odoo_db == "" || $odoo_username == "" || $odoo_apikey == "") {
        return "";
    }


    $common = ripcord::client($odoo_url."/xmlrpc/2/common");
    $common->version();
    $uid = $common->authenticate($odoo_db, $odoo_username, $odoo_apikey, array());
    return $uid;
}

function getAllPrinters() {
    global $odoo_url, $odoo_db, $odoo_username, $odoo_apikey;


    $uid = odooConnect();


    if(!empty($uid)){
    
        $models = ripcord::client("$odoo_url/xmlrpc/2/object");
 
         $domain = [];
        
        $kwargs = ['order' => 'model desc', 'domain' => $domain, 'fields' => ['model', 'serial_number', 'thumbnail', 'manufacture_date', 'building_status', 'age']];
        $lesimprimantes = $models->execute_kw($odoo_db, $uid, $odoo_apikey, 'lynxter.printer', 'search_read', [], $kwargs);
        
        return $lesimprimantes;
    }
    else{
        return false;
    }
}
