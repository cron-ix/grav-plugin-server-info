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
			new \Twig_SimpleFunction('serverUname', [$this, 'serverUnameFunction']),
                        new \Twig_SimpleFunction('serverMachine', [$this, 'serverMachineFunction']),
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
	public function serverMachineFunction()
        {
                $command = 'echo "$(cat /sys/devices/virtual/dmi/id/sys_vendor) $(cat /sys/devices/virtual/dmi/id/product_version)"';
                passthru($command, $output);
                return $output;
        }
}
