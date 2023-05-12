<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Bienvenue sur à vous!") }}
        </h2>
    </x-slot>

    <div class="py-12 mx-auto">
        <h3 class="text-2xl text-gray-900 text-center mb-2">Sudoku record</h3>
        <div class="p-4 w-3/4 min-h-fit max-h-96 mx-auto bg-white overflow-y-auto mb-4">
            @forelse($users as $user)
                <div class="flex justify-between border-b-2 mb-1">
                    <div class="text-gray-900">{{ $user->user->name }}</div>
                    <div class="text-gray-900">{{ $user->time }}</div>
                </div>
            @empty
                <div class="text-gray-900 text-center">Aucun utilisateur</div>
            @endforelse
        </div>

        <form class="text-center mx-auto" action="{{ route('game.index') }}" method="get">
            <div class="mb-4 flex flex-col justify-center items-center">
                <label for="level">
                    <span class="text-gray-700">Niveau de difficulté</span>
                </label>
                <select name="level" id="level" class="border border-gray-400 p-2 rounded w-1/2">
                    <option value="easy">Facile</option>
                    <option value="medium">Moyen</option>
                    <option value="hard">Difficile</option>
                </select>
            </div>
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                Lancer une partie
            </button>
        </form>

    </div>


</x-app-layout>
