## 🧳 Sauvegarder son travail temporairement avec git stash

git stash permet de mettre de côté (stocker) les modifications en cours sans les committer, pour pouvoir changer de branche ou travailler ailleurs.
💾 Sauvegarder les changements actuels

```bash
git stash
```

➡️ Sauvegarde tous les fichiers modifiés et les retire de l’espace de travail (working directory).
📝 Sauvegarder avec un message personnalisé

```bash
git stash save "Mon message de sauvegarde"
```

➡️ Ajoute une description claire pour mieux t’y retrouver plus tard.
📋 Voir la liste des stashs enregistrés

```bash
git stash list
```

➡️ Affiche les stashs disponibles sous forme :

```bash
stash@{0}: WIP on main: Mon message
stash@{1}: WIP on feature: Autre message
```
---
## 🔍 Voir ce qu’un stash contient

```bash
git stash show
```

➡️ Affiche un résumé des fichiers concernés par le dernier stash.

```bash
git stash show -p
```

➡️ Affiche un diff complet du dernier stash.

---
## ♻️ Récupérer et appliquer un stash

🧪 Appliquer le stash sans le supprimer

```bash
git stash apply
```
 ➡️ Réapplique les changements mais garde le stash dans la liste.
✅ Appliquer ET supprimer le stash

```bash
git stash pop
```

➡️ Applique les changements et supprime le stash de la liste.

---
## 🧼 Supprimer un stash manuellement

```bash
git stash drop stash@{0}
```

➡️ Supprime un stash spécifique de la liste.

```bash
git stash clear
```

➡️ Supprime tous les stashs enregistrés.

---
## 🍒 git cherry-pick – Appliquer un commit précis d’une autre branche

```bash
git cherry-pick <id_du_commit>
```

➡️ Copie un commit spécifique d’une autre branche et l’applique dans la branche en cours.
📌 Exemple :

```bash
git checkout main
git cherry-pick a1b2c3d
```

➡️ Applique le commit a1b2c3d (fait ailleurs) dans la branche main.

---
## 🔎 Trouver l’ID du commit :

```bash
git log --oneline
```

➡️ Cela te donne les IDs de commit, que tu peux cherry-pick.

---
## 🧩 Cherry-pick de plusieurs commits

```bash
git cherry-pick ID1 ID2 ID3
```

➡️ Tu peux enchaîner plusieurs commits dans une seule commande.
⚠️ En cas de conflit

Si Git détecte un conflit pendant le cherry-pick :

    Résous les fichiers manuellement

    Puis :

```bash
git add .
git cherry-pick --continue
```

👉 Ou annule l’opération :

```bash
git cherry-pick --abort
```
---
## 🚫 Ne pas confondre avec :

Commande	    Utilisation
git merge	    Intègre toute une branche
git cherry-pick	Copie un commit précis
git rebase	    Rejoue une suite de commits