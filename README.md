# grav-plugin-server-info

## installation

- go to your GRAV instance `/user/plugins` and clone `git clone https://github.com/cron-ix/grav-plugin-server-info ./server-info/`

## usage

Returns informations about the server:

- code: `{{ serverUname('a') }}` with parameter
  - `a`: all information
  - `s`: Operating system name. eg. FreeBSD.
  - `n`: Host name. eg. localhost.example.com.
  - `r`: Release name. eg. 5.1.2-RELEASE.
  - `v`: Version information. Varies a lot between operating systems.
  - `m`: Machine type. eg. i386.
- short code: `{{ serverMachine() }}` to get the machine model
- short code: `{{ serverCPU() }}`  to get the cpu model name
- short code: `{{ serverMemTotal() }}` to get the total amount of physical RAM
- short code: `{{ serverCpuTemp() }}` to get the actuale CPU core temp
