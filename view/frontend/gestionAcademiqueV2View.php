<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Gestion Académique</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
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

    <div id="loginScreen" class="login-container">
        <div class="login-card" data-aos="zoom-in">
            <div class="login-icon">
                <i class="fas fa-graduation-cap fa-2x"></i>
            </div>
            <h1 class="text-center mb-2">Système de Gestion</h1>
            <p class="text-center text-muted mb-4">Académique et Administrative</p>

            <div class="mb-3">
                <label class="form-label">Nom d'utilisateur</label>
                <input type="text" id="username" class="form-control" placeholder="Entrez votre nom d'utilisateur">
            </div>

            <div class="mb-4">
                <label class="form-label">Mot de passe</label>
                <input type="password" id="password" class="form-control" placeholder="Entrez votre mot de passe">
            </div>

            <button onclick="handleLogin()" class="gradient-btn w-100">Se connecter</button>
        </div>
    </div>

    <div id="appContainer" class="app-container">
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
            </div>
        </div>

        <div id="mainContent" class="main-content">
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

            <div class="content-area">
                <div id="enseignantsTab">
                    <div class="d-flex justify-content-between mb-4">
                        <button onclick="showAddForm()" class="gradient-btn">
                            <i class="fas fa-plus"></i> Ajouter
                        </button>
                    </div>

                    <div id="enseignantForm" style="display: none;" class="card-custom mb-4 p-4" data-aos="fade-down">
                        <h4 class="mb-3" id="formTitle">Ajouter un enseignant</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" id="nomInput" class="form-control" placeholder="Nom">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="prenomInput" class="form-control" placeholder="Prénom">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="mentionInput" class="form-control" placeholder="Mention">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="diplomeInput" class="form-control" placeholder="Diplôme">
                            </div>
                            <div class="col-12">
                                <input type="text" id="etablissementInput" class="form-control" placeholder="Établissement">
                            </div>
                            <div class="col-12">
                                <label class="form-label">CV (PDF, Image)</label>
                                <input type="file" id="cvInput" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <div class="col-12">
                                <button onclick="saveEnseignant()" class="btn btn-primary me-2">
                                    <span id="saveButtonText">Ajouter</span>
                                </button>
                                <button onclick="cancelForm()" class="btn btn-secondary">Annuler</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-custom">
                        <table class="table mb-0">
                            <thead class="table-header">
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Mention</th>
                                    <th>Diplôme</th>
                                    <th>Établissement</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="enseignantsTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="etudiantsTab" style="display: none;">
                    <div class="d-flex justify-content-between mb-4">
                        <button onclick="showAddStudentForm()" class="gradient-btn">
                            <i class="fas fa-plus"></i> Ajouter un étudiant
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

                <div id="historiqueTab" style="display: none;">
                    <div class="card-custom">
                        <div class="p-3 table-header">
                            <h5 class="mb-0"><i class="fas fa-history"></i> Historique des Actions</h5>
                        </div>
                    <div class="p-4" id="historiqueContainer">
                    </div>
                </div>
            </div>

            <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="studentModalLabel">Détails de l'étudiant</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="studentModalBody">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addStudentModalLabel">Ajouter un étudiant</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" id="studentNomInput" class="form-control" placeholder="Nom">
                            </div>
                            <div class="mb-3">
                                <input type="text" id="studentPrenomInput" class="form-control" placeholder="Prénom">
                            </div>
                            <div class="mb-3">
                                <input type="text" id="studentNiveauInput" class="form-control" placeholder="Niveau">
                            </div>
                            <div class="mb-3">
                                <input type="text" id="studentMentionInput" class="form-control" placeholder="Mention">
                            </div>
                            <div class="mb-3">
                                <input type="text" id="studentMatriculeInput" class="form-control" placeholder="Matricule">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Photo (Image)</label>
                                <input type="file" id="studentPhotoInput" class="form-control" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button onclick="saveStudent()" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.all.min.js"></script>

    <div class="modal fade" id="cvModal" tabindex="-1" aria-labelledby="cvModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cvModalLabel">Prévisualisation CV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" id="cvModalBody">
                </div>
            </div>
        </div>
    </div>

    <script>
        AOS.init({
            duration: 800,
            once: false
        });

        let currentUser = null;
        let editingId = null;
        let enseignants = [];
        let etudiants = [];
        let historique = [];

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
                loadHistorique();
            }
        }

        function loadEnseignants() {
            fetch('index.php?action=enseignantsList')
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        enseignants = result.data || [];
                        renderEnseignants();
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function loadEtudiants() {
            fetch('index.php?action=etudiantsList')
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        etudiants = result.data || [];
                        renderEtudiants();
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function loadHistorique() {
            fetch('index.php?action=historiqueList')
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        historique = result.data || [];
                        renderHistorique();
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function showAddForm() {
            document.getElementById('enseignantForm').style.display = 'block';
            document.getElementById('formTitle').textContent = 'Ajouter un enseignant';
            document.getElementById('saveButtonText').textContent = 'Ajouter';
            editingId = null;
            clearForm();
            AOS.refresh();
        }

        function clearForm() {
            document.getElementById('nomInput').value = '';
            document.getElementById('prenomInput').value = '';
            document.getElementById('mentionInput').value = '';
            document.getElementById('diplomeInput').value = '';
            document.getElementById('etablissementInput').value = '';
            document.getElementById('cvInput').value = '';
        }

        function cancelForm() {
            document.getElementById('enseignantForm').style.display = 'none';
            editingId = null;
            clearForm();
        }

        function saveEnseignant() {
            const nom = document.getElementById('nomInput').value;
            const prenom = document.getElementById('prenomInput').value;
            const mention = document.getElementById('mentionInput').value;
            const diplome = document.getElementById('diplomeInput').value;
            const etablissement = document.getElementById('etablissementInput').value;
            const cvInput = document.getElementById('cvInput');

            if (!nom || !prenom || !mention || !diplome || !etablissement) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs'
                });
                return;
            }

            const processData = (base64CV = null) => {
                const data = {
                    nom, prenom, mention, diplome, etablissement,
                    cv: base64CV,
                    cv_filename: cvInput.files.length > 0 ? cvInput.files[0].name : null
                };

                if (editingId) {
                    data.id = editingId;
                }

                const url = editingId ? 'index.php?action=enseignantUpdate' : 'index.php?action=enseignantCreate';

                fetch(url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        Swal.fire({
                            icon: 'success',
                            title: editingId ? 'Modifié!' : 'Ajouté!',
                            text: editingId ? 'Enseignant modifié avec succès' : 'Enseignant ajouté avec succès',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        cancelForm();
                        loadEnseignants();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: result.message || 'Une erreur est survenue'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue'
                    });
                });
            };

            if (cvInput.files.length > 0) {
                const file = cvInput.files[0];
                const reader = new FileReader();
                reader.onload = (e) => processData(e.target.result);
                reader.readAsDataURL(file);
            } else {
                processData();
            }
        }

        function editEnseignant(id) {
            const enseignant = enseignants.find(e => e.id === id);
            if (!enseignant) return;

            editingId = id;
            document.getElementById('nomInput').value = enseignant.nom;
            document.getElementById('prenomInput').value = enseignant.prenom;
            document.getElementById('mentionInput').value = enseignant.mention;
            document.getElementById('diplomeInput').value = enseignant.diplome;
            document.getElementById('etablissementInput').value = enseignant.etablissement;

            document.getElementById('enseignantForm').style.display = 'block';
            document.getElementById('formTitle').textContent = 'Modifier un enseignant';
            document.getElementById('saveButtonText').textContent = 'Modifier';

            AOS.refresh();
        }

        function deleteEnseignant(id) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('index.php?action=enseignantDelete', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id })
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Supprimé!',
                                text: 'L\'enseignant a été supprimé',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            loadEnseignants();
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        }

        function renderEnseignants() {
            const tbody = document.getElementById('enseignantsTableBody');
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();

            const filtered = enseignants.filter(e =>
                e.nom.toLowerCase().includes(searchTerm) ||
                e.prenom.toLowerCase().includes(searchTerm)
            );

            tbody.innerHTML = filtered.map((e, idx) => `
                <tr class="${idx % 2 === 0 ? 'table-light' : ''}">
                    <td>${e.nom}</td>
                    <td>${e.prenom}</td>
                    <td><span class="badge bg-primary badge-custom">${e.mention}</span></td>
                    <td>${e.diplome}</td>
                    <td>${e.etablissement}</td>
                    <td class="text-center">
                        <button onclick="previewCV('${e.id}')" class="btn-action bg-info bg-opacity-10 text-info">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="editEnseignant('${e.id}')" class="btn-action bg-primary bg-opacity-10 text-primary ms-2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteEnseignant('${e.id}')" class="btn-action bg-danger bg-opacity-10 text-danger ms-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderEtudiants() {
            const container = document.getElementById('etudiantsContainer');
            container.innerHTML = etudiants.map(e => `
                <div class="col-md-4" data-aos="fade-up">
                    <div class="etudiant-card" onclick="showStudentDetails('${e.id}')" style="cursor:pointer;">
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

        function renderHistorique() {
            const container = document.getElementById('historiqueContainer');
            container.innerHTML = historique.map(h => `
                <div class="d-flex gap-3 mb-4 pb-3 border-bottom" data-aos="fade-right">
                    <div class="history-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="mb-0">${h.action}</h6>
                            <small class="text-muted">${h.date}</small>
                        </div>
                        <p class="mb-1 text-muted">${h.etudiant_nom}</p>
                        <p class="mb-0 text-muted small">${h.details}</p>
                    </div>
                </div>
            `).join('');

            AOS.refresh();
        }

        function previewCV(id) {
            const enseignant = enseignants.find(e => e.id === id);
            const modalBody = document.getElementById('cvModalBody');

            if (enseignant && enseignant.cv_url) {
                modalBody.innerHTML = `<img src="${enseignant.cv_url}" alt="CV de ${enseignant.prenom} ${enseignant.nom}" class="img-fluid">`;
            } else {
                modalBody.innerHTML = '<p class="text-muted">CV non disponible pour cet enseignant.</p>';
            }

            const modal = new bootstrap.Modal(document.getElementById('cvModal'));
            modal.show();
        }

        function showStudentDetails(id) {
            const student = etudiants.find(e => e.id === id);
            const modalBody = document.getElementById('studentModalBody');

            if (student) {
                const photoHtml = student.photo_url ? `<img src="${student.photo_url}" alt="Photo de ${student.prenom} ${student.nom}" class="img-fluid mb-3" style="max-height: 200px;">` : '';
                modalBody.innerHTML = `
                    ${photoHtml}
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

        function showAddStudentForm() {
            const modal = new bootstrap.Modal(document.getElementById('addStudentModal'));
            modal.show();
        }

        function saveStudent() {
            const nom = document.getElementById('studentNomInput').value;
            const prenom = document.getElementById('studentPrenomInput').value;
            const niveau = document.getElementById('studentNiveauInput').value;
            const mention = document.getElementById('studentMentionInput').value;
            const matricule = document.getElementById('studentMatriculeInput').value;
            const photoInput = document.getElementById('studentPhotoInput');

            if (!nom || !prenom || !niveau || !mention || !matricule) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs'
                });
                return;
            }

            const processData = (base64Photo = null) => {
                fetch('index.php?action=etudiantCreate', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        nom, prenom, niveau, mention, matricule,
                        photo: base64Photo
                    })
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Ajouté!',
                            text: 'Étudiant ajouté avec succès',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        document.getElementById('studentNomInput').value = '';
                        document.getElementById('studentPrenomInput').value = '';
                        document.getElementById('studentNiveauInput').value = '';
                        document.getElementById('studentMentionInput').value = '';
                        document.getElementById('studentMatriculeInput').value = '';
                        document.getElementById('studentPhotoInput').value = '';

                        const modalElement = document.getElementById('addStudentModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();

                        loadEtudiants();
                        loadHistorique();
                    }
                })
                .catch(error => console.error('Error:', error));
            };

            if (photoInput.files.length > 0) {
                const file = photoInput.files[0];
                const reader = new FileReader();
                reader.onload = (e) => processData(e.target.result);
                reader.readAsDataURL(file);
            } else {
                processData();
            }
        }

        document.getElementById('searchInput').addEventListener('input', renderEnseignants);

        document.getElementById('password').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') handleLogin();
        });
    </script>
</body>
</html>
