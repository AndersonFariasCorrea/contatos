<?php

if ($_SERVER['REQUEST_METHOD'] != 'DELETE') {
    // Access is not allowed
    header('HTTP/1.0 403 Forbidden');
    exit;
}else{
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Request-With');

    // Initializes the api
    include_once '../core/initialize.php';

    // Intanciates post
    $contact = new Contact($DB);

    $data = json_decode(file_get_contents("php://input"));

    // Validate and set searched contact id
    $contact->id = isset($data->cid) && preg_match("/\d/", $data->cid) ? $data->cid : exit(http_response_code(400));

    // Add uset auth here
    $contact->userid = isset($data->userid) && preg_match("/\d/", $data->userid) ? $data->userid : exit(http_response_code(401));

    //create contact
    if($contact->delete()){
        echo json_encode(['status'=> 1, 'msg' => 'Contato deletado com sucesso']);
    }else{
        echo json_encode(['status'=> 0, 'msg' => 'O contato não foi deletado']);
    }
}