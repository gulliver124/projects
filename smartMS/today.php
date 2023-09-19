<?php
    
require_once('../includes/constants.php');
require_once(PATH_TO_DBCON);

try
{
    $search = "Noodles";
    $sql = "SELECT id,name, description, price from product where name like :search";
    $stmt = $GLOBALS['pdo']->prepare($sql);
    $search = '%'.$search.'%';
    $stmt->bindParam(":search",$search);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
catch(PDOException $e)
{

}

var_dump($result);



?>