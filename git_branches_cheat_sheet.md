
# 🌿 Gestion des branches Git – Cheat Sheet

---

## 🔧 Créer une branche

```bash
git branch nom-de-branche
```
➡️ Crée une nouvelle branche **sans changer de branche**.

```bash
git checkout -b nom-de-branche
```
➡️ Crée **et** bascule directement sur cette branche.

---

## 🔀 Changer de branche

```bash
git checkout nom-de-branche
```
➡️ Change de branche.

```bash
git switch nom-de-branche
```
➡️ Alternative moderne à `checkout`, plus lisible.

---

## 📋 Lister les branches

```bash
git branch
```
➡️ Affiche les branches locales (celle en cours est marquée avec `*`).

```bash
git branch -a
```
➡️ Affiche **toutes les branches**, y compris distantes.

---

## ✏️ Renommer une branche

```bash
git branch -m nouveau-nom
```
➡️ Renomme la branche courante.

```bash
git branch -m ancien-nom nouveau-nom
```
➡️ Renomme une autre branche locale.

---

## 🧬 Fusionner une branche

```bash
git checkout main
git merge nom-de-branche
```
➡️ Fusionne `nom-de-branche` dans `main`.

Si tout va bien : Git crée un commit de fusion automatique.  
S’il y a des conflits : Git te demande de les résoudre.

---

## ⚠️ Résoudre un conflit de fusion

1. Ouvre les fichiers concernés
2. Cherche les balises :
```text
<<<<<<< HEAD
ton contenu actuel
=======
le contenu de l'autre branche
>>>>>>> nom-de-branche
```
3. Choisis ce que tu veux garder
4. Termine avec :
```bash
git add fichier-conflit
git commit
```

---

## 🗑️ Supprimer une branche

```bash
git branch -d nom-de-branche
```
➡️ Supprime une branche **localement** (seulement si elle est fusionnée).

```bash
git branch -D nom-de-branche
```
➡️ Supprime **de force**, même si elle n’est pas fusionnée.

```bash
git push origin --delete nom-de-branche
```
➡️ Supprime une branche **sur le dépôt distant** (GitHub, GitLab…).

---

## 📤 Pousser une branche

```bash
git push -u origin nom-de-branche
```
➡️ Pousse la branche vers GitHub et définit le suivi distant.
