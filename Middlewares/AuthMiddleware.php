<?php

namespace App\Core\Middlewares;

use App\Core\Application;
use App\Core\Exception\ForbiddenExeption;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::$app->isGuest()) {
            // echo 'isGuest';
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                echo 'in_array';
                // throw new ForbiddenExeption();
                Application::$app->response->redirect('login');
            }
        }

        // if (Application::$app->isGuest() || in_array(Application::$app->controller->action, $this->actions)) {
        //     throw new ForbiddenExeption();
        //     Application::$app->response->redirect('/login');
        // }

    }
}
