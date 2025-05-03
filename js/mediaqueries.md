# Les media queries

Les media queries en CSS permettent d'adapter le rendu d'une page web en fonction de divers paramètres du dispositif de l'utilisateur, tels que la taille de l'écran, l'orientation ou la résolution.

## Syntaxe de base

```css
@media [type de media] and (expression) {
    /* Styles CSS */
}
```

- Type de média: Indique la catégorie générale de l'appareil ciblé, comme `screen` pour les écrans ou `print` pour l'impression. Si omis, il est supposé être `all`.

- Expression: Teste une ou plusieurs caractéristiques du dispositif, comme sa largeur ou son orientation. Chaque expression doit être entourée de parenthèses.

## Exemples concrets

Pour appliquer des styles spécifiques lorsque la largeur de l'écran est d'au moins 768px

```css
@media (min-width: 768px) {
    /* Styles pour les écrans de 768px et plus*/
}
```

A l'inverse, pour cibler les écrans de moins de 600px de large

```css
@media (max-width: 600px) {
    /* Styles pour les écrans de moins de 600px*/
}
```

Cibler pour l'orientation de l'écran
```css
@media (orientation: landscape) {
 /* Styles pour un rendu paysage*/
}
```

## Opérateurs logiques

- **and:** Combine plusieurs conditions
```css
@media (min-width: 600px) and (orientation: portrait) {
 /* Styles pour un rendu portrait d'au moins 600px*/
}
```

- **not:** Inverse la condition
```css
@media not all and (monochrome) {
 /*Styles à tous les écrans sauf ceux en mode monochrome*/
}
```

- **only:** Empêche les anciens navigateurs de lire les styles si elles ne supportent pas les media queries.
```css
@media only screen and (min-width: 768px) {
 /*Styles spécifiques*/
}
```