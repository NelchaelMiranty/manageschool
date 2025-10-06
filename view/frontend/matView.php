<?php
 $title = 'Liste des matières';
?>
<?php ob_start(); ?>

<div class="row">
    <div class="col-12 mb-4" data-aos="fade-right">
        <h2 class="mb-4">
            <i class="fas fa-book-open text-primary me-2"></i>
            Liste des Matières
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-12 mb-4">
        <div class="table-responsive" data-aos="fade-right" data-aos-delay="100">
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Intitulé</th>
                        <th>Catégorie</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $index = 0;
                while ($mats = $req->fetch()) {
                    $mid = $mats['mid'];
                    $nom = $mats['intitule'];
                    $cat = $mats['categorie'];
                    $index++;
                ?>
                    <tr data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                        <td><?= $mid ?></td>
                        <td>
                            <a href="index.php?action=listCourses&mid=<?= $mid ?>" class="text-decoration-none fw-bold">
                                <i class="fas fa-folder-open me-1"></i><?= htmlspecialchars($nom) ?>
                            </a>
                        </td>
                        <td>
                            <span class="badge bg-info"><?= htmlspecialchars($cat) ?></span>
                        </td>
                    </tr>
                <?php
                }
                $req->closeCursor();
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-8 col-md-12">
        <div class="card shadow-sm" data-aos="fade-left" data-aos-delay="200">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-file-alt me-2"></i>Aperçu du Document
            </div>
            <div class="card-body p-0">
                <iframe id="ifram" name="ifram" width="100%" height="654" frameborder="0" class="border-0"></iframe>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.1);
        cursor: pointer;
        transition: all 0.3s;
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .table thead {
        position: sticky;
        top: 0;
        z-index: 10;
    }
</style>

<?php $content = ob_get_clean(); ?>

<?php require('platformTemplate.php'); ?>