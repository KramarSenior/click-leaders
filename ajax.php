<?php

use Kramar\ClickLeaders\Database;

require 'vendor/autoload.php';

$db = new Database();

$form_data = $_POST;

$errors = [];


if (!isNameValid($form_data['name'])) {
    $errors['name'] = 'Niepoprawne imię';
}

if (!isNameValid($form_data['lastname'])) {
    $errors['lastname'] = 'Niepoprawne nazwisko';
}

if (!isEmailValid($form_data['email'])) {
    $errors['email'] = 'Niepoprawny email';
}

if (!isPasswordValid($form_data['password'])) {
    $errors['password'] = 'Zbyt słabe hasło';
}

if ($form_data['acceptTerms'] === 'false') {
    $errors['acceptTerms'] = 'Musisz zaakceptować regulamin';
}


$response = [
    'success' => false,
    'data' => [],
];

if (empty($errors)) {
    if (!checkIfEmailAlreadyExists($db, $form_data['email'])) {
        addUserToDatabase($db, $form_data);
        $response['success'] = true;
        $response['data']['email'] = 'User dodany';
    } else {
        $response['data']['email'] = 'Email już istnieje';
    }
} else {
    $response['data'] = $errors;
}


header("Content-Type: application/json");
echo json_encode($response);

function isEmailValid(string $email): bool
{
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    if (preg_match($pattern, $email)) {
        return true;
    } else {
        return false;
    }
}

function isPasswordValid(string $password): bool
{
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,}$/';

    if (preg_match($pattern, $password)) {
        return true;
    } else {
        return false;
    }
}

function isNameValid(string $name): bool
{
    $pattern = '/^[a-zA-Z]+$/';

    if (preg_match($pattern, $name)) {
        return true;
    } else {
        return false;
    }
}

function checkIfEmailAlreadyExists($db, string  $email): bool
{
    $result = $db->query("SELECT * FROM clickleaders.users WHERE email = :email", ['email' => $email]);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function addUserToDatabase($db, array $form_data): void
{
    $db->query("INSERT INTO clickleaders.users (name, lastname, email, password) VALUES (:name, :lastname, :email, :password)",
        [
            'name' => $form_data['name'],
            'lastname' => $form_data['lastname'],
            'email' => $form_data['email'],
            'password' => password_hash($form_data['password'], PASSWORD_DEFAULT)
        ]
    );
}

