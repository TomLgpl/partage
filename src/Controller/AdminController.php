<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Admin Controller
 *
 * @method \App\Model\Entity\Admin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        $this->isAuthorize();

        parent::beforeFilter($event); // TODO: Change the autogenerated stub
    }


    public function index()
    {

    }

    public function upload()
    {
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
            if ($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') {
                if (!empty($name)) {
                    if ($image->getSize() > 0 && $image->getError() == 0) {
                        if (!file_exists($targetPath)) {
                            $this->loadModel('ParPhoto');
                            $d = explode('-', $date);
                            $this->ParPhoto->insertPhoto($name, $d[0], $d[1], $d[2], $dossier, $this->Authentication->getIdentity()->get('uti_lien'));
                            $image->moveTo($targetPath);
                        }
                    }
                }
            }
            die;
        }
        return $this->redirect('/');
    }

    public function nbAAssigner()
    {
        if ($this->request->is('post')) {
            $this->loadModel("ParAssigner");
            $nb = $this->ParAssigner->getNbAAssigner();
            return $this->response->withStringBody($nb . "");
        }
        $this->redirect('/admin');
    }

    public function gePhotoInfoAAssigner()
    {
        $this->loadModel('ParAssigner');
        $photo = $this->ParAssigner->gePhotoInfoAAssigner();
        return $this->response->withType('json')->withStringBody(json_encode($photo));
    }

    private function isAuthorize()
    {
        if (!$this->Authentication->getIdentity()->get('uti_is_admin')) {
            $this->Flash->error(__('Vous n\'avez pas l\'autorisation de consulter cette page.'));
            return $this->redirect('/');
        }
    }

}
