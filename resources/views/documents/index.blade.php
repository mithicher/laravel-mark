<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents') }}
        </h2>
    </x-slot>

    <div class="bg-gray-100">
        <div x-data="window.search" 
            x-init="init"
            class="md:flex" 
            x-cloak
        >
            {{-- Menu --}}
            <div class="md:w-64 bg-white md:h-screen overflow-y-auto md:border-r border-gray-200 sticky top-0 z-40 shadow-sm md:shadow-none">
                {{-- Logo --}}
                <div class="flex items-center px-2 h-16">
                    <svg class="w-12 h-12 transform -rotate-6 text-indigo-600" viewbox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"><path d="M 0, 75 C 0, 18.75 18.75, 0 75, 0 S 150, 18.75 150, 75 131.25, 150 75, 150 0, 131.25 0, 75" fill="currentColor" transform="rotate(0,100,100
                    ) translate(25 25)"></path></svg><svg class="-ml-10 w-12 h-12 text-indigo-200" viewbox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"><path d="M 0, 75 C 0, 18.75 18.75, 0 75, 0 S 150, 18.75 150, 75 131.25, 150 75, 150 0, 131.25 0, 75 " fill="currentColor" transform="rotate(0,100,100) translate(25 25)"></path></svg>
                    <div class="text-gray-800 font-semibold text-lg px-2">{{ $settings->get('document_title') ?? 'Documentation' }}</div>
                </div>

                <div class="hidden md:block py-4">
                    @foreach($documentsGroupedByCategory as $category => $documents) 
                        <div class="text-gray-800 font-semibold mt-5 px-6 hidden md:block">{{ $category }}</div>
                        @foreach($documents as $document)
                            <a x-bind:class="{ 'border-indigo-600 text-indigo-600': tab === '#{{ $document->slug }}' }" class="px-8 py-2 border-l-4 border-transparent block capitalize text-gray-600 truncate hover:text-indigo-600" x-on:click="tab = '#{{ $document->slug }}'" href="#{{ $document->slug }}">{{ Str::of($document->slug)->replace('-', ' ') }}</a>
                        @endforeach    
                    @endforeach
                </div>
                <div class="block md:hidden px-4 pb-2 bg-white">
                    <x-select
                        name="document" 
                        id="document" 
                        x-ref="documentSelect"
                        x-on:change="tab = $refs.documentSelect.value; window.location.hash = $refs.documentSelect.value"
                        class="w-full"
                    >
                        @foreach($documentsGroupedByCategory as $category => $documents) 
                            <optgroup label="{{ $category }}">
                                @foreach($documents as $document)
                                    <option 
                                        :selected="tab === '#{{ $document->slug }}'"
                                        value="#{{ $document->slug }}"
                                    >{{ Str::title($document->slug) }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </x-select>
                </div>
            </div>

            <div class="md:w-3/4 flex-1">

                <div class="bg-white px-4 md:px-10 flex w-full items-center justify-between h-16 shadow-sm space-x-3">
                    <div class="relative flex-1">     
                        <x-input
                            x-ref="search"
                            type="search"
                            name="search"
                            placeholder="Search (Press / to focus)"
                            autocomplete="off"
                            x-on:input.debounce.250ms="search"
                            x-model="query"
                            x-on:keydown.arrow-up.stop.prevent="highlightPrevious"
                            x-on:keydown.arrow-down.stop.prevent="highlightNext"
                            x-on:keydown.enter="goToLink"
                            class="w-full md:w-96"
                        />
                        <ol 
                            class="list-none py-1 rounded-lg bg-white border border-gray-100 shadow-lg absolute top-0 overflow-x-hidden overflow-y-auto z-10 w-96 h-72 mt-12" 
                            x-ref="results"
                            x-show="open"
                            x-on:click.away="open = false; query = ''"
                        >
                            <template x-for="(result, index) in results" :key="index">
                                <li>
                                    <a :href="`#${result.slug}`" 
                                        class="block group" 
                                        x-on:click="tab = '#' + result.slug; query = ''; results = []; open = false;"
                                        :class="{
                                            'bg-indigo-50': index === highlightedIndex, 
                                            'border-t border-gray-100': index != results.length && index != 0 
                                        }"
                                    >
                                        <span class="block group-hover:bg-gray-50 px-4 py-2">
                                            <span class="block text-gray-700 group-hover:text-indigo-600 truncate font-semibold" x-text="result.title"></span>
                                            <span class="text-sm block text-gray-400 line-clamp-3" x-text="result.content"></span>
                                        </span>
                                    </a>
                                </li>
                            </template>

                            <template x-if="results.length == 0">
                                <p class="text-gray-600 p-6">No results found.</p>
                            </template>
                        </ol>
                    </div>

                    <div class="space-x-3 flex items-center">
                        <x-button href="{{ route('documents.create') }}" tag="a">
                            <svg class="w-5 h-5 -ml-1 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>New Doc</x-button>
                        <x-button color="white" href="{{ route('settings') }}" tag="a" class="shadow-sm group">
                            <svg class="w-6 h-6 -mx-1 text-gray-500 group-hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </x-button>
                    </div>
                </div>

                <div class="max-w-4xl mx-auto px-4 lg:px-8 py-8"> 
                    @foreach($documentsGroupedByCategory as $category => $documents) 
                        @foreach($documents as $index => $document)
                            <div x-show="tab === '#{{ $document->slug }}'" x-cloak>
                                <div class="flex items-center justify-between">
                                    <h2 class="font-semibold text-2xl md:text-4xl text-gray-800 tracking-tight">{{ $document->title }}</h2>

                                    <div class="space-x-2 flex">
                                        <a href="{{ route('documents.edit', $document->slug) }}" class="ml-3 bg-white hover:text-gray-700 px-4 py-2 shadow-sm leading-5 font-semibold rounded-md text-gray-600 border border-gray-200 flex items-center">
                                            <svg class="-ml-1 w-4 h-4 text-gray-400 stroke-current mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>Edit</a>
                                        <livewire:documents.delete :document="$document" />
                                    </div>
                                </div>

                                <hr class="border-gray-200 mt-4 mb-8" />

                                <div class="prose md:prose max-w-none prose-indigo md:prose-indigo">
                                    <x-toc :items="$document->table_of_contents" class="font-normal" />
                                    {!! $document->contents !!}
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
         
    </div>

    @push('styles')
        @if ($settings->has('theme'))
            <link rel="stylesheet" href="{{ url('/theme/'. $settings->get('theme') . '.css') }}">
        @else
            <link rel="stylesheet" href="{{ url('/theme/shades-of-purple.css') }}">
        @endif
        @if ($settings->get('code_block_font'))
            <style>
                .prose pre code {
                    font-family: "{{ $settings->get('code_block_font') }}", ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                }
            </style>
        @endif

        <style>
            .prose pre {
                position: relative;
            }
            .prose a.heading-permalink {
                color: rgb(156, 163, 175);
                text-decoration: none;
            }
            .copy-button {
                position: absolute;
                top: 10px;
                right: 16px;
                z-index: 50;
                padding: 4px;
                display: inline-block;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.05rem;
                background-color: rgba(79,70,229, 0.85);
                border-radius: 0.5em;
                font-weight: 400;
                color: #eee;
            }
            .copy-button::before {
                display: inline-block;
                content: '';
                background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%23eeeeee'%3E%3Cpath d='M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z' /%3E%3Cpath d='M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z' /%3E%3C/svg%3E");
                background-position: bottom center;
                background-size: contain;
                background-repeat: no-repeat;
                width: 16px;
                height: 16px;
                margin-right: 2px;
                margin-bottom: -3px;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fuse.js@6.4.6" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/mark.js@8.11.1/dist/mark.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js" defer></script>
        <script>
            window.search = {
                open: false,
                tab: window.location.hash ? window.location.hash : '#introduction',
                items: null,
                fuse: null,
                query: "",
                results: [],
                highlightedIndex: 0,

                init() {
                    // this.$refs.search.focus();
                    document.addEventListener('keypress', (e) => {
                        if (e.code === 'Slash') {
                            e.preventDefault();
                            this.query = '';
                            this.$refs.search.value = '';
                            this.$refs.search.focus();
                        }
                    });

                    this.items = @json($items);

                    this.fuse = new Fuse(this.items, {
                        includeMatches: true,
                        includeScore: true,
                        minMatchCharLength: 3,
                        keys: ['title', 'slug', 'category', 'content'],
                    });
                },
                search() {
                    if (this.fuse === null) {
                        this.results = [];
                        this.open = false;
                        return false;
                    }

                    this.results = this.fuse.search(this.query).map((r) => r.item)

                    if (this.results.length > 0) {
                        this.open = true;
                    }
                },

                scrollIntoView() {
                    this.$refs.results.children[this.highlightedIndex].scrollIntoView({
                        block: 'nearest',
                        behavior: 'smooth'
                    })
                },

                highlightNext() {
                    if (this.highlightedIndex < this.$refs.results.children.length - 1) {
                        this.highlightedIndex = this.highlightedIndex + 1
                        this.scrollIntoView()
                    }
                },

                highlightPrevious() {
                    if (this.highlightedIndex > 0) {
                        this.highlightedIndex = this.highlightedIndex - 1
                        this.scrollIntoView()
                    }
                },

                goToLink() {
                    this.tab = '#' + this.results[this.highlightedIndex].slug
                    window.location.href = '#' + this.results[this.highlightedIndex].slug
                    this.open = false
                    this.query = ''
                    this.results = []
                }
            };

            document.addEventListener('livewire:load', function () {
                function initCopyButtons() {
                    document.querySelectorAll('pre > code').forEach(function (codeBlock) {
                        let button = document.createElement('button');
                        button.className = 'copy-button';
                        button.type = 'button';
                        button.innerText = 'Copy';

                        let pre = codeBlock.parentNode;
                        pre.appendChild(button);
                    });
                }
                initCopyButtons();

                let copyCode = new ClipboardJS('.copy-button', {
                    target: function(trigger) {
                        return trigger.previousElementSibling;
                    }
                });

                copyCode.on('success', function(event) {
                    event.clearSelection();
                    event.trigger.textContent = 'Copied';
                    window.setTimeout(function() {
                        event.trigger.textContent = 'Copy';
                    }, 2000);
                });
            });
        </script>   
    @endpush
</x-guest-layout>
