<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message_default" style="color:green;" onclick="this.classList.add('hidden')"><?= $message ?></div>
