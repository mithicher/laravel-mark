<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Sheets;

class Edit extends Component
{
	public $name;
	public $content;

	public function mount(Document $document) 
	{
	 	$this->name = $document->slug;
	 	$this->content = file_get_contents(base_path('docs/'. $document->slug . '.md'));
	} 

	public function getFilenamesProperty()
    {
    	return Sheets::all()->map(fn($doc) => $doc->slug)->all();
    }

	public function save() 
	{
		$this->validate([
			'name' => ['required', Rule::notIn(array_diff($this->filenames, [$this->name]))],
			'content' => ['required'],
		]);

		$file =  base_path('docs/' . Str::slug($this->name) . '.md');

		file_put_contents($file, $this->content);

		$this->notify('success', 'Document updated!');
		session()->flash('success', 'Document updated');

		return redirect()->to('/documents/#' . Str::slug($this->name));
	}

    public function render()
    {
        return view('livewire.documents.edit');
    }
}
