<?php

  try{
    $bdd = new PDO('mysql:hostlocalhost;dbname=covoit;charset=utf8');
  }catch(exception $e){
    die('Erreur'.$e->getMessage());
  }

?>