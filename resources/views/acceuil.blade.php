<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil Animée</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="acceuil.css">
</head>
<body>

    <!-- En-tête -->
    <header class="bg-primary text-white text-center py-5">
        <h1>Bienvenue sur Notre Site</h1>
        <p class="lead">Explorer notre collection d'animations amusantes.</p>
        <a href="#animations" class="btn btn-light btn-lg">Explorer les Animations</a>
    </header>

    <!-- Section À Propos -->
    <section id="about" class="my-5">
        <div class="container">
            <h2 class="text-center">À Propos de Nous</h2>
            <p class="text-center">
                Nous sommes une plateforme dédiée à la création et au partage d'animations interactives. Explorez notre collection pour découvrir de nouvelles créations.
            </p>
        </div>
    </section>

    <!-- Section Animations -->
    <section id="animations" class="my-5">
        <div class="container">
            <h2 class="text-center">Nos Animations</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="path/to/animation1.gif" class="card-img-top" alt="Animation 1">
                        <div class="card-body">
                            <h5 class="card-title">Animation 1</h5>
                            <p class="card-text">Description de l'animation 1. Cliquez pour en savoir plus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="path/to/animation2.gif" class="card-img-top" alt="Animation 2">
                        <div class="card-body">
                            <h5 class="card-title">Animation 2</h5>
                            <p class="card-text">Description de l'animation 2. Cliquez pour en savoir plus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="path/to/animation3.gif" class="card-img-top" alt="Animation 3">
                        <div class="card-body">
                            <h5 class="card-title">Animation 3</h5>
                            <p class="card-text">Description de l'animation 3. Cliquez pour en savoir plus.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="path/to/animation4.gif" class="card-img-top" alt="Animation 4">
                        <div class="card-body">
                            <h5 class="card-title">Animation 4</h5>
                            <p class="card-text">Description de l'animation 4. Cliquez pour en savoir plus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="path/to/animation5.gif" class="card-img-top" alt="Animation 5">
                        <div class="card-body">
                            <h5 class="card-title">Animation 5</h5>
                            <p class="card-text">Description de l'animation 5. Cliquez pour en savoir plus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="path/to/animation6.gif" class="card-img-top" alt="Animation 6">
                        <div class="card-body">
                            <h5 class="card-title">Animation 6</h5>
                            <p class="card-text">Description de l'animation 6. Cliquez pour en savoir plus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Contact -->
    <section class="bg-light my-5">
        <div class="container">
            <h2 class="text-center">Contactez-Nous</h2>
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" placeholder="Votre Nom">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Votre Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Votre Message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </section>

    <!-- Pied de page -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023 Votre Entreprise. Tous droits réservés.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>