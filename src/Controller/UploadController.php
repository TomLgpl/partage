<?php
declare(strict_types=1);

namespace App\Controller;

class UploadController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    public function index()
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
                        if(!file_exists($targetPath)){
                            $this->loadModel('ParPhoto');
                            $this->ParPhoto->insertPhoto($name, explode('-', $date)[0], explode('-', $date)[1], explode('-', $date)[2], $dossier);
                            $image->moveTo($targetPath);
                        }
                    }
                }
            }
        }
        die;
    }

}
