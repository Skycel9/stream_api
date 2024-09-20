# <center>Stream API - Laravel</center>

Ce projet est une API qui a pour objectif de diffusé des données concernants différents type de vidéo. Ce projet scolaire a également comme objet la prise en main de laravel en autonomie et créer un petit projet afin de comprendre son fonctionnement.

Vous trouverez ci-dessous, la documentation de l'API ainsi que le MCD qui ont pour but de vous aider dans l'utilisation de l'API.

## Documentation

Voici la liste des endpoints et comment les utiliser

```http
GET /api/videos
```

Liste l'ensemble des vidéos

```http
GET /api/videos/{id}
```

Liste les données de la vidéo indiqué par l'ID

```http
POST /api/videos/{id}/like
```

Ajoute/supprime la vidéo en tant que like **lorsqu'un utilisateur est connecté**

```http
POST /api/videos/{id}/note
```

Affiche la note donné par l'utilisateur sur la vidéo indiqué par l'ID **lorsqu'un utilisateur est connecté**

```http
PUT /api/videos/{id}/note?note={value}
```

Ajoute la note choisi par l'utilisateur à la vidéo indiqué par l'ID **lorsqu'un utilisateur est connecté**

```http
DELETE /api/videos/{id}/note
```

Supprime la note donnée par l'utilisateur à la vidéo indiqué par l'ID **lorsqu'un utilisateur est connecté**

```http
GET /api/categories
```

Liste l'ensemble des catégories existante

```http
GET /api/categories/{id}
```

Affiche l'ensemble des données sur la catégorie indiqué par l'ID

```http
GET /api/categories/{slug}
```

Affiche l'ensemble des données sur la categorie indiqué par le slug

```http
GET /api/categories/{id}/videos
```

Liste les vidéos assigné à la catégorie indiqué par l'ID

```http
GET /api/attachments/{id}
```

Affiche l'ensemble des données sur l'image indiqué par l'ID

```http
POST /api/register?name={name}&displayName={displayName}&email={email}&password={password}&profile_picture={profile_picture}
```

Permet d'inscrire un utilisateur, profile_picture peut-être 0 par défaut

```http
POST /api/login?name={name}&password={password}
```

Permet de se connecter à un compte utilisateur, retour le token utile pour les requête nécessitant la connexion d'un utilisateur

```http
POST /api/logout
```

Permet de déconnecter un utilisateur

```http
POST /api/me
```

Affiche les données de l'utilisateur actuellement connecté, **lorsqu"un utilisateur est connecté**

```http
POST /api/me/likes
```

Affiche les données des vidéos liké par l'utilisateur actuellement connecté, **lorsqu'un utilisateur est connecté**

```http
POST /api/me/notes
```

Affiche les données des notes données par l'utilisateur actuellement connecté, **lorsqu'un utilisateur est connecté**

```http
POST /api/videos/{id}/notes
```

Affiche les données de la vidéo ainsi que la note donnée par l'utilisateur actuellement connecté, **lorsqu'un utilisateur est connecté**

```http
PUT /api/me/videos/{id}/notes
```

Permet d'ajouter une note à la vidéo indiqué par l'ID, **lorsqu'un utilisateur est connecté**

```http
DELETE /api/me/videos/{id}/notes
```

Permet de supprimé la note de la vidéo indiqué par l'ID, **lorsqu'un utilisateur est connecté**

```http
GET /api/notes/above/{value}/videos
```

Affiche toutes les entrées de note supérieur à {value}

```http
GET /api/notes/below/{value}/videos
```

Affiche toutes les entrées de note inférieur à {value}

