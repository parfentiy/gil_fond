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
            {{ __('Список заказов') }}
        </h2>
        <div class="py-12">
            <table class="table table-bordered table-striped table-hover text-center align-content-center table-sm caption-top align-top">
                <thead class="table-light text-center fw-bold align-items-center align-top">
                <tr>
                    <th scope="col">№ заказа</th>
                    <th scope="col">Дата заказа</th>
                    <th scope="col">Список товаров</th>
                    <th scope="col">Cтоимость заказа</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($detailedOrders as $item)
                        <tr>
                            <td>
                                {{$item['order_id']}}
                            </td>
                            <td>
                                {{$item['date']}}
                            </td>
                            <td>
                                {{$item['products']}}
                            </td>
                            <td>
                                {{$item['total_amount']}} р.
                            </td>
                            <td>
                                <form class="" name="" id="delete" method="post" enctype="multipart/form-data" action="{{url('/delete-order')}}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm align-text-top" name="order_id" value="{{$item['order_id']}}">Удалить заказ</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="fw-bold">
                            Итого по всем заказам
                        </td>
                        <td></td>
                        <td></td>
                        <td class="fw-bold">
                            {{$finally_amount}} р.
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div>
            <div class="mb-3 d-grid mx-auto">
                @if(empty($detailedOrders))
                    Список пуст
                @endif
            </div>
        </div>

    </x-slot>
</x-app-layout>
