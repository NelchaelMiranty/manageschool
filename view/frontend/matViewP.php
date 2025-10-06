<?php
 $title = 'Liste des matières';
?>
<?php ob_start();
	$_SESSION['prof']= $prid;
?>

<div class="row">
    <div class="col-12 mb-4" data-aos="fade-right">
        <h2 class="mb-4">
            <i class="fas fa-chalkboard-teacher text-primary me-2"></i>
            Gestion des Matières
        </h2>
    </div>
</div>

<div class="row">
    <div class="col-lg-5 col-md-12 mb-4">
        <div class="table-responsive" data-aos="fade-right" data-aos-delay="100">
            <table class="table table-hover">
                <thead class="table-danger">
                    <tr>
                        <th>ID</th>
                        <th>Intitulé</th>
                        <th>Prof</th>
                        <th>Crédits</th>
                        <th>V.H.</th>
                        <th>Sem</th>
                        <th>Délai</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $index = 0;
                while ($mats = $req->fetch()) {
                    $mid = $mats['mid'];
                    $nom = $mats['nom'];
                    $cred = $mats['cred'];
                    $prof = $mats['prof'];
                    $vh = $mats['vh'];
                    $sem = $mats['sem'];
                    $del = $mats['delai'];
                    $pri = $mats['prid'];
                    $index++;
                ?>
                    <tr data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                        <td><?= $mid ?></td>
                        <td>
                        <?php if ($prid == $pri): ?>
                            <a href="index.php?action=listCoursesP&mid=<?= $mid ?>" class="text-decoration-none fw-bold">
                                <i class="fas fa-edit me-1"></i><?= htmlspecialchars($nom) ?>
                            </a>
                        <?php else: ?>
                            <?= htmlspecialchars($nom) ?>
                        <?php endif; ?>
                        </td>
                        <td><span class="badge bg-info"><?= htmlspecialchars($prof) ?></span></td>
                        <td><?= $cred ?></td>
                        <td><?= $vh ?></td>
                        <td><span class="badge bg-secondary"><?= $sem ?></span></td>
                        <td><?= htmlspecialchars($del) ?></td>
                    </tr>
                <?php
                }
                $req->closeCursor();
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-7 col-md-12">
        <div class="card shadow-sm" data-aos="fade-left" data-aos-delay="200">
            <div class="card-header bg-danger text-white">
                <i class="fas fa-file-alt me-2"></i>Prévisualisation
            </div>
            <div class="card-body p-0">
                <iframe id="ifram" name="ifram" width="100%" height="900" frameborder="0" class="border-0"></iframe>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(240, 147, 251, 0.1);
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

<?php require('platformPTemplate.php'); ?>