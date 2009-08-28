$Id:

Language Sections module for Drupal 5.x and 6.x
===============================================

Description:

Language Sections is a simple "input filter" module to allow text sections in several languages to be stored in a single text field.  One typical application is with the "Views" module with its header, footer and "not found" text fields.


Applications:

This module was originally produced with "Views" in mind. It may also be useful wherever "input filters" are supported but multi-language support is unavailable or limited.  For example, you could display "This page is only available in English" at the top of a node when the user's chosen language was not set to English.


Configuration:

Enable the module and activate it in one or more "Input Formats".  It should probably be the first or one of the first filters in the sequence, so set its "weight" to a low number.

Several advanced options are available in the "Configure" tab via admin/settings/filters. See the text
descriptions there for more information. 


Use:

Mark the start of "language sections" with === lc === where "lc" is an appropriate language code for the system.  No specific "end of section" marker is needed - any subsequent section is considered to mark the end of the preceding section. The pseudo language code "qq" is used to represent "no language" - sections marked with "qq" will be displayed for all languages.  Text before the first language section will also be displayed for all languages.

Here's an example - this is the text as entered:
---------------------
This text will be displayed for all languages.
=== es ===
Some Spanish text goes here.
=== en ===
Some English text goes here.
=== qq ===
This part will be displayed for all languages.  
---------------------

When language "en" is selected by the user, the above text will be filtered to become:
---------------------
This text will be displayed for all languages.
Some English text goes here.
This part will be displayed for all languages.  
---------------------

When language "es" is selected by the user, the above text will be filtered to become:
---------------------
This text will be displayed for all languages.
Some Spanish text goes here.
This part will be displayed for all languages.  
---------------------

Any number of language sections can be used, e.g:
=== es ===
Some Spanish
=== en ===
Some English
=== es ===
Some more Spanish
... and so on ...

Note: Although three = characters are shown in these examples, any number can be used, and there may be no space or more than one space around the language code.  i.e. the following are both valid:
=======   en   =======
=es=


Single line handling

A single line should also work, for example:
This is some =en= English =es= Spanish =qq= text.

Finally, language codes in the format aa-bb, such as en-uk, are also supported.

Notes:
If you use Language Sections in the body of a node, you probably need to set the node itself to "no language".


Technical notes:

The "trigger" for a language section can be described as the following sequence:

1. one or more '=' characters, then
2. zero or more spaces, then
3. a language code in the format nn or nn-mm, then
4. zero or more spaces, then
5. one or more '=' characters.

This trigger sequence was chosen so as to be easy to use and easily readable in its raw form, at the risk of false triggering should text happen to contain a sequence matching the trigger sequence.

The regular expression pattern used for matching can be edited (configuration setting).  Be careful not to change the number of parenthesised groups, as that would probably break the logic.


Contact:

Andy Inman - drupal_dev(at)netgenius(dot)co(dot)uk

