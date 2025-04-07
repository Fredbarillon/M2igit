
# 🧾 Git Command Cheat Sheet (Projet M2i)

Voici la liste des commandes Git utilisées pendant la configuration et la synchronisation du projet local avec GitHub, avec une brève explication pour chacune.

---

## 🔧 Configuration de base

```bash
git config --global user.name "Ton Nom"
git config --global user.email "ton@email.com"
```
➡️ Définit ton identité Git (utilisé dans les commits).

---

## 📁 Initialisation du dépôt local

```bash
git init
```
➡️ Initialise un nouveau dépôt Git dans le dossier courant.

---

## 📄 Vérifier l’état des fichiers

```bash
git status
```
➡️ Affiche les fichiers modifiés, non suivis, et prêts à être commités.

---

## ✅ Ajouter des fichiers au suivi

```bash
git add README.md
git add .
```
➡️ Ajoute un ou tous les fichiers au "staging area" (zone de préparation avant commit).

---

## 📝 Commit rapide avec -am

```bash
git commit -am "message"
```

➡️ Ajoute et commit d’un coup tous les fichiers déjà suivis par Git.

⚠️ Important :

    Cette commande ne fonctionne que pour les fichiers déjà trackés (déjà ajoutés une fois avec git add).

    Les nouveaux fichiers (non suivis) ne seront pas inclus. Pour cela, utilise d’abord git add.

---

## 🧾 Créer un commit

```bash
git commit -m "message"
```
➡️ Enregistre les fichiers ajoutés avec un message descriptif.

---

## 🔗 Ajouter un dépôt distant (GitHub)

```bash
git remote add origin https://github.com/utilisateur/nom-du-repo.git
```
➡️ Lie ton dépôt local au dépôt GitHub.

---

## 🔄 Récupérer les modifications distantes

```bash
git pull origin main --allow-unrelated-histories
```
➡️ Fusionne l'historique distant avec ton historique local même s'ils sont indépendants.

---

## 🚀 Envoyer les changements sur GitHub

```bash
git push -u origin main
```
➡️ Envoie les commits locaux vers la branche `main` de GitHub et définit le lien de suivi.

---

## 📜 Afficher l’historique des commits

```bash
git log
git log --oneline --graph --all
```
➡️ Affiche la liste des commits sous forme détaillée ou condensée avec graphe.

---

## 📂 Lister les fichiers suivis

```bash
git ls-files
```
➡️ Liste tous les fichiers actuellement suivis par Git.

---

## ❌ Supprimer un dépôt Git par erreur

```bash
rm -rf .git
```
➡️ Supprime totalement le suivi Git d’un dossier (à ne faire que si nécessaire).

---

## 🛠️ Définir la branche distante comme branche de suivi

```bash
git branch --set-upstream-to=origin/main main
```
➡️ Permet à `git pull` et `git push` de fonctionner sans préciser l'URL ni la branche à chaque fois.

---
