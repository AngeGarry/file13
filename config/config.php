<! -- Liste des fonctions qui vont servir de Controller -->

<?php

// Fonction permettant de connecter avec la database MySQL
function pdo_connect_mysql() 
{
    // Authentification de l'hote, de l'utilisateur et du nom de la database
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'testing';
    //$DATABASE_NAME = 'tkdatabase';
    try 
    {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } 
    catch (PDOException $exception) 
    {
    	// S'il y a une erreur avec la connexion, arrêtez le script et affichez l'erreur.
    	exit('Failed to connect to database!');
    }
}
?>