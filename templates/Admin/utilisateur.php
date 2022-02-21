<div class="ui basic segment">

    <h2 class="ui header"><?= __('Gérer les utilisateurs') ?></h2>
    <div style="border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 2%"></div>
    <br>

    <div class="ui stackable five column grid">
        <div class="column">
            <label for="identifiant"><?= __('Identifiant') ?></label><br>
            <div class="ui fluid input">
                <input type="text" id="identifiant" placeholder="<?= __('Identifiant') ?>">
            </div>
        </div>
        <div class="column">
            <label for="prenom"><?= __('Prénom') ?></label><br>
            <div class="ui fluid input">
                <input type="text" id="prenom" placeholder="<?= __('Prénom') ?>">
            </div>
        </div>
        <div class="column">
            <label for="nom"><?= __('Nom') ?></label><br>
            <div class="ui fluid input">
                <input type="text" id="nom" placeholder="<?= __('Nom') ?>">
            </div>
        </div>
        <div class="column">
            <label for="motdepasse"><?= __('Mot de passe') ?></label><br>
            <div class="ui fluid input">
                <input type="text" id="motdepasse" placeholder="<?= __('Mot de passe') ?>">
            </div>
        </div>
        <div class="column">
            <div class="computer only">
                <br>
            </div>
            <button class="ui green fluid button" id="add_utilisateur">
                <?= __('Ajouter l\'utilisateur') ?>
            </button>
        </div>
    </div>
    <br>
    <div style="border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 2%"></div>
    <br>

    <select class="ui search selection dropdown" id="uti_dropdown">
        <option value="" selected="selected"><?= __('Sélectionner une personne') ?></option>
        <?php foreach ($personnes as $personne) : ?>
            <option value="<?= $personne["uti_lien"] ?>"><?= $personne["uti_prenom"] . " " . $personne["uti_nom"] ?></option>
        <?php endforeach; ?>
    </select>

    <div class="ui segment">
        <?= __('Aucune information à afficher.') ?>
    </div>

</div>

<script>

    $('.ui.dropdown')
        .dropdown();

    $(document).ready(function () {
        $('#uti_dropdown').dropdown('clear');
        $('#identifiant').val("");
        $('#nom').val("");
        $('#prenom').val("");
        $('#motdepasse').val("");
    });

    $('#add_utilisateur').click(function () {
        let formData = new FormData;
        formData.append("identifiant", $('#identifiant').val());
        formData.append("nom", $('#nom').val());
        formData.append("prenom", $('#prenom').val());
        formData.append("motdepasse", $('#motdepasse').val());
        $.ajax({
            url: "admin/ajouterUtilisateur",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#add_utilisateur').addClass('disabled');
                $('#add_utilisateur').addClass('loading');
            },
            success: function () {
                $('#identifiant').val("");
                $('#nom').val("");
                $('#prenom').val("");
                $('#motdepasse').val("");
                $('#add_utilisateur').removeClass('disabled');
                $('#add_utilisateur').removeClass('loading');
            },
            error: function () {
                $('#add_utilisateur').removeClass('disabled');
                $('#add_utilisateur').removeClass('loading');
                alert("Utilisateur non inséré");
            }
        });
    })

</script>
