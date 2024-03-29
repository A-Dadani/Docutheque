<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
    <nav class="flex justify-between items-center p-2 pl-4">
        <a href="/">
            <div>
                <img class="img-fluid" width="220" src="{{ asset('images/ProvinceSidiSlimane.png') }}"
                    alt="" />
            </div>
        </a>
        <ul class="flex space-x-6 mr-6 text-lg">
            @auth
                @if (auth()->user()->role == 'admin')
                    {{-- Administrateur / Chef --}}
                    <li>
                        <a href="/users/requests" class="hover:text-laravel">
                            <i class="fa-solid fa-user-group mr-1 relative">
                                <?php
                                $reqCount = count(
                                    Illuminate\Support\Facades\DB::table('users')
                                        ->where('confirmed', '=', false)
                                        ->get(),
                                );
                                ?>
                                @unless ($reqCount == 0)
                                    {{-- There are some requests --}}
                                    @if ($reqCount < 10)
                                        <i class="fa-solid fa-square absolute text-sm"
                                            style="top: -0.75rem; left: -0.35rem; color: red"></i>
                                        <span class="text-xs absolute"
                                            style="font-family: &quot;Poppins&quot;, Arial, sans-serif; font-style: normal !important; color: #fafafa; top: -0.6rem; left: -0.175rem; font-weight: bold;">{{ $reqCount }}</span>
                                    @elseif ($reqCount < 100)
                                        <i class="fa-solid fa-square absolute text-sm"
                                            style="top: -0.75rem;left: -0.35rem;color: red;transform: scale(1.35,1);"></i>
                                        <span class="text-xs absolute"
                                            style="font-family: &quot;Poppins&quot;, Arial, sans-serif;font-style: normal !important;color: #fafafa;top: -0.6rem;left: -0.35rem;font-weight: bold;">{{ $reqCount }}</span>
                                    @else
                                        {{-- Show 99+ if count is greated than 2 digits --}}
                                        <i class="fa-solid fa-square absolute text-sm"
                                            style="top: -0.75rem;left: -0.35rem;color: red;transform: scale(2,1);"></i>
                                        <span class="text-xs absolute"
                                            style="font-family: &quot;Poppins&quot;, Arial, sans-serif;font-style: normal !important;color: #fafafa;top: -0.6rem;left: -0.55rem;font-weight: bold;">99+</span>
                                    @endif
                                @endunless
                            </i>
                            Demandes d&apos;inscription</a>
                    </li>
                    <li>
                        <a href="/departments/manage" class="hover:text-laravel"><i class="fa-solid fa-users-gear mr-1"></i>
                            Gestion de d&eacute;partements</a>
                    </li>
                    <li>
                        <a href="/documents" class="hover:text-laravel"><i class="fa-solid fa-file-lines mr-1"></i>
                            Gestion de documents</a>
                    </li>
                    <li>
                        <a href="/messages" class="hover:text-laravel"><i class="fa-solid fa-envelope mr-1"></i>
                            Messagerie</a>
                    </li>
                @elseif (auth()->user()->role == 'RespoCommunication')
                    {{-- Responsable de communication --}}
                    <li>
                        <a href="/messages" class="hover:text-laravel"><i class="fa-solid fa-envelope mr-1"></i>
                            Messagerie</a>
                    </li>
                @else
                    {{-- Chef de département / Employé --}}
                    <li>
                        <a href="/documents" class="hover:text-laravel"><i class="fa-solid fa-file-lines mr-1"></i>
                            Gestion de Documents</a>
                    </li>
                @endif
                <li>
                    <form class="inline" action="/logout" method="POST">
                        @csrf
                        <button type="submit"><i class="fa-solid fa-right-from-bracket mr-1"></i> Se
                            d&eacute;connecter</button>
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
