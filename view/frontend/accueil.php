<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les modules AI&DEV Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/css/cclass.css" media="screen" />
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 900px;
            width: 90%;
        }
        .logo-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 40px;
            text-align: center;
            color: white;
        }
        .logo-section img {
            max-width: 250px;
            height: auto;
            margin-bottom: 20px;
        }
        .logo-section h1 {
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }
        .form-section {
            padding: 50px 40px;
        }
        .form-section h2 {
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
        }
        .btn-student {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-student:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .btn-teacher {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        .btn-teacher:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 87, 108, 0.3);
        }
        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }
        @media (max-width: 768px) {
            .logo-section {
                padding: 40px 20px;
            }
            .form-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container" data-aos="zoom-in" data-aos-duration="1000">
        <div class="row g-0">
            <div class="col-md-5 logo-section" data-aos="fade-right" data-aos-delay="200">
                <img src="public/img/aidevlog.png" alt="AI&DEV Academy" class="img-fluid">
                <h1>Bienvenue</h1>
                <p class="mt-3">Votre plateforme d'apprentissage</p>
            </div>
            <div class="col-md-7 form-section">
                <h2 data-aos="fade-down">Connexion</h2>
                <form id="loginForm">
                    <div class="mb-4" data-aos="fade-up" data-aos-delay="100">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo" required>
                    </div>
                    <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
                        <label for="password_input" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password_input" name="passe" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <div class="d-grid gap-3" data-aos="fade-up" data-aos-delay="300">
                        <button type="button" class="btn btn-login btn-student" id="connectSt" onclick="checkPassword()">Connexion Apprenant</button>
                        <button type="button" class="btn btn-login btn-teacher" id="connectPr" onclick="checkPasswordP()">Connexion Formateur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="public/js/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="public/js/changetexte.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>