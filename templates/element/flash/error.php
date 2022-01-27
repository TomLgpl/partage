<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="ui container">
    <div class="ui error message" id="error_message">
        <div class="header">
            <?= $message ?>
        </div>
        <?= isset($params['error']) ? $params['error'] : ''  ?>
    </div>
</div>
<br>
