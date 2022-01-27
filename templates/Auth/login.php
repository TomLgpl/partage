<div class="ui form">
    <?= $this->Form->create() ?>
    <div class="field">
        <label><?= __('Identifiant :') ?></label>
        <input type="text" name="uti_identifiant" placeholder="<?= __('Votre identifiant') ?>">
    </div>
    <div class="field">
        <label><?= __('Mot de passe :') ?></label>
        <input type="password" name="uti_mot_de_passe" placeholder="<?= __('Votre mot de passe') ?>">
    </div>
    <br>
    <button class="ui fluid green button" type="submit"><?= _('Se connecter') ?></button>
    <?= $this->Form->end() ?>
</div>
