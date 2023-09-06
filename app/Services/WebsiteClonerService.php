<?php

namespace App\Services;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class WebsiteClonerService
{
    private $output_dir;

    public function __construct($output_dir)
    {
        $this->output_dir = $output_dir;
    }

    public function clone($targetUrl): void
    {
        $response = (new Client())->get($targetUrl);

        if (
            $response->getStatusCode() < 200
            || $response->getStatusCode() >= 300
        ) {
            throw new \Exception('Failed to clone website');
        }

        $html = (string) $response->getBody();
        $crawler = new Crawler($html);

        if (!is_dir($this->output_dir)) {
            mkdir($this->output_dir, 0755, true);
        }

        parse_url($targetUrl, PHP_URL_SCHEME) . '://' . parse_url($targetUrl, PHP_URL_HOST);

        $crawler->filter('link[rel="stylesheet"], script[src], img[src]')
            ->each(function ($node) use (&$html) {
                $url = $node->attr('href') ?: $node->attr('src');
                $path = parse_url($url, PHP_URL_PATH);
                $filename = $this->output_dir . $path;
                $contents = file_get_contents($url);

                if (!is_dir(dirname($filename))) {
                    mkdir(dirname($filename), 0755, true);
                }

                file_put_contents($filename, $contents);

                $localPath = '.' . $path;
                $html = str_replace($url, $localPath, $html);
            });

        file_put_contents($this->output_dir . '/index.html', $html);
    }
}
