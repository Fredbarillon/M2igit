
## 🧩 Jointures et clés étrangères (Foreign Keys)
## 📍 Où mettre la foreign key ?

L’emplacement de la clé étrangère dépend du type de relation entre les tables :

    one-to-one

    one-to-many

    many-to-many

La foreign key est utilisée pour :

    Assurer que la relation est possible lorsqu’on crée une INNER JOIN

    Préserver l’intégrité référentielle de la base de données (empêcher des liaisons orphelines)

## 🔁 Types de relations
## ✅ One-to-One

    On peut mettre la foreign key dans l'une ou l'autre des deux tables.

    On ajoute une contrainte UNIQUE pour interdire les doublons.

    Bonne pratique : mettre la foreign key dans la table dépendante (ex : passport dépend de user).

        Si un passport disparaît, l’utilisateur peut rester.

        Mais si un user disparaît, le passport ne devrait pas exister non plus.

## 🔁 One-to-Many

    Une seule foreign key.

    On place la foreign key dans la table "enfant", celle qui dépend de la "table parent".

    Cela permet plusieurs lignes dans la table enfant pour une seule dans la table parent.

## 🔄 Many-to-Many

    On crée une table de liaison intermédiaire.

    Cette table contient les deux foreign keys correspondant aux IDs des deux autres tables.

    Exemple :

        students

        courses

        → table student_course avec student_id et course_id comme foreign keys

## 🛠️ Construction d'une jointure
## 🔎 INNER JOIN

    Utilisé pour ne retourner que les lignes qui ont une correspondance dans l'autre table.

    S’il n’y a pas de foreign key en commun, la ligne est ignorée.

    On précise toujours les colonnes avec table.colonne pour éviter les ambiguïtés.

## 💡 Exemple :

SELECT users.name, orders.order_date
FROM users
INNER JOIN orders ON users.id = orders.user_id;

    🔍 Cela retourne uniquement les commandes (orders) qui sont reliées à un utilisateur (users).

    🧰 USING et alias dans les jointures
🧷 USING : simplifier une INNER JOIN si les deux tables ont une colonne de même nom

    Lorsque les deux tables ont une colonne ayant exactement le même nom (ex : id, user_id, etc.), on peut utiliser USING() pour simplifier la syntaxe de la jointure.

    Cela évite de devoir répéter table.colonne = table.colonne.

✅ Exemple :

INNER JOIN orders USING(id)

équivaut à :

INNER JOIN orders ON users.id = orders.id

📝 Attention : la colonne spécifiée dans USING() doit exister avec le même nom dans les deux tables.
🧱 Renommer une table dans une requête (alias)

    On peut renommer les tables temporairement dans une requête avec AS (ou sans AS).

    Cela rend la requête plus lisible, surtout en cas de jointures avec plusieurs tables.

    Convention fréquente : utiliser la première lettre du nom de la table.

✅ Exemple avec alias :

SELECT u.name, o.amount
FROM users AS u
INNER JOIN orders AS o USING(id);

    🧠 Ici u représente users et o représente orders.


   ## 🔀 UNION et autres types de jointures avancées
🧵 UNION — assembler plusieurs requêtes

    Le mot-clé UNION permet de fusionner les résultats de deux requêtes SQL ayant les mêmes colonnes (même nombre et même type).

    Très utile pour simuler un FULL OUTER JOIN en MySQL, en combinant un LEFT JOIN et un RIGHT JOIN.

📌 Attention : chaque requête doit avoir la même structure (même nombre de colonnes et types compatibles).

✅ Exemple de UNION :

SELECT name, order_date
FROM users LEFT JOIN orders ON users.id = orders.user_id
UNION
SELECT name, order_date
FROM users RIGHT JOIN orders ON users.id = orders.user_id;

    Cela simule un FULL JOIN en MySQL.

## 🧬 Jointure naturelle (NATURAL JOIN)

    La jointure naturelle fait un INNER JOIN automatique sur les colonnes de même nom entre deux tables.

    Pas besoin d’écrire ON table1.col = table2.col : c’est automatique.

✅ Syntaxe :

SELECT users.name, orders.amount
FROM users NATURAL JOIN orders;

⚠️ À utiliser uniquement dans des cas simples où l’on contrôle parfaitement les colonnes.
Sinon, cela peut produire des résultats imprévus si des colonnes ont le même nom mais pas la même sémantique.
❌ Jointure croisée (CROSS JOIN)

    Produit le produit cartésien de deux tables.

    Associe toutes les lignes de la première table à toutes les lignes de la seconde.

✅ Exemple :

SELECT *
FROM table1
CROSS JOIN table2;

    📊 Si table1 contient 5 lignes et table2 en contient 4, le résultat aura 5 × 4 = 20 lignes.

## 🔁 Auto-jointure (SELF JOIN)

    Une auto-jointure consiste à joindre une table avec elle-même.

    On utilise des alias pour différencier les deux instances.

📌 Pourquoi l’utiliser ?

    Pour faire référence à deux lignes différentes d’une même table.

    Cas classiques :

        Un employé et son manager (stockés dans une seule table avec manager_id)

        Comparer un groupe de données à un autre groupe (ex : employés vs. moyenne de leur métier)

✅ Exemple simple :

SELECT e1.name AS employee, e2.name AS manager
FROM employees AS e1
INNER JOIN employees AS e2 ON e1.manager_id = e2.id;

✅ Exemple plus complexe :

SELECT j1.job_title, j1.salary, AVG(j2.salary) AS avg_salary_same_job
FROM jobs AS j1
JOIN jobs AS j2 ON j1.job_title = j2.job_title
GROUP BY j1.job_title, j1.salary;

    Ici, on compare le salaire d’une personne à la moyenne des salaires de son métier — grâce à une auto-jointure.

## Pour voir l'utilité des index ou pas:
EXPLAIN SELECT * FROM...  pour check si l'index est utilisé par le sgbd
automatiser des scripts d'explain select pour check son idexation et la vitesse du site