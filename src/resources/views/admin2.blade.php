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
<div class="admin-form">
    <div class="admin-form__heading">
        <p>Admin</p>
    </div>
</div>
<div class='admin__content'>
    <form class="admin-form__content" action="/admin/search" method="get">
        @csrf
        <div class="admin-form__content-item">
            <input class="admin-form__content-item--input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
            <select class="admin-form__content-item--select" name="gender">
                <option value="">性別</option>
                <option value="男性">男性</option>
                <option value="女性">女性</option>
                <option value="その他">その他</option>
            </select>

            <input class="admin-form__content-item--date" type="date" id="date" name="date" value="{{ old('date', date('年/月/日')) }}">

    </form>
    <button class="search-button" type="submit">検索</button>
    <button class="reset-button" type="submit">リセット</button>
</div>
<div class="admin-table">
    <table class="admin-table__inner">
        <tr class="admin-table__row">
            <th class="admin-table__header">
                <span class="admin-table__header-span">お名前</span>
                <span class="admin-table__header-span">性別</span>
                <span class="admin-table__header-span">メールアドレス</span>
                <span class="admin-table__header-span">お問い合わせの種類</span>
            </th>
            @foreach ($contacts ?? '' as $contact)
        <tr class="admin-table__row">
            <td class="admin-table__item">

            </td>
        </tr>
        <th></th>
        <th></th>
        </tr>
            @endforeach
    </table>
</div>

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

@endsection