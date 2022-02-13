<div class="ui basic segment">

    <h2 class="ui header" style="border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 2%"><?= __('Assigner des photos') ?></h2>

    <br>
    <div id="nb_a_assigner"></div>
    <br>
    <div id="photo_a_assigner"></div>

</div>

<script>

    $(document).ready(function(){
        updateNbAAssigner();
        gePhotoInfoAAssigner();
    });

    function gePhotoInfoAAssigner(){
        $.ajax({
            url: "admin/gePhotoInfoAAssigner",
            success: function (data) {
                const infos = data[0];
                display_image("http://tomlgpl.fr/partage/webroot/img/upload/" + infos["pho_annee"] + "/" + (infos["pho_mois"] < 10 ? "0" + infos["pho_mois"] : infos["pho_mois"]) + "/" + (infos["pho_jour"] < 10 ? "0" + infos["pho_jour"] : infos["pho_jour"]) + "/" + infos["pho_dossier"] + "/" + infos["pho_nom"]);
                console.log(infos);
            }
        });
    }

    function updateNbAAssigner(){
        $.ajax({
            url: "admin/nbAAssigner",
            type: "post",
            success: function (data) {
                nb = parseInt(data);
                div = $('#nb_a_assigner');
                if(nb === 0)
                    div.text("<?= __('Aucune photo n\'est à assigner.') ?>");
                else if(nb === 1)
                    div.text("<?= __('Il reste 1 photo à assigner') ?>");
                else if(nb > 1)
                    div.text("<?= __('Il reste ') ?>" + nb + "<?= __(' photos à assigner.') ?>");
            },
            error: function () {
                console.log('erreur');
            }
        });
    }

    function display_image(src,) {
        const img = document.createElement("img");
        img.src = src;
        img.classList.add("ui");
        img.classList.add("image");
        document.getElementById("photo_a_assigner").appendChild(img);
    }

</script>
