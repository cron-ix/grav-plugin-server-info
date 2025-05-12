<?php
namespace Grav\Plugin;
class ServerInfoTwigExtension extends \Twig_Extension
{
	public function getName()
	{
		return 'ServerInfoTwigExtension';
	}
	public function getFunctions()
	{
		return [
			new \Twig_SimpleFunction('serverUname', [$this, 'serverUnameFunction']),
                        new \Twig_SimpleFunction('serverMachine', [$this, 'serverMachineFunction']),
			new \Twig_SimpleFunction('serverCPU', [$this, 'serverCPUFunction']),
			new \Twig_SimpleFunction('serverMemTotal', [$this, 'serverMemTotalFunction']),
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
	public function serverCPUFunction()
        {
                $command = "cat /proc/cpuinfo | grep 'model name' | uniq | awk -F ':' '{print $2}'";
                passthru($command, $output);
                return $output;
        }
	public function serverMemTotalFunction()
        {
                $command = "cat /proc/meminfo | grep MemTotal | awk -F ':' '{print $2}' | xargs";
                passthru($command, $output);
                return $output;
        }
}
