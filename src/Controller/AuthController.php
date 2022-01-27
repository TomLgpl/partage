<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Auth Controller
 *
 * @method \App\Model\Entity\Auth[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AuthController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('auth');
        $result = $this->Authentication->getResult();
        // Si l'utilisateur est connecté, le renvoyer ailleurs

        if ($result->isValid()) {
            $this->loadModel('ParConnexion');
            $this->ParConnexion->ajouter_connexion($this->Authentication->getIdentity()->get('uti_lien'));
            $target = $this->Authentication->getLoginRedirect() ?? '/';

            return $this->redirect($target);
        }
        if ($this->request->is('post') && empty($this->request->getData('uti_identifiant'))) {
            $this->Flash->error(__('Veuillez saisir un identifiant.'));
        } elseif ($this->request->is('post') && empty($this->request->getData('uti_mot_de_passe'))) {
            $this->Flash->error(__('Veuillez saisir un mot de passe'));
        } elseif ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Identifiant ou mot de passe invalide'));
        }
    }

    public function logout()
    {
        $this->Authentication->logout();

        return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
    }
}
