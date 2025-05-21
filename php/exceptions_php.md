
# 💥 Exceptions en PHP – Fiche récapitulative

## 🔑 Définition

Une **exception** est un événement qui se produit pendant l'exécution du programme et **interrompt le flux normal du script**.

- On **lance** une exception avec `throw`.
- Le programme cherche alors **le premier bloc `catch`** capable de l’intercepter.
- Si aucune `catch` ne correspond, cela déclenche une **`Uncaught Exception`**.

---

## 🧪 Syntaxe générale

```php
try {
    // Code pouvant générer une exception
} catch (TypeException $e) {
    // Traitement de l'exception spécifique
} catch (Exception $e) {
    // Catch général (toujours le mettre en dernier)
} finally {
    // Code qui s'exécute toujours, qu'il y ait eu exception ou pas
}
```

---

## 🚀 Utiliser `throw` dans une fonction

```php
function division($a, $b) {
    if ($b === 0) {
        throw new Exception("Division par zéro interdite");
    }
    return $a / $b;
}
```

---

## 🧲 Exemple concret

```php
try {
    echo division(10, 0);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
} finally {
    echo "Fin de l'opération." . PHP_EOL;
}
```

---

## ⚙️ Créer une exception personnalisée

Tu peux créer des classes spécifiques en étendant `Exception`.

```php
class SoldeInsuffisantException extends Exception {
    public function __construct($message) {
        parent::__construct($message);
    }
}
```

Utilisation :

```php
try {
    throw new SoldeInsuffisantException("Solde trop bas !");
} catch (SoldeInsuffisantException $e) {
    echo "Erreur critique : " . $e->getMessage();
}
```

---

## 📚 Exceptions natives utiles (exemples)

- `InvalidArgumentException`
- `RuntimeException`
- `OutOfBoundsException`

---

## ✅ Bonnes pratiques

- Toujours **catcher les exceptions spécifiques en premier** :
```php
try {
    // ...
} catch (CustomException $e) {
    // spécifique
} catch (Exception $e) {
    // général
}
```

- Utiliser `finally` pour **fermer une connexion, un fichier ou libérer une ressource**.
- Ne pas faire `throw new Exception("...")` dans le `catch` sauf si tu veux relancer (rethrow).
- Préférer des **exceptions personnalisées** pour mieux structurer les erreurs métier.

---

## 🧠 Résumé

| Élément        | Description |
|----------------|-------------|
| `throw`        | Lancer une exception |
| `try`          | Tenter un bloc de code risqué |
| `catch`        | Intercepter et gérer une exception |
| `finally`      | Toujours exécuté, même après une exception |
| `Exception`    | Classe de base des exceptions |
| `extends Exception` | Créer ses propres erreurs typées |

---
