
# ✨ Méthodes magiques en PHP – Fiche récapitulative

## 🔑 Définition

Les **méthodes magiques** sont des méthodes spéciales **fournies par PHP**, commençant par `__`.  
Elles permettent de **remplacer ou personnaliser un comportement par défaut du langage** quand une action particulière est réalisée sur un objet.

---

## 📦 Méthodes magiques principales

### 🔹 `__construct()`
- Appelée automatiquement lors de l’instanciation d’un objet.
- Sert à **initialiser** les propriétés ou l’état de l’objet.

---

### 🔹 `__destruct()`
- Appelée automatiquement lors de la **destruction de l’objet**.
- Pratique pour fermer une connexion, libérer une ressource, etc.

---

### 🔹 `__toString()`
- Appelée lorsqu’on tente **d’afficher l’objet comme une chaîne de caractères** (par exemple avec `echo`).

```php
public function __toString(): string {
    return "Je suis un objet affichable";
}
```

---

### 🔹 `__invoke()`
- Appelée quand **l’objet est utilisé comme une fonction**.

```php
class Startup {
    public function __invoke() {
        echo "Démarrage de l'application";
    }
}

$app = new Startup();
$app(); // Affiche : Démarrage de l'application
```

---

### 🔹 `__debugInfo()`
- Modifie **ce que `var_dump($objet)` affiche**.

```php
public function __debugInfo(): array {
    return ['info' => 'donnée simplifiée'];
}
```

---

## 🧩 Accès dynamique aux propriétés

### 🔹 `__get($property)`
- Déclenchée lorsqu’on **accède à une propriété inaccessible ou inexistante**.

```php
public function __get($property) {
    if (property_exists($this, $property)) {
        return $this->$property;
    }
}
```

➡️ Cela crée un **getter universel** pour accéder à toutes les propriétés privées ou protégées de façon indirecte.

---

### 🔹 `__set($property, $value)`
- Déclenchée lorsqu’on **tente d’écrire une valeur dans une propriété inaccessible ou inexistante**.

```php
public function __set($property, $value) {
    if (property_exists($this, $property)) {
        $this->$property = $value;
    }
}
```

⚠️ **Attention** : rend toutes les propriétés modifiables si mal utilisé, ce qui **affaiblit l'encapsulation**.

---

### 🔹 `__isset($property)`
- Appelée quand on fait `isset($objet->propriete)`.

```php
public function __isset($property) {
    return isset($this->$property);
}
```

---

### 🔹 `__unset($property)`
- Appelée lors de `unset($objet->propriete)`.

```php
public function __unset($property) {
    unset($this->$property);
}
```

---

## ✅ Résumé des comportements

| Méthode magique   | Déclenchée quand…                                                   |
|-------------------|----------------------------------------------------------------------|
| `__construct()`   | On instancie un objet                                               |
| `__destruct()`    | L’objet est détruit                                                 |
| `__toString()`    | L’objet est affiché comme une chaîne                                |
| `__invoke()`      | L’objet est appelé comme une fonction (`$obj()`)                    |
| `__debugInfo()`   | `var_dump()` est utilisé sur l’objet                                |
| `__get()`         | Accès à une propriété inaccessible/inexistante                      |
| `__set()`         | Écriture dans une propriété inaccessible/inexistante                |
| `__isset()`       | `isset($obj->prop)` sur propriété inaccessible                      |
| `__unset()`       | `unset($obj->prop)` sur propriété inaccessible                      |

---
