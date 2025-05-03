
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
git commit --allow-empty -m "simple message no modification"
```
➡️ Enregistre les fichiers ajoutés avec un message descriptif.

---

## 🔗 Ajouter un dépôt distant (GitHub)

```bash
git remote add origin https://github.com/utilisateur/nom-du-repo.git
```
➡️ Lie ton dépôt local au dépôt GitHub.

---

::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
## 🗑️ Supprimer un fichier suivi par Git : git rm

```bash
git rm nom-du-fichier
```

➡️ Supprime le fichier du disque et du suivi Git (sera supprimé au prochain commit).
📌 Exemple :

```bash
git rm fichier.txt
git commit -m "Suppression de fichier.txt"
```

➡️ Le fichier est supprimé localement et dans l’historique Git.
🗂️ Supprimer du suivi Git mais garder le fichier localement :

```bash
git rm --cached fichier.txt
```

➡️ Retire le fichier de Git (sera ignoré à l’avenir si .gitignore est configuré), mais il reste sur ton disque.

🧹 Supprimer un dossier entier :

```bash
git rm -r dossier/
```

➡️ Supprime tous les fichiers dans le dossier et le dossier lui-même du suivi Git.

---

## ✏️ Modifier le dernier commit : git commit --amend

```bash
git commit --amend
```

➡️ Permet de modifier le dernier commit :

    soit son message

    soit son contenu (fichiers ajoutés/oubliés)

✍️ Changer seulement le message du commit :

```bash
git commit --amend -m "Nouveau message"
```

➡️ Écrase le message du commit précédent sans changer les fichiers.
➕ Ajouter un fichier oublié au dernier commit :

```bash
git add fichier-oublié.txt
git commit --amend
```

➡️ Ouvre l’éditeur pour éventuellement modifier le message.
Tu peux valider tel quel pour juste ajouter le fichier au dernier commit.
⚠️ Attention :

    Si le commit a déjà été poussé sur GitHub, amender le commit peut provoquer un conflit.

    C’est recommandé uniquement avant un push.


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
## 📜 Voir les commits avec les modifications (git log -p)

```bash
git log -p
```

➡️ Affiche l’historique des commits avec le diff complet (les lignes ajoutées et supprimées) pour chaque commit.

---

## 📊 git log --stat : commits + stats de fichiers

```bash
git log --stat
```

➡️ Affiche les commits avec un résumé des fichiers modifiés, et le nombre de lignes ajoutées/supprimées.

---

## 🧾 git log --oneline : historique condensé

```bash
git log --oneline
```

➡️ Affiche l’historique des commits en une seule ligne chacun, très pratique pour visualiser rapidement.

---

## 🔢 git log -n <nombre> : afficher les n derniers commits

```bash
git log -n 5
```

➡️ Affiche seulement les 5 derniers commits (ou autant que tu veux).

---

## 🧹 Nettoyer les fichiers non suivis avec git clean

git clean sert à supprimer les fichiers non suivis par Git (ceux que git status affiche en "Untracked files").
## 🕵️ git clean -n : mode simulation (ne supprime rien)

```bash
git clean -n
```

➡️ Affiche la liste des fichiers non suivis qui seraient supprimés, sans les effacer.

---

## 🧨 git clean -f : supprimer les fichiers non suivis

```bash
git clean -f
```

➡️ Supprime tous les fichiers non suivis (⚠️ irrécupérable après coup).

---

## 📁 git clean -fd : supprimer fichiers et dossiers non suivis

```bash
git clean -fd
```

➡️ Supprime les fichiers et les dossiers non suivis (ex : .vscode/, build/, etc.)

---

## 🧪 Combiner avec simulation

```bash
git clean -nd
```

➡️ Simule la suppression des dossiers non suivis (sans supprimer réellement).

## ⚠️ Attention

    git clean ne touche ni aux fichiers trackés, ni aux modifications.

    Il supprime uniquement les fichiers/dossiers jamais ajoutés à Git (Untracked).
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

## 🔄 Annuler un commit sans casser l’historique : git revert

git revert <ID_DU_COMMIT>

➡️ Crée un nouveau commit qui annule les effets d’un commit précédent, sans supprimer l’historique.
C’est la méthode recommandée pour annuler proprement un commit déjà partagé.

---

## 🛠️ Définir la branche distante comme branche de suivi

```bash
git branch --set-upstream-to=origin/main main
```
➡️ Permet à `git pull` et `git push` de fonctionner sans préciser l'URL ni la branche à chaque fois.

---

## 🔁 Revenir en arrière avec git reset

git reset sert à annuler des commits ou des ajouts dans différentes zones de Git (staging area, historique, etc.).

Il existe 3 niveaux de reset principaux :
🔸 git reset --soft

```bash
git reset --soft <commit>
```

## ➡️ Reculer l’historique jusqu’à <commit>, mais garde tous les changements dans le staging (git add).

🟢 Utilisé si tu veux réécrire un commit sans perdre ton travail.
🔸 git reset --mixed (par défaut)

```bash
git reset --mixed <commit>
```

## ➡️ Reculer l’historique et désindexer les fichiers (ils restent modifiés mais non "add").

🟡 C’est le reset par défaut. Les changements restent dans le working directory.
🔸 git reset --hard

```bash
git reset --hard <commit>
```

## ➡️ ⚠️ Tout est supprimé (historique + staging + modifications locales).
Tu reviens à l’état exact du commit donné.

🔴 Très dangereux — irréversible si non sauvegardé.

## 🧠 Résumé visuel :
Commande	    Historique	Staging	Working Directory
--soft	            🔙	    ✅	        ✅
--mixed (défaut)	🔙	    ❌	        ✅
--hard	            🔙	    ❌	        ❌

```bash
git reset HEAD fichier
```
➡️ Retire un fichier de la zone de staging.

---

## 🛠️ Restaurer des fichiers

```bash
git restore fichier
```
➡️ Annule les modifications dans le fichier (non commitées).

```bash
git restore --staged fichier
```
➡️ Retire le fichier de la zone de staging sans annuler les modifications.

```bash
git checkout -- fichier
```
➡️ Ancienne méthode (équivalent à `git restore fichier`).

---
## 🏷️ Git tag

```bash
git tag
```

➡️ Liste tous les tags existants.

```bash
git tag -a v1.0 -m "Version 1.0"
```

➡️ Crée un tag annoté avec un nom et un message (meilleure pratique pour les versions).

```bash
git show v1.0
```

➡️ Affiche les infos détaillées du tag (auteur, date, commit pointé…).

---
## 🔼 Pousser un tag

```bash
git push origin v1.0
```
➡️ Pousse un tag spécifique vers le dépôt distant.

```bash
git push --tags
```

➡️ Pousse tous les tags locaux vers le dépôt distant.

---
## ❌ Supprimer un tag

```bash
git tag -d v1.0
```
➡️ Supprime le tag en local.

```bash
git push origin --delete v1.0
```

➡️ Supprime le tag sur le dépôt distant (GitHub, GitLab…).

---
## ⚙️ Créer des alias Git pratiques

```bash
git config --global alias.st status
git config --global alias.co checkout
git config --global alias.ci commit
git config --global alias.br branch
git config --global alias.last "log -1 HEAD"
```

➡️ Crée des alias personnalisés pour taper moins !

---
## 🌀 Utiliser ~ pour naviguer dans l’historique (HEAD~)

~ est un raccourci Git pour remonter dans l’historique des commits.
📌 Syntaxe :

```bash
HEAD~n
```

➡️ Signifie "le commit n positions avant le HEAD (le dernier commit actuel)".

    HEAD~1 = le commit juste avant le dernier

    HEAD~2 = deux commits avant, etc.