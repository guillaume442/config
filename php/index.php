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

?>

<form method="POST">
    <input type="text" name="nomRole">
    <input type="submit" name="submitRole">

</form>

<?php 
    if (isset($_POST['submitRole'])){
        $nomRole = $_POST['nomRole'];

        $sql = "INSERT INTO `role`(`nom_role`) VALUES ('$nomRole')";
        $bdd->query($sql);

        echo "data ajoutée dans la bdd";

    }

?>


<form method="POST">
    <h1>Ajout Centre</h1>
    <input type="text" name="nomCentre">
    <input type="text" name="adresse">
    <input type="text" name="nomCentre">
    <input type="submit" name="submitCentre">

</form>

<?php 
    if (isset($_POST['submitRole'])){
        $nomRole = $_POST['nomRole'];

        $sql = "INSERT INTO `role`(`nom_role`) VALUES ('$nomRole')";
        $bdd->query($sql);

        echo "data ajoutée dans la bdd";

    }

?>