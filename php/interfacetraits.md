
# 🧩 Interfaces en PHP – Fiche récapitulative

## 🔑 Définition

- Une **interface** définit un **contrat** que les classes (ou autres interfaces) doivent respecter.
- Une interface **ne contient que des signatures de méthodes** (aucune propriété ou logique).
- Toutes les méthodes déclarées dans une interface sont **implicitement publiques et abstraites**.

```php
interface Utilisable {
    public function utiliser(); on peut mettre des parma bien sur si on souhaite (meme des tableau d'elements indéfini ... mais attention a delcarer derriere dans l'enfant)
}
```

---

## 📌 Règles importantes

- Une interface **n'est pas une classe**.
- Elle ne contient **aucun attribut**. !!!si depuis php 8.4!! voir doc
- Elle ne contient **que des méthodes sans corps** (juste les signatures).
- **Une classe** qui implémente une interface doit obligatoirement **implémenter toutes ses méthodes** et celle des son parent.

---

## 🧬 Héritage et implémentation

- Une **interface peut hériter (extend)** d’une seule interfaces :

```php
interface A {
    public function methodeA();
}

interface B extends A {
    public function methodeB();
}
```

- Une **classe peut implémenter plusieurs interfaces** (mais **ne peut hériter que d'une seule classe**).

```php
class MaClasse implements A, B {
    public function methodeA() {}
    public function methodeB() {}
}
```

---

## 🚫 Ce que les interfaces **ne peuvent pas faire** :

- Elles ne peuvent pas **implémenter** d’autres interfaces → uniquement `extends`.
- Elles ne peuvent pas contenir de **propriétés**  !!php8.4 oui.
- Pas de **code logique** à l’intérieur, uniquement des méthodes à implémenter.

---

## ✅ Récapitulatif des mots-clés

| Élément        | Mot-clé       | Exemple                           |
|----------------|---------------|-----------------------------------|
| Interface      | `interface`   | `interface User { ... }`          |
| Implémentation | `implements`  | `class Client implements User`    |
| Héritage       | `extends`     | `interface B extends A`           |

---

## 🧠 Remarques pédagogiques

- Une interface est **comme une promesse** : toute classe qui l'implémente **s'engage à fournir une version concrète** des méthodes définies.
- L'intérêt est de **forcer certaines classes à partager des comportements**, même si elles ne sont **pas liées par héritage de classe**.
- C’est aussi une **alternative puissante à l’héritage multiple**.

---



# 🧩 Traits en PHP – Fiche récapitulative

## 🔑 Définition

- Un **trait** est un **mécanisme de réutilisation de code** dans plusieurs classes.
- Il permet de **regrouper des méthodes** communes à inclure dans plusieurs classes **sans duplication**.
- C’est une forme de **copier-coller intelligent**, uniquement à utiliser **dans des classes** (pas dans des interfaces ou en dehors d'une classe).

---

## 📌 Caractéristiques d’un trait

- **Non instanciable** (comme une classe abstraite).
- Ne peut pas avoir de **constructeur**.
- Contient généralement **des méthodes** (et parfois des propriétés, mais à éviter).
- S’utilise avec le mot-clé `use` dans la classe concernée.

```php
trait Logger {
    public function log($message) {
        echo "[LOG] $message" . PHP_EOL;
    }
}
```

---

## 🧪 Utilisation dans une classe

```php
class Application {
    use Logger;

    public function run() {
        $this->log("L'application démarre...");
    }
}
```

---

## 🛠️ Bonnes pratiques

- **Pas d’attributs** dans les traits si possible → cela **alourdit les constructeurs** des classes qui les utilisent.
- Toujours gérer l’initialisation via le **constructeur de la classe** qui utilise le trait (il n’y a **pas de `parent::__construct()`** pour un trait).
- Éviter d’avoir des dépendances croisées entre traits (chaîne de dépendance difficile à maintenir).
- Si les traits sont stockés dans des fichiers séparés : **`require_once`** ou autoload obligatoire.

---

## ✅ Récapitulatif

| Élément                  | Trait                                  |
|--------------------------|----------------------------------------|
| Instanciable             | ❌ Non                                  |
| Contient des méthodes    | ✅ Oui                                  |
| Contient des attributs   | ⚠️ Possible mais déconseillé            |
| Constructeur             | ❌ Non                                  |
| Utilisation              | `use` dans une classe                  |
| Peut être dans une classe | ✅ Oui                                 |
| Peut être dans une interface | ❌ Non                             |

---

## 📦 Exemple concret

```php
trait Horodatage {
    public function afficherDate() {
        echo "Date : " . date('Y-m-d H:i:s') . PHP_EOL;
    }
}

class Email {
    use Horodatage;

    public function envoyer() {
        echo "Envoi de l'email..." . PHP_EOL;
        $this->afficherDate();
    }
}
```

---

## ⚔️ Conflits entre méthodes de traits

- En cas de **conflit de plusieurs traits ayant des méthodes du même nom**, on utilise une **résolution avec des accolades `{}`** dans la déclaration du `use`.
- On peut sélectionner la méthode d’un trait avec `TraitA::method insteadof TraitB` pour forcer l’usage d’un trait spécifique.
- Cela **n’affecte pas les autres méthodes** qui n’ont pas de conflit.

```php
trait A {
    public function hello() {
        echo "Bonjour depuis A";
    }
}

trait B {
    public function hello() {
        echo "Bonjour depuis B";
    }
    public function bye() {
        echo "Au revoir depuis B";
    }
}

class Demo {
    use A, B {
        A::hello insteadof B; // on garde hello() de A
        B::hello as helloB;   // optionnel : on renomme celle de B
    }
}
```

---





