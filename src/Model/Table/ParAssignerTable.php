<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParAssigner Model
 *
 * @method \App\Model\Entity\ParAssigner newEmptyEntity()
 * @method \App\Model\Entity\ParAssigner newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ParAssigner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ParAssigner get($primaryKey, $options = [])
 * @method \App\Model\Entity\ParAssigner findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ParAssigner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ParAssigner[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ParAssigner|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParAssigner saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ParAssigner[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParAssigner[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParAssigner[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ParAssigner[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ParAssignerTable extends Table
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

        $this->setTable('par_assigner');
        $this->setDisplayField(['ass_uti_lien', 'ass_pho_lien']);
        $this->setPrimaryKey(['ass_uti_lien', 'ass_pho_lien']);
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
            ->scalar('ass_uti_lien')
            ->maxLength('ass_uti_lien', 50)
            ->allowEmptyString('ass_uti_lien', null, 'create');

        $validator
            ->scalar('ass_pho_lien')
            ->maxLength('ass_pho_lien', 50)
            ->allowEmptyString('ass_pho_lien', null, 'create');

        return $validator;
    }

    public function getNbAAssigner()
    {
        $conn = ConnectionManager::get('default');
        $req = "
            SELECT count(pho_lien) as nb
            FROM par_photo
            WHERE pho_lien not in
            (
                SELECT DISTINCT ass_pho_lien
                FROM par_assigner
            )
        ";
        $res = $conn->execute($req)->fetch('assoc');

        return $res['nb'];
    }

    public function gePhotoInfoAAssigner()
    {
        $conn = ConnectionManager::get('default');
        $req = "
            SELECT
            pho_lien,
            pho_nom,
            pho_annee,
            pho_mois,
            pho_jour,
            pho_dossier,
            CONCAT(uti_prenom, ' ', uti_nom) as pho_ajouter_par,
            pho_ajouter_date
            FROM par_photo
            join par_utilisateurs on par_utilisateurs.uti_lien = par_photo.pho_ajouter_par
            WHERE pho_lien not in
            (
                SELECT DISTINCT ass_pho_lien
                FROM par_assigner
            )

            order by pho_annee, pho_mois, pho_jour,pho_dossier, pho_nom
            LIMIT 1
        ";
        $res = $conn->execute($req)->fetchAll('assoc');

        return $res;
    }

    public function assigner($pho_lien, $personne)
    {
        $conn = ConnectionManager::get('default');
        $req = "
            INSERT INTO par_assigner
            (
                ass_uti_lien,
                ass_pho_lien
            )
            VALUES
            (
                :uti_lien,
                :pho_lien
            )
        ";
        $param = [
            'uti_lien' => $personne,
            'pho_lien' => $pho_lien,
        ];
        $conn->execute($req, $param);
    }
}
