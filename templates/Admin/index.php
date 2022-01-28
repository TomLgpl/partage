<?php

?>

<div class="ui container">
    <br><br>
    <div class="ui segment">
        <input type="file" id="input_files" multiple accept="image/jpeg, image/png ">
        <br>
        <div id="info" ></div>
        <div class="ui toggle checkbox" id="choix_miniatures">
            <br>
            <input id="afficher_miniatures" type="checkbox" tabindex="0" class="hidden">
            <label for="afficher_miniatures"><?= __('Afficher les miniatures') ?></label>
            <br>
        </div>
        <div id="miniatures" class="ui small images"></div>
        <br>
        <button class="ui button" id="send_files">
            <?= __('Envoyer les fichiers') ?>
        </button>

    </div>
</div>

<script>



    $(document).ready(function() {

    });

    $('#afficher_miniatures').change(function() {
        check = $('#afficher_miniatures').prop("checked");
        if(check)
            updateFilesMiniature();
        else {
            $('#miniatures').empty();
        }
    });

    $('#input_files').change(function() {
        updateFilesSize();
        updateFilesMiniature();
    });

    function updateFilesSize(){
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

    function updateFilesMiniature(){
        var afficherMiniatures = $('#afficher_miniatures').prop("checked")
        if(afficherMiniatures){
            var files = document.getElementById('input_files').files;
            for(var i = 0; i < files.length; i++){
                var file = files[i];
                var imageType = /^image\//;

                if (!imageType.test(file.type)) {
                    continue;
                }

                var img = document.createElement("img");
                img.classList.add("ui");
                img.classList.add("image");
                img.file = file;
                document.getElementById('miniatures').appendChild(img);

                var reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(file);
            }
        }
    }

</script>
