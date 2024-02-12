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



class Vehicule {
    public $nombreDeRoues;
    public $couleur;
    public $anneeDeConstruction;
    public $marque;

    public function __construct($nombreDeRoues, $couleur, $anneeDeConstruction, $marque) {
        $this->nombreDeRoues = $nombreDeRoues;
        $this->couleur = $couleur;
        $this->anneeDeConstruction = $anneeDeConstruction;
        $this->marque = $marque;
    }

    public function concatenation() {
        return $this->nombreDeRoues . ', ' . 
               $this->couleur . ', ' . 
               $this->anneeDeConstruction . ', ' . 
               $this->marque;
    }
}

$voiture = new Vehicule(4, 'violet', 2009, 'Renault');

$moto = new Vehicule(2, 'jaune', 2023, 'Yamaha');

echo 'Voiture: ' . $voiture->concatenation();
echo "\n";
echo 'Moto: ' . $moto->concatenation();






//-------------------------------------------centre-------------------------------------------------


// Gestion de la suppression d'un centre
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimerCentre'])) {
    $idCentre = $_POST['idCentre'];
    $sql = "DELETE FROM centres WHERE id = :idCentre";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':idCentre' => $idCentre]);

    header('Location: index.php?page=centre');
    exit;
}

// Gestion de la modification d'un centre (similaire à la suppression, mais avec un UPDATE SQL)
// ...



//---------------------------formation--------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimerFormation'])) {
    $idFormation = $_POST['idFormation'];
    $sql = "DELETE FROM formations WHERE id_formation = :idFormation";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':idFormation' => $idFormation]);

    // Redirection pour éviter le rechargement du formulaire et la resoumission des données
    header('Location: index.php?page=formation');
    exit;
}

// Traitement de la demande de modification d'une formation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifierFormation'])) {
    $idFormation = $_POST['idFormation'];
    $nomFormationModifie = $_POST['nomFormationModifie'];

    $sql = "UPDATE formations SET nom_formation = :nomFormationModifie WHERE id_formation = :idFormation";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ':nomFormationModifie' => $nomFormationModifie,
        ':idFormation' => $idFormation
    ]);

    header('Location: index.php?page=formation');
    exit;
}

// Traiter l'ajout d'une nouvelle formation si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitFormation'])) {
    $nomFormation = $_POST['nomFormation'];
    $sql = "INSERT INTO formations (nom_formation) VALUES (:nomFormation)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':nomFormation' => $nomFormation]);

    header('Location: index.php?page=formation');
    exit;
}

//-----------------------------session---------------------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimerSession'])) {
    $idSession = $_POST['idSession'];
    $sql = "DELETE FROM session WHERE id_session = :idSession";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':idSession' => $idSession]);
    header('Location: index.php?page=session');
    exit;
}

// Gestion de la modification d'une session
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifierSession'])) {
    $idSession = $_POST['idSession'];
    $nomSessionModifie = $_POST['nomSessionModifie'];
    $sql = "UPDATE session SET nom_session = :nomSessionModifie WHERE id_session = :idSession";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':nomSessionModifie' => $nomSessionModifie, ':idSession' => $idSession]);
    header('Location: index.php?page=session');
    exit;
}

//---------------------------------------------Apprenant-----------------------------------------------------



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitApprenant'])) {
    // Traitez l'ajout d'un nouvel apprenant
    // ...
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifierApprenant'])) {
    $idApprenant = $_POST['idApprenant'];
    $nomApprenantModifie = $_POST['nomApprenantModifie'];
    
    $sql = "UPDATE apprenants SET nom_apprenant = :nomApprenantModifie WHERE id_apprenant = :idApprenant";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ':nomApprenantModifie' => $nomApprenantModifie,
        ':idApprenant' => $idApprenant
    ]);
    
    header('Location: index.php?page=apprenant');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimerApprenant'])) {
    // Traitez la suppression d'un apprenant
    // ...
}

// Affichage des apprenants existants
$sql = "SELECT * FROM apprenants";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$apprenants = $stmt->fetchAll(PDO::FETCH_ASSOC);


// ---------------------------------------------------------------------------------------


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifierRole'])) {
    $idRole = $_POST['idRole'];
    $nomRole = $_POST['nomRoleModifie'];

    $sql = "UPDATE role SET nom_role = :nomRole WHERE id_role = :idRole";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':nomRole' => $nomRole, ':idRole' => $idRole]);

    header('Location: index.php'); // Pour éviter le rechargement du formulaire
    exit;
}


