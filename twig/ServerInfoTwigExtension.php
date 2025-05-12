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
			new \Twig_SimpleFunction('serverCpuTemp', [$this, 'serverCpuTempFunction']),
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
                $command = "cat /proc/cpuinfo | grep 'model name' | uniq | awk -F: '{print $2}' | xargs";
                passthru($command, $output);
                return $output;
        }
	public function serverMemTotalFunction()
        {
                $command = "cat /proc/meminfo | grep MemTotal | awk -F: '{print $2}' | xargs";
                passthru($command, $output);
                return $output;
        }
        public function serverCpuTempFunction()
        {
                // Raspberry Pi
                // $sensor_path = '/sys/class/thermal/thermal_zone0/temp';
                // ThinkCentre
                $sensor_path = '/sys/class/thermal/thermal_zone8/temp';

                // read content
                $sensor_value = @file_get_contents($sensor_path);
                // error handling
                // file not found or NULL
                if ($sensor_value === FALSE) {
                                $return_value = sprintf('Temperature sensor not found at "%1$s", see "README.md" (%2$s) for further information.', $sensor_path, $readme_url);
                }
                // return value is > 0
                // ToDo: can core temp be lower than 0 (extreme cooling scenarios)?
                elseif (intval("$sensor_value") > 0) {
                                $return_value = number_format($sensor_value/1000, 1, ',', '.') . " °C";
                }
                // value is not numeric or 0 and lower
                else {
                                $return_value = sprintf('No temperature found at "%1$s".', $sensor_path);
                }

                return $return_value;
        }
}
