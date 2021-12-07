# Routes de l'application

| URL              | Méthode HTTP | Contrôleur       | Méthode         | Titre HTML                  | Commentaire                               |
| ---------------- | ------------ | ---------------- | --------------- | --------------------------- | ----------------------------------------- |
| `/`              | `GET`        | `MainController` | `home`          | Bienvenue sur le site météo | Page d'accueil                            |
| `/mountain`      | `GET`        | `MainController` | `main_mountain` | La météo des montagnes      | Page montagne                             |
| `/beach`         | `GET`        | `MainController` | `main_beach`    | La météo des plages         | Page plage                                |
| `/set_city/{id}` | `GET`        | `MainController` | `set_city`      | -                           | Défini la ville à afficher dans le widget |
