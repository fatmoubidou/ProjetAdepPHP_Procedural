<?php
function getMateriel($db,$id){
  $requete = $db->prepare('SELECT * FROM materiel where id= ?');
  $requete->execute(array($id));
  $result = $requete->fetch(PDO::FETCH_ASSOC);
  $requete->closeCursor(); // Termine le traitement de la requête
  return $result;
}


function getMateriels($db){
  $requete = $db->query('SELECT * FROM materiel');
  $result = $requete->fetchAll(PDO::FETCH_ASSOC);
  $requete->closeCursor(); // Termine le traitement de la requête
  return $result;
}


function updateMateriel($db,$form){
  //var_dump($form);
  $requete = $db->prepare('UPDATE materiel SET nom = :nom, description = :description, etat = :etat, acces = :acces, num_serie = :num_serie WHERE id = :id');
  $result = $requete->execute(array('id' => $form["id"], 'nom' => $form["nom"], 'description' => $form["description"], 'etat' => $form["etat"], 'acces' => $form["acces"], 'num_serie' => $form["num_serie"]));
  $requete->closeCursor(); // Termine le traitement de la requête
  return $result;
}


function addMateriel($db,$form){
  //var_dump($form);
  $requete = $db->prepare('INSERT INTO materiel(nom, description, etat, acces, num_serie) VALUES(:nom, :description, :etat, :acces, :num_serie)');
  $result = $requete->execute(array('nom' => $form['nom'], 'description' => $form['description'], 'etat' => $form['etat'], 'acces' => $form['acces'], 'num_serie' => $form['num_serie']));
  $requete->closeCursor(); // Termine le traitement de la requête
  return $result;
}


function deleteMateriel($db,$id){
  $requete = $db->prepare('DELETE FROM materiel where id= ?');
  $result = $requete->execute(array($id));
  return $result;
}
