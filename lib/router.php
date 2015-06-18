<?php

require_once "RouterInterface.php";

class Router implements RouterInterface
{
    const DEFAULT_CONTROLLER = "Home";
    const DEFAULT_ACTION     = "index";

    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;

    public function __construct(array $options = array()) {
        $this->parseUri();
    }

    protected function parseUri() {

        $action = isset($_GET['action'])?$_GET['action']:self::DEFAULT_ACTION;
        $controller = isset($_GET['controller'])?$_GET['controller']: self::DEFAULT_CONTROLLER;

        $controller = $controller;

        if (isset($controller)) {
            $this->setController($controller);
        }
        if (isset($action)) {
            $this->setAction($action);
        }
    }

    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . "Controller";


        if (!class_exists($controller)) {
            throw new \InvalidArgumentException(
                "The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
        return $this;
    }

    public function setAction($action) {
        if(count($_POST) > 0){
            $action = "post".ucfirst( strtolower($action) );
        }

        $reflector = new \ReflectionClass($this->controller);

        if (!$reflector->hasMethod($action)) {
            throw new \InvalidArgumentException(
                "The controller action '$action' has been not defined.");
        }
        $this->action = $action;
        return $this;
    }

    public function run() {
        call_user_func_array(
            array(
                new $this->controller, $this->action
            ), []
        );
    }
}