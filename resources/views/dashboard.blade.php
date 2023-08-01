<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/bootstrap.min.css" rel="stylesheet">
    <script src="/bootstrap.bundle.min.js"></script>
    <style>
        form {
            margin: 1; /* Убираем отступы */
        }
    </style>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="mb-3 d-grid col-3 mx-auto">
            <a href="{{url('/catalog')}}" class="btn btn-primary shadow-lg">Каталог товаров</a>
        </div>
    </div>
    <div>
        <div class="mb-3 d-grid col-3 mx-auto">
            <a href="{{url('/orders')}}" class="btn btn-primary shadow-lg">Мои заказы</a>
        </div>
    </div>
    <div>
        <div class="mb-3 d-grid col-3 mx-auto">
            <a href="{{url('/cart')}}" class="btn btn-primary shadow-lg">Посмотреть корзину</a>
        </div>
    </div>
    <div>
        <div class="mb-3 d-grid col-3 mx-auto">
            <a href="{{url('/clear-cart')}}" class="btn btn-primary shadow-lg">Очистить корзину</a>
        </div>
    </div>
</x-app-layout>
