<?php
/*
 * Template/FullCalendar/index.ctp
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
?>

<div class="Calendar index">
	<div id="calendar"></div>
</div>
<?= $this->Html->css('/css/fullcalendar.min'); ?>
<?= $this->Html->css('/css/jquery.qtip.min'); ?>
<?= $this->Html->script('/js/lib/moment.min.js'); ?>
<?= $this->Html->script('/js/fullcalendar.js'); ?>
<?= $this->Html->script('/js/jquery.qtip.min.js'); ?>
<?= $this->Html->script('/js/ready.js'); ?>