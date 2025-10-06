<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Gestion Académique - AI&DEV Academy</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            max-width: 450px;
            width: 100%;
        }
        
        .login-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .app-container {
            display: none;
            min-height: 100vh;
            background: #f8f9fa;
        }
        
        .sidebar {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar-header {
            padding: 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .sidebar-menu {
            margin-top: 30px;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }
        
        .menu-item:hover {
            background: rgba(255,255,255,0.1);
        }
        
        .menu-item.active {
            background: rgba(255,255,255,0.2);
            border-left: 4px solid white;
        }
        
        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }
        
        .main-content.expanded {
            margin-left: 80px;
        }
        
        .top-bar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .content-area {
            padding: 30px;
        }
        
        .gradient-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .gradient-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }
        
        .card-custom {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .badge-custom {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .etudiant-card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s;
        }
        
        .etudiant-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }
        
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .history-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #f0e6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #764ba2;
        }
        
        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118,75,162,0.25);
        }
        
        .btn-action {
            padding: 8px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-action:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>

    <!-- Login Screen -->
    <div id="loginScreen" class="login-container">
        <div class="login-card" data-aos="zoom-in">
            <div class="login-icon">
                <i class="fas fa-graduation-cap fa-2x text-white"></i>
            </div>
            <h1 class="text-center mb-2">Gestion Académique</h1>
            <p class="text-center text-muted mb-4">AI&DEV Academy</p>
            
            <div class="mb-3">
                <label class="form-label">Nom d'utilisateur</label>
                <input type="text" id="username" class="form-control" placeholder="Entrez votre nom d'utilisateur">
            </div>
            
            <div class="mb-4">
                <label class="form-label">Mot de passe</label>
                <input type="password" id="password" class="form-control" placeholder="Entrez votre mot de passe">
            </div>
            
            <button onclick="handleLogin()" class="gradient-btn w-100">Se connecter</button>
            
            <div class="text-center mt-3">
                <a href="index.php?action=accueil" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i>Retour à l'accueil
                </a>
            </div>
        </div>
    </div>

    <!-- Main Application -->
    <div id="appContainer" class="app-container">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <h5 id="sidebarTitle">Gestion Académique</h5>
                <button onclick="toggleSidebar()" style="background: transparent; border: none; color: white; cursor: pointer;">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <div class="sidebar-menu">
                <button class="menu-item active" onclick="switchTab('enseignants')">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">Enseignants</span>
                </button>
                <button class="menu-item" onclick="switchTab('etudiants')">
                    <i class="fas fa-graduation-cap"></i>
                    <span class="menu-text">Étudiants</span>
                </button>
                <button class="menu-item" onclick="switchTab('historique')">
                    <i class="fas fa-history"></i>
                    <span class="menu-text">Historique</span>
                </button>
                <a href="index.php?action=accueil" class="menu-item">
                    <i class="fas fa-home"></i>
                    <span class="menu-text">Accueil</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div id="mainContent" class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 id="pageTitle">Gestion des Enseignants</h2>
                        <p class="text-muted mb-0">Bienvenue, <span id="currentUsername"></span></p>
                    </div>
                    <div class="d-flex gap-3 align-items-center">
                        <div class="position-relative">
                            <i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #999;"></i>
                            <input type="text" id="searchInput" class="form-control ps-5" placeholder="Rechercher..." style="width: 250px;">
                        </div>
                        <button onclick="handleLogout()" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Enseignants Tab -->
                <div id="enseignantsTab">
                    <div class="d-flex justify-content-between mb-4">
                        <button onclick="refreshData()" class="gradient-btn me-2">
                            <i class="fas fa-sync-alt"></i> Actualiser
                        </button>
                    </div>

                    <!-- Table -->
                    <div class="card-custom">
                        <table class="table mb-0">
                            <thead class="table-header">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Mention</th>
                                    <th>Diplôme</th>
                                    <th>Établissement</th>
                                </tr>
                            </thead>
                            <tbody id="enseignantsTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Étudiants Tab -->
                <div id="etudiantsTab" style="display: none;">
                    <div class="d-flex justify-content-between mb-4">
                        <button onclick="refreshData()" class="gradient-btn">
                            <i class="fas fa-sync-alt"></i> Actualiser
                        </button>
                    </div>
                    <div class="card-custom">
                        <div class="p-3 table-header">
                            <h5 class="mb-0"><i class="fas fa-list"></i> Liste des Étudiants</h5>
                        </div>
                        <div class="p-4">
                            <div class="row g-4" id="etudiantsContainer">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Historique Tab -->
                <div id="historiqueTab" style="display: none;">
                    <div class="card-custom">
                        <div class="p-3 table-header">
                            <h5 class="mb-0"><i class="fas fa-history"></i> Historique des Actions</h5>
                        </div>
                        <div class="p-4" id="historiqueContainer">
                            <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                                <div class="history-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-1">
                                        <h6 class="mb-0">Connexion système</h6>
                                        <small class="text-muted"><?= date('Y-m-d H:i') ?></small>
                                    </div>
                                    <p class="mb-1 text-muted">Administrateur</p>
                                    <p class="mb-0 text-muted small">Accès au système de gestion académique</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Student Details -->
            <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="studentModalLabel">Détails de l'étudiant</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="studentModalBody">
                            <!-- Student details will be inserted here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.all.min.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: false
        });

        // Data
        let currentUser = null;
        let enseignants = [];
        let etudiants = [];

        // Login
        function handleLogin() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (username && password) {
                currentUser = { username };
                document.getElementById('currentUsername').textContent = username;
                document.getElementById('loginScreen').style.display = 'none';
                document.getElementById('appContainer').style.display = 'block';
                loadEnseignants();
                
                Swal.fire({
                    icon: 'success',
                    title: 'Connexion réussie!',
                    text: `Bienvenue ${username}`,
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs'
                });
            }
        }

        // Logout
        function handleLogout() {
            Swal.fire({
                title: 'Déconnexion',
                text: 'Voulez-vous vraiment vous déconnecter?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Non'
            }).then((result) => {
                if (result.isConfirmed) {
                    currentUser = null;
                    document.getElementById('loginScreen').style.display = 'flex';
                    document.getElementById('appContainer').style.display = 'none';
                    document.getElementById('username').value = '';
                    document.getElementById('password').value = '';
                }
            });
        }

        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarTitle = document.getElementById('sidebarTitle');
            const menuTexts = document.querySelectorAll('.menu-text');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');

            if (sidebar.classList.contains('collapsed')) {
                sidebarTitle.style.display = 'none';
                menuTexts.forEach(text => text.style.display = 'none');
            } else {
                sidebarTitle.style.display = 'block';
                menuTexts.forEach(text => text.style.display = 'inline');
            }
        }

        // Switch Tab
        function switchTab(tab) {
            document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('active'));
            event.target.closest('.menu-item').classList.add('active');

            document.getElementById('enseignantsTab').style.display = 'none';
            document.getElementById('etudiantsTab').style.display = 'none';
            document.getElementById('historiqueTab').style.display = 'none';

            if (tab === 'enseignants') {
                document.getElementById('pageTitle').textContent = 'Gestion des Enseignants';
                document.getElementById('enseignantsTab').style.display = 'block';
                loadEnseignants();
            } else if (tab === 'etudiants') {
                document.getElementById('pageTitle').textContent = 'Gestion des Étudiants';
                document.getElementById('etudiantsTab').style.display = 'block';
                loadEtudiants();
            } else if (tab === 'historique') {
                document.getElementById('pageTitle').textContent = 'Historique des Actions';
                document.getElementById('historiqueTab').style.display = 'block';
            }
        }

        // Load Enseignants from API
        function loadEnseignants() {
            fetch('index.php?action=getEnseignantsAPI')
                .then(response => response.json())
                .then(data => {
                    enseignants = data;
                    renderEnseignants();
                })
                .catch(error => {
                    console.error('Error loading enseignants:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Impossible de charger les enseignants'
                    });
                });
        }

        // Load Etudiants from API
        function loadEtudiants() {
            fetch('index.php?action=getEtudiantsAPI')
                .then(response => response.json())
                .then(data => {
                    etudiants = data;
                    renderEtudiants();
                })
                .catch(error => {
                    console.error('Error loading etudiants:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Impossible de charger les étudiants'
                    });
                });
        }

        // Refresh Data
        function refreshData() {
            const currentTab = document.querySelector('.menu-item.active').onclick.toString().match(/switchTab\('(\w+)'\)/)[1];
            if (currentTab === 'enseignants') {
                loadEnseignants();
            } else if (currentTab === 'etudiants') {
                loadEtudiants();
            }
            
            Swal.fire({
                icon: 'success',
                title: 'Actualisé!',
                text: 'Les données ont été mises à jour',
                timer: 1500,
                showConfirmButton: false
            });
        }

        // Render Enseignants
        function renderEnseignants() {
            const tbody = document.getElementById('enseignantsTableBody');
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            const filtered = enseignants.filter(e => 
                e.nom.toLowerCase().includes(searchTerm) || 
                e.prenom.toLowerCase().includes(searchTerm)
            );

            tbody.innerHTML = filtered.map((e, idx) => `
                <tr class="${idx % 2 === 0 ? 'table-light' : ''}">
                    <td>${e.id}</td>
                    <td>${e.nom}</td>
                    <td>${e.prenom}</td>
                    <td><span class="badge bg-primary badge-custom">${e.mention}</span></td>
                    <td>${e.diplome}</td>
                    <td>${e.etablissement}</td>
                </tr>
            `).join('');
        }

        // Render Étudiants
        function renderEtudiants() {
            const container = document.getElementById('etudiantsContainer');
            container.innerHTML = etudiants.map(e => `
                <div class="col-md-4" data-aos="fade-up">
                    <div class="etudiant-card" onclick="showStudentDetails(${e.id})" style="cursor:pointer;">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="avatar">
                                ${e.prenom[0]}${e.nom[0]}
                            </div>
                            <span class="badge bg-success badge-custom">${e.niveau}</span>
                        </div>
                        <h5 class="mb-1">${e.prenom} ${e.nom}</h5>
                        <p class="text-muted mb-2">${e.mention}</p>
                        <p class="text-muted small">Matricule: ${e.matricule}</p>
                    </div>
                </div>
            `).join('');
            
            AOS.refresh();
        }

        // Show Student Details in Modal
        function showStudentDetails(id) {
            const student = etudiants.find(e => e.id === id);
            const modalBody = document.getElementById('studentModalBody');

            if (student) {
                modalBody.innerHTML = `
                    <h5>${student.prenom} ${student.nom}</h5>
                    <p><strong>Niveau:</strong> ${student.niveau}</p>
                    <p><strong>Mention:</strong> ${student.mention}</p>
                    <p><strong>Matricule:</strong> ${student.matricule}</p>
                `;
            } else {
                modalBody.innerHTML = '<p class="text-muted">Détails non disponibles pour cet étudiant.</p>';
            }

            const modal = new bootstrap.Modal(document.getElementById('studentModal'));
            modal.show();
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', renderEnseignants);

        // Enter key for login
        document.getElementById('password').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') handleLogin();
        });
    </script>
</body>
</html>