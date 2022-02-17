<?php

use Cake\Routing\Router; ?>

<div class="ui container">
    <div class="ui segment">
        <h2 class="ui header" >
            <?= $dossier ?>
        </h2>
        <?= $jour . '/' . $mois . '/' . $annee ?>
        <div style="border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 2%"></div>
        <br>
        <div class="ui stackable four column grid">
            <?php foreach ($photos as $photo) : ?>
                <div class="column">
                    <div class="rounded image">
                        <img class="ui rounded fluid image" alt="<?= $photo['pho_nom'] ?>" src="http://tomlgpl.fr/partage/img/miniatures/<?= $annee . '/' . $mois . '/' . $jour . '/' . $dossier . '/' . $photo['pho_nom'] ?>">
                    </div>
                    <a class="ui small fluid olive button" href="<?= Router::url(['controller' => 'Download', 'action' => 'photo', $photo["pho_lien"]]) ?>"><?= __('Télécharger') ?></a>
                </div>
            <?php endforeach; ?>
        </div>
        <br>
    </div>
</div>
