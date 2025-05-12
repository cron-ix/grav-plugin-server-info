# grav-plugin-server-info

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
