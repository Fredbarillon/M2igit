Sécurité Applicative - Notes de cours
## 1. Types de sécurité

    Cloud : Protège contre les cybermenaces internes (ex : erreur de configuration) et externes (ex : attaque via internet).

    Nœuds finaux : Protéger les terminaux en bout de chaîne (ordinateurs, imprimantes, téléphones) contre les attaques physiques ou logicielles.

    Réseau : Empêcher les accès non autorisés, les attaques (sniffing, spoofing, etc.) et assurer un chiffrement fort des flux avec des clés (TLS, IPSec, etc.).

    Application : Identifier les vulnérabilités logicielles (ex : injections, XSS) et protéger les données utilisateurs.

    Sécurité internet : Protège les données traitées via les navigateurs ou apps tierces. Implique pare-feux, anti-malwares, proxy filtrants.

    IoT / OT (Operational Technology) : Empêcher que les objets connectés (cameras, capteurs, domotique) soient exploités comme points d’entrée dans un réseau.

## 2. Logiciels malveillants (Malwares)

    Ransomware : Chiffre les données de la victime, puis demande une rançon pour les débloquer.

    Trojan (cheval de Troie) : Logiciel qui se fait passer pour une application légitime. Exploite les failles pour envoyer des données, télécharger des fichiers ou ouvrir un accès distant.

    Spyware : Espionne l’utilisateur à son insu (ex : keylogger, récupération de mots de passe).

    Worm (ver) : Se réplique automatiquement sur d’autres systèmes pour les infecter ou les détruire.

## 3. Types d’attaques

    Ingénierie sociale : Manipulation psychologique pour obtenir des données sensibles.

        Phishing : Email ou site frauduleux pour soutirer des identifiants.

        Harponnage (spear phishing) : Phishing ciblé sur un individu.

        Whaling : Harponnage visant des hauts responsables.

    Attaques par déni de service (DoS) : Surcharge une machine via une pluie de requêtes.

    DDoS : Plusieurs machines (botnets) attaquent une cible.

    Proxy et protections en amont :

        WAF (Web Application Firewall),

        IDS/IPS,

        Anti-DDoS services (ex : Cloudflare).

    Exploit 0-day : Exploite une vulnérabilité avant qu'elle soit connue du public.

    Menaces internes : Provenant d’employés malveillants ou négligents.

    Attaque de l’homme du milieu (MitM) : L’attaquant intercepte la communication entre deux parties. Surtout sur réseaux publics non chiffrés.

## 4. Principes de la sécurité (CIA)
Confidentialité

    Seules les personnes autorisées accèdent aux données.

    Outils : hachage, gestion des identités et des rôles (IAM).

Intégrité

    Garantir que les données n'ont pas été modifiées.

    Outils : hachage, checksum, signature numérique.

    Un hash est une empreinte : il est impossible de retrouver la donnée originale.

    Pour le casser, on utilise des dictionnaires préfabriqués ou des rainbow tables.

    Salt : Donnée aléatoire ajoutée au mot de passe avant hachage pour éviter les collisions.

Disponibilité

    L’information doit être accessible quand nécessaire.

    Outils : sauvegarde, PRA (Plan de reprise), load balancing, anti-DoS.

## 5. Authentification & Autorisation
Authentification

    Vérifie l’identité (ex : login/mot de passe, 2FA).

Autorisation

    Détermine les droits d’accès.

    RBAC : Role-Based Access Control. Les permissions sont liées au rôle.

    ACL : Access Control List. Chaque ressource a sa propre liste de permissions d'accès.

Contrôle d’accès

    DAC (Discretionary Access Control) : L’utilisateur créateur définit les droits.

    MAC (Mandatory Access Control) : Politique centralisée imposée par l’organisation (plus sûre).

## 6. Sécurité par conception

    Intégrer la sécurité dès la conception (shift left).

    Outils : SonarQube (analyse statique), SAST, DAST.

    Code mort : Code non exécuté (ex : boucle inaccessible).

    Principe du moindre privilège : Donner uniquement les droits nécessaires.

    Défense en profondeur : Superposition de couches de protection (réseau, app, OS).

    Audit & monitoring : Suivi des performances et des journaux.

## 7. Gestion des vulnérabilités

    Détection automatique des failles via outils (ex : Dependabot, Snyk).

    CVE (Common Vulnerabilities and Exposures) :

        Catalogue public maintenu par le MITRE (avec le soutien de la NSA & DHS).

        ID unique, base centralisée, interoperabilité avec les outils de sécurité.

