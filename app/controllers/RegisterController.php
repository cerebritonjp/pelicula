<?php

/**
 * SessionController
 *
 * Allows to register new users
 */
class RegisterController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Iniciar sesión/Registrarse');
        parent::initialize();
    }

    /**
     * Action to register a new user
     */
    public function indexAction()
    {
        $form = new RegisterForm;

        if ($this->request->isPost()) {

            $name = $this->request->getPost('name', ['string', 'striptags']);
            $username = $this->request->getPost('username', 'alphanum');
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');

            if ($password != $repeatPassword) {
                $this->flash->error('No coinciden las claves');
                return false;
            }

            $user = new Users();
            $user->username = $username;
            $user->password = sha1($password);
            $user->name = $name;
            $user->email = $email;
            $user->created_at = new Phalcon\Db\RawValue('now()');
            $user->active = 'Y';
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->tag->setDefault('email', '');
                $this->tag->setDefault('password', '');
                $this->flash->success('Gracias por registrarse');

                return $this->dispatcher->forward(
                    [
                        "controller" => "session",
                        "action"     => "index",
                    ]
                );
            }
        }

        $this->view->form = $form;
    }
}
