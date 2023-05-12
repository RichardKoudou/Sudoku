<x-app-layout>

    <style>
        tr:first-child td {
            border-top-color: black;
        }

        tr:nth-child(3n) td {
            border-bottom-color: black;
        }

        td {
            border: 1px solid lightgrey;
            height: 40px;
            width: 40px;
        }

        td:first-child {
            border-left-color: black;
        }

        td:nth-child(3n) {
            border-right-color: black;
        }

        input {
            padding: 0;
            text-align: center;
            border: 0;
            height: 40px;
            width: 40px;
        }

        input:hover {
            background: #ffffff;
        }

        .keypad {
            visibility: hidden;
            position: absolute;
            width: 200px;
            left: 45%;
            top: 5%;
            border: 5px solid grey;
            text-align: center;
            background: lightgreen;
            border-radius: 5px;
        }

        .keypad div {
            display: inline-block;
            width: 60px;
            height: 60px;
            margin: 0px;
            border: 1px solid lightgreen;
            line-height: 60px;
            font-size: 3em;
            background: #74a4c0;
            cursor: pointer;
            color: yellow;
        }

        .keypad .close {
            position: absolute;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            border: 2px solid orange;
            line-height: 20px;
            font-size: 20px;
            color: tomato;
            right: 0;
            top: -18px;
            background-color: steelblue;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Bienvenue sur à vous!") }}
        </h2>
    </x-slot>

    <div class="py-12 mx-auto">
        <h3 class="text-2xl text-gray-900 text-center mb-2">Partie en cours ...</h3>
        @if (session('success'))
            <div id="alert"
                 class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-auto mb-4"
                 role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div id="alert"
                 class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-auto mb-4"
                 role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('game.check') }}" method="post">
            @csrf
            <input type="hidden" name="gridId" value="{{ $gridId }}">
            <input id="sudoku-grid" type="hidden" name="sudokuGrid" value="{{ json_encode($sudokuGrid) }}"/>
            <div class="p-4 w-3/4 h-fit mx-auto bg-white mb-4 flex items-stretch gap-3 flex-col md:flex-row">
                <div class="w-full">
                    <table class="w-full" id="sudoku">
                        <tbody>
                        @foreach ($sudokuGrid as $row)
                            <tr>
                                @foreach ($row as $cell)
                                    <td>
                                        <input type="text" maxlength="1" class="sudoku-input" value="{{ $cell }}" {{ $cell !==0
                                ? 'readonly' : '' }}/>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="w-full">
                    <input type="hidden" name="timer" value="00:00:00" id="input-timer">
                    <h3 class="text-2xl text-gray-900 text-center mb-2">
                        votre temps: <span id="timer">00:00:00</span>
                    </h3>
                    <div class="flex flex-col justify-center items-center">
                        <button type="submit"
                                name="check"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4"
                                value="check">
                            Vérifier
                        </button>
                        <button type="submit"
                                name="check"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4"
                                value="finish">
                            Valider
                        </button>
                        <button type="submit"
                                name="check"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4"
                                value="solve">
                            Solution
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="keypad">
        <div class="close">X</div>
        <div>1</div>
        <div>2</div>
        <div>3</div>
        <div>4</div>
        <div>5</div>
        <div>6</div>
        <div>7</div>
        <div>8</div>
        <div>9</div>
    </div>
    <x-slot name="script">
        <script src="{{ asset('app.js') }}" defer></script>
    </x-slot>

</x-app-layout>
