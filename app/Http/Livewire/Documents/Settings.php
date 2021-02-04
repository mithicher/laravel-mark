<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Spatie\Valuestore\Valuestore;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Settings extends Component
{
	public $document_title;
	public $category_order;
	public $theme;
	public $font;
	public $is_default_page;
	public $site_name;
	public $code_block_font;

	public function mount() 
	{
		$settings = Valuestore::make(storage_path('app/settings.json'));
		
		$this->document_title = $settings->get('document_title') ?? 'Documentation';
		$this->category_order = $settings->get('category_order');
		$this->theme = $settings->get('theme') ?? 'shades-of-purple';
		$this->font = $settings->get('font') ?? 'Space Grotesk';
		$this->is_default_page = (bool) $settings->get('is_default_page') ?? false;

		$this->site_name = $settings->get('site_name') ?? 'Laravel Mark';
		$this->code_block_font = $settings->get('code_block_font') ?? '';
	}

	public function updateSiteName() 
	{
		$this->validate([
			'site_name' => ['required'],
			'font' => ['required', Rule::in($this->fonts)],
		], [], [
			'site_name' => 'site name'
		]);

		$settings = Valuestore::make(storage_path('app/settings.json'));
	    $settings->put([
	    	'site_name' => $this->site_name,
	    	'font' => $this->font
	    ]);

	    $this->emit('$refresh');
	    $this->notify('success', 'Settings saved.');
	}

	public function update()
	{
		$this->validate([
			'document_title' => ['required'],
			'category_order' => ['required'],
			'theme' => ['required', Rule::in($this->themes)],
		], [], [
			'category_order' => 'category order',
			'document_title' => 'document title'
		]);

	    $settings = Valuestore::make(storage_path('app/settings.json'));

	    $settings->put([
	    	'document_title' => $this->document_title,
	    	'category_order' => $this->category_order,
	    	'theme' => $this->theme,
	    	'code_block_font' => $this->code_block_font,
	    	'is_default_page' => (bool) $this->is_default_page
	   	]);

	    $this->emit('$refresh');
	    $this->notify('success', 'Settings saved.');
	}

	public function getThemesProperty() 
	{
		return collect(Storage::disk('themes')->allFiles())->map(fn($file) => File::name($file));
	}

	public function getFontsProperty() 
	{
		return [
			'DM Sans',
			'IBM Plex Mono',
			'Inter',
			'Karla',
			'Quicksand',
			'Roboto Mono',
			'Rubik',
			'Space Grotesk',
			'Sora'
		];
	}

    public function render()
    {
        return view('livewire.documents.settings');
    }
}
