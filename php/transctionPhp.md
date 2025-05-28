
# 🔄 Transactions en PDO – Fiche récapitulative

## 🔑 Définition

Une **transaction** est un **groupe de requêtes SQL exécutées comme un tout**.  
Elle garantit que soit **tout réussit**, soit **rien n’est modifié en base**, ce qui permet une **cohérence totale**.

---

## 🧬 Le principe **ACID**

Les 4 propriétés fondamentales d’une transaction sont :

- **A**tomique : tout ou rien
- **C**ohérente : l’état final est valide
- **I**solée : indépendante des autres transactions en cours
- **D**urable : les changements sont permanents après `commit()`

---

## ⚙️ Fonctionnement d'une transaction avec PDO

1. On démarre avec `beginTransaction()`.
2. On exécute plusieurs requêtes (INSERT, UPDATE…).
3. Si tout se passe bien : `commit()`.
4. En cas d’erreur : `rollBack()` pour **annuler tous les changements**.

---

## 🧪 Exemple concret avec erreur volontaire

```php
try {
    $db = new PDO("mysql:host=localhost;dbname=php", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création des tables
    $db->exec("
        CREATE TABLE IF NOT EXISTS master (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(50),
            lastname VARCHAR(50)
        );
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS cat (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50),
            breed VARCHAR(50),
            master_id INT,
            FOREIGN KEY (master_id) REFERENCES master(id)
        );
    ");

    $db->beginTransaction();

    // Insertion du maître
    $stmt = $db->prepare("INSERT INTO master (firstname, lastname) VALUES (:firstname, :lastname)");
    $stmt->execute(["firstname" => "Zebulon", "lastname" => "Truc"]);
    $masterId = $db->lastInsertId();

    // Insertion du chat (avec faute volontaire "nae" au lieu de "name")
    $stmt = $db->prepare("INSERT INTO cat (name, breed, master_id) VALUES (:name, :breed, :master_id)");
    $stmt->execute(["nae" => "Polux", "breed" => "chachien", "master_id" => $masterId]);

    $db->commit();
    echo "Transaction réussie !\n";
} catch (PDOException $e) {
    echo "Erreur détectée : " . $e->getMessage() . PHP_EOL;
    $db->rollBack();
}
```

---

## 🔍 Lecture des résultats après transaction

```php
$requestGetCats = "
SELECT * FROM cat 
JOIN master ON cat.master_id = master.id
WHERE master.id = :master_id
";

$stmt = $db->prepare($requestGetCats);
$stmt->execute(["master_id" => 1]);  
$cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($cats as $cat) {
    echo "Nom : {$cat['name']}, Race : {$cat['breed']}\n";
}
```

---

## ⚠️ Attention

- Une transaction **n'annule pas** :
  - `TRUNCATE` (irréversible)
  - Certaines erreurs de syntaxe non prises comme exception (si `ERRMODE` pas activé)
- Toujours activer :
```php
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

---

## ✅ Récapitulatif

| Étape            | Méthode PDO           |
|------------------|------------------------|
| Démarrer         | `$pdo->beginTransaction()` |
| Exécuter requêtes| `$stmt->execute()`     |
| Valider          | `$pdo->commit()`       |
| Annuler          | `$pdo->rollBack()`     |

---
