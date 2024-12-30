
@extends('layouts.app')

@section('header-button')
<form class="header-btn" method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="btn-logout" type="submit">logout</button>
</form>

{{-- <div class="header-btn">
    <button class="btn-logout" type="submit" href="/logout">logout</button>
</div> --}}
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
        <p class="p1">Admin</p>
    </div>
</div>
<div class='admin__content'>
    <form class="admin-form__content" action="{{ route('admin.search') }}" method="get">
        @csrf
        <div class="admin-form__content-item">
            <input class="form-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword', $request->keyword) }}">
            <!-- value="{{ old('keyword') }}"> -->
            <select class="form-select" name="gender">
                {{-- <option value="">性別</option> --}}
                <option value="" disabled selected>性別</option> <!-- デフォルトで表示 -->
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
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

<div class="pagination-container">
    <div class="left-content">
        <!-- エクスポートボタン -->
        <a class="btn-export" href="{{ route('admin.export', request()->all()) }}">
            エクスポート
        </a>
        <!-- 成功メッセージ -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="pagination-wrapper">
        <div class="pagination">
            <a href="{{ $contacts->appends(request()->query())->previousPageUrl() }}" 
            class="pagination-arrow {{ $contacts->onFirstPage() ? 'disabled' : '' }}">＜</a>

                        <!-- 数字部分 (現在ページを中心に5個分だけ表示) -->
                @php
                    $start = max($contacts->currentPage() - 2, 1); // 開始ページ
                    $end = min($start + 4, $contacts->lastPage()); // 終了ページ

                    // 開始と終了を調整 (5個分確保)
                    if (($end - $start) < 4) {
                        $start = max($end - 4, 1);
                    }
                 @endphp
            @for ($i = $start; $i <= $end; $i++)
            {{-- @for ($i = 1; $i <= $contacts->lastPage(); $i++) --}}
            <a href="{{ $contacts->appends(request()->query())->url($i) }}" 
            class="pagination-number {{ $i == $contacts->currentPage() ? 'active' : '' }}">{{ $i }}</a>
            @endfor

            <!-- 次のページ -->
            <a href="{{ $contacts->appends(request()->query())->nextPageUrl() }}" 
            class="pagination-arrow {{ !$contacts->hasMorePages() ? 'disabled' : '' }}">＞</a>
        </div>
    </div>
</div>



<div class="admin-table">
    <table class="admin-table__inner">
        <thead>
            <tr class="admin-table__row">
                <th class="admin-table__header-span">お名前</th>
                <th class="admin-table__header-span">性別</th>
                <th class="admin-table__header-span">メールアドレス</th>
                <th class="admin-table__header-span">お問い合わせの種類</th>
                <th class="admin-table__header-span"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr class="admin-table__row1">
                <td class="admin-table__item">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td class="admin-table__item">{{ $contact->gender_label }}</td>
                <td class="admin-table__item">{{ $contact->email }}</td>
                <td class="admin-table__item">{{ $contact->category->content }}</td>
                <td class="admin-table__item2">
                     <!-- モーダル表示ボタン -->
                    <button class="btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal{{ $contact->id }}">
                        詳細
                    </button>
                </td>
            </tr>
            <!-- モーダル -->
            <div class="modal fade" id="contactModal{{ $contact->id }}" data-bs-backdrop="static" 
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel{{ $contact->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-custom">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>名前:</strong> <span>{{ $contact->last_name }} {{ $contact->first_name }}</span></p>
                                <p><strong>性別:</strong> <span>{{ $contact->gender_label }}</span></p>
                                <p><strong>メールアドレス:</strong> <span>{{ $contact->email }}</span></p>
                                <p><strong>電話番号:</strong> <span>{{ $contact->tel }}</span></p>
                                <p><strong>住所:</strong> <span>{{ $contact->address }}</span></p>
                                <p><strong>建物名:</strong> <span>{{ $contact->building }}</span></p>
                                <p><strong>お問い合わせの種類:</strong> <span>{{ $contact->category->content }}</span></p>
                                <p><strong>お問い合わせ内容:</strong> <span>{{ $contact->detail }}</span></p>
                                <!-- 削除ボタン -->
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn-danger">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
{{-- @else
<p>LOGINに失敗しました。</p>
<div class="header-btn">
    <a class="btn-logout" type="submit" href="/login">login</a>
</div>
@endif --}}