//--------------------------------------formulaire inscription/connexion------------------------------------------

    // Démarrez une session PHP
    // session_start();

    // session_start();

    // $messages = [];
    // $dbname = 'afci';
    // $usernameDB = 'bob'; // Utilisateur de la base de données
    // $passwordDB = '123456'; // Mot de passe de la base de données
    
    // Connexion à la base de données
    // $pdo = new PDO("mysql:host=localhost;dbname=$dbname", $usernameDB, $passwordDB);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['register'])) {
            // Ici, 'username' et 'password' sont les noms des champs dans votre formulaire HTML d'inscription
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
            try {
                $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                $messages[] = "Utilisateur créé avec succès.";
            } catch (PDOException $e) {
                $messages[] = "Erreur : " . $e->getMessage();
            }
        } elseif (isset($_POST['login'])) {
            // 'username' et 'password' viennent de votre formulaire HTML de connexion
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch();
    
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $messages[] = "Connexion réussie.";
            } else {
                $messages[] = "Identifiant ou mot de passe incorrect.";
            }
        }
    }
    
    
?>

<!-- ---------------------------------------------------html------------------------------------------------------ -->

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

    <!-- ---------------------------------------------------------------------------------------------------- -->

    <?php foreach ($messages as $message) : ?>
        <p><?php echo $message; ?></p>
    <?php endforeach; ?>

    <h2>Inscription</h2>
    <form method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="register" value="Register">
    </form>

    <h2>Connexion</h2>
    <form method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="login" value="Login">
    </form>


<!-- ------------------------------------------------------------------------------------------------------- -->

<?php


    // Création d'une nouvelle instance de la classe PDO
    // $bdd = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);

    // Configuration des options PDO
    // $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // echo "Connexion réussie !";


// ---------------------------------------------Gestion de la page role---------------------------------------------




if (isset($_GET["page"]) && $_GET["page"] == "role") {
    // Formulaire pour ajouter un nouveau rôle
    ?>
    <form method="POST">
        <h1>Ajout d'un rôle</h1>
        <input type="text" name="nomRole" placeholder="Nom du rôle">
        <input type="submit" name="submitRole" value="Enregistrer">
    </form>

    <?php
    // Affichage des rôles existants avec les boutons Modifier et Supprimer
    $sql = "SELECT * FROM role";
    $requete = $bdd->query($sql);
    $results = $requete->fetchAll(PDO::FETCH_ASSOC);

    echo '<table>';
    echo '<thead><tr><th>ID</th><th>Nom Rôle</th><th>Modifier</th><th>Supprimer</th></tr></thead>';
    echo '<tbody>';
    foreach ($results as $role) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($role['id_role']) . "</td>";
        echo "<td>" . htmlspecialchars($role['nom_role']) . "</td>";
        echo "<td><a href='?page=role&editRole=" . $role['id_role'] . "'>Modifier</a></td>";
        echo "<td>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='idRole' value='" . $role['id_role'] . "'>";
        echo "<input type='submit' name='supprimerRole' value='Supprimer'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo '</tbody>';
    echo '</table>';

    // Ajout d'un rôle
    if (isset($_POST['submitRole'])) {
        $nomRole = $_POST['nomRole'];
        $sql = "INSERT INTO role (nom_role) VALUES (:nomRole)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':nomRole' => $nomRole]);
        echo "<p>Rôle ajouté avec succès.</p>";
        //Redirection pour éviter le rechargement du formulaire
        header('Location: index.php');
        exit;
    }

    if (isset($_POST['submit'])){
        
        $sql = "INSERT INTO role (nom) VALUES (:nom)";
        
        $requete = $bdd->prepare($sql);
        
        $nomRole = specialchars($_POST['nomRole']);

        $requete->bindParam(':nom', $nom);

        $requete->execute();

        echo "données ajoutées à la bdd";
    }

    // Suppression d'un rôle
    if (isset($_POST['supprimerRole'])) {
        $idRole = $_POST['idRole'];
        $sql = "DELETE FROM role WHERE id_role = :idRole";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':idRole' => $idRole]);
        echo "<p>Rôle supprimé avec succès.</p>";
        // Redirection pour éviter le rechargement du formulaire
        header('Location: index.php'); // Pour éviter le rechargement du formulaire
        exit;
    }

    // Modification d'un rôle
    if (isset($_GET['editRole'])) {
        $idRole = $_GET['editRole'];
        // Sélectionnez le rôle actuel à modifier
        $sql = "SELECT * FROM role WHERE id_role = :idRole";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':idRole' => $idRole]);
        $roleToEdit = $stmt->fetch(PDO::FETCH_ASSOC);

        // Afficher le formulaire de modification avec les informations actuelles du rôle
        echo "<form method='POST'>";
        echo "<input type='hidden' name='idRole' value='" . $roleToEdit['id_role'] . "'>";
        echo "<input type='text' name='nomRoleModifie' value='" . $roleToEdit['nom_role'] . "'>";
        echo "<input type='submit' name='modifierRole' value='Sauvegarder'>";
        echo "</form>";
    }
}