## 8. Importance de la sécurité applicative

    Détection de vulnérabilités : permet d’identifier rapidement les failles potentielles.

    Authentification forte (MFA) : vérifie l’identité de manière fiable avec plusieurs facteurs.

    Contrôle d'accès granulaires : assure que chaque utilisateur a un accès strictement nécessaire.

    Chiffrement : protège les données en transit (TLS/HTTPS) et au repos (AES).

    DevSecOps : intègre les pratiques de sécurité tout au long du cycle de développement (CI/CD sécurisé, tests automatisés, revue de code).

    Mises à jour et correctifs : patcher rapidement les vulnérabilités découvertes.

    Détection d'intrusion : mise en place d’outils comme les SIEM (Splunk, ELK) et IDS/IPS pour surveiller les anomalies.

    Formation et sensibilisation continue : les utilisateurs sont souvent la première ligne de défense, d’où l’importance de la formation régulière (ex : simulation de phishing).

## 9. Menaces vs. Vulnérabilités

    Menace : Potentiel ou intention de nuire (ex : hacker, malware).

    Vulnérabilité : Failles exploitables dans un système.

## 10. OWASP

    OWASP SAMM : Software Assurance Maturity Model. Guide de maturité pour la sécurité logicielle.

    OWASP ASVS : Application Security Verification Standard. Liste de contrôles à appliquer pour valider la sécurité d’une application.

    OWASP ZAP : Outil open-source pour scanner les vulnérabilités web (proxy/interception).

## 11. Token JWT (JSON Web Token)

Un token JWT est un jeton d’authentification sécurisé utilisé pour échanger des informations entre deux parties (client/serveur) sous forme encodée et signée.
Structure d’un JWT (Base64 encodé)
xxxxx.yyyyy.zzzzz

    Header : contient le type de jeton et l'algorithme de signature.

{
  "alg": "HS256",
  "typ": "JWT"
}

    Payload : contient les "claims" (infos).

{
  "sub": "1234567890",
  "name": "Fred",
  "role": "admin",
  "exp": 1717000000
}

    Signature : créée avec un secret ou une clé privée.

HMACSHA256(base64UrlEncode(header) + "." + base64UrlEncode(payload), secret)
Exemple complet
eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.
eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkZyZWQiLCJyb2xlIjoiYWRtaW4iLCJleHAiOjE3MTcwMDAwMDB9.
SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c
Utilisation

    Authentification stateless (pas de session sur le serveur)

    Ajout dans les headers HTTP : Authorization: Bearer <token>

    Échange de données sécurisé (via HTTPS)

⚠️ Attention

    Le payload est lisible, ne jamais y mettre de mots de passe non chiffrés.

    Le champ exp est essentiel pour que le token expire.

## 12. Défaillances cryptographiques

Les défaillances cryptographiques concernent l’usage de protocoles ou algorithmes faibles ou mal implémentés, qui compromettent la sécurité des données.

    MD5 : Obsolète, car vulnérable aux attaques par collision (deux entrées donnant le même hash). À éviter.

    SHA-256 : Algorithme de hachage robuste et encore recommandé.

    AES (Advanced Encryption Standard) : Chiffrement symétrique rapide et sécurisé, utilisé pour protéger les données "au repos".

    RSA : Chiffrement asymétrique utilisé pour les échanges de clés ou les signatures numériques.

    TLS/HTTPS : Protocole assurant un canal sécurisé pour les communications sur internet (données en transit).

    HSM (Hardware Security Module) : Oui, nécessaire en entreprise. Matériel sécurisé pour générer, stocker et utiliser les clés cryptographiques. Recommandé dans les secteurs sensibles (finance, santé).

    OpenSSL : Bibliothèque open-source pour mettre en œuvre SSL/TLS.

## Bonnes pratiques :

    Toujours utiliser des versions récentes des algorithmes.

    Ne jamais coder son propre algorithme de chiffrement.

    Forcer TLS 1.2 ou supérieur.

    Utiliser des certificats valides et renouvelés automatiquement.


14. Concepts complémentaires (approfondissement)

Contrôle d’accès

Définition : Le contrôle d’accès permet de restreindre l’accès aux ressources d’un système aux seules entités autorisées.

