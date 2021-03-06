<x-app-layout>
    <x-slot name="header">user
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <p><a href="/component-test1">てすと１</a></p>
                    <p><a href="/component-test2">てすと2</a></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
