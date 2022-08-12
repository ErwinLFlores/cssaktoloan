<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Registry Model
 *
 * @method \App\Model\Entity\Registry get($primaryKey, $options = [])
 * @method \App\Model\Entity\Registry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Registry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Registry|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Registry saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Registry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Registry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Registry findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RegistryTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('registry');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('serial_key')
            ->maxLength('serial_key', 255)
            ->requirePresence('serial_key', 'create')
            ->notEmptyString('serial_key');

        $validator
            ->scalar('sap_family_serial')
            ->maxLength('sap_family_serial', 255)
            ->allowEmptyString('sap_family_serial');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->scalar('created_by')
            ->maxLength('created_by', 255)
            ->allowEmptyString('created_by');

        return $validator;
    }

    public function ifSerialKeyExist($serial)
    {
        $response = false;
        $results = $this->find('all')
            ->where(['serial_key' => $serial])
            ->first();

        if(!empty($results)) {
            $response = true;
        }

        return $response;
    }
}
