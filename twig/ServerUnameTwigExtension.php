<?php
namespace Grav\Plugin;
class ServerUnameTwigExtension extends \Twig_Extension
{
	public function getName()
	{
		return 'ServerUnameTwigExtension';
	}
	public function getFunctions()
	{
		return [
			new \Twig_SimpleFunction('serverUname', [$this, 'serverUnameFunction'])
		];
	}
	public function serverUnameFunction($arg)
	{
		$args = array('a', 's', 'n', 'r', 'v', 'm');
		$value = "Null";
		if (in_array($arg, $args)) {
			return php_uname($arg);
		}
		else {
			return "Fehler: kein Argument oder ungültiges Argument.";
		}
	}
}

