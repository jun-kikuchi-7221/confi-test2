@extends('layouts.app')

@section('header-button')
<div class="header-btn">
    <a class="btn" type="submit" href="/login">logout</a>
</div>
@endsection

@section('css')
<link rel=" stylesheet" href="{{ asset('css/admin.css') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="admin-form__content">
    <div class="admin-form__heading">
        <p>Admin</p>
    </div>
</div>
<form class="search-form" action="/admin/search" method="get">
    @csrf
    <div class="search-form__item">
        <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
        <select class="search-form__item-select" name="gender">
            <option value="">性別</option>
            <option value="男性">男性</option>
            <option value="女性">女性</option>
            <option value="その他">その他</option>
        </select>

        <!-- <div class="custom-select-container"> -->
        <select class="search-form__item-select--category" name="category">
            <option value="">お問い合わせの種類</option>
            @foreach ($categories as $category)
            <!-- <option value="{{ $category->id }}">{{ $category['content'] }}</option> -->
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->content }}
                @endforeach
        </select>
        <!-- <option value="delivery">商品のお届けについて</option>
                    <option value="exchange">商品の交換について</option>
                    <option value="trouble">商品トラブル</option>
                    <option value="feedback">ショップへのお問い合わせ</option>
                    <option value="other">その他</option> -->
        </select>
        <!-- </div> -->
        <input class="" type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}">


        <button class="search-button" type="submit">検索</button>
        <button class="reset-button" type="submit">リセット</button>

        </=>

        <table class="admin__table">
            <tr class="admin__table-title">
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
            </tr>

        </table>


        <!-- <form class="form">
        <div class="form__group">
            <div class="form__group-title">
                <ls class="form__label--item">お名前</ls>
                <ls class="form__label--item">性別</ls>
                <ls class="form__label--item">メールアドレス</ls>
                <ls class="form__label--item">お問い合わせの種類</ls>
            </div>
        </div>
    </form> -->



        <form action="find" method="POST">
            @csrf
            <input type="text" name="input" value="{{$input ?? '' }}">
            <input type="submit" value="見つける">
        </form>

</form>
@endsection