<?php

namespace KoineTest\AssetDownloader;

use GuzzleHttp\Client;
use Koine\AssetDownloader\AssetDownloader;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use PHPUnit_Framework_TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class AssetDownloaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var AssetDownloader
     */
    protected $downloader;

    /**
     * @var Filesystem | ObjectProphecy
     */
    protected $fileSystem;

    /**
     * @var httpClient | ObjectProphecy
     */
    protected $httpClient;

    /**
     * @before
     */
    public function initialize()
    {
        $this->httpClient = $this->prophesize(Client::class);
        $this->fileSystem = $this->prophesize(Filesystem::class);

        $this->downloader = new AssetDownloader([
            'httpClient' => $this->httpClient->reveal(),
            'fileSystem' => $this->fileSystem->reveal(),
            'from'       => 'https://foo.com/',
        ]);
    }

    /**
     * @test
     */
    public function canDownloadAndWriteToFilesystem()
    {
        $path = '/dir1/dir2/file.jpg';
        $contents = 'foo';
        $source = 'https://foo.com/dir1/dir2/file.jpg';

        $uri = $this->prophesize(UriInterface::class);
        $uri->getPath()->willReturn($path);

        $response = $this->prophesize(ResponseInterface::class);
        $response->getBody()->willReturn($contents);

        $this->httpClient->request('GET', $source)
            ->willReturn($response->reveal());

        $this->fileSystem->write($path, $contents)
            ->shouldBeCalled();

        $this->downloader->download($uri->reveal());
    }

    /**
     * @test
     */
    public function canModifyDestination()
    {
        $expected = new AssetDownloader([
            'fileSystem' => new Filesystem(new Local('/tmp')),
        ]);

        $actual = new AssetDownloader(['destination' => '/tmp']);

        $this->assertEquals($expected, $actual);
    }
}
