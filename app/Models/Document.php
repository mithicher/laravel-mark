<?php

namespace App\Models;

use Spatie\Sheets\Sheet;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Document extends Sheet
{
    public function getDateAttribute()
	{
			return Carbon::createFromTimestamp($this->attributes['date']);
	}

	public function getTableOfContentsAttribute() 
	{
			$file = base_path('docs/'. $this->slug .'.md');
			$markdownContent = file_get_contents($file);
			$markdown = preg_replace('(```[a-z]*\n[\s\S]*?\n```)', '', $markdownContent);

			return collect(explode(PHP_EOL, $markdown))
					->reject(function (string $line) {
							// Only search for level 2 and 3 headings.
							return ! Str::startsWith($line, '## ') && ! Str::startsWith($line, '### ');
					})
					->map(function (string $line) {
							return [
									'level' => strlen(trim(Str::before($line, '# '))) + 1,
									'title' => $title = trim(Str::after($line, '# ')),
									'anchor' => Str::slug($title),
							];
					});
	}
}
