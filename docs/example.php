<?php

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Potherca\Flysystem\Git\LocalAdapterGitDecorator;
use Potherca\Flysystem\Adapter\CloneRemoteGitToLocal;

/* Git Adapter Specific Code */
$root = '/path/to/repo'
$gitUrl = 'https://github.com/gitonomy/gitlib.git';

/*
    Gitonomy and other git-libs all to be simple (or complex) wrapper around
    commands fed to the Symfony Command class. Seems simpler to just make the
    call to Command ourselves.

    _Maybe_ we could use the Git class from Composer (to help with URL and AUTH)
    https://github.com/composer/composer/blob/HEAD/src/Composer/Util/Git.php

    Otherwise we need to parse the URL and do AUTH ourselves.

    Regardless it seems wise to create a "client" class that does the actual
    connecting, similar to other Adapters (to keep the API familiar for devs).
*/

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
