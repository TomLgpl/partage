<?php

?>

<div class="ui container">

    <div class="ui top attached tabular menu">
        <a class="item active" data-tab="Ajouter"><?= __('Ajouter') ?></a>
        <a class="item" data-tab="Assigner"><?= __('Assigner') ?>
            <div class="floating ui red label" id="label_assigner"></div>
        </a>
        <a class="item" data-tab="utilisateur"><?= __('Gérer les utilisateurs') ?></a>
        <a class="item" data-tab="album"><?= __('Gérer les albums') ?></a>
    </div>
    <div class="ui bottom attached tab segment active" data-tab="Ajouter">
        <?php require_once('ajouter.php') ?>
    </div>
    <div class="ui bottom attached tab segment" data-tab="Assigner">
        <?php require_once('assigner.php') ?>
    </div>
    <div class="ui bottom attached tab segment" data-tab="utilisateur">
        <?php require_once('utilisateur.php') ?>
    </div>
    <div class="ui bottom attached tab segment" data-tab="album">
        <?php require_once('album.php') ?>
    </div>

</div>


<script>

    $('.menu .item')
        .tab()
    ;

</script>
