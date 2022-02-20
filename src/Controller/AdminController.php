<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utility\Resizer;
use Cake\Cache\Cache;
use Cake\Event\EventInterface;

/**
 * Admin Controller
 *
 * @method \App\Model\Entity\Admin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminController extends AppController
{

    public function initialize(): void
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->set(['item' => "admin"]);
    }


    public function index()
    {
        $this->isAuthorize();
        $this->loadModel("ParUtilisateurs");
        $personne = $this->ParUtilisateurs->getAllUtilisateurs();
        $this->set(['personnes' => $personne]);
    }

    public function upload()
    {
        $this->isAuthorize();
        if ($this->request->is('post')) {
            //on vérifie que les dossiers existent bien
            $targetPath = WWW_ROOT . 'img' . DS . 'upload';
            $date = $this->request->getData('date');
            $dossier = $this->request->getData('dir');
            foreach (explode('-', $date) as $dir) {
                $targetPath .= DS . $dir;
                if (!is_dir($targetPath)) {
                    mkdir($targetPath);
                }
            }
            $targetPath .= DS . str_replace(' ', '_', $dossier);
            if (!is_dir($targetPath)) {
                mkdir($targetPath);
            }

            $image = $this->request->getData('photo');
            $name = $image->getClientFileName();
            $type = $image->getClientMediaType();
            $targetPath .= DS . $name;
            if (!empty($name)) {
                if ($image->getSize() > 0 && $image->getError() == 0) {
                    if (!file_exists($targetPath)) {
                        $this->loadModel('ParPhoto');
                        $d = explode('-', $date);
                        $this->ParPhoto->insertPhoto($name, $d[0], $d[1], $d[2], $dossier, $this->Authentication->getIdentity()->get('uti_lien'));
                        $image->moveTo($targetPath);
                        Resizer::resizeImage($name, $d[2], $d[1], $d[0], $dossier);
                    }
                }
            }
            die;
        }
        return $this->redirect('/');
    }

    public function nbAAssigner()
    {
        $this->isAuthorize();
        if ($this->request->is('post')) {
            $this->loadModel("ParAssigner");
            $nb = $this->ParAssigner->getNbAAssigner();
            return $this->response->withStringBody($nb . "");
        }
        $this->redirect('/admin');
    }

    public function gePhotoInfoAAssigner()
    {
        $this->isAuthorize();
        $this->loadModel('ParAssigner');
        $photo = $this->ParAssigner->gePhotoInfoAAssigner();
        return $this->response->withType('json')->withStringBody(json_encode($photo));
    }

    public function assigner()
    {
        $this->isAuthorize();
        if ($this->request->is('post')) {
            $this->loadModel("ParAssigner");
            $personnes = explode(",", $this->request->getData("personnes"));
            $pho_lien = $this->request->getData("photo");
            pr($personnes);
            if (!empty($personnes[0]) && !empty($pho_lien)) {
                foreach ($personnes as $personne) {
                    $this->ParAssigner->assigner($pho_lien, $personne);
                }
            }
            die;
        }
        return $this->redirect('/admin');
    }

    public function ajouterUtilisateur()
    {
        $this->isAuthorize();
        if($this->request->is('post')) {
            $this->loadModel('ParUtilisateurs');
            $identifiant = $this->request->getData('identifiant');
            $prenom = $this->request->getData('prenom');
            $nom = $this->request->getData('nom');
            $mdp = $this->request->getData('motdepasse');
            $this->ParUtilisateurs->ajouterUtilisateur($identifiant, $prenom, $nom, $mdp);
            die();
        }
        return $this->redirect('/admin');
    }

    private function isAuthorize()
    {
        if (!$this->Authentication->getIdentity()->get('uti_is_admin')) {
            $this->Flash->error(__('Vous n\'avez pas l\'autorisation de consulter cette page.'));
            return $this->redirect('/');
        }
    }

}
