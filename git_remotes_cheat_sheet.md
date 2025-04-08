
# 🌐 Dépôts distants avec Git – Cheat Sheet

Tout ce qu’il faut savoir pour connecter un dépôt local à un dépôt distant (comme GitHub), le synchroniser, et gérer les échanges.

---
## 📦 Créer un dépôt GitHub avec contenu de base

    Va sur https://github.com

    Clique sur "New repository"

    Renseigne :

        Nom du dépôt

        Description (facultatif)

        Visibilité : public ou privé

    Coche les options :

        ✅ Add a README file

        ✅ Add .gitignore (choisis un template selon ton langage, ex : Python, Node, etc.)

    Clique sur Create repository

---
## 📥 Cloner le dépôt GitHub en local

```bash
git clone https://github.com/ton-utilisateur/nom-du-repo.git
```

➡️ Crée une copie locale complète du dépôt GitHub.
Un dossier nom-du-repo/ est créé avec tout le contenu (README, .gitignore, etc.)

---
## 🔍 Vérifier les dépôts distants

```bash
git remote -v
```
➡️ Affiche les dépôts distants configurés (`origin`, `upstream`, etc.) avec leurs URL.

---

## ➕ Ajouter un dépôt distant

```bash
git remote add origin https://github.com/utilisateur/nom-du-repo.git
```
➡️ Ajoute un dépôt distant nommé `origin`.  
Tu peux aussi utiliser SSH :
```bash
git remote add origin git@github.com:utilisateur/nom-du-repo.git
```

---

## 🚀 Pousser vers le dépôt distant pour la première fois

```bash
git push -u origin main
```

➡️ Envoie la branche locale `main` sur le dépôt distant `origin`.  
Le `-u` permet à Git de **se souvenir du lien** entre ta branche locale et distante.

---

## 🔁 Pousser ensuite (push simple)

```bash
git push
```
➡️ Envoie les commits vers le dépôt distant pour la branche courante, **si le lien a été défini** avec `-u` précédemment.

---

## 🔄 Récupérer les dernières modifications

```bash
git pull
```
➡️ Récupère les dernières modifications du dépôt distant et les **fusionne** avec ta branche locale.

---

## 📥 Récupérer sans fusionner : `fetch`

```bash
git fetch
```
➡️ Récupère les commits depuis le dépôt distant, **sans les fusionner** automatiquement.  
Tu peux ensuite explorer ou comparer manuellement.

---

## 🧠 Résumé des remotes

| Commande                           | Action                                |
|-----------------------------------|---------------------------------------|
| `git remote -v`                   | Voir les remotes                      |
| `git remote add origin URL`       | Ajouter un remote                     |
| `git push -u origin <branche>`    | Premier push avec suivi               |
| `git push`                        | Push simple                           |
| `git pull`                        | Récupérer et fusionner                |
| `git fetch`                       | Récupérer sans fusionner              |

---
