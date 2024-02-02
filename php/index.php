<?php

// Configuration de la connexion à la base de données
$host = "mysql"; // Votre hôte de base de données
$port = "3306";
$dbname = "afci"; // Le nom de votre base de données
$user = "admin"; // Votre nom d'utilisateur
$pass = "admin"; // Votre mot de passe

try {
    $bdd = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire de soumission d'une nouvelle formation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitFormation'])) {
    $nomFormation = $_POST['nomFormation'];
    // Assurez-vous que le nom de la table correspond à celui dans votre base de données
    $sql = "INSERT INTO formations (nom_formation) VALUES (:nomFormation)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':nomFormation' => $nomFormation]);
    
    // Rediriger ou afficher un message de succès
    echo "Formation ajoutée avec succès.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitSession'])) {
    $nomSession = $_POST['nomSession']; // Assurez-vous que ce champ est présent dans votre formulaire
    // Mettez à jour la requête pour inclure la nouvelle colonne
    $sql = "INSERT INTO session (nom_session, date_debut, id_pedagogie, id_formation) VALUES (:nomSession, :dateDebut, :idPedagogie, :idFormation)";
    $stmt = $bdd->prepare($sql);
    // Remplacez les valeurs ci-dessous par celles que vous récupérez de votre formulaire ou d'autres sources
    $stmt->execute([
        ':nomSession' => $nomSession,
        ':dateDebut' => '2023-01-01', // Exemple de date, ajustez selon vos besoins
        ':idPedagogie' => 1, // Exemple d'ID, ajustez selon vos besoins
        ':idFormation' => 1 // Exemple d'ID, ajustez selon vos besoins
    ]);
    
    echo "Session ajoutée avec succès.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitApprenant'])) {
    $nomApprenant = $_POST['nomApprenant'];
    // Utilisez le nom correct de la table et de la colonne selon votre base de données
    $sql = "INSERT INTO apprenants (nom_apprenant) VALUES (:nomApprenant)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':nomApprenant' => $nomApprenant]);
    
    echo "Apprenant ajouté avec succès.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFCI - Gestion des centres</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <a href="?page=role"><li>Role</li></a>
                <a href="?page=centre"><li>Centre</li></a>
                <a href="?page=formation"><li>Formation</li></a>
                <a href="?page=pedagogie"><li>Pedagogie</li></a>
                <a href="?page=session"><li>Session</li></a>
                <a href="?page=apprenant"><li>Apprenants</li></a>
            </ul>
        </nav>
    </header>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom Rôle</th>
            <th>Modifier</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        
        <?php

        
            // Ici, vous devriez récupérer les données de la base de données avec PHP
            // J'utilise une boucle foreach statique en guise d'exemple
            $roles = [
                ['id' => 1, 'nom' => 'Directeur'],
                ['id' => 2, 'nom' => 'Coordinateur'],
                ['id' => 3, 'nom' => 'Formateur'],
                ['id' => 4, 'nom' => 'Apprenant'],
                ['id' => 5, 'nom' => 'Inactif'],
                ['id' => 6, 'nom' => 'Exemple'],
            ];


            foreach ($roles as $role) {
                echo "<tr>";
                echo "<td>{$role['id']}</td>";
                echo "<td>{$role['nom']}</td>";
                echo "<td><button class='btn-modify'>Modifier</button></td>";
                echo "<td><button class='btn-delete'>Supprimer</button></td>";
                echo "<form action='traitement_role.php' method='post'>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>



<!-- Formulaire pour ajouter un nouveau rôle -->
<form method="POST">
    <input type="text" name="nomRole" placeholder="Ajouter un rôle">
    <input type="submit" name="submitRole" value="Ajouter">
</form>


<?php

$host = "mysql"; // Remplacez par l'hôte de votre base de données
$port = "3306";
$dbname = "afci"; // Remplacez par le nom de votre base de données
$user = "admin"; // Remplacez par votre nom d'utilisateur
$pass = "admin"; // Remplacez par votre mot de passe


    // Création d'une nouvelle instance de la classe PDO
    $bdd = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);

    // Configuration des options PDO
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // echo "Connexion réussie !";

    // Lire des données dans la BDD
    $sql = "SELECT * FROM apprenants";
    $requete = $bdd->query($sql);
    $results = $requete->fetchAll(PDO::FETCH_ASSOC);
    

    // foreach( $results as $value ){
    //     foreach($value as $data){
    //         echo $data;
    //         echo "<br>";

    //     }
    //     echo "<br>";
    // }

    foreach( $results as $value ){
        echo "<h2>" . $value["nom_apprenant"] . "</h2>";
        echo "<br>";
    }


    // Insérer des données dans la BDD
// Gestion de la page role
if (isset($_GET["page"]) && $_GET["page"] == "role"){
 ?>
    <form method="POST">
        <h1>Ajout d'un role</h1>
        <label for="">Nom du role</label>
        <input type="text" name="nomRole">
        <input type="submit" name="submitRole" value="enregistrer">
    
    </form>

    
    
<?php

    $sql = "SELECT * FROM role";
    $requete = $bdd->query($sql);
    $results = $requete->fetchAll(PDO::FETCH_ASSOC);

    foreach( $results as $value ){
        foreach($value as $data){
            echo $data;
            echo "<br>";

        }
        echo "<br>";
    }

}

if (isset($_POST['submitRole'])){
    $nomRole = $_POST['nomRole'];

    $sql = "INSERT INTO `role`(`nom_role`) VALUES ('$nomRole')";
    $bdd->query($sql);

    echo "data ajoutée dans la bdd";

}


// Gestion de la page centre
if (isset($_GET["page"]) && $_GET["page"] == "centre"){
    ?>
       <form method="POST">
            <h1>Ajout d'un centre</h1>
            <label>Nom de la ville</label>
           <input type="text" name="villeCentre">
           <label for="">Adresse</label>
           <input type="text" name="adresseCentre">
           <label for="">Code postal</label>
           <input type="text" name="cpCentre">
           <input type="submit" name="submitCentre" value="enregistrer">
       
       </form>
       
   <?php

        $sql = "SELECT * FROM centres";
        $requete = $bdd->query($sql);
        $results = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach( $results as $value ){
        foreach($value as $data){
            echo $data;
            echo "<br>";

        }
        echo "<br>";
        }
   }

   if (isset($_POST['submitCentre'])){
    $villeCentre = $_POST['villeCentre'];
    $adresseCentre = $_POST['adresseCentre'];
    $cpCentre = $_POST['cpCentre'];

    $sql = "INSERT INTO `centres`(`ville_centre`, `adresse_centre`, `code_postal_centre`) VALUES ('$villeCentre','$adresseCentre','$cpCentre')";
    $bdd->query($sql);

    echo "data ajoutée dans la bdd";

}

// gestion de la page Formation
   if (isset($_GET["page"]) && $_GET["page"] == "formation"){
    ?>
        <form method="POST">
            <h1>Ajout d'une formation</h1>
            <input type="text" name="nomFormation">
            <input type="submit" name="submitFormation" value="enregistrer">
        </form>
       
   <?php
   }

// Gestion de la page Pedagogie
   if (isset($_GET["page"]) && $_GET["page"] == "pedagogie"){

    $sql = "SELECT * FROM role";
    $requete = $bdd->query($sql);
    $results = $requete->fetchAll(PDO::FETCH_ASSOC);


    ?>
       <form method="POST">
       <h1>Ajout d'un membre de l'équipe pédagogique</h1>
            <label>Nom</label>
            <input type="text" name="nomPedagogie">
            <label>Prénom</label>
            <input type="text" name="prenomPedagogie">
            <label>Adresse mail</label>
            <input type="text" name="numPedagogie">
            <label>Numéro</label>
            <input type="text" name="mailPedagogie">
            <label>Rôle</label>
            <select name="idPedagogie" id="">
                <!-- <option value="idrole">id - nom role</option> -->
                <?php 
                
                foreach( $results as $value ){             
                        echo '<option value="' . $value['id_role'] .  '">' . $value['id_role'] . ' - ' . $value['nom_role'] . '</option>';   
                }
                ?>
            </select>
            <input type="submit" name="submitPedagogie" value="enregistrer">
       
       </form>
       
   <?php

$sql = "SELECT * FROM pedagogie";
    $requete = $bdd->query($sql);
    $results = $requete->fetchAll(PDO::FETCH_ASSOC);
    

    foreach( $results as $value ){
        foreach($value as $data){
            echo $data;
            echo "<br>";

        }
        echo "<br>";
    }

   }

   if (isset($_POST['submitPedagogie'])){
    $nomPedagogie = $_POST['nomPedagogie'];
    $prenomPedagogie = $_POST['prenomPedagogie'];
    $numPedagogie = $_POST['numPedagogie'];
    $mailPedagogie = $_POST['mailPedagogie'];
    $idPedagogie = $_POST['idPedagogie'];

    $sql = "INSERT INTO `pedagogie`(`nom_pedagogie`, `prenom_pedagogie`, `mail_pedagogie`, `num_pedagogie`, `id_role`) VALUES ('$nomPedagogie','$prenomPedagogie','$numPedagogie','$mailPedagogie','$idPedagogie')";
    $bdd->query($sql);

    echo "data ajoutée dans la bdd";

}

// Gestion de la page session
   if (isset($_GET["page"]) && $_GET["page"] == "session"){
    ?>
        <form method="POST">
            <h1>Ajout d'une session</h1>
            <input type="text" name="nomSession" placeholder="Nom de la session" required>
            <input type="submit" name="submitSession" value="Enregistrer">
        </form>

       
   <?php
   }

// Gestion de la page apprenant
   if (isset($_GET["page"]) && $_GET["page"] == "apprenant"){
    ?>
        <form method="POST">
            <h1>Ajout d'un apprenant</h1>
            <input type="text" name="nomApprenant" placeholder="Nom de l'apprenant" required>
            <input type="submit" name="submitApprenant" value="Enregistrer">
        </form>

       
   <?php
   }

?>



<?php 


?>
</body>
</html>