// ------------------------------------------Gestion de la page centre--------------------------------------------




if (isset($_GET["page"]) && $_GET["page"] == "centre") {
    // Formulaire pour l'ajout d'un nouveau centre
    ?>
    <form method="POST">
        <h1>Ajout d'un centre</h1>
        <label>Nom de la ville</label>
        <input type="text" name="villeCentre" required>
        <label>Adresse</label>
        <input type="text" name="adresseCentre" required>
        <label>Code postal</label>
        <input type="text" name="cpCentre" required>
        <input type="submit" name="submitCentre" value="Enregistrer">
    </form>
    <?php

if (isset($_POST['submit'])){
        
    $sql = "INSERT INTO apprenants (villeCentre, adresseCentre, cpCentre) VALUES (:villeCentre, :adresseCentre, :cpCentre)";
    
    $requete = $bdd->prepare($sql);
    
    $nom = specialchars($_POST['nom']);
    $prenom = specialchars($_POST['prenom']);
    $mail = specialchars($_POST['mail']);

    $requete->bindParam(':nom', $villeCentre);
    $requete->bindParam(':prenom', $adresseCentre);
    $requete->bindParam(':mail', $cpCentre);

    $requete->execute();

    echo "données ajoutées à la bdd";
}

    // Traitement de l'ajout d'un nouveau centre
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitCentre'])) {
        
        $villeCentre = $_POST['villeCentre'];
        $adresseCentre = $_POST['adresseCentre'];
        $cpCentre = $_POST['cpCentre'];

        $sql = "INSERT INTO centres (ville_centre, adresse_centre, code_postal_centre) VALUES (:villeCentre, :adresseCentre, :cpCentre)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':villeCentre' => $villeCentre, ':adresseCentre' => $adresseCentre, ':cpCentre' => $cpCentre]);

        header('Location: index.php?page=centre'); // Pour rafraîchir et voir le nouveau centre ajouté
        exit;
    }

    // Récupération et affichage des centres existants
    $sql = "SELECT * FROM centres";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $centres = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<table>';
    echo '<thead><tr><th>ID</th><th>Ville</th><th>Adresse</th><th>Code Postal</th><th>Actions</th></tr></thead>';
    echo '<tbody>';
    foreach ($centres as $centre) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($centre['id']) . "</td>"; // Assurez-vous que 'id' est le bon nom de colonne pour l'identifiant du centre
        echo "<td>" . htmlspecialchars($centre['ville_centre']) . "</td>";
        echo "<td>" . htmlspecialchars($centre['adresse_centre']) . "</td>";
        echo "<td>" . htmlspecialchars($centre['code_postal_centre']) . "</td>";
        echo "<td><a href='index.php?page=centre&editCentre=" . $centre['id'] . "'>Modifier</a> | ";
        echo "<form method='POST' action='index.php?page=centre' style='display:inline;'>";
        echo "<input type='hidden' name='idCentre' value='" . $centre['id'] . "'>";
        echo "<input type='submit' name='supprimerCentre' value='Supprimer'>";
        echo "</form></td>";
        echo "</tr>";
    }
    echo '</tbody>';
    echo '</table>';
}



// ----------------------------gestion de la page Formation----------------------------------------


