<?php

?>

<div class="ui container">

    <div class="ui top attached tabular menu">
        <a class="item active" data-tab="Ajouter"><?= __('Ajouter') ?></a>
        <a class="item" data-tab="Assigner"><?= __('Assigner') ?></a>
        <a class="item" data-tab="third">Third</a>
    </div>
    <div class="ui bottom attached tab segment active" data-tab="Ajouter">
        <?php require_once('ajouter.php') ?>
    </div>
    <div class="ui bottom attached tab segment" data-tab="Assigner">
        <?php require_once('assigner.php') ?>
    </div>
    <div class="ui bottom attached tab segment" data-tab="third">
        Third
    </div>

</div>


<script>

    $('.menu .item')
        .tab()
    ;

</script>
