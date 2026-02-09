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