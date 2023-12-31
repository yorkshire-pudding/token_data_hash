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
The Token Data Hash module will read a value the has variable the URL query and
interpret it as a comma sperated list of values after decoding it in the
assigned manner.

Security Warning: If you are able to use a hash with no data in it as a unique
identifyer which expires you should do that instead. It is much more secure
then having the information stored in the URL encrypted or otherwise. This
module is for those cases when you have to reference information on an external
system which drupal can not interface with.

INSTALLATION
------------
* Install as you would normally install a contributed drupal module.
* A configuration page can be found at `/admin/config/development/token_data_hash`

USAGE
-------------
Let's say you want to provide users to a link that will allow them to
unsubscribe from a mailing list. You want that page to display their name
and email address, and you need to know an identifier that is stored
in an external system, so you include their id number.

For your user Jon Doe with uid 1234 you would start with a string similar to:
1234,Jon Doe,jdoe@example.com

You would then encode it into base 64:
MTIzNCxKb24gRG9lLGpkb2VAZXhhbXBsZS5jb20=
and send the user a link that looks like this:
http://example.com/unsubscribe?hash=MTIzNCxKb24gRG9lLGpkb2VAZXhhbXBsZS5jb20=

The parameter name along with a tool to generated encoded strings can be found at `/admin/config/development/token_data_hash`

On the form you could then use tokens to fill in the default values
of the fields with the following strings:

* Id number: [hashes:base64:value:0]
* Name: [hashes:base64:value:1]
* Email: [hashes:base64:value:2]

Using the same example this information can also be encrypted with the passphrase `key`:
* Id number: [hashes:open_ssl:key:value:0]
* Name: [hashes:open_ssl:key:value:1]
* Email: [hashes:open_ssl:key:value:2]

The types of encoding currently supported are:
* base64: The string treated as a plain text base64 string
* open_ssl: The string is decoded from base64. The string is then decrypted using
openssl aes-256-ecb.

TROUBLESHOOTING
---------------
* As soon as I start running into trouble with it I will start shooting it

FAQ
---
Q: Why aren't there more FAQ
A: No one has frequently asked me questions about this yet.

MAINTAINERS
-----------
Current maintainers:
* Bryan Heisler (geekygnr) - https://drupal.org/user/2775199
Written on behalf of the University of Waterloo - Department of Advancment
https://uwaterloo.ca/support/
