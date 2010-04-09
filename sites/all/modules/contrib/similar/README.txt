$Id: README.txt,v 1.6 2007/11/29 21:35:03 deekayen Exp $

DESCRIPTION:
------------

A module that displays a block with similar published nodes to the
currently viewed one, based on the title and body fields.

This module is for MySQL-based Drupal sites. It uses MySQL's
FULLTEXT indexing for MyISAM tables, and should automatically add
the index when you activate the module for the first time on a
Drupal site version 4.7.x or newer.

NOTE: If your node_revisions table is InnoDB, this module's install
file will convert your table to MyISAM. The FULLTEXT indexing
feature of MyISAM is not available for InnoDB (yet).

INSTALLATION
------------

Copy the similar directory to your modules directory.
(sites/all/modules/similar)

Activate the module in administer > Site building > Modules.
Turn on the similar block in administer > Site building > Blocks.

Configure the number of similar entries and specific node types
you want the block to search for at (default is 5):
   admin/build/block/configure/similar/0

Adjust your cache settings at admin/settings/similar.

BUG REPORTING
-------------

http://drupal.org/project/issues/similar

CONTRIBUTORS
------------
David Kent Norman http://deekayen.net/

Arnab Nandi http://arnab.org/