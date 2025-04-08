## 📄 Créer un fichier depuis le terminal
 
 🟢 Avec touch (création simple, vide)

```bash
touch monfichier.txt
```

➡️ Crée un fichier vide nommé monfichier.txt.

Fonctionne avec n’importe quelle extension :

```bash
touch index.html
touch notes.md
touch script.py
```

---
## ✍️ Avec redirection (création + ajout de texte)

```bash
echo "Hello world" > hello.txt
```

➡️ Crée un fichier hello.txt contenant "Hello world".

---
## 📌 Ajouter du contenu sans écraser :

```bash
echo "Nouvelle ligne" >> hello.txt
```

➡️ Ajoute "Nouvelle ligne" à la fin du fichier existant.

---
## 📝 Créer et éditer en direct avec un éditeur :

```bash
nano monfichier.txt
```

➡️ Ouvre le fichier dans l’éditeur nano (si installé).
Pour sauvegarder : Ctrl + O, puis Entrée
Pour quitter : Ctrl + X

---
## 🔥 Bonus : Créer un fichier Markdown pour un projet

```bash
touch README.md
```

➡️ Fichier souvent utilisé pour décrire un projet GitHub.