## 📚 Bases de données relationnelles vs NoSQL
## 🧱 Les SGBD relationnels (SQL)

## ➤ Principaux SGBD relationnels :

    MySQL : gratuit, très utilisé dans le web, bonnes performances mais moins robuste sur les aspects financiers.

    PostgreSQL : open-source, riche en fonctionnalités, très fiable. Recommandé pour les services financiers ou les systèmes exigeants en intégrité des données.

    MariaDB : fork de MySQL, plus transparent (communauté open-source), compatible avec MySQL.

    SQLite : base embarquée, légère, sans serveur. Idéal pour les applications mobiles ou locales.

    Oracle : très robuste et sécurisée, utilisée dans des environnements critiques (ex : banques, défense). Mais coûteuse et complexe.

## ! Inconvénients SQL :

    Schéma rigide : chaque table a des colonnes définies à l’avance.

    Scalabilité verticale : pour améliorer les performances, il faut un serveur plus puissant. Pas adapté aux systèmes très distribués.

    Peu efficace avec des données non structurées (textes, logs, objets multimédias).

    Moins performant à très grande échelle (Big Data).

## 🚀 Les bases de données NoSQL

    NoSQL = Not Only SQL, elles offrent d'autres modèles que le relationnel.

## 🔑 Avantages généraux :

    Scalabilité horizontale : les données sont réparties sur plusieurs serveurs (clustering, sharding), ce qui facilite la montée en charge.

    Pas de schéma fixe : permet de stocker des données hétérogènes.

    Performance accrue pour les écritures/lectures massives.

    Adaptées aux données non structurées ou semi-structurées.

    Conçues pour les applications modernes (réseaux sociaux, e-commerce, IoT, etc.).

## 🔍 Les grands modèles de NoSQL
1. 📄 Base orientée documents

    🔧 Exemple : MongoDB

    🔹 Stocke les données sous forme de documents (type JSON → BSON).

    🔹 Chaque document peut avoir des champs différents, donc très flexible.

    🔹 Adapté aux catalogues de produits, profils utilisateurs, CMS, etc.

    ✅ Avantages :

        Lecture/écriture rapide.

        Structure proche des objets dans les langages modernes.

        Indexation possible sur des champs internes.

2. 🗝️ Base clé-valeur

    🔧 Exemple : Redis

    🔹 Stocke des paires clé → valeur (comme un dictionnaire).

    🔹 Idéal pour la gestion de cache, sessions utilisateurs, files d'attente.

    ✅ Avantages :

        Ultra rapide (en mémoire).

        Simple à utiliser.

    ❗ Limité pour les requêtes complexes.

3. 🧱 Base en colonnes

    🔧 Exemple : Cassandra DB

    🔹 Données stockées en colonnes plutôt qu’en lignes.

    🔹 Chaque ligne peut avoir un nombre variable de colonnes.

    🔹 Très bon pour l'écriture massive, le Big Data et les requêtes analytiques (IoT, journaux, etc.).

    ✅ Avantages :

        Résilient et très scalable.

        Idéal pour les systèmes qui écrivent en continu.

4. 🕸️ Base orientée graphes

    🔧 Exemple : Neo4J

    🔹 Structure de données : nœuds (entités) et arêtes (relations).

    🔹 Représente naturellement des réseaux complexes : amis, recommandations, préférences, connexions.

    ✅ Avantages :

        Performant pour requêtes relationnelles profondes (ex : "amis d’amis").

        Idéal pour réseaux sociaux, moteurs de recommandation, détection de fraudes.

5. 🌀 Base multimodèle

    🔧 Exemple : ArangoDB, OrientDB

    🔹 Supporte plusieurs modèles : documents, graphes, clé-valeur, etc.

    🔹 Permet de combiner différents types de données dans un seul SGBD.

## ⚠️ Inconvénients des NoSQL

    📌 Chaque solution a ses propres commandes, API, et concepts → pas de langage unifié.

    📌 Moins adapté quand les relations complexes sont indispensables (ex : jointures SQL).

    📌 Moins de maturité pour certaines fonctionnalités critiques (transactions ACID, sécurité avancée).

## 🧠 Le Théorème CAP

    S’applique aux bases distribuées sur plusieurs nœuds (NoSQL en particulier) :

Tu ne peux garantir que 2 sur 3 des propriétés suivantes :
Propriété	Définition
C (Consistency)	Tous les nœuds ont la même donnée à tout moment.
A (Availability)	Le système répond toujours, même en cas de panne.
P (Partition Tolerance)	Le système fonctionne malgré la perte d’un lien réseau entre nœuds.

    ➤ Par exemple :

    MongoDB privilégie Availability + Partition Tolerance.

    Cassandra privilégie Availability + Partition Tolerance.

    HBase privilégie Consistency + Partition Tolerance.

## 🎯 Cas d’usage typiques de NoSQL
Secteur	Cas d’usage	Modèle conseillé
Réseaux sociaux	Relations utilisateurs, recommandations	Graphe (Neo4J)
E-commerce	Fiches produits hétérogènes, recherches rapides	Document (MongoDB)
Big Data / Logs	Collecte et analyse de millions d’entrées	Colonnes (Cassandra)
Gestion de sessions	Sessions utilisateurs temporaires	Clé-valeur (Redis)
IoT / capteurs	Écritures en masse, stockage souple	Colonnes ou documents