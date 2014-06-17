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

See http://www.php.net/manual/en/function.base64-decode.php

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
Let's say you want to provide users to a link that will allow them to unsubscribe from a mailing list. You want that page to display their name and email address and you don't want to bother them with the hassle of logging in so you need to know their user id as well.

For your user Jon Doe with uid 1234 you would start with a string similar to:
1234,Jon Doe,jdoe@example.com
You would then encode it into base 64:
MTIzNCxKb24gRG9lLGpkb2VAZXhhbXBsZS5jb20=
and send the user a link that looks like this:
http://example.com/unsubscribe?user=MTIzNCxKb24gRG9lLGpkb2VAZXhhbXBsZS5jb20=

On the form you could then use tokens to fill in the default values of the fields with the following strings:
User id: [current-page:hash:user:value:0]
Name: [current-page:hash:user:value:1]
Email: [current-page:hash:user:value:2]

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
