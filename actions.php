 <?php
    header("Access-Control-Allow-Origin: localhost:8082");
    header("Access-Control-Allow-Methods: GET, POST, PUT");
    header("Access-Control-Allow-Headers: Content-Type");

$connect = new PDO('mysql:host=localhost;dbname=covoit', 'root','');

$received_data = json_decode(file_get_contents('php://input'));
// var_dump($received_data);
// echo "lol"
// $data = array();
/*
if($received_data->action == 'fetchall_motorization') {
    $query = 'SELECT libellet FROM `motorization`';
    $statement = $connect->prepare($query);
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
if($received_data->action == 'fetchall_vehicles_for_user') {
    $query2 = "SET @row_id = 0; ";
    $query = "SELECT id_vehicles, @row_id := @row_id + 1 AS row_id, vehicles.id_motorization, libellet AS motorization, vehicles.id_user, vehicle_name, nb_places, color 
                  FROM `vehicles`, `motorization`, `users`
                  WHERE motorization.id_motorization = vehicles.id_motorization
                  AND vehicles.id_user = users.id_user
                  AND users.tel = $received_data->tel";
    $statement2 = $connect->prepare($query2);
    $statement = $connect->prepare($query);
    $statement2->execute();
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
if($received_data->action == 'fetch_vehicle_for_user') {
    $query2 = "SET @row_id = 0; ";
    $query = "SELECT id_vehicles, @row_id := @row_id + 1 AS row_id, vehicles.id_motorization, libellet AS motorization, vehicles.id_user, vehicle_name, nb_places, color 
                  FROM `vehicles`, `motorization`, `users`
                  WHERE motorization.id_motorization = vehicles.id_motorization
                  AND vehicles.id_user = users.id_user
                  AND users.tel = $received_data->tel";
    $statement2 = $connect->prepare($query2);
    $statement = $connect->prepare($query);
    $statement2->execute();
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data[$received_data->vehicleRowId - 1]);
}*/
if($received_data->action == 'fetch_personnal_information') {
    $query2 = "SET @row_id = 0; ";
    $query = "SELECT @row_id := @row_id + 1 AS row_id, l_name, f_name, tel, password AS Nom, Prenom, Telephone, Mot_De_Passe 
                  FROM `users`"
    $statement2 = $connect->prepare($query2);
    $statement = $connect->prepare($query);
    $statement2->execute();
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

?>