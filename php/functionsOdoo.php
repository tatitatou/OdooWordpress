<?php
require_once('ripcord/ripcord.php');

// Connexion
$url = "http://web:8069";
$db = "odoo18";
$username = "apiwordpress@admin.fr";
$cleapi = "f157113d3d816ffbb7649894b7ffbed1bb26faef";

// Client XML-RPC
$common = ripcord::client($url . "/xmlrpc/2/common");
$uid = $common->authenticate($db, $username, $cleapi, []);

$object = ripcord::client("$url/xmlrpc/2/object");

/**
 * SEARCH
 */
function search($object, $db, $uid, $cleapi)
{
    $domain = [
        '|',
        ['state', '=', 'usable'],
        ['state', '=', 'broken'],
    ];

    $donneesrecues = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'rentcars.vehicle',
        'search',
        [$domain],
        [
            'offset' => 0,
            'limit' => null,
            'order' => 'date_purchased desc'
        ]
    );

    echo "<pre>" . print_r($donneesrecues, true) . "</pre>";
}

/**
 * SEARCH COUNT
 */
function search_count($object, $db, $uid, $cleapi)
{
    $domain = [
        ['age_vehicle', '>', 1],
        ['state', '!=', 'broken'],
    ];

    $donneesrecues = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'rentcars.vehicle',
        'search_count',
        [$domain]
    );

    echo "<pre>Nombre de véhicules de plus d'1 an non cassés : " . $donneesrecues . "</pre>";
}

/**
 * SEARCH READ
 */
function search_read($object, $db, $uid, $cleapi)
{
    $domain = [
        ['age_vehicle', '>', 1],
        ['state', '!=', 'broken'],
    ];

    $fields = ['model', 'date_purchased', 'garage_id', 'age_vehicle'];

    $donneesrecues = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'rentcars.vehicle',
        'search_read',
        [$domain],
        [
            'fields' => $fields,
            'order' => 'model desc',
        ]
    );

    echo "<pre>" . print_r($donneesrecues, true) . "</pre>";
}

/**
 * CREATE
 */
function create_vehicle($object, $db, $uid, $cleapi)
{
    // Première voiture
    $imagePath = "photos/toyota.jpg";
    $imageData = file_get_contents($imagePath);
    $base64Image = base64_encode($imageData);

    $vehicule1 = [
        'model' => 'voiture API1',
        'date_purchased' => '2021-07-20',
        'immatriculation' => 'GX841DD',
        'garage_id' => 1,
        'state' => 'usable',
        'thumbnail' => $base64Image,
        'option_ids' => [[6, 0, [1, 2]]] // many2many
    ];

    // Deuxième voiture
    $imagePath = "photos/ford.jpg";
    $imageData = file_get_contents($imagePath);
    $base64Image = base64_encode($imageData);

    $vehicule2 = [
        'model' => 'voiture API2',
        'date_purchased' => '2021-07-21',
        'immatriculation' => 'GH841DD',
        'garage_id' => 1,
        'state' => 'usable',
        'thumbnail' => $base64Image,
        'option_ids' => [[6, 0, []]]
    ];

    $vals_list = [$vehicule1, $vehicule2];

    $donneesrecues = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'rentcars.vehicle',
        'create',
        [$vals_list]
    );

    echo "<pre>" . print_r($donneesrecues, true) . "</pre>";
}

/**
 * WRITE (mise à jour)
 */
function write_vehicle($object, $db, $uid, $cleapi, $id)
{
    // Modification d'un élément
    $donneesrecues = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'rentcars.vehicle',
        'write',
        [[(int)$id], [
            'model' => "voiture modifiée par l'API",
            'date_purchased' => '2021-07-15',
            'immatriculation' => 'VV000VV',
            'garage_id' => 2,
            'state' => 'broken',
        ]]
    );

    echo "<pre>" . print_r($donneesrecues, true) . "</pre>";

    // Modification de plusieurs éléments
    $donneesrecues = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'rentcars.vehicle',
        'write',
        [[1, 2, 5], [
            'garage_id' => 2,
            'state' => 'usable'
        ]]
    );

    echo "<pre>" . print_r($donneesrecues, true) . "</pre>";
}

/**
 * UNLINK (suppression)
 */
function unlink_vehicle($object, $db, $uid, $cleapi, $id)
{
    // Suppression d'un élément
    $donneesrecues = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'rentcars.vehicle',
        'unlink',
        [[(int)$id]]
    );

    echo "<pre>" . print_r($donneesrecues, true) . "</pre>";

    // Suppression de plusieurs éléments
    $donneesrecues = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'rentcars.vehicle',
        'unlink',
        [[18, 19]]
    );

    echo "<pre>" . print_r($donneesrecues, true) . "</pre>";
}
