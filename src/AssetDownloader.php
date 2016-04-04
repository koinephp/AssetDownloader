<?php

namespace Koine\AssetDownloader;

use GuzzleHttp\Client;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Http\Message\UriInterface;

class AssetDownloader
{
    /**
     * @var string
     */
    private $from;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @param array $config
     *                      Allowed keys:
     *                      - from type: Sting
     *                      - destination type: Sting
     *                      - httpClient type: @see Client
     */
    public function __construct(array $config = [])
    {
        if (isset($config['fileSystem'])) {
            $this->setFilesystem($config['fileSystem']);
        }

        if (!isset($config['httpClient'])) {
            $config['httpClient'] = new Client();
        }

        if (isset($config['from'])) {
            $this->from($config['from']);
        }

        if (isset($config['destination'])) {
            $this->to($config['destination']);
        }

        $this->setHttpClient($config['httpClient']);
    }

    public function download(UriInterface $uri)
    {
        $path = $uri->getPath();
        $source = $this->from . $path;
        $contents = $this->httpClient->request('GET', $source)->getBody();
        $this->getFilesystem()->write($path, $contents);
    }

    /**
     * @param string $from
     *
     * @return self
     */
    public function from($from)
    {
        $this->from = rtrim($from, '/');

        return $this;
    }

    /**
     * @param string $to path to save the assets
     *
     * @return self
     */
    public function to($to)
    {
        $filesystem = new Filesystem(new Local($to));
        $this->setFilesystem($filesystem);

        return $this;
    }

    private function getFilesystem()
    {
        if ($this->fileSystem === null) {
            throw new \LocalException('Destination was not set');
        }

        return $this->fileSystem;
    }

    private function setHttpClient(Client $client)
    {
        $this->httpClient = $client;
    }

    private function setFilesystem(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }
}
