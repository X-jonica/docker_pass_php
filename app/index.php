<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecurePass - Gestionnaire de mots de passe</title>
    <!-- Bootstrap 4 CSS -->
    <link href="/public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/public/assets/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
     <link href="/public/assets/fonts/poppins.css" rel="stylesheet">
    <!-- lien css -->
     <link href="/public/assets/css/styleIndex.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">
                <i class="fas fa-lock mr-2"></i>SecurePass
            </a>
            <button id="menuToggle" class="navbar-toggler" type="button" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fonctionnalite">Fonctionnalités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item ml-lg-3">
                        <a href="../views/login.php" id="btn-connexion-nav" class="btn btn-outline-light">Connexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="accueil" class="hero-section">
        <div class="container text-center py-5" id="hero-section-div">
            <span class="security-badge mb-3">
                <i class="fas fa-shield-alt mr-2"></i>Sécurité de niveau bancaire
            </span>
            <h1 class="display-4 font-weight-bold mb-4" id="title_doc">Gérez vos mots de passe en toute sécurité</h1>
            <p class="lead mb-5">SecurePass protège vos identifiants et vous permet de naviguer en ligne sans souci</p>
            <div class="d-flex justify-content-center" id="group_btn">
                <a href="../views/login.php" id="connexion-btn" class="btn btn-primary btn mr-3" >
                    <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                </a>
                <a href="#" id="demo-video" class="btn btn-outline-light">
                    <i class="fas fa-play-circle mr-2"></i>Voir la démo
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fonctionnalite" class="py-4">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold mb-3">Pourquoi choisir SecurePass ?</h2>
                <p class="text-muted lead">Une solution complète pour la gestion de vos identifiants</p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 p-4">
                        <div class="feature-icon">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                        <h4>Authentification forte</h4>
                        <p class="text-muted">Protection par 2FA et biométrie pour un accès ultra-sécurisé à vos mots de passe.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 p-4">
                        <div class="feature-icon">
                            <i class="fas fa-key"></i>
                        </div>
                        <h4>Générateur de mots de passe</h4>
                        <p class="text-muted">Créez des mots de passe complexes et uniques en un clic pour tous vos comptes.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 p-4">
                        <div class="feature-icon">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h4>Synchronisation multiplateforme</h4>
                        <p class="text-muted">Accédez à vos mots de passe sur tous vos appareils, en toute sécurité.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="CTA" class="py-5 bg-light">
        <div class="container py-5 text-center">
            <h2 class="font-weight-bold mb-4">Prêt à simplifier votre vie numérique ?</h2>
            <p class="lead mb-5">Rejoignez les utilisateurs qui protègent déjà leurs identifiants avec SecurePass</p>
            <a href="../views/register.php" id="btn-start-now" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-user-plus mr-2"></i>Commencer maintenant
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- SecurePass (gauche) -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-4">
                        <i class="fas fa-lock mr-2"></i>SecurePass
                    </h5>
                    <p>La solution ultime pour gérer et protéger vos mots de passe en toute simplicité.</p>
                </div>

                <!-- Navigation (centre) -->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Navigation</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#accueil" class="text-white">Accueil</a></li>
                        <li class="mb-2"><a href="#fonctionnalite" class="text-white">Fonctionnalités</a></li>
                        <li class="mb-2"><a href="#contact" class="text-white">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact (droite) -->
                <div class="col-lg-4">
                    <h5 class="mb-4" id="contact">Contact</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-envelope mr-2"></i> contact@securepass.com</li>
                        <li class="mb-2"><i class="fas fa-phone mr-2"></i> +33 1 23 45 67 89</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt mr-2"></i> AnyWhere, World</li>
                    </ul>
                </div>
            </div>
                        <hr class="my-4 bg-light">
            <div class="row">
                <div class="col-md-6 text-center text-md-left">
                    <p class="mb-0">© 2025 SecurePass. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <a href="#" class="text-white mr-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white mr-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white mr-3"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script defer src="/public/assets/js/jquery-3.5.1.slim.min.js"></script>
    <script defer src="/public/assets/js/popper.min.js"></script>
    <script src="/public/assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        const demo = document.getElementById("demo-video");
        demo.addEventListener("click", () => {
            alert("Pas encore disponible pour le moment!")
        })

        const toggleButton = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navbarNav');

        toggleButton.addEventListener('click', () => {
            // toggle la classe "show" qui contrôle l'affichage Bootstrap
            navMenu.classList.toggle('show');
        });
    </script>
</body>
</html>