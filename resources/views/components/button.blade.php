@props([
	'color' => 'black',
    'tag' => 'button',
    'type' => 'submit'
])

@php
$buttonColor = [
    'indigo' => 'border-transparent bg-indigo-600 hover:bg-indigo-700 text-white active:bg-indigo-900 focus:border-indigo-900 ring-indigo-300',
    'red' => 'border-transparent bg-red-600 hover:bg-red-700 text-white active:bg-red-900 focus:border-red-900 ring-red-300',
    'blue' => 'border-transparent bg-blue-600 hover:bg-blue-700 text-white active:bg-blue-900 focus:border-blue-900 ring-blue-300',
    'white' => 'border-gray-100 bg-white text-gray-600 hover:text-gray-700  active:text-gray-900 focus:border-gray-200 ring-gray-100',
    'black' => 'border-transparent bg-gray-800 hover:bg-gray-700 text-white active:bg-gray-900 focus:border-gray-900 ring-gray-300'
][$color];
@endphp

<{{ $tag }}  {{ $tag === 'button' ? $type : '' }}
    {{ $attributes->merge(['class' => $buttonColor . ' inline-flex items-center px-4 py-2 border rounded-md font-semibold focus:outline-none focus:ring disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</{{ $tag }}>
