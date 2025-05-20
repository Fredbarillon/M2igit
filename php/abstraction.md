
# 🧱 Abstraction en PHP – Fiche récapitulative

## 🔑 Définition

- L'**abstraction** permet de définir une **structure commune** à plusieurs classes, **sans pouvoir l'instancier directement**.
- Une **classe abstraite** est une classe déclarée avec le mot-clé `abstract`.
- Elle peut contenir :
  - des **méthodes abstraites** (sans corps, juste la signature),
  - des **méthodes concrètes** (avec corps),
  - des **constructeurs**,
  - des **propriétés concrètes**.

---

## 📌 Méthodes abstraites

- Doivent être définies avec le mot-clé `abstract`.
- **Pas de corps `{}`**, uniquement une **signature**.
- Obligatoirement **implémentées dans les classes enfants**.

```php
abstract class Forme {
    abstract public function calculerAire(): float;
}
```

---

## 🚫 Propriétés abstraites ?

- ❌ En PHP, **les propriétés ne peuvent pas être abstraites**.
- ✔️ Tu peux définir des propriétés `protected` ou `public` que les classes enfants utiliseront.

---

## 🧱 Exemple complet

```php
abstract class Forme {
    public function __construct(protected string $nom) {}

    abstract public function calculerAire(): float;
    abstract public function calculerPerimetre(): float;

    public function infos(): void {
        echo "Forme : {$this->nom}" . PHP_EOL;
    }
}
```

### Rectangle :

```php
class Rectangle extends Forme {
    public function __construct(
        protected float $longueur,
        protected float $largeur,
        string $nom
    ) {
        parent::__construct($nom);
    }

    public function calculerAire(): float {
        return $this->longueur * $this->largeur;
    }

    public function calculerPerimetre(): float {
        return 2 * ($this->longueur + $this->largeur);
    }

    public function infos(): void {
        parent::infos();
        echo "Longueur : {$this->longueur}" . PHP_EOL;
        echo "Largeur : {$this->largeur}" . PHP_EOL;
        echo "Aire : {$this->calculerAire()}" . PHP_EOL;
        echo "Périmètre : {$this->calculerPerimetre()}" . PHP_EOL;
    }
}
```

### Cercle :

```php
class Cercle extends Forme {
    public function __construct(
        protected float $rayon,
        string $nom
    ) {
        parent::__construct($nom);
    }

    public function calculerAire(): float {
        return pi() * pow($this->rayon, 2);
    }

    public function calculerPerimetre(): float {
        return 2 * pi() * $this->rayon;
    }

    public function infos(): void {
        parent::infos();
        echo "Rayon : {$this->rayon}" . PHP_EOL;
        echo "Aire : {$this->calculerAire()}" . PHP_EOL;
        echo "Périmètre : {$this->calculerPerimetre()}" . PHP_EOL;
    }
}
```

---

## 🧪 Utilisation

```php
$forme1 = new Rectangle(5, 10, "Rectangle");
$forme2 = new Cercle(7, "Cercle");

$forme1->infos();
$forme2->infos();
```

---

## ✅ Bonnes pratiques & compléments

- Une classe abstraite est idéale pour **partager du code commun** tout en forçant certaines méthodes à être définies.
- Tu peux utiliser **`parent::`** pour appeler des méthodes ou des constructeurs du parent.
- Depuis **PHP 8.1**, tu peux utiliser **Constructor Property Promotion** même dans des classes abstraites :

```php
abstract class Forme {
    public function __construct(public string $nom) {}
}
```

---

## ❗ À retenir

| Élément               | Autorisé ? |
|-----------------------|------------|
| Instancier une classe abstraite | ❌ Non |
| Méthode abstraite     | ✅ Oui |
| Propriété abstraite   | ❌ Non |
| Constructeur dans une classe abstraite | ✅ Oui |
| Appel via `parent::` dans l'enfant | ✅ Oui |

---
