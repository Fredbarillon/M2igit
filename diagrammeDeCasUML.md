# UML – Diagrammes de Cas d'Utilisation

## 🧠 Philosophie générale

Un bon **diagramme de cas d'utilisation** vise à :
- **Représenter les interactions** entre des *acteurs* (utilisateurs ou systèmes) et le *système étudié*.
- **Clarifier les rôles**, les besoins fonctionnels, et les extensions possibles d’un système.
- **Être lisible**, même par des non-informaticiens (clients, managers...).

---

## 📍 Acteurs

### 🔹 Types d'acteurs :
- **Humain** (utilisateur, employé, client...)
- **Organisation** (ex: entreprise partenaire)
- **Système informatique** (logiciel externe, base de données...)

### 🔹 Relations entre acteurs :
- **Ligne pleine** → relation directe entre acteur et cas d'utilisation
- **Flèche avec trait plein** → généralisation d’acteur : *l’acteur B hérite des actions de A*
  - **Direction** : la flèche va de l’acteur spécialisé **vers** l’acteur général (*de B vers A*)

---

## 🧩 Relations entre cas d'utilisation

### ➕ `<<include>>` :
- **Signifie** : le cas d'utilisation A *inclut toujours* le comportement du cas B.
- **Utilisation** : pour éviter la répétition de comportements communs.
- **Représentation** : flèche pointillée + `<<include>>` allant de A vers B.

### ➖ `<<extend>>` :
- **Signifie** : le cas d'utilisation A *peut éventuellement* étendre le comportement de B.
- **Utilisation** : pour modéliser des fonctionnalités optionnelles ou des exceptions.
- **Représentation** : flèche pointillée + `<<extend>>` allant de A vers B.

### 🔁 Généralisation :
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

## 🔸 Acteurs secondaires

- Parfois appelés *acteurs secondaires* ou *indirects*.
- Ils **interagissent sans être initiateurs** de l’action.
- Ils sont souvent placés à droite ou en bas du diagramme pour signaler leur rôle périphérique.

---

## 📌 À retenir

- **Un acteur peut interagir avec plusieurs cas d’utilisation**.
- **Un cas d’utilisation peut être partagé entre plusieurs acteurs**.
- La **clarté prime sur l'exhaustivité** : rester lisible et pertinent.

