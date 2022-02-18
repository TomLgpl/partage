<?php


use Cake\Routing\Router; ?>

<div class="ui container">
    <div class="ui segment">
        <h2 class="ui header" >
            <?= __('Mes albums') ?>
        </h2>
        <div style="border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 2%"></div>
        <br>
        <?php if(count($dossiers) == 0) : ?>
            <div class="ui container">
                <div class="ui info message">
                    <div class="header">
                        <?= __('Vous n\'apparaissez dans aucun album') ?>
                    </div>
                </div>
            </div>
            <br>
        <?php endif; ?>
        <div class="ui stackable three column grid">
            <?php foreach ($dossiers as $dossier) : ?>
                <div class="column">
                    <div class="ui card">
                        <div class="image">
                            <img class="ui fluid image" src="img/miniatures/<?= $dossier['pho_annee'] . '/' . ($dossier['pho_mois'] < 10 ? '0' . $dossier['pho_mois'] : $dossier['pho_mois']) . '/' . ($dossier['pho_jour'] < 10 ? '0' . $dossier['pho_jour'] : $dossier['pho_jour']) . '/' . $dossier['pho_dossier'] . '/' . $dossier['pho_nom'] ?>">
                        </div>
                        <div class="content">
                            <div class="header">
                                <?= str_replace(["-", "_"], "&nbsp;", $dossier['pho_dossier']) ?>
                            </div>
                            <div class="meta">
                                <span><?= ($dossier['pho_jour'] < 10 ? '0' . $dossier['pho_jour'] : $dossier['pho_jour']) . '/' . ($dossier['pho_mois'] < 10 ? '0' . $dossier['pho_mois'] : $dossier['pho_mois']) . '/' . $dossier['pho_annee'] ?></span>
                            </div>
                        </div>
                        <div class="extra content">
                            <b><a href="<?= Router::url(['Controller' => 'Photos', 'action' => 'album', $dossier['dossier_lien']]) ?>"><i style="" class="fa-solid fa-square-plus"></i>&nbsp;&nbsp;<?= __('Voir mes photos') ?></a></b>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <br>
    </div>
</div>
