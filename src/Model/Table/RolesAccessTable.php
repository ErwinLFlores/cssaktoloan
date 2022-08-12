<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RolesAccess Model
 *
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\RolesAcces get($primaryKey, $options = [])
 * @method \App\Model\Entity\RolesAcces newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RolesAcces[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RolesAcces|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RolesAcces saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RolesAcces patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RolesAcces[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RolesAcces findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RolesAccessTable extends Table
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

        $this->setTable('roles_access');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
        ]);
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
            ->scalar('controller_type')
            ->maxLength('controller_type', 255)
            ->requirePresence('controller_type', 'create')
            ->notEmptyString('controller_type');

        $validator
            ->integer('action_view')
            ->allowEmptyString('action_view');

        $validator
            ->integer('action_add')
            ->allowEmptyString('action_add');

        $validator
            ->integer('action_edit')
            ->allowEmptyString('action_edit');

        $validator
            ->integer('action_delete')
            ->allowEmptyString('action_delete');

        $validator
            ->integer('action_prints')
            ->allowEmptyString('action_prints');

        $validator
            ->integer('action_reports')
            ->allowEmptyString('action_reports');

        $validator
            ->integer('action_members')
            ->allowEmptyString('action_members');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->isUnique(['controller_type', 'role_id']));

        return $rules;
    }

    public function getRole($role_id)
    {
        $result = $this->find('all')
            ->where(['role_id' => $role_id])
            ->first();

        return $result;
    }

    public function getAccess($role_id) 
    {
        $active_roles = $this->find('all')
            ->where([
                'role_id' => $role_id
            ])
            ->all();
        $current_roles = [];

        foreach ($active_roles as $key => $role) {
            $current_roles[$role->controller_type] = [
                'action_index' => $role->action_index,
                'action_view' => $role->action_view,
                'action_add' => $role->action_add,
                'action_edit' => $role->action_edit,
                'action_delete' => $role->action_delete,
                'action_prints' => $role->action_prints,
                'action_reports' => $role->action_reports,
                'action_members' => $role->action_members
            ];
        }

        return $current_roles;
    }

    public function getAccessRecord($roleaccess_id) 
    {
        $result = $this->find('all')
            ->where([
                'id' => $roleaccess_id
            ])
            ->first();

        return $result;
    }
}
