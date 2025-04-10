# UML – Diagramme de Séquence (PlantUML)

Ce document explique **comment modéliser un diagramme de séquence UML** en utilisant **PlantUML**, avec les concepts clés et leur syntaxe.

---

## 🎭 Acteurs

- Un **acteur** ou **objet** est défini par `participant`, `actor`, `boundary`, `control`, `entity`, etc.
- Il apparaît en haut du diagramme, avec une **ligne de vie verticale** dessous.

```plantuml
participant Utilisateur
participant "Service Authentification" as Auth
```

---

## 📉 Ligne de vie

- La **ligne de vie** est une ligne pointillée qui part de l’objet.
- Des **barres d'activation** apparaissent lors de l'exécution d'une opération.

---
## Action
activate Client
deactivate Client


## 📩 Types de messages

### 🔹 Message synchrone
- Appel de méthode bloquant (le caller attend la fin).
```plantuml
Alice -> Bob : traiterDemande()
```

### 🔹 Message asynchrone
- Envoi de signal, non bloquant (le caller continue).
```plantuml
Client --> Serveur : notifier()
```

### 🔹 Message de retour
- Représente une réponse ou la fin d'une méthode.
- Flèche en pointillée de droite à gauche.
```plantuml
Bob --> Alice : OK
```

---

## 🧩 Création et destruction d'objet

### 🛠️ Création
- Ligne de vie créée dynamiquement avec `create` ou simple message.
```plantuml
create Service
Client -> Service : init()
```

### 💥 Destruction
- Utiliser `destroy NomObjet` à la suite d'une action de fin.
```plantuml
Session -> Session : logout()
destroy Session
```

---

## 🧰 Fragments combinés (structures de contrôle)

### 👉 `loop` : boucle
```plantuml
loop Tant que identifiants incorrects
  Utilisateur -> Auth : entrerIdentifiants()
  Auth -> BDD : verifier()
  BDD --> Auth : faux
end
```

### 👉 `alt` : condition (if/else)
```plantuml
alt Mot de passe correct
  Auth --> Utilisateur : accès OK
else Mot de passe incorrect
  Auth --> Utilisateur : erreur
end
```

### 👉 `opt` : condition optionnelle
```plantuml
opt se souvenir de moi activé
  Auth -> Cookie : enregistrer()
end
```

### 👉 `par` : parallélisme
```plantuml
par traitement image
  Serveur -> ModuleImage : traiter()
and traitement audio
  Serveur -> ModuleSon : analyser()
end
```

### 👉 `region` : section critique (accès exclusif)
```plantuml
region Accès BDD
  Service -> BDD : lock()
  Service -> BDD : write()
end
```

### 👉 `neg` : scénario interdit
```plantuml
neg tentative de piratage
  Utilisateur -> Auth : injection SQL
end
```

### 👉 `break` : rupture de scénario
```plantuml
break Compte désactivé
  Auth --> Utilisateur : refus immédiat
end
```

### 👉 `ref` : inclusion d’un autre diagramme
```plantuml
ref Authentification
```

---

## 🌐 Exemple combiné : scénario d’authentification

```plantuml
participant Utilisateur
participant Auth
participant BDD

alt Champs remplis
  Utilisateur -> Auth : envoyer identifiants
  Auth -> BDD : vérifier()
  BDD --> Auth : OK
  Auth --> Utilisateur : accès OK
else Champs vides
  Auth --> Utilisateur : erreur saisie
end
```

---

penser a numeroter les actions aide à la lisibilité

