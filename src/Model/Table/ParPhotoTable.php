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

    public function insertPhoto($nom, $annee, $mois, $jour, $dossier, $uti_lien){
        $conn = ConnectionManager::get('default');
        $req = "
            insert into par_photo
            (
                pho_lien,
                pho_nom,
                pho_annee,
                pho_mois,
                pho_jour,
                pho_dossier,
                pho_ajouter_par,
                pho_ajouter_date
            )
            values
            (
                :lien,
                :nom,
                :annee,
                :mois,
                :jour,
                :dossier,
                :uti_lien,
                NULL
            )
        ";
        $param = array(
            'lien' => Uuid::gen_uuid(),
            'nom' => $nom,
            'annee' => $annee,
            'mois' => $mois,
            'jour' => $jour,
            'dossier' => $dossier,
            'uti_lien' => $uti_lien
        );
        $conn->execute($req, $param);
    }

    public function getDossierparUtilisateur($uti_lien){
        $conn = ConnectionManager::get('default');

        $req = "
            SELECT
            min(pho_nom) as pho_nom,
            CONCAT(pho_dossier, '-', pho_jour, '-', pho_mois, '-', pho_annee) as dossier_lien,
            pho_dossier,
            pho_jour,
            pho_mois,
            pho_annee
            FROM par_photo
            JOIN par_assigner on par_assigner.ass_pho_lien = par_photo.pho_lien
            where ass_uti_lien = :uti_lien
            GROUP BY (dossier_lien)
            order by pho_annee desc, pho_mois desc, pho_jour desc
        ";
        $param = array(
          "uti_lien" => $uti_lien
        );
        $res = $conn->execute($req, $param)->fetchAll('assoc');
        return $res;
    }

    public function getNbPhotoInAlbumByUti($dossier_lien, $uti_lien){
        $conn = ConnectionManager::get('default');
        $req = "
            SELECT count(pho_lien) as nb
            FROM par_photo
            JOIN par_assigner on par_assigner.ass_pho_lien = par_photo.pho_lien
            where ass_uti_lien = :uti_lien and CONCAT(pho_dossier, '-', pho_jour, '-', pho_mois, '-', pho_annee) = :dossier_lien
        ";
        $param = array(
            "uti_lien" => $uti_lien,
            "dossier_lien" => $dossier_lien
        );
        $res = $conn->execute($req, $param)->fetch('assoc');
        return $res['nb'];
    }

    public function getPhotosInAlbumByUti($dossier_lien, $uti_lien){
        $conn = ConnectionManager::get('default');
        $req = "
            SELECT
            pho_nom,
            pho_lien
            FROM par_photo
            JOIN par_assigner on par_assigner.ass_pho_lien = par_photo.pho_lien
            where ass_uti_lien = :uti_lien and CONCAT(pho_dossier, '-', pho_jour, '-', pho_mois, '-', pho_annee) = :dossier_lien
            order by pho_nom
        ";
        $param = array(
            "uti_lien" => $uti_lien,
            "dossier_lien" => $dossier_lien
        );
        $res = $conn->execute($req, $param)->fetchAll('assoc');
        return $res;
    }

    public function getPhotoInfos($pho_lien){
        $conn = ConnectionManager::get('default');
        $req = "
            SELECT
            pho_nom,
            pho_annee,
            pho_mois,
            pho_jour,
            pho_dossier
            FROM par_photo
            WHERE pho_lien = :pho_lien
        ";
        $param = array(
            "pho_lien" => $pho_lien
        );
        $res = $conn->execute($req, $param)->fetch("assoc");
        return $res;
    }

}
