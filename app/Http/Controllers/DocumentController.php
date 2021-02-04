<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Spatie\Sheets\Sheets;
use Spatie\Valuestore\Valuestore;

class DocumentController extends Controller
{
    public function index(Sheets $sheets) 
    {
        $documents = $sheets->collection('docs')->all();

        $groupedCategory = $documents->groupBy('category');
        
        $settings = Valuestore::make(storage_path('app/settings.json'));

        $categories = $settings->has('category_order') 
        	? explode(',', $settings->get('category_order')) 
        	: $groupedCategory->keys()->all();

    	return view('documents.index', [
            'items' => $documents->map(fn($doc) => [
                    'title' => $doc->title, 
                    'slug' => $doc->slug, 
                    'category' => $doc->category,
                    'content' => strip_tags($doc->contents->toHtml())
                ])->all(),
    		'documentsGroupedByCategory' => collect($categories)
                ->mapWithKeys(fn($cat) =>[$cat => $groupedCategory[$cat]])
                ->all(),
            'settings' => $settings
    	]);
    }

    public function show(Document $document) 
    {
    	return view('documents.show', ['document' => $document]);
    }
}
