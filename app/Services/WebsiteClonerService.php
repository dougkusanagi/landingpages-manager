<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class WebsiteClonerService
{
    private $output_dir;
    private $targetUrl;

    public function __construct($output_dir)
    {
        $this->output_dir = $output_dir;
    }

    public function clone($targetUrl): void
    {
        $this->targetUrl = $targetUrl;
        $html = $this->getBody($targetUrl);

        if (!is_dir($this->output_dir)) {
            mkdir($this->output_dir, 0755, true);
        }

        $crawler = new Crawler($html);

        $crawler->filter('link[rel="stylesheet"], script[src], img[src]')
            ->each(function ($node) use (&$html) {
                $url = $node->attr('href') ?: $node->attr('src');
                $path = parse_url($url, PHP_URL_PATH);
                $filename = $this->output_dir . $path;

                $contents = $this->getContent($url);

                if (!is_dir(dirname($filename))) {
                    mkdir(dirname($filename), 0755, true);
                }

                file_put_contents($filename, $contents);

                $localPath = '.' . $path;
                $html = str_replace($url, $localPath, $html);
            });

        file_put_contents($this->output_dir . '/index.html', $html);
    }

    private function getBody($url): string
    {
        $response = Http::withHeaders([
            'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36',
            'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'
        ])->get($url);

        if (!$response->successful()) {
            throw new \Exception('Failed to clone website');
        }

        return $response->body();
    }

    private function getContent($url): string
    {
        if (Str::startsWith($url, '//')) {
            $url = str_replace('//', '', $url);
            $url = 'https://' . $url;
        }

        if (Str::startsWith($url, '/')) {
            $host = parse_url($this->targetUrl, PHP_URL_HOST);
            $url = $host . $url;
        }

        $response = Http::withHeaders([
            'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36',
            'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'
        ])->get($url);

        return $response->body();
    }
}
