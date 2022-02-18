<div class="ui basic segment">

    <h2 class="ui header" ><?= __('Ajouter des photos') ?></h2>
    <div style="border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 2%"></div>
    <br>
    <div class="ui input">
        <input type="date" id="date_files">
    </div>
    <br><br>
    <div class="ui input">
        <input type="text" id="dir_files" placeholder="Nom du dossier">
    </div>
    <br><br>
    <div class="ui input">
        <input type="file" id="input_files" multiple accept="image/jpeg, image/png">
    </div>
    <br>
    <div id="info"></div>
    <div class="ui toggle checkbox" id="choix_miniatures">
        <br>
        <input id="afficher_miniatures" type="checkbox" tabindex="0" class="hidden">
        <label for="afficher_miniatures"><?= __('Afficher les miniatures') ?></label>
        <br>
    </div>
    <div id="miniatures" class="ui small images"></div>
    <br>
    <button class="ui green button" id="send_files">
        <?= __('Envoyer les fichiers') ?>
    </button>
    <br><br>
    <div class="ui green progress">
        <div class="bar" id="progress_bar" style="transition-duration: 300ms; width: 0%;">
            <div class="progress" id="progress_label">0 %</div>
        </div>
        <div class="label"><?= __('Envoi des fichiers ...') ?></div>
    </div>

</div>

<script>

    nbItemEnvoye = 0;
    nbItemTotal = 0;

    $(document).ready(function () {
        $('#send_files').addClass('disabled');
    });

    $('#afficher_miniatures').change(function () {
        if ($('#afficher_miniatures').prop("checked"))
            updateFilesMiniature();
        else {
            $('#miniatures').empty();
        }
    });

    $('#input_files').change(function () {
        updateFilesSize();
        updateFilesMiniature();
        updateButton();
    });

    $('#send_files').click(function () {
        sendFiles();
    });

    function updateButton() {
        if (document.getElementById('input_files').files.length > 0)
            $('#send_files').removeClass('disabled');
        else
            $('#send_files').addClass('disabled');
    }

    function updateFilesSize() {
        var size = 0;
        var files = document.getElementById('input_files').files;
        var nbFiles = files.length;
        for (var numFiles = 0; numFiles < nbFiles; numFiles++) {
            size += files[numFiles].size;
        }
        var sOutput = size + " bytes";
        // partie de code facultative pour l'approximation des multiples
        for (var aMultiples = ["Ko", "Mo", "Go", "To", "Po", "Eo", "Zo", "Yo"], nMultiple = 0, nApprox = size / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
            sOutput = nApprox.toFixed(2) + " " + aMultiples[nMultiple];
        }
        $('#info').text(sOutput);
    }

    function updateFilesMiniature() {
        const afficherMiniatures = $('#afficher_miniatures').prop("checked")
        if (afficherMiniatures) {
            $('#miniatures').empty();
            var files = document.getElementById('input_files').files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /^image\//;

                if (!imageType.test(file.type)) {
                    continue;
                }

                const img = document.createElement("img");
                img.classList.add("ui");
                img.classList.add("image");
                img.file = file;
                document.getElementById('miniatures').appendChild(img);

                var reader = new FileReader();
                reader.onload = (function (aImg) {
                    return function (e) {
                        aImg.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(file);
            }
        }
    }

    function sendFiles() {
        const files = document.getElementById('input_files').files;
        $('#progress_bar').width('0%');
        date = $('#date_files').val();
        dir = $('#dir_files').val();
        dir.replace(' ', '_');
        $('#send_files').addClass('loading');
        $('#send_files').addClass('disabled');
        nbItemTotal = files.length;
        nbItemEnvoye = 0;
        for (let i = 0; i < files.length; i++) {
            sendFile(files[i], date, dir);
        }
    }

    function updateProgressBar() {
        nbItemEnvoye++;
        var progress = Math.trunc((nbItemEnvoye / nbItemTotal) * 100)
        $('#progress_bar').width(progress + '%');
        $('#progress_label').text(progress + ' %')
        if(progress === 100){
            $('#send_files').removeClass('loading');
            $('#send_files').removeClass('disabled');
            updateNbAAssigner();
            gePhotoInfoAAssigner();
        }
    }

    function sendFile(file, date, dir) {
        let formData = new FormData;
        formData.append("photo", file);
        formData.append("date", date);
        formData.append("dir", dir);
        $.ajax({
            url: "admin/upload",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
            },
            success: function () {
                updateProgressBar();
            },
            error: function () {
                console.log("Erreur pendant l'envoi d'un fichier");
            }
        });
    }

</script>
