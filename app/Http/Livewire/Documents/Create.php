<?php

namespace App\Http\Livewire\Documents;

use Sheets;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Create extends Component
{
	public $name = '';
	public $content = '';

	public function getFilenamesProperty()
    {
    	return Sheets::all()->map(fn($doc) => $doc->slug)->all();
    }

	public function save() 
	{
		$this->validate([
			'name' => ['required', Rule::notIn($this->filenames)],
			'content' => ['required'],
		]);

		$file =  base_path('docs/' . Str::slug($this->name) . '.md');

		file_put_contents($file, $this->content);

		session()->flash('success', 'Document created.');

		return redirect()->to('/documents/#' . Str::slug($this->name));
	}

    public function render()
    {
        return view('livewire.documents.create');
    }
}
