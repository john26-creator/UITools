<?php

header('Content-type:application/json;charset=utf-8');
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$confEmail = $_POST["confEmail"];
$email = $_POST["mail"];
$sujet = $_POST["sujet"];
$message = $_POST["message"];

$status = true; //statut du formaulaire et de l'envoie du mail

function isInformed ($field) { //Est ce qu'un champ est renseigné
    return isset($field) && !empty($field);
}

if (isInformed($email)) {  // Est ce que l'email est renseigné ?
    $mailRegexp = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}$/";
    if(!preg_match($mailRegexp, $email))  { // Est ce qu'il a un format de mail ?
        $status = false;
    } 
} else {
    $status = false;
}

if (!isInformed($message)) {
    $status =  false;
}
if (!isInformed($nom)) {
    $status = false;
}
session_start();

if ($status) {
    $headers = "From: $email" . "\r\n" .
     "Reply-To: $email" . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
    $status = mail("jonathan.amselem.pro@gmail.com", $sujet, $message, $headers);
} if ($status) {
    setcookie("nom", $nom, time()+3600);
    setcookie("prenom", $prenom);
    setcookie("message", $message);
    setcookie("sujet", $sujet);
    setcookie("mail", $email);
    setcookie("confmail", $confEmail);

    $_SESSION["session"] = "bonjour $nom, $prenom";
}   
 else {
    session_destroy();
}

//var_dump($email);
echo json_encode(['status' => $status]);