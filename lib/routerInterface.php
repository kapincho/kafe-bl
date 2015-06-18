<?php

interface RouterInterface
{
    public function setController($controller);

    public function setAction($action);

    public function run();
}