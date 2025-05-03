# La convention de nommage BEM

BEM (**Block, Element, Modifier**) est une convention de nommage permettant de rendre le code plus structuré, lisible et réutilisable.

## Structure de BEM

- **Block:** Un composant autonome de l'interface
- **Element:** Une partie d'un bloc qui ne peut exister indépendamment de celui-ci
- **Modifier:** Une variation d'un bloc ou d'un élément

## Syntaxe

```css
.block {}
.block__element {}
.block--modifier {}
.block__element--modifier {}
```

## Exemple concret

Imaginons un bouton avec BEM:

```html
<button class="button button--primary">Envoyer</button>

<button class="button button--secondary">Envoyer</button>
```

```css


.button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
}

.button--primary {
    background-color: blue;
    color: white;
}

.button--secondary {
    background-color: white;
    color: blue;
}
```

Imaginons une card avec un titre et une description:

```html
<div class="card card--highlight">
    <h2 class="card__title">Titre de la carte</h2>
    <p class="card__description">Description de la carte</p>
</div>
```

```css
.card {
    border: 1px solid #ccc;
    padding: 15px;
}

.card__title {
    font-size: 1.5em;
}

.card__description {
    font-size: 1em;
}

.card--highlight {
    background-color: yellow;
}
```
