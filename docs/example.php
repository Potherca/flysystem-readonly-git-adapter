<?php

use Gitonomy\Git\Repository;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Potherca\Flysystem\Git\LocalAdapterGitDecorator;
use Potherca\Flysystem\Adapter\CloneRemoteGitToLocal;

/* Git Adapter Specific Code */
$root = '/path/to/repo'
$gitUrl = 'https://github.com/gitonomy/gitlib.git';

/* Generic Adapter/FlySystem Code */
// =============================================================================
$adapter = new Local($root);
$decoratedAdapter = new LocalAdapterGitDecorator($adapter, $gitUrl);
$filesystem = new Filesystem($decoratedAdapter);

// -----------------------------------------------------------------------------
//                                  OR
// -----------------------------------------------------------------------------
$adapter = new CloneRemoteGitToLocal($root, $gitUrl);
$filesystem = new Filesystem($adapter);
// =============================================================================

// Use the Flysystem as you normally would.

/*EOF*/
