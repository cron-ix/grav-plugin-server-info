<?php
namespace Grav\Plugin;
use \Grav\Common\Plugin;
class ServerInfoPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onTwigExtensions' => ['onTwigExtensions', 0]
        ];
    }
    public function onTwigExtensions()
    {
        require_once(__DIR__ . '/twig/ServerInfoTwigExtension.php');
        $this->grav['twig']->twig->addExtension(new ServerInfoTwigExtension());
    }
}
