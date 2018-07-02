<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class TranslateTable
 * @package App\Model\Table
 */
class TranslateTable extends Table
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

        $this->setTable('translate');
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('message')
            ->allowEmpty('message');

        $validator
            ->scalar('note')
            ->allowEmpty('note');

        $validator
            ->scalar('lang_en')
            ->allowEmpty('lang_en');

        $validator
            ->scalar('lang_vi')
            ->allowEmpty('lang_vi');

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
