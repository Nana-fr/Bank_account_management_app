<?php
try
{
    $connection = new PDO('mysql:host=localhost;dbname=banque_php', 'root', '');
} catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$sqlQuery = 'SELECT * FROM Customers';
$customersStatement = $connection->prepare($sqlQuery);
$customersStatement->execute();
$customers = $customersStatement->fetchAll();
$login = [];
foreach ($customers as $customer) {
  $login += [$customer['email']=> $customer['password_customer']];
}
return $login;
?>