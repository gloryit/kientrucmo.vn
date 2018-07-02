<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class WebsiteImagesTable
 * @package App\Model\Table
 */
class WebsiteImagesTable extends Table
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

        $this->setTable('website_images');
        $this->setDisplayField('name');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('picture');

        $validator
            ->scalar('ext')
            ->maxLength('ext', 3)
            ->requirePresence('ext', 'create')
            ->notEmpty('ext');

        $validator
            ->scalar('uri')
            ->maxLength('uri', 255)
            ->requirePresence('uri', 'create')
            ->notEmpty('uri');

        $validator
            ->integer('width')
            ->allowEmpty('width');

        $validator
            ->integer('height')
            ->allowEmpty('height');

        $validator
            ->scalar('mine_type')
            ->maxLength('mine_type', 100)
            ->requirePresence('mine_type', 'create')
            ->notEmpty('mine_type');

        return $validator;
    }
}
