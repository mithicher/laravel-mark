@php
$id = $id ?? md5(Str::random(8));
@endphp

<div
	x-data="{
		height: '{{ $height ?? '400px' }}',
		tab: 'write',
		content: @entangle($attributes->wire('model')),
		showConvertedMarkdown: false,
		convertedContent: '',
		convertedMarkdown() {
			this.showConvertedMarkdown = true;
			this.convertedContent = marked(this.content, { sanitize: true });
		}
	}"
	x-init="
		codeMirrorEditor = CodeMirror.fromTextArea($refs.input, {
			mode: 'markdown',
			theme: 'default',
			lineWrapping: true
		});

		codeMirrorEditor.setValue(content);
		codeMirrorEditor.setSize('100%', height);
		setTimeout(function() {
		    codeMirrorEditor.refresh();
		}, 1);

		codeMirrorEditor.on('change', () => content = codeMirrorEditor.getValue())
	"
	class="relative"
	x-cloak
>
	<div class="flex items-center justify-between bg-gray-50 border border-b-0 border-gray-300 top-0 left-0 right-0 block rounded-t-md">
		<div>
			<button type="button" class="py-2 px-4 inline-block text-gray-400 font-semibold" :class="{ 'text-indigo-600': tab === 'write' }" x-on:click.prevent="tab = 'write'; showConvertedMarkdown = false">Write</button>
			<button type="button" class="py-2 px-4 inline-block text-gray-400 font-semibold" :class="{ 'text-indigo-600': tab === 'preview' && showConvertedMarkdown === true }" x-on:click.prevent="tab = 'preview'; convertedMarkdown()">Preview</button>
		</div>
		<div>
			<div class="relative" x-data="{ open: false }" x-cloak>
				<button type="button" x-on:click="open = true" class="px-3 py-2">
					<svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="128" cy="128" r="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></circle><polyline points="120 120 128 120 128 176 136 176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><circle cx="128" cy="84" r="12"></circle></svg>
				</button>
				<div x-show="open"
		            x-transition:enter="transition ease-out duration-200"
		            x-transition:enter-start="transform opacity-0 scale-95"
		            x-transition:enter-end="transform opacity-100 scale-100"
		            x-transition:leave="transition ease-in duration-75"
		            x-transition:leave-start="transform opacity-100 scale-100"
		            x-transition:leave-end="transform opacity-0 scale-95"
		            class="absolute z-50 mt-2 -mr-1 w-64 rounded-md shadow-lg origin-top-right right-0"
		            style="display: none;"
		            x-on:click="open = false"
		            x-on:click.away="open = false"
		        >
			        <div class="rounded-md ring-1 ring-black ring-opacity-5 bg-white divide-y divide-gray-100 text-sm py-1">
			            <div class="flex items-center py-1">
			            	<div class="text-gray-500 px-4 w-24">Italics</div>
			            	<div class="text-gray-800 px-4">*italic*</div>
			            </div>
			            <div class="flex items-center py-1">
			            	<div class="text-gray-500 px-4 w-24">Bold</div>
			            	<div class="text-gray-800 px-4">**bold**</div>
			            </div>
			            <div class="flex items-center py-1">
			            	<div class="text-gray-500 px-4 w-24">Blockquote</div>
			            	<div class="text-gray-800 px-4">> Blockquote</div>
			            </div>
			            <div class="flex items-center py-1">
			            	<div class="text-gray-500 px-4 w-24">Code</div>
			            	<div class="text-gray-800 px-4">```Code Block```</div>
			            </div>
			            <div class="flex items-center py-1">
			            	<div class="text-gray-500 px-4 w-24">Link</div>
			            	<div class="text-gray-800 px-4">[Text](link)</div>
			            </div>
			            <div class="flex items-center py-1">
			            	<div class="text-gray-500 px-4 w-24">Image</div>
			            	<div class="text-gray-800 px-4">![Caption](link)</div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>

	{{-- <textarea 
		style="resize: none" 
		x-show="! showConvertedMarkdown"
		x-ref="input"
		autocomplete="off"
      	x-model.debounce.750ms="content"
		class="hidden pt-12 prose max-w-none w-full prose-indigo textarea bg-white leading-6 rounded-md shadow-sm border border-gray-300 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-5"
	></textarea> --}}
	<div x-show="! showConvertedMarkdown">
		<div wire:ignore>
			<textarea id="{{ $id }}" x-ref="input" x-model="content" class="hidden"></textarea>
		</div>
	</div>

	<div x-show="showConvertedMarkdown" >
		<div x-html="convertedContent" class="prose max-w-none w-full prose-indigo leading-6 rounded-b-md shadow-sm border border-gray-300 p-5 bg-white overflow-y-auto" :style="`height: ${height}`"></div>
	</div>
</div>

@once
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.59.2/lib/codemirror.min.css">
<style>
.CodeMirror-focused {   
    border-radius: .375rem;
    outline: 2px solid transparent;
    outline-offset: 2px;
    --tw-ring-opacity: 0.5;
    --tw-ring-color: rgba(199, 210, 254, var(--tw-ring-opacity));
    --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
    --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
    box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
}
.CodeMirror {
	padding: 0.75rem;
	font-family: inherit;
	font-size: inherit;
	border-bottom-left-radius: .375rem;
	border-bottom-right-radius: .375rem;
	--tw-border-opacity: 1;
    border: 1px solid rgba(209, 213, 219, var(--tw-border-opacity));
}
.CodeMirror.CodeMirror-focused {
    --tw-border-opacity: 1;
    border-color: rgba(165, 180, 252, var(--tw-border-opacity));
}

.cm-s-default .cm-header,
.cm-s-default .cm-variable-2 {
	color: rgb(31, 41, 55);
}
</style>
@endpush
@push('scripts')
	<script src="https://cdn.jsdelivr.net/npm/codemirror@5.59.2/lib/codemirror.min.js" defer></script>
	<script src="https://cdn.jsdelivr.net/npm/codemirror@5.59.2/mode/markdown/markdown.js" defer></script>
	<script src="https://unpkg.com/marked@0.3.6/lib/marked.js" defer></script>
@endpush
@endonce
