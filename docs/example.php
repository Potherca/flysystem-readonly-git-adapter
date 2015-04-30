<?php

use Gitonomy\Git\Repository;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Potherca\Flysystem\Git\LocalAdapterGitDecorator;

/* Git Adapter Specific Code */
$root = '/path/to/repo'
$gitUrl = 'https://github.com/gitonomy/gitlib.git';
$repository = Gitonomy\Git\Admin::cloneTo($root, $gitUrl, false); /*false = non-bare repo*/

/* Generic Adapter/FlySystem Code */
$adapter = new Local($root);
$repository = new Repository($root, $repositoryOptions);
$decoratedAdapter = new LocalAdapterGitDecorator($adapter, $repository);
$filesystem = new Filesystem($decoratedAdapter);

// Use the Flysystem as you normally would.

/*EOF*/
