
# 🧱 Programmation Orientée Objet en PHP – Récapitulatif

## 🔒 Visibilité des classes, méthodes et attributs

- **`public`** : accessible partout.
- **`protected`** : accessible dans la classe et ses enfants.
- **`private`** : accessible uniquement dans la classe elle-même.

**Exemples :**

```php
class Exemple {
    private $secret = "Invisible";

    private function cacherSecret() {
        return "Méthode privée";
    }
}
```

---

## 🧰 Le Constructeur (`__construct`)

- Méthode spéciale appelée automatiquement lors de la création d’un objet.
- On peut définir les attributs en amont ou les créer directement dans le constructeur avec leur visibilité.

```php
class User {
    public string $nom;

    public function __construct(string $nom) {
        $this->nom = $nom;
    }
}
```

---

## 🔁 `$this`

- Disponible partout dans la classe (attributs, méthodes).
- Fait référence à l’**instance courante**.

```php
$this->nom = $nom;
```

---

## 🧩 Getters et Setters

Permettent d'encapsuler l'accès aux propriétés privées.

```php
class Produit {
    private float $prix;

    public function setPrix(float $prix): void {
        if ($prix > 0) $this->prix = $prix;
    }

    public function getPrix(): float {
        return $this->prix;
    }
}
```

---

## 🧹 Destructeur (`__destruct`)

- Appelé automatiquement lors de la destruction de l’objet.

```php
public function __destruct() {
    echo "Objet détruit";
}
```

- Si besoin, on peut lui passer des paramètres (rare) :

```php
public function __destruct(...$params): void {}
```

- Sinon, on peut forcer la destruction avec :
```php
unset($objet);
```

---

## 🧷 Static

- Une méthode ou propriété `static` appartient à la **classe elle-même**, pas à une instance.

```php
class Compteur {
    public static int $nb = 0;

    public static function incremente() {
        self::$nb++;
    }
}
```

Accès : `Classe::methode()`, ou via `self::` ou `static::` dans une méthode statique.

---

## 📦 `__toString()`

Méthode spéciale appelée lorsqu’un objet est affiché sous forme de texte.

```php
public function __toString(): string {
    return "Utilisateur: {$this->nom}";
}
```

---

## 🧬 Héritage

- Une classe enfant hérite d’une classe parent avec `extends`.

```php
class Animal {
    public function parler() {
        return "Je fais un bruit";
    }
}

class Chien extends Animal {
    public function parler() {
        return "Wouf!";
    }
}
```

---

## 🧠 Polymorphisme

- Une **même méthode** peut avoir un **comportement différent** selon la classe appelante.

---

## 🧱 Surcharge (Override)

Redéfinir une méthode héritée avec un nouveau comportement.

```php
class ParentClass {
    public function direBonjour() {
        return "Bonjour du parent";
    }
}

class EnfantClass extends ParentClass {
    public function direBonjour() {
        return "Bonjour de l'enfant";
    }
}
```

Utiliser `parent::` pour accéder au comportement de base :

```php
public function direBonjour() {
    return parent::direBonjour() . " + enfant";
}
```

---

## 🛑 `final`

Empêche une classe d’être héritée ou une méthode d’être surchargée.

```php
final class Base {}
final public function stop() {}
```

---

## 📁 Inclusion de fichiers

- `require` : inclus et **stoppe tout** si erreur.
- `require_once` : comme `require`, mais une seule fois.
- `include` : inclus, **mais ne stoppe pas** si erreur.
- `include_once` : comme `include`, mais une seule fois.

---

## 💡 Ternaire pour condition

```php
$isAlive = ($this->health <= 0) ? false : true;

// Encore plus concis :
$isAlive = $this->health > 0;
```
