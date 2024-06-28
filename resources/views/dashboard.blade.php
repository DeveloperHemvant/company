<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           
            @if (Auth::user()->role == 'user')
            {{ __('User Dashboard') }}
            @endif
            @if (Auth::user()->usertype == 'Admin')
            {{ __('Associate Dashboard') }}
            @endif
            @if (Auth::user()->role == 'admin')
            {{ __('Admin Dashboard') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-welcome /> --}}
            </div>
        </div>
    </div>
    
</x-app-layout>
