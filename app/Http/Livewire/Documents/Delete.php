<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Facades\File;

class Delete extends Component
{
	public $name;

	public function mount(Document $document) 
	{
		$this->name = $document->slug;
	}

	public function delete() 
	{
		$file = base_path('docs/' . $this->name . '.md');
		$exists = File::exists($file);

		if ($exists) {
		    File::delete($file);
		} 

		return redirect()->to('/documents');
	}

    public function render()
    {
        return view('livewire.documents.delete');
    }
}
