<?php
 $title = 'Liste des cours';
?>
<?php ob_start(); ?>

<script src="public/js/jquery-3.4.1.js"></script>
<script src="public/js/changetexte.js"></script>

<div class="row mb-4">
    <div class="col-12" data-aos="fade-down">
        <h2 class="mb-4">
            <i class="fas fa-graduation-cap text-primary me-2"></i>
            Liste des Cours
        </h2>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm" data-aos="fade-up">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-cloud-upload-alt text-success me-2"></i>
                    Soumettre un Devoir
                </h5>
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
                <input type="hidden" id="matId" name="matId" value="<?php echo $matId; ?>"/>
                <div class="row align-items-end">
                    <div class="col-md-8 mb-3 mb-md-0">
                        <label for="myfile" class="form-label">Sélectionnez votre fichier (PDF uniquement)</label>
                        <input type="file" class="form-control" id="myfile" name="myfile" accept=".pdf"/>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success w-100" onclick="uploadDev()">
                            <i class="fas fa-upload me-2"></i>Télécharger
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-12 mb-4">
        <div class="table-responsive" data-aos="fade-right" data-aos-delay="100">
            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Matière</th>
                        <th>N°</th>
                        <th>Fichier</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $index = 0;
                foreach ($resultat as $cours) {
                    $index++;
                    $fileIcon = 'fa-file-pdf';
                    $fileColor = 'text-danger';
                    $fileUrl = '';

                    if($cours['type'] == 3) {
                        $fileIcon = 'fa-file-video';
                        $fileColor = 'text-warning';
                        $fileUrl = 'public/video/' . $cours['fichier'];
                    } else if($cours['type'] == 1) {
                        $fileUrl = 'public/pdf/' . $cours['fichier'];
                    } else if($cours['type'] == 2) {
                        $fileIcon = 'fa-file-powerpoint';
                        $fileColor = 'text-primary';
                        $fileUrl = 'public/ppt/' . $cours['fichier'];
                    }
                ?>
                    <tr data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                        <td><?= htmlspecialchars($cours['mid']) ?></td>
                        <td><span class="badge bg-secondary"><?= htmlspecialchars($cours['num']) ?></span></td>
                        <td>
                            <a href="<?= $fileUrl ?>" target="ifram" class="text-decoration-none">
                                <i class="fas <?= $fileIcon ?> <?= $fileColor ?> me-1"></i>
                                <?= htmlspecialchars($cours['fichier']) ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-8 col-md-12">
        <div class="card shadow-sm" data-aos="fade-left" data-aos-delay="200">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-file-alt me-2"></i>Visualisation du Document
            </div>
            <div class="card-body p-0">
                <iframe id="ifram" name="ifram" width="100%" height="900" frameborder="0" class="border-0"></iframe>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.1);
        transition: all 0.3s;
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
</style>

<?php $content = ob_get_clean(); ?>

<?php require('platformTemplate.php'); ?>