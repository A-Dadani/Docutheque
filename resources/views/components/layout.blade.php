<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="{{ asset('css/LCLbootstrap.css') }}" rel="stylesheet" type="text/css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
        }
    </style>
    <title>Docuth&egrave;que &bull; Province de Sidi Slimane</title>
</head>

<body>
    <nav class="flex justify-between items-center p-2">
        <a href="/">
            <div>
                <img class="img-fluid" style="width: 50%;" src="{{ asset('images/ProvinceSidiSlimane.png') }}"
                    alt="" />
            </div>
        </a>
        <ul class="flex space-x-6 mr-6 text-lg">
            @auth
                <li>
                    <span class="font-bold uppercase">
                        Bienvenue {{ auth()->user()->name }}
                    </span>
                </li>
                @if (auth()->user()->role == 'RespoCommunication')
                    <li>
                        <a href="/messages" class="hover:text-laravel"><i class="fa-solid fa-envelope mr-1"></i>
                            Gestion de messagerie</a>
                    </li>
                @else
                    <li>
                        <a href="/listings/manage" class="hover:text-laravel"><i class="fa-solid fa-gear mr-1"></i>
                            Gestion des Documents</a>
                    </li>
                @endif
                <li>
                    <form class="inline" action="/logout" method="POST">
                        @csrf
                        <button type="submit"><i class="fa-solid fa-door-closed mr-1"></i> Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus mr-1"></i> Cr&eacute;er
                        un compte</a>
                </li>
                <li>
                    <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket mr-1"></i>
                        Se connecter</a>
                </li>
            @endauth
        </ul>
    </nav>
    <main>
        {{ $slot }}
    </main>

    <footer>
        <!--Copyright section-->
        <div class="bg-neutral-200 p-4 text-center text-neutral-700 dark:bg-neutral-700 dark:text-neutral-200">
            © 2023 Copyright:
            <a class="text-neutral-800 dark:text-neutral-400" href="http://www.provincesidislimane.ma">Province de Sidi
                Slimane</a>
        </div>
    </footer>
    <x-flash-message />
</body>

</html>
