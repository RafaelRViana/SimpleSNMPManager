:: INSTALA��O ::

Pr�-requisitos:
-PHP
-Servidor de aplica��o, ex: Apache
-Biblioteca php-snmp instalada
OBS: Caso, seja um servidor Ubuntu a biblioteca pode ser instalada atrav�s do comando: apt-get install php5-snmp

Instala��o:
Descompactar arquivo na pasta html do Apache.

:: M�todos SNMP ::
CPU:
VALUE hrProcessorLoad OBJECT-TYPE (
  Syntax: [UNIVERSAL 2] INTEGER (0..100)
  Access: read-only
  Status: current
  Description: The average, over the last minute, of the percentage
               of time that this processor was not idle.
               Implementations may approximate this one minute
               smoothing period if necessary.
)
    ::= 1.3.6.1.2.1.25.3.3.1.2

Mem�ria:
VALUE hrStorageUsed OBJECT-TYPE (
  Syntax: [UNIVERSAL 2] INTEGER (0..2147483647)
  Access: read-only
  Status: current
  Description: The amount of the storage represented by this entry
               that is allocated, in units of
               hrStorageAllocationUnits.
)
    ::= 1.3.6.1.2.1.25.2.3.1.6

OBS: Esse valor � de mem�ria ALOCADA. Os resultados retornado pelo SNMP, coincidem com os obtidos pelo comando top, por�m s�o diferentes do comando htop.

Tr�fego Rede:
VALUE ifInOctets OBJECT-TYPE (
  Syntax: [APPLICATION 1] INTEGER (0..4294967295)
  Access: read-only
  Status: mandatory
  Description: The total number of octets received on the
               interface, including framing characters.
)
    ::= 1.3.6.1.2.1.2.2.1.10

VALUE ifOutOctets OBJECT-TYPE (
  Syntax: [APPLICATION 1] INTEGER (0..4294967295)
  Access: read-only
  Status: mandatory
  Description: The total number of octets transmitted out of the
               interface, including framing characters.
)
    ::= 1.3.6.1.2.1.2.2.1.16

N�mero de processos:
VALUE hrSystemProcesses OBJECT-TYPE (
  Syntax: [APPLICATION 2] INTEGER (0..4294967295)
  Access: read-only
  Status: current
  Description: The VALUE hrSystemProcesses OBJECT-TYPE (
  Syntax: [APPLICATION 2] INTEGER (0..4294967295)
  Access: read-only
  Status: current
  Description: The number of process contexts currently loaded or
               running on this system.
)
    ::= 1.3.6.1.2.1.25.1.6
