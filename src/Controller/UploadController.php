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
            $image = $this->request->getData('photo');
            $name = $image->getClientFileName();
            $type = $image->getClientMediaType();
            $targetPath = WWW_ROOT . 'img' . DS . 'upload' . DS . $name;
            if ($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') {
                if (!empty($name)) {
                    if ($image->getSize() > 0 && $image->getError() == 0) {
                        $image->moveTo($targetPath);                    }
                }
            }
        }

        $this->redirect('/admin');
    }
}
