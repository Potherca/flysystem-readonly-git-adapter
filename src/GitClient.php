<?php

namespace Potherca\Flysystem\Adapter;

use Gitonomy\Git\Repository;

class GitClient
{
    /** @var Repository */
    private $repository;

    /** @var string */
    private $branch;
    /** @var string */
    private $url;
    /** @var string */
    private $remoteName = 'origin';

    /**
     * @param Repository $repository
     * @param string $url
     */
    final public function __construct(Repository $repository, $url)
    {
        $this->url = $url;
        $this->repository = $repository;
    }

    public function cloneRemote()
    {
        $this->parseUrl();

        $this->gitInit();
        $this->gitAddRemote();
        $this->gitPull();
    }

    private function parseUrl()
    {
        /* @TODO: Add implementation once URL definition has been decided */
    }

    private function gitInit()
    {
        return $this->repository->run('init');
    }

    private function gitAddRemote()
    {
        $arguments = [
            'add',
            $this->remoteName,
            $this->url
        ];

        return $this->repository->run('remote', $arguments);
    }

    private function gitPull()
    {
        $arguments = [
            $this->remoteName,
            $this->branch,
        ];

        return $this->repository->run('pull', $arguments);
    }
}