<?php

// $host = "mysql"; // Votre hôte de base de données
// $port = "3306";
// $dbname = "afci"; // Le nom de votre base de données
// $user = "admin"; // Votre nom d'utilisateur
// $pass = "admin"; // Votre mot de passe

// // Établissement de la connexion à la base de données
// try {
//     $bdd = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
//     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// } catch (PDOException $e) {
//     echo "Erreur de connexion : " . $e->getMessage();
//     exit;
// }

// // Vérification et traitement de la modification du rôle
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'Modifier') {
//     $role_id = $_POST['role_id'];
//     $nom_role = $_POST['nom_role'];

//     // Requête SQL pour mettre à jour le nom du rôle
//     $sql = "UPDATE role SET nom_role = :nom_role WHERE id_role = :role_id";
//     $stmt = $bdd->prepare($sql);
//     $stmt->bindParam(':nom_role', $nom_role);
//     $stmt->bindParam(':role_id', $role_id);
    
//     if ($stmt->execute()) {
//         // Si la mise à jour est un succès, redirection vers index.php avec un paramètre de succès
//         header('Location: index.php?update=success');
//     } else {
//         // Gestion des erreurs ici
//         header('Location: index.php?update=error');
//     }
//     exit();
// }

// // Rediriger vers index.php si l'utilisateur accède directement à ce script
// header('Location: index.php');
// exit();
