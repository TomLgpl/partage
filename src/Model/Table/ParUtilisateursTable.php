<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParUtilisateurs Model
 *
 * @method \App\Model\Entity\ParUtilisateur newEmptyEntity()
 * @method \App\Model\Entity\ParUtilisateur newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ParUtilisateur[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParUtilisateur get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParUtilisateur findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ParUtilisateur patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParUtilisateur[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParUtilisateur|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParUtilisateur saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParUtilisateur[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParUtilisateur[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParUtilisateur[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParUtilisateur[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ParUtilisateursTable extends Table
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

        $this->setTable('par_utilisateurs');
        $this->setDisplayField('uti_lien');
        $this->setPrimaryKey('uti_lien');
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
            ->scalar('uti_lien')
            ->maxLength('uti_lien', 50)
            ->allowEmptyString('uti_lien', null, 'create');

        $validator
            ->scalar('uti_identifiant')
            ->maxLength('uti_identifiant', 100)
            ->requirePresence('uti_identifiant', 'create')
            ->notEmptyString('uti_identifiant')
            ->add('uti_identifiant', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('uti_mot_de_passe')
            ->maxLength('uti_mot_de_passe', 100)
            ->requirePresence('uti_mot_de_passe', 'create')
            ->notEmptyString('uti_mot_de_passe');

        $validator
            ->scalar('uti_nom')
            ->maxLength('uti_nom', 100)
            ->requirePresence('uti_nom', 'create')
            ->notEmptyString('uti_nom');

        $validator
            ->scalar('uti_prenom')
            ->maxLength('uti_prenom', 100)
            ->requirePresence('uti_prenom', 'create')
            ->notEmptyString('uti_prenom');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['uti_identifiant']), ['errorField' => 'uti_identifiant']);

        return $rules;
    }

    public function getAllUtilisateurs()
    {
        $conn = ConnectionManager::get('default');
        $req = "
            SELECT
            uti_lien,
            uti_prenom,
            uti_nom
            FROM par_utilisateurs
            order by uti_prenom, uti_nom
        ";

        return $conn->execute($req)->fetchAll('assoc');
    }
}
