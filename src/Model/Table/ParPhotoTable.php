<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Utility\Uuid;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParPhoto Model
 *
 * @method \App\Model\Entity\ParPhoto newEmptyEntity()
 * @method \App\Model\Entity\ParPhoto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ParPhoto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParPhoto get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParPhoto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ParPhoto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParPhoto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParPhoto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParPhoto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParPhoto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParPhoto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParPhoto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParPhoto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ParPhotoTable extends Table
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

        $this->setTable('par_photo');
        $this->setDisplayField('pho_lien');
        $this->setPrimaryKey('pho_lien');
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
            ->scalar('pho_lien')
            ->maxLength('pho_lien', 50)
            ->allowEmptyString('pho_lien', null, 'create');

        $validator
            ->scalar('pho_nom')
            ->maxLength('pho_nom', 100)
            ->requirePresence('pho_nom', 'create')
            ->notEmptyString('pho_nom');

        $validator
            ->integer('pho_annee')
            ->requirePresence('pho_annee', 'create')
            ->notEmptyString('pho_annee');

        $validator
            ->integer('pho_mois')
            ->requirePresence('pho_mois', 'create')
            ->notEmptyString('pho_mois');

        $validator
            ->integer('pho_jour')
            ->requirePresence('pho_jour', 'create')
            ->notEmptyString('pho_jour');

        return $validator;
    }

    public function insertPhoto($nom, $annee, $mois, $jour, $dossier){
        $conn = ConnectionManager::get('default');
        $req = "
            insert into par_photo
            (
                pho_lien,
                pho_nom,
                pho_annee,
                pho_mois,
                pho_jour,
                pho_dossier
            )
            values
            (
                :lien,
                :nom,
                :annee,
                :mois,
                :jour,
                :dossier
            )
        ";
        $param = array(
            'lien' => Uuid::gen_uuid(),
            'nom' => $nom,
            'annee' => $annee,
            'mois' => $mois,
            'jour' => $jour,
            'dossier' => $dossier
        );
        $conn->execute($req, $param);
    }

}
