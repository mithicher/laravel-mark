<div x-data="{ confirmed: false }" x-cloak>
	<div x-on:click.away="confirmed = false">
	    <x-button
	    	type="button"
	    	x-show="!confirmed"
	    	x-on:click.prevent="confirmed = true" 
	    	color="white" type="button" class="text-red-600 border-gray-200 leading-5 items-center inline-flex shadow-sm">
	    	<svg class="w-4 h-4 -ml-1 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
			</svg>Delete
		</x-button>
		<x-button
			type="button"
			x-show="confirmed"
	    	wire:click="delete" 
	    	color="red" type="button" class="leading-5 items-center inline-flex shadow-sm">
	    	<svg class="w-4 h-4 -ml-1 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
			</svg>Are you sure?
		</x-button>
	</div>
</div>
