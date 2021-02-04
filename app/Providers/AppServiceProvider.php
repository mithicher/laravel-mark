<?php

namespace App\Providers;

use Livewire\Component;
use Spatie\Valuestore\Valuestore;
use League\CommonMark\Environment;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Block\Element\FencedCode;
use Spatie\Sheets\ContentParsers\MarkdownParser;
use League\CommonMark\Normalizer\SlugNormalizer;
use League\CommonMark\Block\Element\IndentedCode;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use League\CommonMark\Extension\Table\TableExtension;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;
use Spatie\Sheets\ContentParsers\MarkdownWithFrontMatterParser;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when([MarkdownParser::class, MarkdownWithFrontMatterParser::class])
            ->needs(CommonMarkConverter::class)
            ->give(function () {
                $environment = Environment::createCommonMarkEnvironment();
                
                $environment->addExtension(new TableExtension);
                $environment->addExtension(new HeadingPermalinkExtension());
                $environment->addExtension(new TableOfContentsExtension());
                
                $environment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer(['html', 'php', 'js']));
                $environment->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer(['html', 'php', 'js']));

                // Set your configuration
                $config = [
                    // Extension defaults are shown below
                    // If you're happy with the defaults, feel free to remove them from this array
                    'table_of_contents' => [
                        'html_class' => 'table-of-contents',
                        'position' => 'placeholder',
                        'style' => 'bullet',
                        'min_heading_level' => 1,
                        'max_heading_level' => 6,
                        'normalize' => 'relative',
                        'placeholder' => null,
                    ],
                    'heading_permalink' => [
                        'html_class' => 'heading-permalink mr-3 italic',
                        'id_prefix' => '',
                        'insert' => 'before',
                        'title' => 'Permalink',
                        'symbol' => '#',
                        'slug_normalizer' => new SlugNormalizer(),
                    ],
                    'allow_unsafe_links' => false,
                    'safe' => true
                ];

                return new CommonMarkConverter($config, $environment);
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Component::macro('notify', function($type = 'info', $message) {
            $this->dispatchBrowserEvent('notify', [
                'type' => $type,
                'text' => $message
            ]);
        });

        View::share('settings', Valuestore::make(storage_path('app/settings.json')));
    }
}
