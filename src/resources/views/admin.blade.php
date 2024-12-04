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
    <form class="admin-form__content" action="{{ route('admin.search') }}" method="get">
        @csrf
        <div class="admin-form__content-item">
            <input class="form-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword', $request->keyword) }}">
            <!-- value="{{ old('keyword') }}"> -->
            <select class="form-select" name="gender">
                <option value="">性別</option>
                <option value="1" {{ old('gender', $request->gender) == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ old('gender', $request->gender) == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ old('gender', $request->gender) == '3' ? 'selected' : '' }}>その他</option>
                <!-- <option value="1">男性</option> 
                <option value="2">女性</option>
                <option value="3">その他</option> -->
            </select>
            <select class="form-select2" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $request->category_id) == $category->id ? 'selected' : '' }}>
                    <!-- {{ request('category_id') == $category->id ? 'selected' : '' }}> -->
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
            <input class="form-date" type="date" name="save_date" value="{{ old('date', $request->save_date) }}">
        </div>
        <button class="search-button" type="submit">検索</button>
        <!-- <button class="reset-button" type="reset" onclick=" window.location.href='/admin/search' ;">リセット</button> -->
        <!-- リセットボタン -->
        <a class="reset-button" href="{{ route('admin') }}">リセット</a>
    </form>
</div>
<div class="pagination">
    <a href="{{ $contacts->previousPageUrl() }}" class="pagination-arrow {{ $contacts->onFirstPage() ? 'disabled' : '' }}">＜</a>
    @for ($i = 1; $i <= $contacts->lastPage(); $i++)
        <a href="{{ $contacts->url($i) }}" class="pagination-number {{ $i == $contacts->currentPage() ? 'active' : '' }}">{{ $i }}</a>
    @endfor
    <a href="{{ $contacts->nextPageUrl() }}" class="pagination-arrow {{ !$contacts->hasMorePages() ? 'disabled' : '' }}">＞</a>
</div>





{{-- <div class="pagination"> 
    <a href="#" class="pagination-arrow disabled">＜</a>
    <a href="#" class="pagination-number active">1</a>
    <a href="#" class="pagination-number">2</a>
    <a href="#" class="pagination-number">3</a>
    <a href="#" class="pagination-number">4</a>
    <a href="#" class="pagination-number">5</a>
    <a href="#" class="pagination-arrow">＞</a>
</div>　--}}

<div class="admin-table">
    <table class="admin-table__inner">
        <thead>
            <tr class="admin-table__row">
                <th class="admin-table__header-span">お名前</th>
                <th class="admin-table__header-span">性別</th>
                <th class="admin-table__header-span">メールアドレス</th>
                <th class="admin-table__header-span">お問い合わせの種類</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr class="admin-table__row1">
                <td class="admin-table__item">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td class="admin-table__item">{{ $contact->gender_label }}</td>
                <td class="admin-table__item">{{ $contact->email }}</td>
                <td class="admin-table__item">{{ $contact->category->content }}</td>
            </tr>
            @endforeach
        </tbody>
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