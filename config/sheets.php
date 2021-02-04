<?php

return [
    'default_collection' => null,

    'collections' => [

        /* An example collection. All keys are optional.

        'posts' => [
            'disk' => 'posts',
            'sheet_class' => App\Post::class,
            'path_parser' => Spatie\Sheets\PathParsers\SlugWithDateParser::class,
            'content_parser' => Spatie\Sheets\ContentParsers\MarkdownParser::class,
            'extension' => 'txt',
        ], */

        'docs' => [
            'disk' => 'docs',
            'sheet_class' => App\Models\Document::class,
            'path_parser' => Spatie\Sheets\PathParsers\SlugParser::class,
            'content_parser' => Spatie\Sheets\ContentParsers\MarkdownWithFrontMatterParser::class,
            'extension' => 'md',
        ], 
    ],
];
