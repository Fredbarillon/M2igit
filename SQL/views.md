## 🔍 Les Vues en SQL
## 📌 Définition

Une vue est une table virtuelle basée sur le résultat d'une requête SQL.

    Elle ne stocke pas de données : les résultats sont générés à la volée lors de l'appel.

    Elle est facilement accessible comme une table normale.

## 🎯 Intérêts principaux

✅ Simplifie les requêtes complexes
→ Permet de cacher la complexité derrière un nom simple.

✅ Sécurité et confidentialité
→ On peut restreindre l’accès à certaines colonnes ou lignes d’une table.
→ Utile pour exposer uniquement les données nécessaires.

✅ Réutilisable
→ Une vue peut être utilisée dans d’autres vues ou requêtes complexes.
→ On peut construire des UNION, des jointures, des filtres, etc., puis les manipuler comme une "variable de requête".

✅ Optimisation des requêtes
→ Évite de répéter des sous-requêtes lourdes à chaque fois.

## 🛠️ Syntaxe de base

CREATE VIEW nom_vue AS
SELECT col1, col2, ...
FROM nom_table
WHERE condition;

* 🔄 Gestion des vues

ALTER VIEW nom_vue AS
SELECT ...;               -- Pour modifier une vue

DROP VIEW nom_vue;        -- Pour supprimer une vue

CREATE OR REPLACE VIEW nom_vue AS
SELECT ...;               -- Pour créer ou écraser une vue existante

SHOW FULL TABLES
WHERE table_type = 'VIEW';  -- Pour lister les vues existantes

🔁 Exemples d’usage avancé

    Créer une vue à partir d'une autre vue :

CREATE VIEW vue_2 AS
SELECT * FROM vue_1
WHERE col = 'valeur';

    Masquer des données sensibles :

CREATE VIEW vue_sécurisée AS
SELECT nom, prénom
FROM utilisateurs
WHERE rôle != 'admin';

    Préparer une UNION complexe :

CREATE VIEW ventes_totales AS
SELECT client_id, montant FROM ventes_en_ligne
UNION
SELECT client_id, montant FROM ventes_en_magasin;

Puis :

SELECT client_id, SUM(montant)
FROM ventes_totales
GROUP BY client_id;