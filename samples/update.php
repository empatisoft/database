<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */
require_once 'config.php';

$data = $db->update(
    array(
        'table' => 'test',
        'fields' => array('name' => 'ONUR KAYA'),
        'where' => array(
            array('key' => 'id','values' => 1)
        )
    )
);

var_dump($data);