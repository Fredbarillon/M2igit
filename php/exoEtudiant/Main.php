<?php
require_once 'Student.php';
require_once 'StudentRepo.php';

try {
    // 1) Connexion au serveur (sans base)
    $pdo = new PDO(
        'mysql:host=localhost;charset=utf8mb4',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "Connexion au serveur MySQL OK", PHP_EOL;

    // 2) Création de la base si elle n'existe pas
    $pdo->exec(
        'CREATE DATABASE IF NOT EXISTS exoEtudiants '
      . 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci'
    );
    echo "Base exoEtudiants créée ou déjà existante", PHP_EOL;

    // 3) Sélection de la base
    $pdo->exec('USE exoEtudiants');
    echo "Base exoEtudiants sélectionnée", PHP_EOL;

    // 4) Création de la table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS etudiants (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            first_name VARCHAR(50) NOT NULL,
            date_of_birth DATETIME,
            email VARCHAR(50) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "Table etudiants créée ou déjà existante", PHP_EOL;

    // 5) 
    $repo = new StudentRepo($pdo);
    // …

} catch (PDOException $e) {
    // un seul catch pour TOUTES les étapes ci-dessus
    die("Erreur MySQL : " . $e->getMessage());
}





// $dob = new DateTime("2085-06-06 00:00:00");
// print_r($etudiant);



// echo $etudiantSauvegarde->id; 
// echo $etudiantSauvegarde->name;
try {
    // $etudiantSauvegarde = $etudiantRepo->saveOneStudent($etudiant); 
    $etudiant = new Etudiant(null, "mimi", "matty", $dob , "rand@om2.com");
    $etudiantRepo->updateStudent(new Etudiant(5, "mimi", "mattou", new DateTime("2085-06-06 00:00:00"), "doc@oc.fr"));
    $etudiantRepo->deleteStudent(2);
    $etudiantRepo->getAllStudents();
}catch (Exception $e){
    echo "Erreur : ", $e->getMessage(), PHP_EOL;    
}finally{
    $pdo = null; 
    echo "connexion fermée !", PHP_EOL; 
}
