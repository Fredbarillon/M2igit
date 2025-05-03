# UML – Diagrammes de Cas d'Utilisation

## 🧠 1. Philosophie générale

Un bon **diagramme de cas d'utilisation** vise à :
- **Représenter les interactions** entre des *acteurs* (utilisateurs ou systèmes) et le *système étudié*.
- **Clarifier les rôles**, les besoins fonctionnels, et les extensions possibles d’un système.
- **Être lisible**, même par des non-informaticiens (clients, managers...).

---

## 📍 2. Les acteurs

### 🔹 Types d'acteurs
- **Humain** (utilisateur, employé, client...)
- **Organisation** (ex: entreprise partenaire)
- **Système informatique** (logiciel externe, base de données...)

### 🔹 Relations entre acteurs
- **Ligne pleine** → relation directe entre acteur et cas d'utilisation
- **Flèche avec trait plein** → généralisation d’acteur : *l’acteur B hérite des actions de A*
  - **Direction** : la flèche va de l’acteur spécialisé **vers** l’acteur général (*de B vers A*)

### 🔸 Acteurs secondaires
- Parfois appelés *acteurs secondaires* ou *indirects*.
- Ils **interagissent sans être initiateurs** de l’action.
- Ils sont souvent placés à droite ou en bas du diagramme pour signaler leur rôle périphérique.

---

## 🧰 3. Représentation du système

- Le **système** est représenté par un **rectangle** (ou cadre).
- Le **nom du système** est écrit dans un coin (généralement en haut).
- Tous les **cas d'utilisation** sont placés **à l’intérieur** de ce rectangle.
- Les **acteurs** (humains, organisations, systèmes externes) sont situés **à l’extérieur** du rectangle et interagissent avec les cas via des traits.

---

## 🧩 4. Relations entre cas d'utilisation

### ➕ `<<include>>`
- **Signifie** : le cas d'utilisation A *inclut toujours* le comportement du cas B.
- **Utilisation** : pour éviter la répétition de comportements communs.
- **Représentation** : flèche pointillée + `<<include>>` allant de A vers B.

### ➖ `<<extend>>`
- **Signifie** : le cas d'utilisation A *peut éventuellement* étendre le comportement de B.
- **Utilisation** : pour modéliser des fonctionnalités optionnelles ou des exceptions.
- **Représentation** : flèche pointillée + `<<extend>>` allant de A vers B.

### 🔁 Généralisation
- Fonctionne **aussi pour les cas d'utilisation**.
- Cas B **hérite** des fonctionnalités de A.
- **Flèche pleine avec triangle** de B vers A (comme en POO).

#### 🧪 Exemple :
Imaginons une application bancaire.

```
                     ▲
                     │
           [Gérer un compte]
             /           \
[Consulter le solde]  [Effectuer un virement]
```

- **Gérer un compte** est une action générale.
- **Consulter le solde** et **Effectuer un virement** sont des cas spécifiques qui héritent du cas général.

---

## 📄 5. Bonnes pratiques pour les cas d'utilisation

- **Nommer clairement** chaque cas d'utilisation avec un **verbe à l'infinitif** suivi d’un complément :
  - ✅ Ex : *"Créer un compte"*, *"Consulter l’historique"*
  - ❌ Éviter : *"Compte utilisateur"*, *"Historique"*

- Un cas d'utilisation décrit **ce que fait le système**, pas ce que fait l’utilisateur :
  - ✅ "Envoyer une notification"
  - ❌ "Recevoir une alerte" (car ce n’est pas une action du système)

- **Ne pas surcharger le diagramme** :
  - Rester simple, montrer **les fonctionnalités clés**
  - Les détails techniques vont dans un autre diagramme (activité, séquence…)

- Utiliser les cas d’utilisation pour **modéliser les besoins fonctionnels**, pas les processus internes du système.

---

## 📒 6. Focus : logique métier vs interactions

- Le diagramme de cas d'utilisation **n'intègre pas la logique métier interne** (ex : calculs, règles de gestion, traitement d'erreurs).
- Ces éléments doivent être modélisés dans d'autres diagrammes UML :
  - **Diagramme d'activité** : flux logique
  - **Diagramme de séquence** : chronologie des interactions
  - **Diagramme de classes** : structure des entités

### 📌 Bonnes pratiques

| Idée                              | Verdict     | Commentaire rapide |
|----------------------------------|-------------|---------------------|
| Écarter la logique métier        | ✅           | À traiter dans d'autres types de diagrammes |
| Cas d’utilisation = interactions | ✅           | Uniquement ce que voit ou fait un acteur |
| Cas sans acteur direct           | ✅           | OK s’ils dépendent de cas reliés à des acteurs |
| Cas entièrement techniques       | ⚠️ À éviter  | À modéliser ailleurs, sauf si impact visible pour un acteur |


---

## 📚 7. Cas d'utilisation vs technique

- Un cas d'utilisation est **indépendant de l'implémentation** :
  - Il ne dit pas *comment* une fonctionnalité est codée.
  - Il dit *quoi* le système doit permettre à l’acteur.

---

## 📃 8. Documentation recommandée

Pour chaque cas d'utilisation dans un diagramme, on peut associer une **fiche descriptive** avec :
- Objectif du cas
- Acteurs impliqués
- Scénario principal
- Scénarios alternatifs (erreurs, exceptions)
- Conditions de déclenchement
- Résultat attendu

---

## ⚠️ 9. Limites du diagramme de cas d'utilisation

- ❌ **Ne montre pas la chronologie** :
  - On ne sait pas dans quel ordre les actions se produisent.
  - Pour cela, utiliser un **diagramme de séquence** ou **d'activités**.

- ❌ **Ne décrit pas les flux de données ou de contrôle**.

- ❌ **Ne modélise pas l’interface utilisateur** (UI/UX).

- ❌ **Ne gère pas la logique métier complexe**.

- ❌ **Pas adapté pour les fonctions internes ou non-fonctionnelles** (performances, sécurité, etc.).

exemple de tables en uml:
@startuml
class "Individus" as Table {
  | Prénom | Sexe | Âge | Métier        | Expérience |
  | Julie  | F    | 24  | Électricienne | 4          |
  | Francoise | F | 40  | Comptable     | 30         |
  | Romain | M    | 30  | Développeur   | NULL       |
  | Manuel | M    | 39  | Professeur    | 12         |
}
@enduml