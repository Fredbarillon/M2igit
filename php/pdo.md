
# 🛠️ PDO en PHP – Fiche récapitulative

## 🔑 Qu'est-ce que PDO ?

- **PDO (PHP Data Objects)** est une **API** d’abstraction pour accéder à une base de données en PHP.
- Elle permet d’**utiliser le même code PHP** pour plusieurs types de bases de données (MySQL, SQLite, PostgreSQL, etc.).
- Elle fournit une **interface orientée objet** pour :
  - se connecter à une base,
  - préparer des requêtes SQL,
  - exécuter,
  - lire les résultats,
  - sécuriser les données (anti injection SQL).

---

## ⚙️ Activation de PDO

- Vérifie dans le fichier `php.ini` que les extensions suivantes sont actives :
  - `extension=pdo_mysql`
  - `extension=openssl`
  - `extension=pdo_sqlite`
- Redémarre Apache/Nginx après activation.

---

## 📡 Connexion à une base de données

```php
$pdo = new PDO("mysql:host=localhost;dbname=maBase", "utilisateur", "motDePasse");
```

Paramètres :
- **DSN** (Data Source Name) : type + host + nom de base.
- **username**
- **password**
- **options (facultatif)**

Pour **fermer la connexion** :
```php
$pdo = null;
```

---

## 📥 Exécuter une requête SQL

### 🔹 Avec `exec()` (pas de résultat renvoyé)

```php
$pdo->exec("CREATE DATABASE exoPdo;");
```

### 🔹 Avec `prepare()` + `execute()` (requêtes dynamiques et sécurisées)

```php
$request = "INSERT INTO chiens (nom, date_of_birth) VALUES (:nom, :dob)";
$stmt = $pdo->prepare($request);
$stmt->execute(['nom' => 'Rex', 'dob' => '2015-01-01']);
```

---

## 🧪 Lecture des résultats

### 🔹 Une seule ligne :

```php
$result = $stmt->fetch(PDO::FETCH_ASSOC);
```

### 🔹 Toutes les lignes :

```php
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
```

### 🔹 Définir le mode de lecture par défaut :

```php
$stmt->setFetchMode(PDO::FETCH_ASSOC);
```

---

## 🔄 Transactions

Une **transaction** regroupe plusieurs requêtes SQL à exécuter ensemble.  
Si une échoue, tout est annulé.

```php
$pdo->beginTransaction();
$stmt->execute([...]);
$pdo->commit(); // ou $pdo->rollBack();
```

⚠️ Appeler `lastInsertId()` **avant** le `commit()` pour récupérer l’ID généré.

---

## 🔑 Sécurité & Bindings

### Méthode 1 : tableau associatif dans `execute()`

```php
$stmt->execute(['nom' => 'Bella']);
```

### Méthode 2 : `bindParam()`

```php
$stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
$stmt->execute();
```

Types PDO :
- `PDO::PARAM_STR`
- `PDO::PARAM_INT`
- `PDO::PARAM_BOOL`
- `PDO::PARAM_NULL`

---

## 🔍 Autres méthodes utiles

- `$pdo->lastInsertId()` : dernier ID auto-incrémenté.
- `$stmt->rowCount()` : nombre de lignes affectées.
- `$pdo->errorInfo()` : infos sur la dernière erreur SQL.

---

## 🧩 Exemple complet

```php
try {
    $pdo = new PDO("mysql:host=localhost;", "root", "");
    echo "Connexion établie\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS exoPdo CHARACTER SET utf8mb4;");
    $pdo = new PDO("mysql:host=localhost;dbname=exoPdo", "root", "");

    $pdo->exec("CREATE TABLE IF NOT EXISTS chiens (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(50),
        date_of_birth DATETIME
    )");

    $stmt = $pdo->prepare("INSERT INTO chiens (nom, date_of_birth) VALUES (:nom, :dob)");
    $chiens = [
        ['nom' => 'Rex', 'dob' => '2015-01-01'],
        ['nom' => 'Fido', 'dob' => '2016-05-15']
    ];
    foreach ($chiens as $c) {
        $stmt->execute($c);
    }

    $stmt = $pdo->prepare("SELECT * FROM chiens");
    $stmt->execute();
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

} catch (PDOException $e) {
    echo "Erreur PDO : " . $e->getMessage();
} finally {
    $pdo = null;
}
```

---

