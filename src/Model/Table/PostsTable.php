<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Class PostsTable
 * @package App\Model\Table
 */
class PostsTable extends Table
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

        $this->setTable('posts');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_id',
            'joinType' => 'INNER'
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
            ->integer('id');

        $validator
            ->scalar('uri')
            ->allowEmpty('uri');

        $validator
            ->scalar('title')
            ->allowEmpty('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->allowEmpty('slug');

        $validator
            ->scalar('header')
            ->allowEmpty('header');

        $validator
            ->scalar('content')
            ->allowEmpty('content');

        $validator
            ->integer('dsp_order')
            ->requirePresence('dsp_order', 'create')
            ->notEmpty('dsp_order');

        $validator
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->scalar('author')
            ->maxLength('author', 255)
            ->allowEmpty('author');

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
        $rules->add($rules->existsIn(['menu_id'], 'Menus'));

        return $rules;
    }
}
