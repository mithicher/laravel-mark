<x-app-layout>
    <div class="py-8 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg px-6 py-10 md:p-10 md:flex md:items-center">
                <div class="md:w-1/2">
                    <h2 class="mb-5 text-2xl md:text-3xl lg:text-4xl text-gray-800 font-semibold tracking-tight text-center md:text-left"><span class="inline-flex h-3 bg-indigo-200 leading-none items-end">Laravel Mark</span> is a markdown based personal note taking app.</h2>
                    
                    <div class="space-y-2 md:space-y-0 flex flex-col md:flex-row items-center space-x-3">
                        <x-button tag="a" href="{{ route('documents') }}" class="py-3 px-5 w-48 justify-center md:w-auto">Get started</x-button>

                        <div class="flex mt-3 space-x-3 items-center">
                            <x-icon name="arrow-bend-down-right" class="transform -rotate-12" />
                            <div class="text-2xl text-gray-500 cursive font-normal">It's free and open-source</div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="{{ url('/work.svg') }}" alt="" class="mt-6 md:mt-0 h-40 md:h-64 mx-auto object-fit">
                </div>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <h3 class="border-b border-gray-200 px-4 sm:px-6 py-4 text-gray-600">Some of the features it includes are:</h3>

                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <x-icon name="pencil-line" class="text-indigo-500 w-10 h-10 flex-shrink-0" />
                            <div class="ml-6 text-lg leading-7 font-semibold">Markdown Based</div>
                        </div>

                        <div class="ml-16">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Write using the power of markdown. Beautiful markdown editor with syntax highlighting.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        <div class="flex items-center">
                            <x-icon name="swatches" class="text-indigo-500 w-10 h-10 flex-shrink-0" />
                            <div class="ml-6 text-lg leading-7 font-semibold">Code Block Theme</div>
                        </div>

                        <div class="ml-16">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Pick from a list of beautifully selected themes for your code block.
                                Both light and dark version theme available.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <x-icon name="magnifying-glass" class="text-indigo-500 w-10 h-10 flex-shrink-0" />
                            <div class="ml-6 text-lg leading-7 font-semibold">Search Support</div>
                        </div>

                        <div class="ml-16">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Document search powered by Fusejs, so that you can find your needs quickly.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                        <div class="flex items-center">
                            <x-icon name="globe" class="text-indigo-500 w-10 h-10 flex-shrink-0" />
                            <div class="ml-6 text-lg leading-7 font-semibold text-gray-900 dark:text-white">100% Free and Open-Source</div>
                        </div>

                        <div class="ml-16">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laravel Mark is free and open-source, licensed under MIT. If you enjoy these app, feel free to share this app with others.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-16 pb-8">
                <div class="border-t border-gray-200"></div>
            </div>
            <div class="flex flex-col space-y-2 md:space-y-0 md:flex-row items-center justify-between">
                <div class="text-gray-500 text-sm">Created by <a href="https://twitter.com/mithicher" class="text-indigo-500 underline">@mithicher</a></div>
                <div class="flex space-x-3">
                    <a target="_blank" rel="noopener" href="https://twitter.com/mithicher">
                        <svg class="w-6 h-6 fill-current text-gray-400 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19.633,7.997c0.013,0.175,0.013,0.349,0.013,0.523c0,5.325-4.053,11.461-11.46,11.461c-2.282,0-4.402-0.661-6.186-1.809 c0.324,0.037,0.636,0.05,0.973,0.05c1.883,0,3.616-0.636,5.001-1.721c-1.771-0.037-3.255-1.197-3.767-2.793 c0.249,0.037,0.499,0.062,0.761,0.062c0.361,0,0.724-0.05,1.061-0.137c-1.847-0.374-3.23-1.995-3.23-3.953v-0.05 c0.537,0.299,1.16,0.486,1.82,0.511C3.534,9.419,2.823,8.184,2.823,6.787c0-0.748,0.199-1.434,0.548-2.032 c1.983,2.443,4.964,4.04,8.306,4.215c-0.062-0.3-0.1-0.611-0.1-0.923c0-2.22,1.796-4.028,4.028-4.028 c1.16,0,2.207,0.486,2.943,1.272c0.91-0.175,1.782-0.512,2.556-0.973c-0.299,0.935-0.936,1.721-1.771,2.22 c0.811-0.088,1.597-0.312,2.319-0.624C21.104,6.712,20.419,7.423,19.633,7.997z"></path></svg>
                    </a>

                    <a target="_blank" rel="noopener" href="https://github.com/mithicher">
                        <svg class="w-6 h-6 fill-current text-gray-400 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.026,2c-5.509,0-9.974,4.465-9.974,9.974c0,4.406,2.857,8.145,6.821,9.465 c0.499,0.09,0.679-0.217,0.679-0.481c0-0.237-0.008-0.865-0.011-1.696c-2.775,0.602-3.361-1.338-3.361-1.338 c-0.452-1.152-1.107-1.459-1.107-1.459c-0.905-0.619,0.069-0.605,0.069-0.605c1.002,0.07,1.527,1.028,1.527,1.028 c0.89,1.524,2.336,1.084,2.902,0.829c0.091-0.645,0.351-1.085,0.635-1.334c-2.214-0.251-4.542-1.107-4.542-4.93 c0-1.087,0.389-1.979,1.024-2.675c-0.101-0.253-0.446-1.268,0.099-2.64c0,0,0.837-0.269,2.742,1.021 c0.798-0.221,1.649-0.332,2.496-0.336c0.849,0.004,1.701,0.115,2.496,0.336c1.906-1.291,2.742-1.021,2.742-1.021 c0.545,1.372,0.203,2.387,0.099,2.64c0.64,0.696,1.024,1.587,1.024,2.675c0,3.833-2.33,4.675-4.552,4.922 c0.355,0.308,0.675,0.916,0.675,1.846c0,1.334-0.012,2.41-0.012,2.737c0,0.267,0.178,0.577,0.687,0.479 C19.146,20.115,22,16.379,22,11.974C22,6.465,17.535,2,12.026,2z"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
