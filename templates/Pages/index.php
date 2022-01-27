<?php

use Cake\Routing\Router; ?>

<br><br>

<div class="ui container">
    <div class="ui inverted segment">
        <h1 class="ui header"><?= __('Bientôt dispo') ?></h1>
    </div>
    <?php if($isAdmin): ?>
        <a class="ui button" href="<?= Router::url(['controller' => 'Admin', 'action' => 'index']) ?>"><?= __('Page admin') ?></a>
    <?php endif; ?>
    <br>
    <br>
    <a class="ui button" href="<?= Router::url(['controller' => 'Auth', 'action' => 'logout']) ?>"><?= __('Se déconnecter') ?></a>
</div>

