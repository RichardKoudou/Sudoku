<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Mon historique de record") }}
        </h2>
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-auto mb-4"
                 role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto mb-4"
                 role="alert">
                {{ session('error') }}
            </div>
        @endif
    </x-slot>

    <div class="py-12 mx-auto">
        <h3 class="text-2xl text-gray-900 text-center mb-2">Mes records</h3>
        <div class="p-4 w-3/4 min-h-fit max-h-96 mx-auto bg-white overflow-y-auto mb-4">
            @forelse($histories as $history)
                <div class="flex justify-between border-b-2 mb-1">
                    <div class="text-gray-900">{{ Carbon\Carbon::parse($history->created_at)->format('d/m/Y') }}</div>
                    <div class="text-gray-900">{{ $history->time }} seconde</div>
                </div>
            @empty
                <div class="text-gray-900 text-center">Aucun record</div>
            @endforelse
        </div>
    </div>

</x-app-layout>
