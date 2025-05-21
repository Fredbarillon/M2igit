<?php
require_once 'Student.php';

class StudentRepo {
    public function __construct(private PDO $pdo){}

    public function saveOneStudent(Etudiant $etudiant){
        $request = "INSERT INTO etudiants (name, first_name, date_of_birth, email) 
        VALUES (:name, :first_name, :date_of_birth, :email);"; 
        $stmt = $this->pdo->prepare($request); 
        $dateFormatted = $etudiant->date_of_birth->format('Y-m-d H:i:s');
        $stmt->bindParam("name", $etudiant->name); 
        $stmt->bindParam("first_name", $etudiant->first_name); 
        $stmt->bindParam("date_of_birth", $dateFormatted); 
        $stmt->bindParam("email", $etudiant->email); 
        $requestSuccess = $stmt->execute(); 

        if($requestSuccess){
            $etudiant->id = $this->pdo->lastInsertid(); 
            return $etudiant;
        }
        return false;
    }
    
    public function getAllStudents(){
        $request = "SELECT * FROM etudiants;"; 
        $stmt = $this->pdo->prepare($request); 
        $stmt->execute(); 
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        if(!$results){
            throw new Exception("Aucun étudiant trouvé dans la base de données.");
        }else{
            echo "Liste des étudiants :", PHP_EOL;
            foreach($results as $etudiant){
            print_r($etudiant); 
            } 
        echo json_encode($results); 
        }
    }

    public function updateStudent(Etudiant $etudiant){
        if(!$etudiant->id){
            throw new Exception("pas d'étudiant à cette id.");
        }
        $sql = "UPDATE etudiants SET name = :name, first_name = :first_name WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name',$etudiant->name);
        $stmt->bindParam(':first_name',$etudiant->first_name);
        $stmt->bindParam(':id',$etudiant->id, PDO::PARAM_INT);
        $stmt->execute();
        echo "l'étudaint ",$etudiant->name, $etudiant->first_name ," a été mis à jour.",PHP_EOL;
    }

    public function deleteStudent(int $id){
        if(!$id){
            throw new Exception("pas d'étudiant à cette id.");
        }
        $sql = "DELETE FROM etudiants WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        echo "l'étudaint avec l'id ",$id," a été supprimé.",PHP_EOL;
    }
}