if (isset($_GET["page"]) && $_GET["page"] == "formation") {
    // Formulaire pour ajouter une nouvelle formation
    ?>
    <form method="POST">
        <h1>Ajout d'une formation</h1>
        <input type="text" name="nomFormation" placeholder="Nom de la formation" required>
        <input type="submit" name="submitFormation" value="Enregistrer">
    </form>
    <?php

    // Traiter l'ajout d'une nouvelle formation
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitFormation'])) {
        $nomFormation = $_POST['nomFormation'];
        $sql = "INSERT INTO formations (nom_formation) VALUES (:nomFormation)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':nomFormation' => $nomFormation]);
        
        echo "Formation ajoutée avec succès.";
        // Redirection pour éviter le rechargement du formulaire
        header('Location: index.php?page=formation');
        exit;
    }

    if (isset($_POST['submit'])){
        
        $sql = "INSERT INTO apprenants (nomFormation) VALUES (:nomFormation)";
        
        $requete = $bdd->prepare($sql);
        
        $nomFormation = specialchars($_POST['nomFormation']);

        $requete->bindParam(':nomFormation', $nomFormation);

        $requete->execute();

        echo "données ajoutées à la bdd";
    }

    if (isset($_GET['editFormation'])) {
        $idFormation = $_GET['editFormation'];
        $sql = "SELECT * FROM formations WHERE id_formation = :idFormation";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':idFormation' => $idFormation]);
        $formationToEdit = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($formationToEdit) {
            echo "<form method='POST'>";
            echo "<input type='hidden' name='idFormation' value='" . htmlspecialchars($formationToEdit['id_formation']) . "'>";
            echo "<input type='text' name='nomFormationModifie' value='" . htmlspecialchars($formationToEdit['nom_formation']) . "'>";
            echo "<input type='submit' name='modifierFormation' value='Modifier'>";
            echo "</form>";
        }
    }
    

    // Récupération et affichage des formations existantes
    $sql = "SELECT * FROM formations"; // Assurez-vous que la table s'appelle 'formations'
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<table>';
    echo '<thead><tr><th>ID</th><th>Nom de la formation</th><th>Actions</th></tr></thead>';
    echo '<tbody>';
    foreach ($formations as $formation) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($formation['id_formation']) . "</td>";
        echo "<td>" . htmlspecialchars($formation['nom_formation']) . "</td>";
        echo "<td><a href='index.php?page=formation&editFormation=" . $formation['id_formation'] . "'>Modifier</a></td>";
        echo "<td>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='idFormation' value='" . $formation['id_formation'] . "'>";
        echo "<input type='submit' name='supprimerFormation' value='Supprimer'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo '</tbody>';
    echo '</table>';

    // Code pour le formulaire de modification si en mode édition d'une formation
    // ...
}



// -------------------------------Gestion de la page Pedagogie-----------------------------------



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

if (isset($_POST['submit'])){
        
    $sql = "INSERT INTO apprenants (nomPedagogie, prenomPedagogie, numPedagogie, mailPedagogie, idPedagogie) 
    VALUES (:nomPedagogie, :prenomPedagogie, :numPedagogie, :mailPedagogie, :idPedagogie)";
    
    $requete = $bdd->prepare($sql);
    
    $nomPedagogie = specialchars($_POST['nomPedagogie']);
    $prenomPedagogie = specialchars($_POST['renomPedagogie']);
    $numPedagogie = specialchars($_POST['numPedagogie']);
    $mailPedagogie = specialchars($_POST['mailPedagogie']);
    $idPedagogie = specialchars($_POST['idPedagogie']);

    $requete->bindParam(':nomPedagogie', $nomPedagogie);
    $requete->bindParam(':prenomPedagogie', $prenomPedagogie);
    $requete->bindParam(':numPedagogie', $numPedagogie);
    $requete->bindParam(':mailPedagogie', $mailPedagogie);
    $requete->bindParam(':idPedagogie', $idPedagogie);

    $requete->execute();

    echo "données ajoutées à la bdd";
}



// ----------------------------------Gestion de la page session-----------------------------------------


   if (isset($_GET["page"]) && $_GET["page"] == "session"){
    ?>
        <form method="POST">
            <h1>Ajout d'une session</h1>
            <input type="text" name="nomSession" placeholder="Nom de la session" required>
            <input type="submit" name="submitSession" value="Enregistrer">
        </form>

   <?php


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

if (isset($_POST['submit'])){
        
    $sql = "INSERT INTO apprenants (nomSession) VALUES (:nomSession)";
    
    $requete = $bdd->prepare($sql);
    
    $nomSession = specialchars($_POST['nomSession']);

    $requete->bindParam(':nomSession', $nomSession);

    $requete->execute();

    echo "données ajoutées à la bdd";
}

// Affichage des sessions existantes
$sql = "SELECT * FROM session"; // Assurez-vous que la table s'appelle 'sessions'
$stmt = $bdd->prepare($sql);
$stmt->execute();
$sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table>';
echo '<thead><tr><th>ID</th><th>Nom de la session</th><th>Actions</th></tr></thead>';
echo '<tbody>';
foreach ($sessions as $session) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($session['id_session']) . "</td>";
    echo "<td>" . htmlspecialchars($session['nom_session']) . "</td>";
    echo "<td>";
    // Lien pour le mode édition
    echo "<a href='index.php?page=session&editSession=" . $session['id_session'] . "'>Modifier</a>";
    echo "</td><td>";
    // Formulaire pour la suppression
    echo "<form method='POST'>";
    echo "<input type='hidden' name='idSession' value='" . $session['id_session'] . "'>";
    echo "<input type='submit' name='supprimerSession' value='Supprimer'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo '</tbody>';
echo '</table>';

// Gestion du formulaire d'édition si l'utilisateur est en mode édition
if (isset($_GET['editSession'])) {
    $idSession = $_GET['editSession'];
    $sql = "SELECT * FROM session WHERE id_session = :idSession";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':idSession' => $idSession]);
    $sessionToEdit = $stmt->fetch(PDO::FETCH_ASSOC);

    // Affichage du formulaire de modification
    echo "<form method='POST'>";
    echo "<input type='hidden' name='idSession' value='" . $sessionToEdit['id_session'] . "'>";
    echo "<input type='text' name='nomSessionModifie' value='" . $sessionToEdit['nom_session'] . "'>";
    echo "<input type='submit' name='modifierSession' value='Sauvegarder'>";
    echo "</form>";
}
}

