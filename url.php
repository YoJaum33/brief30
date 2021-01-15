<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>url</title>
  <meta name="description" content="recette facile">
</head>
<body><pre><?php

  // séparer ses identifiants et les protéger, une bonne habitude à prendre
  include "urldbconf.php";

  try {

    // instancie un objet $connexion à partir de la classe PDO
    $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);

    // Requête de sélection 
    $requete = "SELECT * FROM `url`";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $resultat = $prepare->fetchAll();
    print_r([$requete, $resultat]); // debug & vérification

    $requete = "SELECT * FROM `mc`";
    $prepare = $connexion->prepare($requete);
    $prepare->execute();
    $resultat = $prepare->fetchAll();
    print_r([$requete, $resultat]); // debug & vérification

    
    // Requête d'insertion
    $requete = "INSERT INTO `url` (`id`, `url`, `shortcut`, `datetime`, `description`) 
    VALUES ('3', 'https://simplonline.co/', 'spl', NOW(), 'le site de Simplon')";
    $resultat = $prepare->rowCount(); // rowCount() nécessite PDO::MYSQL_ATTR_FOUND_ROWS => true
    $lastInsertedurlId = $connexion->lastInsertId(); // on récupère l'id automatiquement créé par SQL
    print_r([$requete, $resultat, $lastInsertedurlId]); // debug & vérification

    $requete = "INSERT INTO `url` (`id`, `url`, `shortcut`, `datetime`, `description`) 
    VALUES ('4', 'https://www.leboncoin.fr/', 'lbcoin', NOW(), 'le site ')";
    $resultat = $prepare->rowCount(); 
    $lastInsertedurlId = $connexion->lastInsertId(); 
    print_r([$requete, $resultat, $lastInsertedurlId]); 



    // Requête de modification
    $requete = "UPDATE `url`
                SET `shortcut` = :shortcut
                WHERE `id` = :id";
    $prepare = $connexion->prepare($requete);
    $prepare->execute(array(
      ":id"   => 3,
      ":shortcut" => "spline"
    ));
    $resultat = $prepare->rowCount();
    print_r([$requete, $resultat]); // debug & vérification

   // Requête de suppression
    $requete = "DELETE FROM `url`
                WHERE ((`id` = :id));";
    $prepare = $connexion->prepare($requete);
    $prepare->execute(array(
      ":id"   => 4
    ));
    $resultat = $prepare->rowCount();
    print_r([$requete, $resultat, $lastInsertedurlId]); // debug & vérification

    $requete = "INSERT INTO `url` (`id`, `url`, `shortcut`, `datetime`, `description`) 
    VALUES ('5', 'https://www.zataz.com/total-energie-direct-obligee-de-stopper-un-jeu-en-ligne-suite-a-une-fuite-de-donnees/',
     'ztz7', NOW(), 'L\'entreprise Total Energie Direct avait lancé un jeu en ligne. Le concours a dû être stoppé. Il était possible d\'accéder aux données des autres joueurs.')";
    $resultat = $prepare->rowCount(); 
    $lastInsertedurlId = $connexion->lastInsertId(); 
    print_r([$requete, $resultat, $lastInsertedurlId]); 



    $requete = "INSERT INTO `mc` (`id`, `mc_id`) VALUES ('3', 'piratage')";
    $resultat = $prepare->rowCount(); 
    $lastInsertedmcId = $connexion->lastInsertId(); 
    print_r([$requete, $resultat, $lastInsertedmcId]); 



    $requete = "INSERT INTO `assoc_mc_url` ( `mc_id`, `url_id`)
                 VALUES ( :mc_id, :url_id);";
    $prepare = $connexion->prepare($requete);
    $prepare->execute(array(
      ":mc_id" => "3",
      ":url_id" => "5"
    ));
    $resultat = $prepare->rowCount(); // rowCount() nécessite PDO::MYSQL_ATTR_FOUND_ROWS => true
    $lastInsertedAssocId = $connexion->lastInsertId(); // on récupère l'id automatiquement créé par SQL
    print_r([$requete, $resultat, $lastInsertedAssocId]); // debug & vérification
    

    $requete = "SELECT * FROM url
            INNER JOIN  assoc_mc_url  ON url_id =  url_id
            WHERE  	mc_id = 3";
            $prepare = $connexion->prepare($requete);
            $prepare->execute(array(":assoc_mc_url_id" => 3)); 
            $resultat = $prepare->fetchAll();
            print_r([$requete, $resultat]);
           


    
  } catch (PDOException $e) {

    // en cas d'erreur, on récup et on affiche, grâce à notre try/catch
    exit("❌🙀💀 OOPS :\n" . $e->getMessage());

  }

  ?></pre></body>
</html>