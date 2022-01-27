<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParConnexion Model
 *
 * @method \App\Model\Entity\ParConnexion newEmptyEntity()
 * @method \App\Model\Entity\ParConnexion newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ParConnexion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParConnexion get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParConnexion findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ParConnexion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParConnexion[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParConnexion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParConnexion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParConnexion[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParConnexion[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParConnexion[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParConnexion[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ParConnexionTable extends Table
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

        $this->setTable('par_connexion');
        $this->setDisplayField('con_utilisateur_lien');
        $this->setPrimaryKey('con_utilisateur_lien');
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
            ->scalar('con_utilisateur_lien')
            ->maxLength('con_utilisateur_lien', 50)
            ->allowEmptyString('con_utilisateur_lien', null, 'create');

        $validator
            ->dateTime('con_horodatage')
            ->notEmptyDateTime('con_horodatage');

        $validator
            ->scalar('con_ip')
            ->maxLength('con_ip', 50)
            ->requirePresence('con_ip', 'create')
            ->notEmptyString('con_ip');

        return $validator;
    }

    public function ajouter_connexion($uti_lien){
        $conn = ConnectionManager::get('default');
        $req = "
            insert into par_connexion
            (
                con_utilisateur_lien,
                con_horodatage,
                con_ip
            )
            values
            (
                :utilisateur_lien,
                CURRENT_TIMESTAMP,
                :ip
            )
        ";
        $param = array(
            'utilisateur_lien' => $uti_lien,
            'ip' => $_SERVER['REMOTE_ADDR']
        );
        $conn->execute($req, $param);
    }

}
