<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class MenusTable
 * @package App\Model\Table
 */
class MenusTable extends Table
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

        $this->setTable('menus');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Posts', [
            'foreignKey' => 'menu_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->allowEmpty('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->allowEmpty('slug');

        $validator
            ->integer('dsp_order')
            ->requirePresence('dsp_order', 'create')
            ->notEmpty('dsp_order');

        $validator
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        return $validator;
    }
}
