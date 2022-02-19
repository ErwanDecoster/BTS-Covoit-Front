<?php

$connect = new PDO('mysql:host=localhost;dbname=covoit', 'root','');

$received_data = json_decode(file_get_contents('php://input'));

$data = array();

if($received_data->action == 'fetchall') {
    $query = 'SELECT libellet FROM `motorization`';
    $statement = $connect->prepare($query);
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

?>