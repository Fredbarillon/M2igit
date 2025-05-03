# 🖥️ Responsive Design – Guide Technique et Bonnes Pratiques

## ⚠️ Erreurs fréquentes à éviter

### ❌ Mauvaise conceptualisation dans Figma
- Les problèmes de responsive viennent souvent de **maquettes mal pensées**, pas du CSS lui-même.
- Dès la maquette : penser en **grilles fluides**, **éléments flexibles**, et **points de rupture**.

### ❌ Mauvaises pratiques CSS
- `body { width: 100vw; }` ➜ casse le responsive car **ne prend pas en compte la barre de scroll**.
  ✅ Préférer : `body { width: auto; }`
- Éviter les hauteurs fixes sur le `body`.
- Centrer le contenu global : `body { margin: auto; }`

---

## 🧱 Mise en page

### 📦 `main`, `section` & co
- Gérer la largeur avec `max-width`
- Gérer la hauteur avec `min-height`
- Centrer : `margin: 0 auto;`

### 🔧 Flexbox
- Utiliser `display: flex` **uniquement sur le parent direct** des éléments à aligner.
- Exemple :
  ```css
  .container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5em 0.5em; /* horizontal + vertical */
  }

    gap en em pour rester relatif à la taille du texte.

🧩 Grid Layout

    Ne pas coder en dur :

grid-template-columns: 1fr 1fr 1fr; /* ❌ rigide */

✅ Préférer :

    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));

    Permet une adaptation fluide du nombre de colonnes.

    gap permet de gérer les gouttières (gutters) entre les éléments.

🃏 Cartes (Cards UI)

.card {
  aspect-ratio: 19 / 6;
  object-fit: cover;
  width: 100%; /* remplit l'espace disponible */
}

    aspect-ratio : maintient un ratio largeur/hauteur stable.

    object-fit: cover : image toujours remplie sans déformation.

📐 BEM – Convention de nommage CSS

    BEM = Block Element Modifier

    Structure :

    .block {}
    .block__element {}
    .block--modifier {}
    .block__element--modifier {}

🔠 Exemples

    .form__input--error ➜ champ d’un formulaire avec une erreur

    .nav__item--active ➜ élément de navigation actif

🔤 em vs rem
Unité	Utilisation principale	Dépendance
rem	Taille de police globale (root)	Basé sur html { font-size }
em	Marges, paddings, spacing	Dépend du parent immédiat

Astuce : utiliser rem pour les tailles de police et em pour les espacements pour un meilleur contrôle.
📱 Breakpoints CSS (avec @media)

    Astuce : utiliser em dans les media queries pour une meilleure cohérence multi-navigateurs.

Appareil	px	em
📱 Téléphone (petit)	320px	20em
📱 Téléphone (standard)	375px	23.4375em
📱 Grand téléphone / Phablette	425px	26.5625em
📱↔️ Petite tablette (portrait)	600px	37.5em
📲 Tablette (paysage)	768px	48em
💻 Petit laptop / tablette large	1024px	64em
💻 Ordinateur portable	1280px	80em
🖥️ Écran de bureau	1440px	90em

Exemple :

@media (max-width: 48em) {
  .nav {
    flex-direction: column;
  }
}

✅ Check-list Responsive Design

Utiliser max-width + margin: auto pour centrer.

Ne pas fixer la hauteur du body.

Utiliser flex-wrap: wrap ou grid avec auto-fit.

Eviter vw ou vh mal maîtrisés.

Penser mobile-first : commencer avec les petits écrans.