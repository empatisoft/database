<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */
require_once 'config.php';

$data = $db->delete(
    array(
        'table' => 'test',
        'where' => array(
            array('key' => 'id','values' => 1)
        )
    )
);

var_dump($data);