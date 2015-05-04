<?php

namespace Potherca\Flysystem;

use Gitonomy\Git\Repository;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Potherca\Flysystem\Decorator\LocalAdapterGitDecorator;
use Potherca\Flysystem\Adapter\CloneRemoteGitToLocal;
use Potherca\Flysystem\Adapter\GitClient;

/* Git Adapter Specific Code */
$root = '/path/to/repo';
$gitUrl = 'https://github.com/gitonomy/gitlib.git';

/*
    Using Gitonomy seems better than "doing it ourselves" as it takes other
    settings and environments into account. It would mean the difference between
    "works" and "works for me"

    Also it seems wise to create a "client" class that does the actual
    connecting, similar to other Adapters (to keep the API familiar for developers).
*/

$repository = new Repository($root);
$client = new GitClient($repository, $gitUrl);
// =============================================================================
$adapter = new Local($root);
$decoratedAdapter = new LocalAdapterGitDecorator($adapter, $client);
$filesystem = new Filesystem($decoratedAdapter);
// -----------------------------------------------------------------------------
//                                  OR
// -----------------------------------------------------------------------------
$adapter = new CloneRemoteGitToLocal($root, $client);
$filesystem = new Filesystem($adapter);
// =============================================================================

// Use the Flysystem as you normally would.
$file = '/composer.json';
if ($filesystem->has($file)) {
    $contents = $filesystem->read($file);
} else {
    $contents = 'No composer.json present.';
}

echo $contents;

/*EOF*/
