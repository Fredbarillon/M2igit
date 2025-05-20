## 🛡️ DCL – Data Control Language

Le DCL sert à gérer les droits d’accès aux bases de données.
Il permet de restreindre ou accorder l’accès à des utilisateurs ou des rôles selon leurs privilèges.
👤 Création d’un utilisateur

CREATE USER 'username'@'host' IDENTIFIED BY 'password';

    username : nom de l’utilisateur

    host :

        'localhost' → accès local

        '%' → accès depuis n’importe quelle IP (⚠️ à sécuriser !)

    🔐 % doit être utilisé avec SSL ou sur des connexions sécurisées uniquement

## 🗝️ GRANT – Accorder des droits

GRANT privileges ON database.table TO 'username'@'host';

🔹 Exemples de privileges :

    SELECT, INSERT, UPDATE, DELETE

    ALL PRIVILEGES → tous les droits

    CREATE, DROP, ALTER, INDEX, EXECUTE...

🔹 Exemples de ON :

    *.* → toutes les bases, toutes les tables

    ma_base.* → toutes les tables de la base ma_base

    ma_base.ma_table → une table précise

## 🛑 REVOKE – Retirer des droits

REVOKE privileges ON database.table FROM 'username'@'host';

🔍 Voir les droits d’un utilisateur

SHOW GRANTS FOR 'username'@'host';

    ✅ Cela montre tous les GRANT actifs pour ce user.

## 🔄 FLUSH PRIVILEGES

FLUSH PRIVILEGES;

    Sert à rafraîchir les droits, utile si modification manuelle des tables système.
    Aujourd’hui, la plupart des SGBD n’en ont plus besoin automatiquement.

## 🧑‍🤝‍🧑 Rôles et groupes

    Un rôle est un groupe de permissions qu’on peut accorder à un ou plusieurs utilisateurs.

    On utilise la même syntaxe que pour les utilisateurs.

CREATE ROLE 'lecture_seule';
GRANT SELECT ON ma_base.* TO 'lecture_seule';
GRANT 'lecture_seule' TO 'utilisateur1'@'localhost';

    📌 Un rôle peut même donner le droit à un utilisateur de créer d'autres utilisateurs dans un scope défini.

## ⚙️ Gestion avancée des utilisateurs
## 🔐 Limites d’utilisation

ALTER USER 'username'@'host'
WITH
  MAX_QUERIES_PER_HOUR 100,
  MAX_UPDATES_PER_HOUR 50,
  MAX_CONNECTIONS_PER_HOUR 200,
  MAX_USER_CONNECTIONS 10;

🔒 Verrouiller / déverrouiller un compte

ALTER USER 'username'@'host' ACCOUNT LOCK;
ALTER USER 'username'@'host' ACCOUNT UNLOCK;

⌛ Expiration de mot de passe

ALTER USER 'username'@'host' PASSWORD EXPIRE;
ALTER USER 'username'@'host' PASSWORD EXPIRE INTERVAL 90 DAY;

## 🗑️ Supprimer un utilisateur

DROP USER 'username'@'host';

## 🎯 Échelles de permissions
Niveau	Exemple
Serveur entier	GRANT ALL ON *.*
Base de données	GRANT SELECT ON ma_base.*
Table	GRANT INSERT ON ma_base.ma_table
Colonne (rare)	GRANT SELECT (col1, col2) ON ma_base.ma_table