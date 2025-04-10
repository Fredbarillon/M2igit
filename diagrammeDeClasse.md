# UML – Diagramme de Classe

## 🧠 Philosophie générale

Un **diagramme de classe UML** permet de modéliser la structure interne d'un système orienté objet. Il présente :

- Les **classes** (entités logiques)
- Leurs **attributs** (données)
- Leurs **opérations** (méthodes)
- Et les **relations** entre elles (association, héritage, dépendance...)

Ce diagramme est très utilisé en analyse et conception orientée objet, pour passer du besoin au code.

---

## 📁 Structure d'une classe UML

Une classe est représentée sous forme d'un rectangle à 3 compartiments :

1. **Nom de la classe** (centré et en gras)
2. **Attributs** (avec leur visibilité, type, et éventuellement valeur par défaut)
3. **Opérations** (méthodes avec visibilité, paramètres et type de retour)

### Symboles de visibilité :

| Symbole | Visibilité | Portée                                               |
| ------- | ---------- | ---------------------------------------------------- |
| `+`     | Public     | Accessible depuis toutes les autres classes          |
| `-`     | Privé      | Accessible uniquement depuis la classe elle-même     |
| `#`     | Protégé    | Accessible depuis la classe et ses sous-classes      |
| `~`     | Package    | Accessible depuis les classes du même package/module |

> 🔎 Un attribut `static` peut être accédé sans instance, mais garde sa visibilité normale.

---

## 🔗 Relations entre classes

### Héritage (Généralisation)
- Flèche avec triangle vide.
- Une classe **fille** hérite des attributs/méthodes d’une **classe mère**.

### Dépendance
- Flèche en pointillée.
- Une classe utilise temporairement une autre dans une méthode (paramètre ou variable locale).

### Association
- Trait plein entre deux classes.
- Peut être bidirectionnelle ou unidirectionnelle (flèche).
- Exemple : *Un client a un ou plusieurs comptes*.

### Agrégation
- Association avec **losange vide** du côté du "tout".
- Représente une relation *part-of* faible (l'objet peut exister indépendamment).
- 💡 *Similaire à `<<include>>` dans les diagrammes de cas d'utilisation : une fonctionnalité utilisée par une autre, mais les deux restent indépendantes.*
la destruction de cette classe n'entraine pas la destruction de l'autre

### Composition
- Association avec **losange plein** du côté du "tout".
- Représente une relation *part-of* forte : la destruction du conteneur entraîne la destruction du contenu.
- 💡 *Comparable à une inclusion obligatoire dans la logique du système.*

---

## 🔄 Multiplicité

La **multiplicité** se note aux extrémités d'une association pour préciser combien d'instances peuvent participer :

- `1` : exactement un
- `0..1` : zéro ou un
- `*` : zéro ou plusieurs
- `1..*` : au moins un
- `0..*` : tout nombre

> Exemple : un `Client` peut avoir `0..*` `Commandes`

---

## 🔍 Navigabilité

- Une association peut être **navigable** : la classe A "connaît" la classe B.
- Une **flèche** indique la direction possible de navigation.
- **Sans flèche** : navigation dans les deux sens.

---

## 🧩 Similarités avec le diagramme de cas d'utilisation

| Élément du diagramme de classe | Élément équivalent en cas d'utilisation               | Explication                                                                 |
|-------------------------------|--------------------------------------------------------|-----------------------------------------------------------------------------|
| **Héritage**                  | Généralisation entre acteurs                          | Permet de partager des comportements ou responsabilités                    |
| **Agrégation**                | `<<include>>`                                          | Composant utilisé par un autre, mais pouvant vivre indépendamment          |
| **Composition**               | `<<include>>` fort / interne                           | Étroitement intégré, destruction liée                                      |
| **Dépendance**                | Déclenchement ponctuel d’un cas secondaire             | Utilisation temporaire, non structurelle                                   |
| **Multiplicité**              | Peu présent, mais comparable aux scénarios optionnels  | Permet de représenter les variations de comportement                       |
| **Navigabilité**              | Direction de l'interaction entre acteur et système     | Qui initie / connaît l'autre dans l’échange                                |

> 🎯 Ces comparaisons ne sont pas toujours parfaites, mais permettent de faire des ponts logiques entre les deux types de diagrammes UML.

---

## 📆 Lire un diagramme de classe

1. Identifier les **classes** (souvent les noms propres dans l'UE).
2. Lire les **attributs** pour comprendre les données.
3. Lire les **opérations** pour voir le comportement attendu.
4. Regarder les **relations** (types et multiplicités).
5. Identifier les liens d'héritage pour voir la hiérarchie.

> 📒 Astuce : un diagramme de classe est une **vue logique du code orienté objet**. On construit d'abord les classes et les raltions, on rempli après.
---


 exemple:voir diagramme
 ```bash
 @startuml
class Bibliotheque {
  - documents : List<Document>
  - adherents : List<Adherent>
  + ajouterDocument( Document)
  + inscrire(Adherent)
  + desinscrire(Adherent)
  + checkLivresEmpruntes(Adherent)
}

class Adherent {
  - prenom : string
  - nom : string
  - livresEmpruntes : List<Livre>
  + emprunter(Livre)
  + rendre(Livre)
}

class Emprunt {
  - dateEmprunt : date
  - dateRetour : date
  + prolonger()
}

' === DOCUMENTS ===
class Document {
  - titre : string
}

class Journal {
  - dateParution : date
}

class Volume {
  - auteur : string
}

class Livre {
  - isRented : bool
  + tousLesGetters()
}

class Bd {
  - dessinateur : string
}

class Dictionnaire {
}

' === HERITAGE ===

Document <|-- Journal
Document <|-- Volume

Volume <|-- Livre
Volume <|-- Bd
Volume <|-- Dictionnaire

' === ASSOCIATIONS ===

Bibliotheque "1" o-- "*" Document : contient
Bibliotheque "1" o-- "*" Adherent : gère

Adherent "1" o-- "0..3" Livre : emprunte
Emprunt "1" o-- "1" Livre : concerne
Emprunt "1" o-- "1" Adherent : effectué par

Livre "0..1" --> "0..1" Emprunt : est associé à
@enduml
```