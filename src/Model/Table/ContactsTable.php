<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class ContactsTable
 * @package App\Model\Table
 */
class ContactsTable extends Table
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

        $this->setTable('contacts');
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
            ->scalar('author')
            ->maxLength('author', 255)
            ->allowEmpty('author');

        $validator
            ->scalar('uri')
            ->maxLength('uri', 255)
            ->allowEmpty('uri');

        $validator
            ->scalar('company')
            ->maxLength('company', 255)
            ->allowEmpty('company');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->allowEmpty('address');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 255)
            ->allowEmpty('tel');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 255)
            ->allowEmpty('fax');

        $validator
            ->scalar('tax_code')
            ->maxLength('tax_code', 255)
            ->allowEmpty('tax_code');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('website')
            ->maxLength('website', 255)
            ->allowEmpty('website');

        $validator
            ->scalar('hotline')
            ->maxLength('hotline', 255)
            ->allowEmpty('hotline');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
