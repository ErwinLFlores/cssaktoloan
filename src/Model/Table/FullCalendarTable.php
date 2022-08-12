<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Entity\EventType;


/**
 * EventTypes Model
 */
class FullCalendarTable extends Table
{
    public $useTable = false;
    public $name = "FullCalendar";
}
