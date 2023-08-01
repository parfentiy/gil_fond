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
            {{ __('Корзина') }}
        </h2>
        <div class="py-12">
            Заказ № {{$orderNumber}} создан успешно
        </div>

    </x-slot>
</x-app-layout>
