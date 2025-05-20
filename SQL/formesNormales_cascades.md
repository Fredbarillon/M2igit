## 📚 Formes normales (NF) – Normalisation des bases de données
➤ Objectif :

Éviter la redondance et les anomalies (insertion, mise à jour, suppression) en découpant correctement les informations dans des tables.
1️⃣ Première forme normale (1NF)

    Chaque cellule d'une table contient une valeur atomique et unique.

    ❌ Pas de liste, de tableau, de dictionnaire (map), etc.

    ✅ Toutes les colonnes doivent contenir des données indivisibles.

2️⃣ Deuxième forme normale (2NF)

    La table est en 1NF.

    Tous les attributs non clés dépendent entièrement de la clé primaire.

    ❌ Pas de dépendance partielle à une clé composite.

3️⃣ Troisième forme normale (3NF)

    La table est en 2NF.

    Aucun attribut non-clé ne doit dépendre transitivement d’une clé primaire.

    Ex : si A → B et B → C, alors C dépend de A de façon transitive → à corriger.

## 🧠 Edgar F. Codd & le modèle relationnel
➤ Qui est-il ?

Créateur du modèle relationnel de base de données (années 1970), qui définit les bases des SGBD relationnels.
✅ Les 12 règles de Codd

Ces règles sont des critères idéaux pour qu’un SGBD soit réellement "relationnel".
(✍️ Tu peux développer chaque règle plus tard si besoin)

Exemples :

    Règle 1 : toutes les données doivent être représentées sous forme de valeurs dans des tables.

    Règle 2 : accès garanti à toutes les données par une combinaison de nom de table, nom de colonne et valeur de clé primaire.

    etc.

## 🔁 Cascades et actions sur clés étrangères
➤ ON DELETE CASCADE

    Supprime automatiquement les lignes associées dans les tables enfants.

    ⚠️ Attention : peut causer des suppressions massives non désirées.

    🛠️ À utiliser avec prudence, surtout en production.

➤ ON UPDATE CASCADE

    Propagation des modifications de clé primaire vers les tables liées.

    ✅ Utile pour assurer la cohérence en cas de mise à jour d’un identifiant.

➤ Autres options :

    RESTRICT : empêche la suppression/mise à jour s'il existe des références.

    SET NULL : les clés étrangères deviennent NULL si la référence est supprimée.