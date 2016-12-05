Koine AssetDownloader
-----------------

Downloads assets from a website

Code information:

[![Build Status](https://travis-ci.org/koinephp/AssetDownloader.png?branch=master)](https://travis-ci.org/koinephp/AssetDownloader)
[![Coverage Status](https://coveralls.io/repos/github/koinephp/AssetDownloader/badge.svg?branch=master)](https://coveralls.io/github/koinephp/AssetDownloader?branch=master)
[![Code Climate](https://codeclimate.com/github/koinephp/AssetDownloader/badges/gpa.svg)](https://codeclimate.com/github/koinephp/AssetDownloader)
[![Issue Count](https://codeclimate.com/github/koinephp/AssetDownloader/badges/issue_count.svg)](https://codeclimate.com/github/koinephp/AssetDownloader)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/koinephp/AssetDownloader/badges/quality-score.png)](https://scrutinizer-ci.com/g/koinephp/AssetDownloader/)
[![StyleCI](https://styleci.io/repos/55406012/shield)](https://styleci.io/repos/55406012)

Package information:

[![Latest Stable Version](https://poser.pugx.org/koine/asset-downloader/v/stable.svg)](https://packagist.org/packages/koine/asset-downloader)
[![Total Downloads](https://poser.pugx.org/koine/asset-downloader/downloads.svg)](https://packagist.org/packages/koine/asset-downloader)
[![Latest Unstable Version](https://poser.pugx.org/koine/asset-downloader/v/unstable.svg)](https://packagist.org/packages/koine/asset-downloader)
[![License](https://poser.pugx.org/koine/asset-downloader/license.svg)](https://packagist.org/packages/koine/asset-downloader)
[![Dependency Status](https://gemnasium.com/koinephp/AssetDownloader.png)](https://gemnasium.com/koinephp/AssetDownloader)


## Usage


```php
<?php

use Koine\AssetDownloader\AssetDownloader;
use Psr\Http\Message\UriInterface;

$assetDownloader = new AssetDownloader();
$assetDownloader
    ->from('https://example.com')
    ->to(realpath('./public'));

$downloader->download(new Uri('http://localhost/images/image-on-production-website.jpg'));
```

## Installing

```bash
composer require koine/asset-downloader
```

## Issues/Features proposals

[Here](https://github.com/koinephp/AssetDownloader/issues) is the issue tracker.

## License

[MIT](MIT-LICENSE)

## Authors

- [Marcelo Jacobus](https://github.com/koinephp)
