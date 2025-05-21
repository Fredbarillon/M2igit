<?php
require_once 'Student.php';
require_once 'StudentRepo.php';

$pdo = null; 

try {
    $pdo = new PDO("mysql:host=localhost;", "root", "");
    echo "connexion ok!", PHP_EOL; 
} catch (PDOException $e){
    echo "Erreur de connexion : " . $e->getMessage(), PHP_EOL; 
    exit;  
}

$pdo?->exec("CREATE DATABASE IF NOT EXISTS exoEtudiants CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
echo "bdd créé !", PHP_EOL;

try {
    $pdo = new PDO("mysql:host=localhost;dbname=exoEtudiants", "root", ""); 
    echo "connexion ok!", PHP_EOL; 
} catch (PDOException $e){
    echo "Erreur de connexion : " . $e->getMessage(), PHP_EOL; 
    exit;  
}

$request = "CREATE TABLE IF NOT EXISTS etudiants (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    date_of_birth DATETIME,
    email VARCHAR(50) NOT NULL
)";
$pdo->exec($request);
echo "table créé !", PHP_EOL;




// $dob = new DateTime("2085-06-06 00:00:00");
// $etudiant = new Etudiant(null, "mimi", "matty", $dob , "rand@om2.com");
// print_r($etudiant);
$etudiantRepo = new StudentRepo($pdo); 


// echo $etudiantSauvegarde->id; 
// echo $etudiantSauvegarde->name;
try {
    // $etudiantSauvegarde = $etudiantRepo->saveOneStudent($etudiant); 
    $etudiantRepo->updateStudent(new Etudiant(2, "mimi", "mattou", new DateTime("2085-06-06 00:00:00"), "doc@oc.fr"));
    $etudiantRepo->deleteStudent(2);
    $etudiantRepo->getAllStudents();
}catch (Exception $e){
    echo "Erreur : ", $e->getMessage(), PHP_EOL;    
}finally{
    $pdo = null; 
    echo "connexion fermée !", PHP_EOL; 
}
