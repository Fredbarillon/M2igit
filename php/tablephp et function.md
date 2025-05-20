## 🧩 PHP – Manipulation des tableaux
## ➕ Ajouter des éléments dans un tableau
1. Ajout à la fin

$table[] = $value;

2. Ajout à une position précise

$table[$index] = $value;

3. Ajouter plusieurs éléments d’un coup

array_push($table, "valeur1", "valeur2");

## 📤 Afficher le contenu d’un tableau

print_r($table);

    Pour un affichage lisible :

echo "<pre>";
print_r($table);
echo "</pre>";

## 🔢 Créer une matrice

$matrice = [[1, 2], [3, 4]];

🧯 Destructuration (depuis PHP 7.1+)
🧾 Exemple tableau associatif

$table = ["bla" => "valeur"];
["bla" => $value] = $table;
echo $value; // affiche "valeur"

## 🔢 Exemple tableau numérique

$table = [10, 20, 30];
[$a, $b] = $table;      // $a = 10, $b = 20
[, , $c] = $table;      // skip les deux premiers, $c = 30

⚠️ Attention aux tableaux mixtes

$table = [0 => "a", "x" => "b", 1 => "c"];
[$a, $b] = $table; // ne fonctionnera pas comme prévu : ordre et indices incompatibles

## 🌬️ Spread & Rest (fusion de tableaux)
## 🔄 Spread (depuis PHP 7.4+)

$table1 = [1, 2];
$table3 = [5, 6];
$table2 = [...$table1, 3, 4, ...$table3];
// Résultat : [1, 2, 3, 4, 5, 6]

## 🔁 Parcourir des tableaux imbriqués
🧮 Exemple :

$multitable = [[1,2,3], [4,5,6], [7,8,9]];

foreach ($multitable as $tables) {
    foreach ($tables as $val) {
        echo $val . ".";
    }
}

## ✅ Vérifier si l’élément est un tableau :

foreach ($multitable as $elem) {
    if (is_array($elem)) {
        foreach ($elem as $val) {
            echo $val . ".";
        }
    } else {
        echo $elem;
    }
}

## ❓ Gérer les valeurs null
Vérification simple :

if ($value === null) {
    echo "Valeur manquante";
}

Remplacement par défaut :

$value = $value ?? "valeur_par_defaut";

## 📌 Insérer une valeur à une position précise
## ✅ 1. Tableau numérique avec array_splice()

$fruits = ["pomme", "banane", "orange"];
array_splice($fruits, 1, 0, "kiwi");
print_r($fruits);
// Résultat : ["pomme", "kiwi", "banane", "orange"]

✅ 2. Tableau associatif (reconstruction manuelle)

$infos = [
    "nom" => "Alice",
    "age" => 25
];

$newInfos = [];

foreach ($infos as $key => $value) {
    $newInfos[$key] = $value;
    if ($key === "nom") {
        $newInfos["ville"] = "Lyon";
    }
}

print_r($newInfos);
/*
Array (
    [nom] => Alice
    [ville] => Lyon
    [age] => 25
)
*/

## 🧪 PHP – Les fonctions
## 🔁 Définir une fonction avec types
## 📌 Syntaxe classique avec types :

function uneFonction(int $a, int $b): float {
    return $a / $b;
}

## 🔎 Explication :

    int $a et int $b : types attendus en paramètre

    : float : type de retour (ici, un nombre décimal)

    ✅ Types possibles : int, float, string, bool, array, object, void, etc.

## ⚙️ Ajouter des conditions logiques dans le return

function isValid(int $age): bool {
    return $age >= 18 && $age < 100;
}


## 🪝 Paramètres passés par référence (&)

function doublerValeur(int &$x): void {
    $x *= 2;
}

## ⚠️ Attention :

    Le & signifie que la variable d’origine est modifiée.

    Pas recommandé dans des cas sensibles → ⚠️ effet de bord.

## ## ⚙️ Paramètres par défaut

function saluer(string $nom = "invité"): void {
    echo "Bonjour $nom\n";
}

✅ Règle :

    Les paramètres par défaut doivent être à la fin de la liste.

function presentation(string $nom, int $age = 0) {}

## 🌬️ Paramètre rest (...) → arguments multiples
## 🎯 Définir une fonction à paramètres variables

function somme(int ...$nombres): int {
    $total = 0;
    foreach ($nombres as $n) {
        $total += $n;
    }
    return $total;
}

📤 À l’appel :

somme(1, 2, 3);             // OK
somme(...[1, 2, 3, 4]);     // Spread d’un tableau

    ## 🧠 $nombres est automatiquement un tableau

## 🧾 Appel avec arguments nommés (PHP 8+)

function infoAge(string $prenom, int $age): void {
    echo "$prenom a $age ans\n";
}

infoAge(age: 25, prenom: "Léo");

    Permet de changer l’ordre sans confusion

    Très lisible !

## 🧠 Fonctions anonymes & fléchées
🔸 Fonction anonyme (classique)

$carre = function($x) {
    return $x * $x;
};

echo $carre(4); // 16

🔹 Fonction fléchée (PHP 7.4+)

$carre = fn($x) => $x * $x;

    ⚠️ Ne supporte qu’une seule ligne et pas d’instructions {}.

    Utiliser les union types (PHP 8.0+)

function addition(int|float $a, int|float $b): int|float {
    return $a + $b;
}

    Le | permet de dire "ceci ou cela" → c’est une union, pas un ||

    Marche uniquement dans PHP ≥ 8.0