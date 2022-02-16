<?php

namespace App\Controller;

class PhotosController extends AppController
{

    public function initialize(): void
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->set(['item' => "photos"]);
    }

    public function index()
    {
        $this->loadModel('ParPhoto');
        $dossiers = $this->ParPhoto->getDossierparUtilisateur($this->Authentication->getIdentity()->get('uti_lien'));
        $this->set(['dossiers' => $dossiers]);
    }

    public function album(){

    }

}
