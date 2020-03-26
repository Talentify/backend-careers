<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

use Cake\Event\Event;

/**
* Vacancies Model
*
* @method \App\Model\Entity\Vacancy newEmptyEntity()
* @method \App\Model\Entity\Vacancy newEntity(array $data, array $options = [])
* @method \App\Model\Entity\Vacancy[] newEntities(array $data, array $options = [])
* @method \App\Model\Entity\Vacancy get($primaryKey, $options = [])
* @method \App\Model\Entity\Vacancy findOrCreate($search, ?callable $callback = null, $options = [])
* @method \App\Model\Entity\Vacancy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
* @method \App\Model\Entity\Vacancy[] patchEntities(iterable $entities, array $data, array $options = [])
* @method \App\Model\Entity\Vacancy|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
* @method \App\Model\Entity\Vacancy saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
* @method \App\Model\Entity\Vacancy[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
* @method \App\Model\Entity\Vacancy[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
* @method \App\Model\Entity\Vacancy[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
* @method \App\Model\Entity\Vacancy[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
*/
class VacanciesTable extends Table
{
  /**
  * Initialize method
  *
  * @param array $config The configuration for the Table.
  * @return void
  */
  public function initialize(array $config): void
  {
    parent::initialize($config);

    $this->setTable('vacancies');
    $this->setPrimaryKey('id');

    $this->addBehavior('Timestamp', [
			'events' => [
				'Model.beforeSave' => [
					'created_at' => 'new',
					'updated_at' => 'always'
				]
			]
		]);
  }

  /**
  * Default validation rules.
  *
  * @param \Cake\Validation\Validator $validator Validator instance.
  * @return \Cake\Validation\Validator
  */
  public function validationDefault(Validator $validator): Validator
  {
    $validator
    ->integer('id')
    ->allowEmptyString('id', null, 'create');

    $validator
    ->scalar('title')
    ->maxLength('title', 256)
    ->requirePresence('title', 'create')
    ->notEmptyString('title');

    $validator
    ->scalar('description')
    ->requirePresence('description', 'create')
    ->notEmptyString('description');

    $validator
    ->scalar('status')
    ->requirePresence('status', 'create')
    ->inList('status', ['active','inactive'])
    ->notEmptyString('status');

    $validator
    ->scalar('workplace')
    ->maxLength('workplace', 300)
    ->allowEmptyString('workplace');

    $validator
    ->numeric('salary')
    ->allowEmptyString('salary');

    return $validator;
  }

  public function findAvailable(Query $query, $options): Query
  {
    $query->applyOptions($options);

    return $query->where([
      $this->aliasField('status') => 'active'
    ]);
  }

  public function beforeMarshal(Event $event, \ArrayObject $data)
  {
    if (!empty($data['salary'])) {
      $fmt = new \NumberFormatter( 'en_US', \NumberFormatter::CURRENCY );
      $currency = 'USD';
      $data['salary'] = numfmt_parse_currency($fmt, '$'.$data['salary'], $currency);
    }
  }
}
