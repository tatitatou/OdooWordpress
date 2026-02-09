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

if (!$uid) {
    die("Échec de l'authentification.");
}

$object = ripcord::client("$url/xmlrpc/2/object");

/**
 * SEARCH
 */
function search_printers($object, $db, $uid, $cleapi)
{
    $domain = [
        '|',
        ['building_status', '=', 'stock'],
        ['building_status', '=', 'sent'],
    ];

    $result = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'lynxter.printer',
        'search',
        [$domain],
        [
            'offset' => 0,
            'limit' => null,
            'order' => 'manufacture_date desc'
        ]
    );

    echo "<pre>SEARCH:\n" . print_r($result, true) . "</pre>";
}

/**
 * SEARCH COUNT
 */
function search_count_printers($object, $db, $uid, $cleapi)
{
    $domain = [
        ['age', '>', 1],
        ['building_status', '=', 'stock'],
    ];

    $count = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'lynxter.printer',
        'search_count',
        [$domain]
    );

    echo "<pre>Nombre d'imprimantes de plus d'un an en stock: $count</pre>";
}

/**
 * SEARCH READ
 */
function search_read_printers($object, $db, $uid, $cleapi)
{
    $domain = [
        ['age', '>', 1],
        ['building_status', '!=', 'sent'],
    ];

    $fields = ['serial_number', 'model', 'manufacture_date', 'age', 'building_status', 'location'];

    $result = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'lynxter.printer',
        'search_read',
        [$domain],
        [
            'fields' => $fields,
            'order' => 'model desc',
        ]
    );

    echo "<pre>SEARCH_READ:\n" . print_r($result, true) . "</pre>";
}

/**
 * CREATE
 */
function create_printers($object, $db, $uid, $cleapi)
{
    // Image
    $imagePath = __DIR__ . "/photos/Lynxter_S600D-scaled.jpg";
    $imageData = file_get_contents($imagePath);
    $base64Image = base64_encode($imageData);

    $printer1 = [
        'serial_number' => 1001,
        'model' => 'S600D',
        'manufacture_date' => '2021-07-20',
        'sending_date' => '2021-08-01',
        'location' => 'Atelier A',
        'building_status' => 'stock',
        'thumbnail' => $base64Image,
        'material_ids' => [[6, 0, [1, 2]]], // IDs de matériaux existants
    ];

    $printer2 = [
        'serial_number' => 1002,
        'model' => 'S300X_FIL',
        'manufacture_date' => '2022-01-10',
        'sending_date' => null,
        'location' => 'Atelier B',
        'building_status' => 'work in progress',
        'material_ids' => [[6, 0, [1]]],
    ];

    $vals_list = [$printer1, $printer2];

    $result = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'lynxter.printer',
        'create',
        [$vals_list]
    );

    echo "<pre>CREATE:\n" . print_r($result, true) . "</pre>";
}

/**
 * WRITE (mise à jour)
 */
function write_printer($object, $db, $uid, $cleapi, $id)
{
    $result = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'lynxter.printer',
        'write',
        [[(int)$id], [
            'location' => "Entrepôt principal",
            'building_status' => 'sent',
            'sending_date' => date('Y-m-d'),
        ]]
    );

    echo "<pre>WRITE:\n" . print_r($result, true) . "</pre>";
}

/**
 * UNLINK (suppression)
 */
function unlink_printer($object, $db, $uid, $cleapi, $id)
{
    $result = $object->execute_kw(
        $db,
        $uid,
        $cleapi,
        'lynxter.printer',
        'unlink',
        [[(int)$id]]
    );

    echo "<pre>UNLINK:\n" . print_r($result, true) . "</pre>";
}

/**
 * === APPELS DE TEST ===
 */

// Décommente ce que tu veux tester :

search_printers($object, $db, $uid, $cleapi);
search_count_printers($object, $db, $uid, $cleapi);
search_read_printers($object, $db, $uid, $cleapi);

// create_printers($object, $db, $uid, $cleapi);
// write_printer($object, $db, $uid, $cleapi, 1);
// unlink_printer($object, $db, $uid, $cleapi, 10);
