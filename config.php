<?php
    if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false) {
        // Running on localhost
        $BASE_URL = '';
    } else {
        // Running on UMBC server
        $BASE_URL = '/~momini1/is448/SmartStitch_IS448_Project';
    }
?>
