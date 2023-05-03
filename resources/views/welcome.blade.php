<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <main>
            <table id="sudoku">
                <tbody>
                    @foreach ($sudokuGrid as $row)
                    <tr>
                        @foreach ($row as $cell)
                        <td>
                            <input type="text" maxlength="1" class="sudoku-input" value="{{ $cell }}" {{ $cell !==0
                                ? 'readonly' : '' }}>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </main>

        <style>
            /* with css reset */
            * {
                box-sizing: border-box;
            }

            table {
                margin: 10px;
            }

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
                text-align: center;
            }

            input:hover {
                background: #ffffff;
            }
        </style>

        <script>
            const sudoku = document.getElementById('sudoku');
            const inputs = sudoku.getElementsByTagName('input');

            for (let i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('keydown', function(e) {
                    if (e.keyCode === 38) {
                        inputs[i - 9].focus();
                    } else if (e.keyCode === 40) {
                        inputs[i + 9].focus();
                    } else if (e.keyCode === 37) {
                        inputs[i - 1].focus();
                    } else if (e.keyCode === 39) {
                        inputs[i + 1].focus();
                    }
                });
            }
        </script>
    </div>
</body>

</html>
