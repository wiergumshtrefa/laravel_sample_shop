@extends('layouts.app')

@section('content')
    <!-- Навигационная панель с кнопками регистрации и входа -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Магазин</a>
            <div class="d-flex ms-auto">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-primary me-2">Регистрация</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-success">Войти</a>
                @else
                    <span class="navbar-text me-3">Здравствуйте, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Выход</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <h1>Каталог товаров</h1>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Обратите внимание: путь к изображению -->
                    <!-- В вашем коде есть строка: <img src="{{ asset($product->image) }}" ... -->
                         убедитесь, что $product->image содержит правильный относительный путь или имя файла -->
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    
                    <!-- В вашем коде есть лишняя картинка: -->
                    <!-- <img src="{{ asset('public/images/pri.png') }}" alt="Описание изображения"> -->
                    <!-- Обычно не нужно добавлять такую картинку, если она не нужна. Можно убрать или оставить по необходимости -->

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <!-- Можно убрать или оставить по необходимости -->
                        {{-- <img src="{{ asset('public/images/pri.png') }}" alt="Описание изображения"> --}}
                        <p class="card-text">{{ $product->price }} руб.</p>
                        <form action="{{ route('add.to.cart', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">В корзину</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('cart') }}" class="btn btn-success">Корзина</a>
    <a href="{{ route('feedback') }}" class="btn btn-info">Обратная связь</a>
@endsection