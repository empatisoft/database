<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */
require_once 'config.php';

$data = $db->insert(
    'test',
    array(
        'is_active' => 1,
        'name' => 'Example',
        'created_at' => date('Y-m-d H:s:i'),
        'created_by' => 1
    ),
    true // Eklenen kaydın id değerini döndürmesi için true ayarlanır. Ayarlanmazsa true/false boolen değeri döner.
);

var_dump($data);