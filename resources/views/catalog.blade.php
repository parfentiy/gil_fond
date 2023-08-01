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
            {{ __('Каталог') }}
        </h2>
        <div class="align-content-center align-items-center mx-9">
            @foreach(\App\Models\Category::all() as $category)
            <table class="table table-bordered table-striped table-hover text-center align-content-center table-sm caption-top align-top">
                <thead class="table-light text-center fw-bold align-items-center align-top">
                    <div class="fw-bold">
                        Категория: {{ $category->name }}
                    </div>

                    <tr>
                        <th scope="col">Наименование</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Кол-во</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody  class="table-light text-center align-items-center align-top">
                    @foreach(\App\Models\Product::where('category_id', $category->id)->get() as $product)
                        <tr class="mx-auto">
                            <td>
                                {{$product->name}}
                            </td>
                            <td>
                                {{$product->price}} р.
                            </td>

                            <form class="" name="" id="category" method="post" enctype="multipart/form-data" action="{{route('addToCart')}}">
                            <td class="col-2">
                                @csrf
                                <input class="form-control form-control-sm px-3" required type="number" name="quantity"
                                       value="{{\App\Models\Cart::where('user_id', Auth::user()->id)->where('product_id', $product['id'])->pluck('quantity')->first()}}"/>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm align-text-top px-2" name="product_id" value="{{$product->id}}">Добавить в корзину</button>

                            </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach

        </div>
        <div class="py-12">
            <div class="mb-1 d-grid col-3 mx-auto">
                <a href="{{url('/cart')}}" class="btn btn-sm btn-primary shadow-lg">Посмотреть корзину</a>
            </div>
            <div class="mb-1 d-grid col-3 mx-auto">
                <a href="{{url('/clear-cart')}}" class="btn btn-sm btn-primary shadow-lg">Очистить корзину</a>
            </div>
        </div>
    </x-slot>
</x-app-layout>
