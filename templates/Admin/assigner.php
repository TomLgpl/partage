<div class="ui basic segment">

    <h2 class="ui header" ><?= __('Assigner des photos') ?></h2>
    <div style="border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 2%"></div>
    <br>
    <div id="nb_a_assigner"></div>
    <br>
    <div id="contenu">
        <div class="ui fluid image" id="photo_a_assigner"></div>
        <br>
        <select class="ui fluid search dropdown" multiple="" id="dropdown">
            <option value=""><?= __('Personne') ?></option>
            <?php foreach ($personnes as $personne) : ?>
                <option value="<?= $personne["uti_lien"] ?>"><?= $personne["uti_prenom"] . " " . $personne["uti_nom"] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button class="ui fluid green button" id="assigner_button">
            <?= __('Assigner') ?>
        </button>

        <br>
        <div class="ui grid container">
            <div class="eight wide column">
                <?= __('Photo prise le : ') ?>
                <b id="date_prise"></b>
                <br>
                <?= __('Dossier : ') ?>
                <b id="nom_dossier"></b>
            </div>
            <div class="eight wide column">
                <?= __('Photo ajouté le : ') ?>
                <b id="date_ajout"></b>
                <br>
                <?= __('Photo ajouté par : ') ?>
                <b id="ajouter_par"></b>
            </div>
        </div>
    </div>


</div>

<script>

    let pho_lien = "";

    $('.ui.dropdown')
        .dropdown();

    $(document).ready(function(){
        updateNbAAssigner();
        gePhotoInfoAAssigner();
    });

    function gePhotoInfoAAssigner(){
        $.ajax({
            url: "admin/gePhotoInfoAAssigner",
            success: function (data) {
                $('#dropdown').dropdown('clear');
                if(data.length === 0) {
                    $('#contenu').hide();
                }
                else{
                    $('#contenu').show();
                    const infos = data[0];
                    display_image("http://tomlgpl.fr/partage/webroot/img/miniatures/" + infos["pho_annee"] + "/" + (infos["pho_mois"] < 10 ? "0" + infos["pho_mois"] : infos["pho_mois"]) + "/" + (infos["pho_jour"] < 10 ? "0" + infos["pho_jour"] : infos["pho_jour"]) + "/" + infos["pho_dossier"] + "/" + infos["pho_nom"]);
                    $('#date_prise').text((infos["pho_jour"] < 10 ? "0" + infos["pho_jour"] : infos["pho_jour"]) + "/" + (infos["pho_mois"] < 10 ? "0" + infos["pho_mois"] : infos["pho_mois"]) + "/" + infos["pho_annee"]);
                    $('#nom_dossier').text(infos["pho_dossier"]);
                    $('#date_ajout').text(infos["pho_ajouter_date"]);
                    $('#ajouter_par').text(infos["pho_ajouter_par"]);
                    pho_lien = infos["pho_lien"];
                }
            }
        });
    }

    function updateNbAAssigner(){
        $.ajax({
            url: "admin/nbAAssigner",
            type: "post",
            success: function (data) {
                nb = parseInt(data);
                $('#label_assigner').text(data);
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
        $('#photo_a_assigner').empty();
        document.getElementById("photo_a_assigner").appendChild(img);
    }

    $('#assigner_button').click(function () {
        const personnes = $('#dropdown').val();
        let formData = new FormData;
        formData.append("personnes", personnes);
        formData.append("photo", pho_lien);
        $.ajax({
            url: "admin/assigner",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                updateNbAAssigner();
                gePhotoInfoAAssigner();
            }
        });
    });

</script>
