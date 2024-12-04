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
<div class="admin-search">
    <form action="/admin/search" method="GET">
        @csrf
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
        <select name="gender">
            <option value="">性別</option>
            <option value="男性">男性</option>
            <option value="女性">女性</option>
            <option value="その他">その他</option>
        </select>
        <select name="category">
            <option value="">お問い合わせの種類</option>
            <!-- categoriesを動的に取得 -->
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->content }}</option>
            @endforeach
        </select>
        <input type="date" name="date" value="{{ old('date') }}">
        <button type="submit" class="search-button">検索</button>
        <button type="reset" class="reset-button">リセット</button>
    </form>
    <button class="export-button">エクスポート</button>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th>詳細</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $contact)
        <tr>
            <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
            <td>{{ $contact->gender }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content }}</td>
            <td><a href="/admin/contact/{{ $contact->id }}" class="details-button">詳細</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination">
    {{ $contacts->links('pagination::bootstrap-4') }}
</div>

@endsection