# 🧠 JavaScript DOM Methods – Mémo pratique

Voici un mémo utile des méthodes JavaScript les plus courantes pour manipuler le DOM, notamment autour de `closest()`.

---

## 🔷 closest(selector)
> Remonte dans l’arbre DOM et retourne **le premier élément parent (ou lui-même)** qui correspond au **sélecteur CSS**.

```js
element.closest("section");
```

- 🔁 Remonte l'arbre DOM
- ✅ Retourne le premier ancêtre correspondant
- ❌ Retourne `null` si aucun élément trouvé

---

## 🔷 parentElement
> Donne l’**élément parent direct** (un seul niveau au-dessus)

```js
element.parentElement;
```

---

## 🔷 children
> Donne tous les **enfants directs** (HTML elements uniquement)

```js
element.children;
```

- 🔽 Retourne un `HTMLCollection`

---

## 🔷 querySelector(selector)
> Sélectionne le **premier descendant correspondant** au sélecteur CSS

```js
element.querySelector(".active");
```

---

## 🔷 querySelectorAll(selector)
> Sélectionne **tous les descendants** correspondants au sélecteur CSS

```js
element.querySelectorAll("button");
```

- 🔍🔍 Retourne une `NodeList` → tu peux faire un `forEach`

---

## 🔷 matches(selector)
> Vérifie si l’élément correspond au **sélecteur CSS donné**

```js
element.matches(".selected");
```

- ✅ Retourne `true` ou `false`
- 🧪 Utile dans les `event.target`

---

## 🔷 getAttribute() / setAttribute()
> Lire ou modifier un **attribut HTML**

```js
element.getAttribute("data-id");
element.setAttribute("aria-hidden", "true");
```

---

## 🔷 classList
> Gérer les **classes CSS** d’un élément

```js
element.classList.add("active");
element.classList.remove("hidden");
element.classList.toggle("selected");
```

---

## 🔷 nextElementSibling / previousElementSibling
> Naviguer vers les **éléments frères** (prochains/précédents)

```js
element.nextElementSibling;
element.previousElementSibling;
```

---

## 🧪 Exemple complet

```js
list.addEventListener("click", (e) => {
  const td = e.target.closest("td");
  if (td && td.matches(".clickable")) {
    console.log(td.textContent);
  }
});
```

---

## 📁 À retenir

- `closest()` : remonte dans le DOM
- `parentElement` / `children` : navigation structurelle
- `querySelectorAll()` : sélection multiple
- `matches()` : test d’un élément
- `classList` et `get/setAttribute()` : manipulation dynamique