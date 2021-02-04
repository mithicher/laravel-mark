<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        	<div class="mb-5">
				<x-label for="name" :value="__('Name')" class="mb-2" />
		    	<x-input type="text" class="w-full" name="name" wire:model.defer="name" />
		    	<x-input-error class="mt-1" for="name" />
			</div>
     	 
			<div class="mb-5">
				<x-label for="content" :value="__('Content')" class="mb-2" />
		    	<x-markdown-editor name="content" wire:model.defer="content" />
		    	<x-input-error class="mt-1" for="content" />
			</div>

		    <button type="button" class="px-4 py-2 bg-gray-800 text-white rounded-lg"
		    	wire:click="save"
		    >Save</button>
		</div>
	</div>
</div>
