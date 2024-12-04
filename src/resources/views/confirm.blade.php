@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <p>Confirm</p>
    </div>
    <form class="form" action="/contacts" method="POST">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        {{ $contact['last_name'] }}　 {{ $contact['first_name'] }}
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        @if($contact['gender'] === '1')
                        男性
                        @elseif($contact['gender'] === '2')
                        女性
                        @else($contact['gender'] === '3')
                        その他
                        @endif
                        <!-- {{ $contact['gender'] === 'male' ? '男性' : ($contact['gender'] === 'female' ? '女性' : 'その他') }} -->
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        {{ $contact['email'] }}
                        <input type="hidden" name="email" value="{{ $contact['email'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        {{ $contact['tel'] }}
                        <input type="hidden" name="tel" value="{{ $contact['tel'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        {{ $contact['address'] }}
                        <input type="hidden" name="address" value="{{ $contact['address'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        {{ $contact['building'] }}
                        <input type="hidden" name="building" value="{{ $contact['building'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        {{ $contact['category'] }}
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text1">
                        {{ $contact['detail'] }}
                        <input type="hidden" name="detail" value="{{ $contact['detail'] }}" />
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">送信</button>
            <button class="form__button-submit--fixes" type="button" onclick="history.back()">修正</button>
        </div>
    </form>

</div>
@endsection