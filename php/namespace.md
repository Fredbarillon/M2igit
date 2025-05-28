
# 🗂️ Namespaces en PHP – Fiche récapitulative

## 🔑 Définition

Un **namespace** (espace de noms) permet de **regrouper des classes, fonctions, constantes ou interfaces** ayant un lien logique.  
Il est comparable à un **package** dans d'autres langages comme Java ou C#.

---

## 🎯 Pourquoi utiliser un namespace ?

- ✅ **Évite les collisions de noms** entre :
  - tes propres classes/fonctions
  - des classes PHP internes
  - des bibliothèques tierces (ex. : Symfony, Laravel)
- ✅ Permet de **gérer des alias** pour simplifier les appels.
- ✅ Crée des **groupes logiques** de fichiers selon la structure du projet.

---

## 🧩 Déclaration d’un namespace

```php
namespace App\Controller;
```

➡️ Cette ligne doit apparaître **tout en haut du fichier PHP**, **avant tout code PHP autre** (sauf `declare(strict_types=1)`).

---

## 📦 Accès aux éléments d’un namespace

- **Non qualifié** : `NomClasse`
- **Qualifié** : `SousNamespace\\NomClasse`
- **Entièrement qualifié** : `\\NamespaceComplet\\NomClasse`

---

## 🛠️ Importer avec `use`

Tu peux importer une classe, fonction ou constante d’un namespace pour éviter d’écrire le chemin complet :

```php
use App\Controller\UserController;
use MonFramework\Utils\Debug as DebugTool;
```

➡️ L’alias `as` permet de **renommer pour éviter les conflits**.

---

## 📁 Utilisation dans l’architecture

Les namespaces **reflètent souvent l’arborescence des fichiers** :

```
src/
├── Controller/
│   └── UserController.php   → namespace App\Controller;
├── Model/
│   └── User.php             → namespace App\Model;
```

---

## 🧪 Exemple complet

```php
// Fichier : src/Service/Mailer.php
namespace App\Service;

class Mailer {
    public function envoyer($dest) {
        echo "Envoi à $dest";
    }
}
```

```php
// Fichier : public/index.php
require_once '../src/Service/Mailer.php';

use App\Service\Mailer;

$mailer = new Mailer();
$mailer->envoyer("test@example.com");
```

---

## ✅ Bonnes pratiques

- Utiliser des namespaces **cohérents avec la structure des dossiers**.
- Ne jamais mélanger plusieurs namespaces dans un même fichier.
- Toujours faire les `require_once` nécessaires ou utiliser un **autoloader (ex: Composer)**.

---

## 🧠 En résumé

| Élément                | Utilisation                          |
|------------------------|--------------------------------------|
| Déclaration            | `namespace Mon\Namespace;`          |
| Importation            | `use Mon\Namespace\Classe;`         |
| Alias                  | `use ... as ...;`                    |
| Avantage principal     | Évite les collisions de noms         |
| Bonne pratique         | Refléter l’arborescence du projet    |

---
