<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Routing\Router;

$cakeDescription = 'Partage';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"
            integrity="sha512-dqw6X88iGgZlTsONxZK9ePmJEFrmHwpuMrsUChjAw1mRUhUITE5QU9pkcSox+ynfLhL15Sv2al5A0LVyDCmtUw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
          integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js"></script>
    <script src="https://kit.fontawesome.com/45f6709f50.js" crossorigin="anonymous"></script>

    <?= $this->Html->css('custom.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

<div class="ui fluid container">
    <div class="ui grid">
        <div class="computer only row">
            <div class="column">
                <div class="ui secondary pointing menu">
                    <a href="<?= Router::url(['controller' => 'Pages', 'action' => 'index']) ?>"
                       class="item <?= $item == "accueil" ? "active" : ""?>">
                        <i class="fa-solid fa-house"></i>&nbsp;&nbsp;<?= __('Accueil') ?>
                    </a>
                    <?php if ($isAdmin): ?>
                        <a href="<?= Router::url(['controller' => 'Admin', 'action' => 'index']) ?>"
                           class="item <?= $item == "admin" ? "active" : ""?>">
                            <i class="fa-solid fa-lock"></i>&nbsp;&nbsp;<?= __('Admin') ?>
                        </a>
                    <?php endif; ?>
                    <div class="right menu">
                        <a class="item" href="<?= Router::url(['controller' => 'Auth', 'action' => 'logout']) ?>">
                            <i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;<?= __('Se déconnecter') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tablet mobile only row">
            <div class="column">
                <div class="ui secondary pointing menu">
                    <a id="mobile_item" class="item">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>



</div>
</body>
</html>

<div class="ui pushable basic segment">
    <div class="ui top sidebar vertical menu">
        <a href="<?= Router::url(['controller' => 'Pages', 'action' => 'index']) ?>"
           class="item <?= $item == "accueil" ? "active" : ""?>">
            <i class="fa-solid fa-house"></i>&nbsp;&nbsp;<?= __('Accueil') ?>
        </a>
        <?php if ($isAdmin): ?>
            <a href="<?= Router::url(['controller' => 'Admin', 'action' => 'index']) ?>"
               class="item <?= $item == "admin" ? "active" : ""?>">
                <i class="fa-solid fa-lock"></i>&nbsp;&nbsp;<?= __('Admin') ?>
            </a>
        <?php endif; ?>
        <div class="right menu">
            <a class="item" href="<?= Router::url(['controller' => 'Auth', 'action' => 'logout']) ?>">
                <i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;<?= __('Se déconnecter') ?>
            </a>
        </div>
    </div>
    <div class="pusher">
        <div id="content" class="ui basic segment">
            <?= $this->Flash->render() ?>
            <br>
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>



<script>

    $('.ui.sidebar').sidebar({
        context: $('.ui.pushable.basic.segment'),
        transition: 'overlay'
    }).sidebar('attach events', '#mobile_item');

</script>
