# 📘 Cours JavaScript – DOM, BOM, Formulaires et Classes

Ce document regroupe de manière claire et détaillée toutes les notions essentielles abordées dans tes notes sur JavaScript, avec des explications, des exemples et une structuration pédagogique.

---

## 🔹 1. DOM – Document Object Model

Le **DOM** est une représentation en arbre de tous les éléments HTML d'une page. Chaque balise HTML est convertie en **objet JavaScript** manipulable.

### ✨ Manipuler un élément HTML
```js
document.body.style.background = "red";
```

### 🧠 Tout élément HTML a :
- des **attributs** (ex: `id`, `class`, `href`, etc.)
- des **méthodes** (ex: `appendChild()`, `remove()`, `setAttribute()`…)

### 🔍 Accéder aux éléments DOM
```js
document.documentElement; // <html>
document.head;            // <head>
document.body;            // <body>
```

### 🔄 Naviguer dans l'arbre DOM
```js
let parent = element.parentNode;
let next = element.nextSibling;
let previous = element.previousSibling;
```

### 👶 Accéder aux enfants
```js
let enfants = document.body.childNodes;
let premier = document.body.firstChild;
let dernier = document.body.lastChild;
let existe = document.body.hasChildNodes();
```

Les collections comme `childNodes` sont **en lecture seule** et ne sont pas de vrais tableaux.  
🔄 Pour les convertir :
```js
let tab = Array.from(document.body.childNodes);
// ou
let tab2 = [...document.body.childNodes];
```

---

## 🧮 2. Éléments spécifiques : Tables

Certains éléments HTML ont des propriétés spécifiques :
```js
let table = document.querySelector("table");
table.rows;
table.caption;
table.tHead;
table.tBodies;
let tr = table.rows[0];
tr.cells;
tr.rowIndex;
```

---

## 🧲 3. Sélectionner des éléments

### 🔧 Sélecteurs classiques :
```js
document.getElementById("id");
document.getElementsByClassName("class");
document.getElementsByTagName("div");
document.getElementsByName("nom");
```

### 🧪 Sélecteurs CSS :
```js
document.querySelector("ul > li:last-child");   // Premier correspondant
document.querySelectorAll(".item");             // Tous les éléments
```

### 🧩 Fonctions complémentaires :
```js
element.matches("selector");  // Vérifie si l'élément correspond
element.closest("selector");  // Remonte dans l'arbre DOM
```

---

## 🎧 4. Événements – `addEventListener`

### 🔘 Exemple de clic :
```js
button.addEventListener("click", (event) => {
  console.log("Bouton cliqué !");
});
```

### 🧠 L'objet `event` contient :
- `event.target` → élément cliqué
- `event.preventDefault()` → empêche l'action par défaut (très utile pour les formulaires)

---

## 🏗️ 5. Créer / modifier dynamiquement

### ➕ Créer un élément :
```js
let p = document.createElement("p");
p.innerText = "Paragraphe dynamique";
document.body.appendChild(p);
```

### ✍️ Différence `innerText` vs `innerHTML` :
```js
div.innerText = "<b>Texte</b>";  // Affiche littéralement <b>Texte</b>
div.innerHTML = "<b>Texte</b>";  // Interprète le HTML
```

---

## 🌍 6. BOM – Browser Object Model

Le **BOM** est l'ensemble des objets représentant le navigateur.

### 🔑 Objets principaux :
```js
alert("Alerte !");
confirm("Es-tu sûr ?");
prompt("Ton nom ?");
navigator.userAgent; // Infos sur le navigateur
location.href;       // URL actuelle
```

---

## 📝 7. Formulaires

### 🧩 Récupérer les éléments du formulaire :
```js
let input = document.getElementById("champ");
let valeur = input.value;
```

### ✋ Empêcher l'envoi automatique :
```js
form.addEventListener("submit", (event) => {
  event.preventDefault(); // Stoppe l’envoi automatique
  // Tu peux ensuite traiter les données à la main
});
```

### 🛠️ Modifier un attribut :
```js
input.setAttribute("type", "password");
```

---

## 🧱 8. Classes en JavaScript (ES6)

### 🐶 Exemple simple :
```js
class Chien {
  constructor(pue, name) {
    this.pue = pue;
    this.name = name;
  }

  aboyer() {
    console.log(`${this.name} aboie !`);
  }
}

const rex = new Chien(true, "Rex");
rex.aboyer(); // "Rex aboie !"
```

---

## 🧠 Résumé final

| Concept       | But                                                   |
|---------------|--------------------------------------------------------|
| DOM           | Manipuler dynamiquement le contenu HTML               |
| BOM           | Interagir avec le navigateur                          |
| Events        | Réagir aux actions utilisateur                        |
| Formulaires   | Intercepter et traiter les données utilisateur        |
| Classes       | Créer des objets personnalisés avec comportements     |

---

Tu veux une version imprimable ou un PDF de ce cours ? Ou l'intégrer à un site de démo pédagogique ? 😉