?>



<!-- // ---------------------------------Gestion de la page apprenant--------------------------------------- -->



<?php

if (isset($_GET["page"]) && $_GET["page"] == "apprenant") {
    // Formulaire pour ajouter un nouvel apprenant
?>

    <form method="POST">
        <h1>Ajout d'un apprenant</h1>
        <input type="text" name="nomApprenant" placeholder="Nom de l'apprenant" required>
        <input type="submit" name="submitApprenant" value="Enregistrer">
    </form>

<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimerApprenant'])) {
        $idApprenant = $_POST['idApprenant'];
        $sql = "DELETE FROM apprenants WHERE id_apprenant = :idApprenant";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':idApprenant' => $idApprenant]);
        header('Location: index.php?page=apprenant');
        exit;
    }

    // Traitement du formulaire d'ajout d'un nouvel apprenant
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitApprenant'])) {
        $nomApprenant = $_POST['nomApprenant'];
        $sql = "INSERT INTO apprenants (nom_apprenant) VALUES (:nomApprenant)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':nomApprenant' => $nomApprenant]);
        
        // Affiche un message de succès et recharger la page pour voir le nouvel apprenant
        echo "<p>Apprenant ajouté avec succès.</p>";
        header('Location: index.php');
        exit;
    }

    if (isset($_POST['submit'])){
        
        $sql = "INSERT INTO apprenants (nomApprenant) VALUES (:nomApprenant)";
        
        $requete = $bdd->prepare($sql);
        
        $nomApprenant = specialchars($_POST['nomApprenant']);

        $requete->bindParam(':nomApprenant', $nomApprenant);

        $requete->execute();

        echo "données ajoutées à la bdd";
    }



    if (isset($_GET['editApprenant'])) {
        $idApprenant = $_GET['editApprenant'];
        
        $sql = "SELECT * FROM apprenants WHERE id_apprenant = :idApprenant";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([':idApprenant' => $idApprenant]);
        $apprenantToEdit = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($apprenantToEdit) {
            // Affichez le formulaire de modification si l'apprenant existe
            echo "<form method='POST'>";
            echo "<input type='hidden' name='idApprenant' value='" . htmlspecialchars($apprenantToEdit['id_apprenant']) . "'>";
            echo "<input type='text' name='nomApprenantModifie' value='" . htmlspecialchars($apprenantToEdit['nom_apprenant']) . "'>";
            echo "<input type='submit' name='modifierApprenant' value='Modifier'>";
            echo "</form>";
        }
    }
    

    // Affichage des apprenants existants avec les boutons Modifier et Supprimer
echo '<table>';
// ... [Votre code pour l'en-tête du tableau] ...
foreach ($apprenants as $apprenant) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($apprenant['id_apprenant']) . "</td>";
    echo "<td>" . htmlspecialchars($apprenant['nom_apprenant']) . "</td>";
    echo "<td>";
    // Bouton Modifier
    echo "<a href='index.php?page=apprenant&editApprenant=" . $apprenant['id_apprenant'] . "'>Modifier</a>";
    echo "</td><td>";
    // Formulaire et bouton Supprimer
    echo "<form method='POST'>";
    echo "<input type='hidden' name='idApprenant' value='" . $apprenant['id_apprenant'] . "'>";
    echo "<input type='submit' name='supprimerApprenant' value='Supprimer'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo '</table>';



}

?>

</body>
</html>



<!-- table user -->
