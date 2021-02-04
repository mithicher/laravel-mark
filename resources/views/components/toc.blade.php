<div>
	@if ($items->isNotEmpty())
	    @foreach ($items as $item)
	        <div class="flex items-center space-x-3">
	            <em class="text-gray-400 text-lg italic">#</em>
	            <a href="{{ URL::current() }}#{{ $item['anchor'] }}" {{ $attributes->merge(['class']) }}>
	                {{ $item['title'] }}
	            </a>
	       </div>
	    @endforeach
    @endif
</div>
