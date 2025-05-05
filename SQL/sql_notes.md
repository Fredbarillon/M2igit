
# 🗄️ Cours SQL – Bases, Requêtes et Bonnes Pratiques

---

## 📚 Base de données 1 : `bibliotheque`

```sql
CREATE DATABASE IF NOT EXISTS bibliotheque;
USE bibliotheque;
```

Création d'une base de données simple pour gérer des livres et des membres.

### 📘 Table `Livre`

```sql
CREATE TABLE Livre (
    id_livre INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(150) NOT NULL,
    auteur VARCHAR(150) NOT NULL,
    annee_publication YEAR NOT NULL,
    genre VARCHAR(100) NOT NULL,
    exemplaires_disponibles INT NOT NULL DEFAULT 0
);
```

- `AUTO_INCREMENT` : incrémentation automatique des ID
- `VARCHAR` : chaîne de caractères à taille variable
- `YEAR` : type spécial pour l’année
- `DEFAULT` : valeur par défaut si aucune entrée

### 👤 Table `Membre`

```sql
CREATE TABLE Membre (
    id_membre INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prénom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL, 
    adresse VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    téléphone VARCHAR(15) NOT NULL
);
```

- `UNIQUE` : empêche les doublons (ici sur l'email)
- `DATE` : date complète (année/mois/jour)

```sql
SHOW FIELDS FROM Membre;
```

Permet d’afficher la structure de la table.

---

## 🎧 Base de données 2 : `spotify`

```sql
CREATE DATABASE IF NOT EXISTS spotify;
USE spotify;
```

Une base de données pour simuler une plateforme de streaming musical.

### 🎵 Table `Chansons`

```sql
CREATE TABLE Chansons (
    id_chanson INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    artiste VARCHAR(255) NOT NULL,
    album VARCHAR(255) NOT NULL,
    duree TIME NOT NULL,
    genre VARCHAR(100) NOT NULL DEFAULT 'unknown',
    annee_sortie YEAR NOT NULL
);
```

### 👥 Table `Utilisateurs`

```sql
CREATE TABLE Utilisateurs (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom_utilisateur VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    pays VARCHAR(100) NOT NULL
);
```

### 🎶 Table `Playlists`

```sql
CREATE TABLE Playlists (
    id_Playlist INT PRIMARY KEY AUTO_INCREMENT,
    nom_playlist VARCHAR(255) NOT NULL,
    id_utilisateur INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs (id_utilisateur),
    date_creation TIMESTAMP NOT NULL
);
```

- `FOREIGN KEY` : crée une relation avec une autre table

```sql
SHOW FIELDS FROM Chansons;
SHOW FIELDS FROM Utilisateurs;
SHOW FIELDS FROM Playlists;
```

---

## 💼 Requêtes avancées : base `exo_dql_avance`

```sql
USE exo_dql_avance;
```

### 🔎 Sélection de données

```sql
SELECT first_name, last_name, birth_date 
FROM Employees 
WHERE MONTH(birth_date) = 12;
```

- `MONTH()` : extrait le mois d'une date

```sql
SELECT first_name, DATE_FORMAT(hire_date, '%W,%d %M %Y') AS format_date 
FROM Employees;
```

- `DATE_FORMAT()` : permet de formater une date dans une syntaxe lisible

```sql
SELECT first_name, last_name, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age 
FROM Employees ORDER BY age;
```

- `TIMESTAMPDIFF()` : différence entre deux dates (ici en années)

### 📊 Sous-requêtes & Agrégats

```sql
SELECT first_name, last_name, department, salary
FROM Employees 
WHERE salary > (SELECT AVG(salary) FROM Employees);
```

```sql
SELECT AVG(salary) AS averageSalary 
FROM Employees 
GROUP BY department 
HAVING averageSalary > 3000 ORDER BY averageSalary DESC;
```

- `HAVING` s’utilise **après** un `GROUP BY`, contrairement à `WHERE`.

### 🗂 Requêtes diverses

```sql
SELECT * FROM Employees;
SELECT * FROM Projects;
```

```sql
SELECT name, TIMESTAMPDIFF(DAY, end_date, CURDATE()) AS Days_since_end 
FROM Projects 
WHERE DATEDIFF('2022-12-31', end_date)
ORDER BY Days_since_end DESC;
```

```sql
SELECT city, AVG(salary) AS averageSalary, COUNT(*) AS allEmployees 
FROM Employees 
GROUP BY city 
HAVING allEmployees >= 5 AND averageSalary > 3500;
```

```sql
SELECT first_name, last_name, department, salary 
FROM Employees 
WHERE salary > (
    SELECT AVG(salary) FROM Employees GROUP BY department
);
```

```sql
SELECT * 
FROM Employees 
WHERE DATE_ADD(hire_date, INTERVAL 6 MONTH) < NOW();
```

### 🇫🇷 Localisation en français

```sql
SET lc_time_names = 'fr_FR';
SELECT first_name, last_name, DATE_FORMAT(birth_date, '%d %M %Y') FROM Employees;
```

- Permet d’afficher les mois et jours en français

---

## 🧠 Concepts importants

### 🔐 Sécurité et contraintes

```sql
SET SQL_SAFE_UPDATES = 0;
```

- Désactive la protection empêchant les `DELETE`/`UPDATE` sans `WHERE`.

### 📌 Autres rappels

- `SHOW VARIABLES LIKE 'lc_time_names';` ➜ montre la langue actuelle
- `TRUNCATE TABLE` ➜ vide une table rapidement, sans journalisation

---


> I CREATE flows like nobody else, I READ your mind and you feel upset. UPDATE your thoughts to my style or I'll DELETE your ass from this DATABASE.

