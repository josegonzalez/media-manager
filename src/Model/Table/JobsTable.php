<?php
namespace App\Model\Table;

use App\Model\Entity\Job;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jobs Model
 *
 */
class JobsTable extends Table
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

        $this->table('jobs');
        $this->displayField('id');
        $this->primaryKey('id');

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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('queue', 'create')
            ->notEmpty('queue');

        $validator
            ->requirePresence('data', 'create')
            ->notEmpty('data');

        $validator
            ->add('priority', 'valid', ['rule' => 'numeric'])
            ->requirePresence('priority', 'create')
            ->notEmpty('priority');

        $validator
            ->add('expires_at', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('expires_at');

        $validator
            ->add('delay_until', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('delay_until');

        $validator
            ->add('locked', 'valid', ['rule' => 'numeric'])
            ->requirePresence('locked', 'create')
            ->notEmpty('locked');

        return $validator;
    }
}
