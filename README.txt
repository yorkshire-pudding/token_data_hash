CONTENTS OF THIS FILE
---------------------
* Introduction
* Requirements
* Installation
* Usage
* Troubleshooting
* FAQ
* Maintainers

INTRODUCTION
------------
The Token Data Hash module will read a value from the URL query and
interpret it as a comma sperated list of values after running base64_decode()
on the string.

See http://www.php.net//manual/en/function.base64-decode.php

REQUIREMENTS
------------
Drupal 7 core and the tokens module.

INSTALLATION
------------
* Install as you would normally install a contributed drupal module. See:
  https://drupal.org/documentation/install/modules-themes/modules-7
  for further information.

USEAGE
-------------
Once installed the token will be found under the 'current-page' type. It requires the field
name of the hash be sent.

TROUBLESHOOTING
---------------
* As soon as I start running into trouble with it I will start shooting it
FAQ
---
Q: Why aren't there any FAQ
A: No one has frequently asked me questions about this yet.

MAINTAINERS
-----------
Current maintainers:
* Bryan Heisler (geekygnr) - https://drupal.org/user/2775199
Written on behalf of the University of Waterloo - Department of Advancment - http://uwaterloo.ca/support
