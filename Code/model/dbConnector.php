<?php

/**
 *|File Info|
 *
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 *  | Author   : Glassey Nicolas                                                         |
 *  | Project  : ProjetWEB-DB-LJACorp                                                    |
 *  | Created  : 04.04.2019 - 18:48                                                      |
 *  |                                                                                    |
 *  | Last update :    [27.05.2019]                                                      |
 *  |                                                                                    |
 *  | Git source  :    [https://github.com/Havachi/ProjetWEB-DB-LJACorp]                 |
 *  *~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*
 */

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function add a new item in the cart
 * @param
 * @return array : The full cart after adding the new leasing
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function executeQueryUpdate($query)
{
    $queryResult = null;

    $dbConnexion = openDBConnexion();//open database connexion
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetchAll();//prepare result for client
    }
    $dbConnexion = null;//close database connexion
    return $queryResult;
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is designed to execute a query received as parameter
 * @param $query : must be correctly build for sql (synthaxis) but the protection against sql injection will be done there
 * @return array|null : get the query result (can be null)
 * Source : http://php.net/manual/en/pdo.prepare.php
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function executeQuerySelect($query)
{
    $queryResult = null;

    $dbConnexion = openDBConnexion();//open database connexion
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetchAll();//prepare result for client
    }
    $dbConnexion = null;//close database connexion
    return $queryResult;
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is designed to insert value in database
 * @param $query
 * @return bool|null : $statement->execute() returne true is the insert was successful
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function executeQueryInsert($query)
{
    $queryResult = null;

    $dbConnexion = openDBConnexion();//open database connexion
    if ($dbConnexion != null) {
        $statement = $dbConnexion->prepare($query);//prepare query
        $queryResult = $statement->execute();//execute query
    }
    $dbConnexion = null;//close database connexion
    return $queryResult;
}

/**~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~
 * This function is designed to manage the database connexion. Closing will be not proceeded there. The client is responsible of this.
 * @return PDO|null
 * Source : http://php.net/manual/en/pdo.construct.php
 **~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~~-~-~-~-~-~-~-~-~-~-~*/
function openDBConnexion()
{
    $tempDbConnexion = null;

    $sqlDriver = 'mysql';
    $hostname = 'localhost';
    $port = 3306;
    $charset = 'utf8';
    $dbName = 'snows';
    $userName = 'appliConnector';
    $userPwd = '123qweasD$';
    $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

    try {
        $tempDbConnexion = new PDO($dsn, $userName, $userPwd);
    } catch (PDOException $exception) {
        echo 'Connection failed: ' . $exception->getMessage();
    }
    return $tempDbConnexion;
}