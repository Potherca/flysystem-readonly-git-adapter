<?php

namespace Potherca\Flysystem\Adapter;

use League\Flysystem\Adapter\Local;

class CloneRemoteGitToLocal extends Local
{
    /** @var bool */
    private $cloned = false;
    /** @var GitClient */
    private $client;


    /**
     * @param string $root
     * @param GitClient $client
     */
    final public function __construct($root, GitClient $client)
    {
        $this->client = $client;

        parent::__construct($root);
    }

    /**
     * @param string $path
     *
     * @return array|bool|false
     */
    public function read($path)
    {
        if ($this->cloned == false) {
            $this->client->cloneRemote();
            $this->cloned = true;
        }

        return parent::read($path);
    }

}