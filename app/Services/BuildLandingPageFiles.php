<?php

namespace App\Services;

use App\Models\LandingPage;
use Illuminate\Support\Facades\Process;
use Symfony\Component\Process\ExecutableFinder;

class BuildLandingPageFiles
{
    public function __invoke2(LandingPage $landingPage)
    {
        $html_template = $this->getHtmlTemplate($landingPage);
        $style = $this->getCss();
        $tailwind_config = $this->getTailwindConfig();
        $ftp_page_dir = public_path('ftp' . DIRECTORY_SEPARATOR . $landingPage->id);

        // dd($ftp_page_dir);

        // $this->rrmdir($ftp_page_dir);

        // mkdir($ftp_page_dir, 0777, true);

        // file_put_contents($ftp_page_dir . '/index.html', $html_template);
        // file_put_contents($ftp_page_dir . '/tailwind.css', $style);
        // file_put_contents($ftp_page_dir . '/tailwind.config.js', $tailwind_config);

        // "npx tailwindcss -c {$ftp_page_dir}/tailwind.config.js -i {$ftp_page_dir}/tailwind.css -o {$ftp_page_dir}/style.css"

        // $shell_build_command = "cd {$ftp_page_dir} && dir && npx tailwindcss -c tailwind.config.js -i tailwind.css -o style.css";
        // $result = Process::run($shell_build_command);

        // echo $result->output();

        // $result = shell_exec('npm run tailwindcss -c tailwind.config.js -i tailwind.css -o style.css');
        $result = shell_exec('dir');

        $result = Process::run('cd ftp/1 && dir');
        dump($result->output());

        $result = Process::run('cd ftp/1 && npx tailwindcss -c tailwind.config.js -i tailwind.css -o style.css');
        dd($result->output());
    }

    public function __invoke(LandingPage $landingPage)
    {
        $html_template = $this->getHtmlTemplate($landingPage);
        $landingpage_dir = public_path("ftp/{$landingPage->id}");

        if (!is_dir($landingpage_dir)) {
            mkdir($landingpage_dir, 0777, true);
        }

        file_put_contents(
            "{$landingpage_dir}/index.html",
            $html_template
        );
    }

    private function getHtmlTemplate(LandingPage $landingPage)
    {
        return <<<HTML
            <!doctype html>
            <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="{$landingPage->seo_description}">
                <meta name="keywords" content="{$landingPage->seo_keywords}">
                <title>{$landingPage->seo_title}</title>

                <script src="https://cdn.tailwindcss.com"></script>

                <style>
                    {$landingPage->css}
                </style>
            </head>
            <body>
                {$landingPage->html}
            </body>
            </html>
        HTML;
    }

    private function getCss()
    {
        return <<<CSS
            @tailwind base;
            @tailwind components;
            @tailwind utilities;
        CSS;
    }

    private function getTailwindConfig()
    {
        return <<<JS
            module.exports = {
                content: [
                    './**/*.{html}',
                ],
                theme: {
                    extend: {},
                },
                variants: {},
                plugins: [],
            };
        JS;
    }

    private function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);

            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . "/" . $object))
                        $this->rrmdir($dir . DIRECTORY_SEPARATOR . $object);
                    else
                        unlink($dir . DIRECTORY_SEPARATOR . $object);
                }
            }

            rmdir($dir);
        }
    }
}
