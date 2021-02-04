<div>
	<x-form-section submit="updateSiteName">
		<x-slot name="title">Site Settings</x-slot>
		<x-slot name="description">Update name of your site and font settings.</x-slot>

		<x-slot name="form">
			<div class="mb-5">
		    	<x-label for="site_name">Site Name</x-label>
		    	<x-input 
		    		id="site_name"
		    		type="text"
		    		name="site_name"
		    		wire:model.defer="site_name"
		    		class="w-full md:w-1/2 mt-1"
		    	/>
		    	<x-input-error for="site_name" class="mt-1" />
		    </div>

		    <div class="mb-5">
		    	<x-label for="font">Font Family</x-label>
		    	<x-select name="font" wire:model.defer="font" class="w-full md:w-72 mt-1">
		    		@foreach($this->fonts as $fontface)
		    			<option value="{{ $fontface }}">{{ $fontface }}</option>
		    		@endforeach
		    	</x-select>
		    	<x-input-error for="font" class="mt-1" />
		    </div>
		</x-slot>

		<x-slot name="actions">
	        <x-button>
	            {{ __('Save') }}
	        </x-button>
	    </x-slot>
	</x-form-section>

	<x-section-border />

	<div class="mt-10 sm:mt-0">
		<x-form-section submit="update">
			<x-slot name="title">Document Settings</x-slot>
			<x-slot name="description">Update document title, change your code block theme, change the overall font family of the website. Change order of your category.</x-slot>

			<x-slot name="form">
				<div class="mb-5">
			    	<x-label for="document_title">Title</x-label>
			    	<x-input 
			    		id="document_title"
			    		type="text"
			    		name="document_title"
			    		wire:model.defer="document_title"
			    		class="w-full md:w-1/2 mt-1"
			    	/>
			    	<x-input-error for="document_title" class="mt-1" />
			    	<x-hint class="mt-1">
			    		Title of your documentation <br>
			    		eg. My Notes, Documentation
			    	</x-hint>
			    </div>

			    <div class="mb-5">
			    	<x-label for="category_order">Category Order</x-label>
			    	<x-input 
			    		id="category_order"
			    		type="text"
			    		name="category_order"
			    		wire:model.defer="category_order"
			    		class="w-full mt-1"
			    	/>
			    	<x-input-error for="category_order" class="mt-1" />
			    	<x-hint class="mt-1">
			    		Comma separated category names with order as prefered. Please ignore spaces while putting commas. The order given here will be used in the sidebar of your docs. <br>
			    		eg. Getting Started,Components,Notes.
			    	</x-hint>
			    </div>

			    <div class="mb-5">
			    	<x-label for="theme">Code Block Theme</x-label>
			    	<x-select name="theme" wire:model.defer="theme" class="w-full md:w-72 mt-1">
			    		@foreach($this->themes as $theme)
			    			<option value="{{ $theme }}">{{ Str::title(Str::of($theme)->replace('-', ' ')) }}</option>
			    		@endforeach
			    	</x-select>
			    	<x-input-error for="theme" class="mt-1" />
			    </div>

			    <div class="mb-5">
			    	<x-label for="code_block_font">Code Block Font Family <span class="text-sm text-gray-400">(optional)</span></x-label>
			    	<x-input 
			    		id="code_block_font"
			    		type="text"
			    		name="code_block_font"
			    		wire:model.defer="code_block_font"
			    		class="w-full md:w-1/2 mt-1"
			    	/>
			    	<x-input-error for="code_block_font" class="mt-1" />
			    	<x-hint class="mt-1">
			    		Enter the name of your favourite monospace font family <br>
			    		eg. JetBrains Mono
			    	</x-hint>
			    </div>

			    <div class="mb-5 flex items-center space-x-3">
			    	<label for="is_default_page" class="inline-flex items-center">
			            <input id="is_default_page" type="checkbox" wire:model.defer="is_default_page" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
			            <span class="ml-2 text-sm text-gray-600">{{ __('Make document page as default page') }}</span>
			        </label>
			    </div>
			</x-slot>

			<x-slot name="actions">
		        <x-button>
		            {{ __('Save') }}
		        </x-button>
		    </x-slot>
		</x-form-section>
	</div>
</div>
