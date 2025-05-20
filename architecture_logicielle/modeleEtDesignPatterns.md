🏛️ Architecture logicielle
➤ Objectif :

Répondre à des problématiques structurelles :

    Où placer la logique métier ?

    Comment accéder aux données ?

    Qui gère l’interaction avec l’utilisateur ?

    Que peut ou ne peut pas faire un module ?

🧱 Modèles d’architecture applicative
🔹 Application monolithique

Tout est regroupé dans un seul bloc (fichier ou serveur).
✅ Avantages :

    Déploiement rapide, architecture simple.

    Moins de complexité réseau.

❌ Inconvénients :

    Difficile à faire évoluer.

    Faible résilience (un bug impacte tout).

🔹 Application moderne : critères clés

    Maintenabilité

    Scalabilité (adaptabilité à la montée en charge)

    Testabilité

    Répartition claire entre les équipes

    Performance et résilience

📐 Architecture en couches (n-tiers)

Modèle structuré en couches verticales.
Exemples : MVC étendu, Hexagonal, Onion…
1️⃣ Présentation / Interface (UI)

    Gère l’interaction utilisateur : navigateur, mobile, API REST.

    Contient les contrôleurs.

    ⚠️ Ne contient aucune logique métier.

2️⃣ Service / Métier

    Gère les règles métier et la logique d’application.

    Coordonne les appels aux couches inférieures.

    Exemples : authService(), validerCommande().

3️⃣ Accès aux données (DAO / Repository)

    Point d’entrée unique vers la base de données.

    ❌ Pas de logique métier ici.

    Exemples : commandeRepo.save().

ORM :

    Outils : Prisma, TypeORM, Sequelize, Doctrine…

    Transforment les objets métiers en objets relationnels.

🔁 Communication entre couches

    Uniquement verticale :
    une couche ne connaît que la couche directement inférieure/supérieure.

    Exemple :
    UI → Controller → Service → Repository → BDD
    UI ← Controller ← Service ← Repository ← BDD

🌐 Architecture microservices
➤ Caractéristiques :

    Chaque service est un module indépendant, interconnecté par API.

    Langages indépendants possibles.

    Modules connectés via un réseau (HTTP, AMQP, etc.).

✅ Avantage :

    Très flexible, adaptable à des équipes différentes.

❗Inconvénient :

    La communication entre services devient plus complexe que leur contenu.

🎭 MVC et variantes (compatible avec n-tiers)
➤ Type : Patron de conception structurel
🎯 Objectifs :

    Séparer les responsabilités (affichage, données, logique).

    Favoriser les tests unitaires, modularité, réutilisation.

    Modifier l’interface sans impacter la logique métier.

📦 Composants MVC :
📊 Model :

    Représente les entités métiers (ex : Commande, Utilisateur).

    Contient les règles de gestion (méthodes, validations).

    Communique avec la base via repository / ORM.

👁 View :

    Affiche les données du modèle.

    0 logique métier.

🧭 Controller :

    Reçoit les actions de l’utilisateur (clic, requête HTTP...).

    Fait le lien entre vue et modèle.