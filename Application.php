<?php

namespace Astcode\Core;

use App\Models\User;

use Astcode\Core\Request;
use Astcode\Core\DB\DbModel;
use Astcode\Core\DB\Database;

// namespace App\Application;
/**
 * @author Aaron Thomas <aaron@aaronsthomas.com>
 * @package Astcode\Core
 */
class Application
{
    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterRequest';

    protected array $eventListeners = [];

    public static Application $app;
    public static string $ROOT_DIR;
    public string $userClass;
    public string $layout = 'main';
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?UserModel $user;
    public View $view;

    public ?Controller $controller = null;

    public function __construct($rootPath, $config)
    {
        if (isset($config['userClass'])) {
            $this->userClass = $config['userClass'];
        }
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db = new Database($config['db']);

        $primaryKeyValue = (string) $this->session->get('user');
        if($primaryKeyValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryKeyValue]);
        } else {
            $this->user = null;            
        }
    }

    public function run()
    {
        $this->triggerEvent(self::EVENT_BEFORE_REQUEST);
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('exceptions/_error', [
                'exception' => $e
            ]);
        }
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryKeyValue = $user->{$primaryKey};
        $this->session->set('user', $primaryKeyValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function on($eventName, $callback)
    {
        $this->eventListeners[$eventName][] = $callback;
    }

    public function triggerEvent($eventName)
    {
        $callbacks = $this->eventListeners[$eventName] ?? [];
        foreach ($callbacks as $callback) {
            call_user_func($callback);
        }
    }


}
