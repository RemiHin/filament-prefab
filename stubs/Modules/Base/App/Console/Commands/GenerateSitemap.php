<?php

namespace RemiHin\FilamentPrefabStubs\Modules\Base\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Spatie\Sitemap\SitemapIndex;
use function App\Console\Commands\public_path;

class GenerateSitemap extends Command
{
    protected $signature = 'app:generate-sitemap';

    protected $description = 'Generate a fresh sitemap.xml';

    protected $chunkSize = 100;

    public function handle(): int
    {
        // Delete old sitemaps
        foreach (scandir(public_path()) as $file) {
            if (Str::of($file)->contains('sitemap')) {
                unlink(public_path('/') . $file);
            }
        }

        // Create new sitemap.xml index file
        $sitemapIndex = SitemapIndex::create();

        $models = config('sitemap.models');

        foreach ($models as $model) {
            $model::query()
                ->chunk($this->chunkSize, function ($records, $chunk) use ($sitemapIndex, $model) {
                    $label = strtolower(substr($model,11));

                    if (strpos($label, '\\')) {
                        $label = substr($label, strpos($label, '\\') + 1);
                    }

                    $sitemapName = $label . '_sitemap_' . $chunk . '.xml';

                    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
                    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . PHP_EOL;

                    foreach ($records as $record) {
                        // Get the flags for if a record has to be skipped
                        // With the logic below, we check if the record even has the function we are checking and if that function is true
                        // If the function does not exist, we do not need to check the latter and we dont need to skip
                        // If the function exists we need to check for the right condition
                        $visibleSkipFlag = (method_exists($record, 'isVisible') && !$record->isVisible());
                        $publishedSkipFlag = (method_exists($record, 'isPublished') && !$record->isPublished());

                        // If one of the flags is true, we have to skip it.
                        // Example: a news item is "visible", but has not yet reached its publication date, so it should not be taken in the sitemap
                        if($visibleSkipFlag || $publishedSkipFlag) {
                            continue;
                        };

                        $sitemap .= '    <url>' . PHP_EOL;
                        $sitemap .= '        <loc>' . $record->getRoute() . '</loc>' . PHP_EOL;
                        $sitemap .= '        <lastmod>' . $record->updated_at->format('Y-m-d') . '</lastmod>' . PHP_EOL;
                        $sitemap .= '        <changefreq>weekly</changefreq>' . PHP_EOL;
                        $sitemap .= '        <priority>0.6</priority>' . PHP_EOL;
                        $sitemap .= '    </url>' . PHP_EOL;
                    }

                    $sitemap .= '</urlset>';
                    file_put_contents(public_path($sitemapName), $sitemap);
                    $sitemapIndex->add($sitemapName);
                }
                );
        }

        // Finish it!
        $sitemapIndex->writeToFile(public_path('sitemap.xml'));

        return 0;
    }
}