RBAC (Role-Based Access Control) : Modèle d’accès où les permissions sont associées à des rôles. Chaque utilisateur est affecté à un ou plusieurs rôles selon ses fonctions. Exemple : un rôle "admin" peut avoir le droit de créer/supprimer un utilisateur, alors qu’un "visiteur" ne peut que consulter.

ACL (Access Control List) : Liste spécifique par ressource définissant qui peut y accéder et avec quel niveau de permission.

DAC/MAC : voir section 5 pour rappel.

Broken Access Control (contrôle d’accès défaillant)

Vulnérabilité courante où un utilisateur parvient à accéder à une ressource sans en avoir les droits (ex : URL tampering pour accéder à d’autres comptes utilisateurs).

🔐 Exemples :

Un utilisateur non administrateur pouvant accéder à un panneau d’administration via l’URL.

Suppression de données sans authentification.

TDD (Test-Driven Development)

Méthodologie de développement qui consiste à écrire les tests avant le code.

Étapes :

Écrire un test qui échoue.

Écrire le code minimal pour que le test passe.

Refactoriser le code.

Avantage : garantit que les fonctionnalités sont testées dès le départ et encourage un design plus robuste.

SonarQube

Définition : Outil d’analyse de code statique.

Fonction : Analyse automatiquement le code source pour détecter :

bugs,

vulnérabilités (ex : injection SQL),

code mort,

code non maintenable.

Quand l’utiliser : Intégré dans la chaîne CI/CD ou en local avant commits.

Outils similaires :

SonarCloud : version SaaS de SonarQube.

GitHub propose aussi une analyse de sécurité via CodeQL.

Utilisation de bibliothèques puissantes

Préférer des librairies éprouvées et maintenues plutôt que du code maison pour les fonctions critiques (authentification, chiffrement, parsers).

Vérifier leur réputation (GitHub stars, activité, issues).

TCP / TLS

TCP : Protocole de transport orienté connexion, assure la livraison fiable des paquets.

TLS : Protocole de sécurisation des échanges sur TCP (anciennement SSL).

Certificat SSL/TLS :

Sert à chiffrer la communication entre client et serveur.

Authentifie l'identité du serveur.

Certificat auto-signé :

Génére soi-même, utile pour du développement local.

Non reconnu par les navigateurs (pas de CA - autorité de certification).

Création : via OpenSSL :

openssl req -x509 -newkey rsa:4096 -keyout key.pem -out cert.pem -days 365

Injection (OS/SQL/...)

Prévention :

Utilisation d’ORM (Doctrine, Eloquent) pour éviter les injections SQL.

Nettoyage systématique des entrées utilisateur : suppression des caractères spéciaux, trim(), htmlspecialchars(), regex de validation.

Injection de commande OS :

Exécution arbitraire via exec, system, etc.

Contre-mesures : ne jamais insérer des inputs utilisateurs directement dans une commande shell.

Insecure Design / Sécurité par conception

Penser la sécurité dès la phase de conception.

Exemples :

Prévoyance de contrôle d'accès dès la modélisation des entités.

Mise en place d'une séparation de responsabilité (ex : modèle MVC).

Sécurité par défaut :

Activer les options de sécurité dès le déploiement (ex : CSP, désactivation de l’indexation, limitations sur les uploads).

Modélisation des menaces

Analyser dès le départ les points d’entrée, les faiblesses possibles, les utilisateurs malveillants.

Outils : STRIDE, LINDDUN.

Permet d’anticiper les risques et d’y répondre par la conception.

Principe du moindre privilège

Ne jamais donner plus de droits qu’un utilisateur ou un processus n’en a besoin.

Appliqué aux bases de données, utilisateurs système, API keys, etc.

Composants obsolètes ou vulnérables

Dépendances connues pour être des vecteurs d’attaques.

Outil recommandé :

Snyk : détecte les vulnérabilités connues dans les librairies (PHP, JS, Python…).

Intégrable dans GitHub ou pipelines CI/CD.

Session & Logs

Gestion des tokens de session :

Protéger contre le vol ou la fuite de session.

Déconnexion après inactivité, rotation régulière.

HttpOnly, Secure, SameSite sur les cookies.

Logging :

Ajouter des logs explicites en fin de fonction ou dans les erreurs pour aider au debug et à la détection d’anomalies.

Utiliser des bibliothèques : Monolog (PHP), Winston (JS), Logback (Java).


