
# 🚀 Git Flow Cheat Sheet (sans installation)

Basé sur le modèle Git Flow, voici toutes les commandes utiles **sans besoin d’installer l’extension git-flow**. Utilise-les depuis n'importe quel terminal Git (Git Bash, etc.).

---

## 🛠️ Initialiser Git Flow

```bash
git flow init
```
➡️ Initialise Git Flow dans ton dépôt.  
Tu pourras définir :
- la branche principale (ex: `main` ou `master`)
- la branche de développement (souvent `develop`)
- les préfixes pour features, releases, hotfixes…

---

## ✨ Fonctionnalités (Features)

### 🚧 Commencer une fonctionnalité

```bash
git flow feature start MA_FEATURE
```
➡️ Crée une branche `feature/MA_FEATURE` depuis `develop`.

---

### ✅ Terminer une fonctionnalité

```bash
git flow feature finish MA_FEATURE
```
➡️ Fusionne `feature/MA_FEATURE` dans `develop`, supprime la branche et revient sur `develop`.

---

### 🌍 Publier une fonctionnalité

```bash
git flow feature publish MA_FEATURE
```
➡️ Pousse la branche `feature/MA_FEATURE` sur le dépôt distant.

---

### 📥 Récupérer une fonctionnalité distante

```bash
git flow feature pull origin MA_FEATURE
```
➡️ Récupère une branche de feature publiée par un collègue.

---

## 📦 Releases

### 🚧 Démarrer une release

```bash
git flow release start MA_VERSION
```
➡️ Crée une branche `release/MA_VERSION` depuis `develop`.

---

### ✅ Terminer une release

```bash
git flow release finish MA_VERSION
```
➡️ Fusionne la release dans `main` et `develop`, ajoute un tag, et supprime la branche.

---

### 🌍 Publier une release

```bash
git flow release publish MA_VERSION
```
➡️ Pousse la branche `release/MA_VERSION` vers le dépôt distant.

---

### 📥 Récupérer une release distante

```bash
git flow release pull origin MA_VERSION
```
➡️ Récupère une branche de release en cours partagée par un collègue.

---

## 🛠️ Hotfixes

### 🚑 Commencer un hotfix

```bash
git flow hotfix start MA_CORRECTION
```
➡️ Crée une branche `hotfix/MA_CORRECTION` depuis `main`.

---

### ✅ Terminer un hotfix

```bash
git flow hotfix finish MA_CORRECTION
```
➡️ Fusionne dans `main` et `develop`, ajoute un tag, supprime la branche.

---

## 🧼 Support (optionnel)

### 🔧 Démarrer une branche de support

```bash
git flow support start SUPPORT_X
```
➡️ Crée une branche `support/SUPPORT_X` (utile pour maintenance de version spécifique).

---

## 🔄 Listes utiles

```bash
git flow feature
git flow release
git flow hotfix
```
➡️ Affiche les fonctionnalités/releases/hotfixes en cours.

---

## 🧠 Remarques

- Git Flow est un **modèle structuré de gestion de branches**, idéal pour les workflows en équipe.
- Même sans extension, tu peux **manuellement reproduire chaque commande** en utilisant les branches.

---


