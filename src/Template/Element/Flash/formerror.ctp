<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message_default" style="color:red;" onclick="this.classList.add('hidden')"><?= $message ?></div>
