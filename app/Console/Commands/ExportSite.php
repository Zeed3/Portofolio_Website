<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExportSite extends Command
{
    protected $signature = 'site:export {--out=docs : Output directory relative to the project root}';

    protected $description = 'Render every page to static HTML for GitHub Pages hosting.';

    /**
     * Routes to export, mapped to their output path. Directory-index files
     * (work/index.html) let clean URLs like /work resolve on GitHub Pages.
     */
    private array $pages = [
        '/'       => 'index.html',
        '/work'   => 'work/index.html',
        '/about'  => 'about/index.html',
        '/resume' => 'resume/index.html',
    ];

    // A URL the app will never really use, so we can find and rewrite the
    // absolute links Laravel generates into page-relative ones.
    private const SENTINEL = 'http://site.invalid';

    public function handle(Kernel $kernel): int
    {
        $out = base_path($this->option('out'));

        // Start from a clean output directory.
        File::deleteDirectory($out);
        File::ensureDirectoryExists($out);

        foreach ($this->pages as $uri => $path) {
            $request = Request::create(self::SENTINEL . $uri, 'GET');
            $response = $kernel->handle($request);

            if ($response->getStatusCode() !== 200) {
                $this->error("  {$uri} returned {$response->getStatusCode()}");
                return self::FAILURE;
            }

            $depth = substr_count($path, '/'); // index.html = 0, work/index.html = 1
            $html = $this->relativize($response->getContent(), $depth);

            $target = $out . '/' . $path;
            File::ensureDirectoryExists(dirname($target));
            File::put($target, $html);
            $this->info("  rendered {$uri}  ->  " . $this->option('out') . "/{$path}");
        }

        // Static assets.
        File::copyDirectory(public_path('css'), $out . '/css');

        // Tell GitHub Pages to serve the files as-is (no Jekyll processing).
        File::put($out . '/.nojekyll', '');

        $this->info('Static site written to ' . $this->option('out') . '/');
        return self::SUCCESS;
    }

    /**
     * Turn the absolute sentinel URLs into paths relative to the page being
     * written, so the export works under any GitHub Pages base path and can
     * also be opened locally.
     */
    private function relativize(string $html, int $depth): string
    {
        $prefix = $depth === 0 ? './' : str_repeat('../', $depth);

        // Links/assets like http://site.invalid/css/styles.css -> ./css/styles.css
        $html = str_replace(self::SENTINEL . '/', $prefix, $html);

        // The bare home link http://site.invalid -> ./ (or ../ from a subpage)
        $html = str_replace(self::SENTINEL, rtrim($prefix, '/') . '/', $html);

        return $html;
    }
}
