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
            <table class="table table-bordered table-striped table-hover text-center align-content-center table-sm caption-top align-top">
                <thead class="table-light text-center fw-bold align-items-center align-top">
                <tr>
                    <th scope="col">Наименование</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Кол-во</th>
                    <th scope="col">Общая стоимость</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $totalAmount = 0;
                    @endphp
                    @foreach(\App\Models\Cart::where('user_id', Auth::user()->id)->get() as $item)

                        <tr>
                            <td>
                                {{\App\Models\Product::find($item['product_id'])->name}}
                            </td>
                            <td>
                                {{\App\Models\Product::find($item['product_id'])->price}} р.
                            </td>
                            <td>

                                <form id="{{$item['product_id']}}" method="post" enctype="multipart/form-data" action="{{route('addToCart')}}">
                                    @csrf
                                    <input id="updater" class="form-control form-control-sm" required type="number" name="quantity"
                                       value="{{\App\Models\Cart::where('user_id', Auth::user()->id)->where('product_id', $item['product_id'])->pluck('quantity')->first()}}"/>
                                </form>
                            </td>
                            <td>
                                {{\App\Models\Product::whereId($item['product_id'])->first()->price * $item['quantity']}} р.
                            </td>
                            <td>
                                <button form="{{$item['product_id']}}" type="submit" class="btn btn-primary btn-sm align-text-top" name="product_id" value="{{$item['product_id']}}">Изменить кол-во</button>
                            </td>
                            <td>
                                <form class="" name="" id="delete" method="post" enctype="multipart/form-data" action="{{route('deleteFromCart')}}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm align-text-top" name="product_id" value="{{$item['product_id']}}">Удалить из корзины</button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $totalAmount += \App\Models\Product::whereId($item['product_id'])->first()->price * $item['quantity'];
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="fw-bold">
                            Итого
                        </td>
                        <td></td>
                        <td></td>
                        <td class="fw-bold">
                            {{$totalAmount}} р.
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div>
            <div class="mb-3 d-grid mx-auto">
                @if(!is_null(\App\Models\Cart::where('user_id', Auth::user()->id)->first()))
                    <div class="mb-3 d-grid mx-auto">
                        <form class="" name="" id="addOrder" method="post" enctype="multipart/form-data" action="{{url('/add-order')}}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm align-text-top" name="total_amount" value="{{$totalAmount}}">Оформить заказ</button>
                        </form>
                    </div>
                    <div class="mb-3 d-grid mx-auto">
                        <a href="{{url('/clear-cart')}}" class="btn btn-sm btn-primary shadow-lg">Очистить корзину</a>
                    </div>
                @else
                    Корзина пуста
                @endif
            </div>
        </div>

    </x-slot>
</x-app-layout>
