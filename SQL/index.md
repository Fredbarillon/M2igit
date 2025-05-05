## ⚡️ Les index en SQL
## 📌 Qu’est-ce qu’un index ?

Un index est une structure de données spéciale utilisée pour accélérer les recherches dans une table SQL.

    Il fonctionne un peu comme l’index d’un livre : il permet d’accéder plus rapidement à une ligne sans devoir tout lire.

    Certains index sont créés automatiquement :

        Les clés primaires (PRIMARY KEY)

        Les valeurs uniques (UNIQUE)
        → Ce sont des index par défaut.

✅ Avantages

    🔍 Accélère les opérations avec :

        WHERE

        JOIN

        ORDER BY

        GROUP BY

    ⏱️ Réduit le temps de réponse des requêtes

❌ Inconvénients

    🐢 Ralentit les opérations d'écriture :

        INSERT

        UPDATE

        DELETE

    💾 Utilise de l’espace disque supplémentaire

    ❗ Trop d’index = surcharge inutile

## 🛠️ Création d’index
🔹 À la création de la table :

CREATE TABLE utilisateurs (
    id INT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    INDEX idx_nom (nom)
);

🔹 Après la création de la table :

CREATE INDEX idx_nom ON utilisateurs(nom);

## 🧮 Index composés

On peut indexer plusieurs colonnes ensemble :

CREATE INDEX idx_nom_prenom ON utilisateurs(nom, prenom);

    📌 Utile si les recherches se font souvent sur les deux colonnes ensemble.

🔎 Visualiser les index

SHOW INDEX FROM utilisateurs;

## 🗑️ Supprimer un index

DROP INDEX idx_nom FROM utilisateurs;

⚠️ Attention :

    ALTER TABLE DROP INDEX ne fonctionne pas en MySQL

    Il faut toujours utiliser DROP INDEX ... FROM