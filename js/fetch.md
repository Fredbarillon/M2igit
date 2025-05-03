# JavaScript Asynchrone & API

## Qu'est-ce que l'asynchrone en JavaScript ?

JavaScript est **mono-threadé**, ce qui signifie qu'il ne peut exécuter qu'une seule instruction à la fois. Cependant, grâce à des mécanismes comme **les promesses** et **async/await**, on peut effectuer des tâches asynchrones (comme des requêtes réseau) **sans bloquer** l'exécution du reste du code.

L'asynchrone est donc crucial lorsqu'on travaille avec des **API**, des bases de données ou tout autre service externe.

---

## Exemple concret avec une API : PokeAPI

```js
const BASE_URL = "https://pokeapi.co/api/v2/pokemon/";

async function getPokemon(name) {
  const response = await fetch(BASE_URL + name);
  const data = await response.json();
  return data;
}
```

### Explication ligne par ligne :
- `const BASE_URL = "..."` : Déclaration de l'URL de base de l'API.
- `async function getPokemon(name)` : Fonction asynchrone qui prend un nom de Pokémon.
- `const response = await fetch(BASE_URL + name)` : Envoie une requête HTTP GET à l'API pour récupérer les données du Pokémon.
- `const data = await response.json()` : Convertit la réponse en JSON.
- `return data` : Retourne les données du Pokémon.

---

## Utiliser `.map()`

```js
const datas = ["pikachu", "bulbasaur"].map(pokemon => getPokemon(pokemon));
```

- `.map()` permet de transformer un tableau en appelant une fonction pour chaque élément.
- Ici, on utilise `.map()` pour appeler `getPokemon()` sur chaque nom de Pokémon.
- Attention : cela crée un tableau de promesses. Pour obtenir les données, on utiliserait `Promise.all()`.

---

## Méthode POST : Créer une ressource

```js
async function createNewPost(post) {
  const response = await fetch("https://example.com/api/posts", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Authorization": "Bearer VOTRE_TOKEN_ICI"
    },
    body: JSON.stringify(post)
  });

  const data = await response.json();
  return data;
}
```

### Explication :
- `method: "POST"` : Indique qu'on envoie des données pour créer une ressource.
- `headers` : Spécifie le type de contenu envoyé (JSON) et une autorisation (token).
- `body: JSON.stringify(post)` : Convertit l'objet `post` en chaîne JSON.
- `await fetch(...)` : Envoie la requête.
- `await response.json()` : Lit la réponse au format JSON.

---

## Méthode DELETE : Supprimer une ressource

```js
async function deletePost(id) {
  const response = await fetch(`https://example.com/api/posts/${id}`, {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json"
    }
  });

  if (response.status === 200) {
    return true;
  } else {
    throw new Error("Erreur lors de la suppression");
  }
}
```

### Explication :
- `method: "DELETE"` : Requête pour supprimer une ressource.
- L'`id` est inséré directement dans l'URL.
- Si le statut de la réponse est `200`, la suppression a fonctionné.
- Sinon, une erreur est levée.

---

## Résumé des méthodes HTTP

| Méthode | Description |
|--------|-------------|
| GET    | Lire une ressource |
| POST   | Créer une ressource |
| PUT / PATCH | Modifier une ressource existante |
| DELETE | Supprimer une ressource |

---

## À retenir :
- Toujours utiliser `async/await` avec `fetch` pour un code plus lisible.
- Toujours gérer les erreurs (`try/catch` ou vérification du `status`).
- Bien configurer les `headers` pour les requêtes POST/DELETE.
- Pour plusieurs appels asynchrones en parallèle : `Promise.all()`.
