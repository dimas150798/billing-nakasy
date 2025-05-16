<?php

defined('BASEPATH') or exit('No direct script access allowed');

function formatBytes($bytes, $decimal = null)
{
    $satuan = ["bytes", 'kb', 'mb', 'gb', 'tb'];
    $i = 0;

    while ($bytes > 1024) {
        $bytes /= 1024;
        $i++;
    }

    return round($bytes, $decimal) . " " . $satuan[$i];
}

function Connect_Kraksaaan()
{
    $CI = &get_instance();

    $ipMikrotik         = '103.189.60.31:8799';
    $usernameMikrotik   = 'adminnakasy';
    $passwordMikrotik   = 'nakasyinfly';

    $api = new RouterosAPI();
    $connected = $api->connect('103.189.60.31:8799', 'adminnakasy', 'nakasyinfly');

    // if (!$connected) {
    //     echo json_encode("Connection Failed Kraksaan: " . $api->error_str);
    //     exit;
    // }

    // // Cek jumlah data ppp/secret/print
    // if (count($api->comm('/ppp/secret/print')) == 0) {
    //     echo json_encode("No PPP secrets found");
    //     $api->disconnect(); // Disconnect jika tidak ada data
    //     exit;
    // }

    return $api;
}

function Connect_Paiton()
{
    $CI = &get_instance();

    $ipMikrotik         = '103.189.60.33:8799';
    $usernameMikrotik   = 'adminnakasy';
    $passwordMikrotik   = 'nakasyinfly';

    $api = new RouterosAPI();
    $connected = $api->connect('103.189.60.33:8799', 'adminnakasy', 'nakasyinfly');

    // if (!$connected) {
    //     echo json_encode("Connection Failed Kraksaan: " . $api->error_str);
    //     exit;
    // }

    // // Cek jumlah data ppp/secret/print
    // if (count($api->comm('/ppp/secret/print')) == 0) {
    //     echo json_encode("No PPP secrets found");
    //     $api->disconnect(); // Disconnect jika tidak ada data
    //     exit;
    // }

    return $api;
}
