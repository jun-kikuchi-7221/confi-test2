@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <p>Contact</p>
    </div>
    <form class="form" action="/contacts/confirm" method="post" novalidate>
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--name1">
                    <input type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name') }}" />
                    <div class="form__error1">
                        @error('first_name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group-content">
                <div class="form__input--name2">
                    <input type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name') }}" />
                    <div class="form__error">
                        @error('last_name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--gender-text">
                    <label class="custom-radio">
                        <input type="radio" name="gender" value="1" checked>
                        <span class="radio-circle"></span>
                        男性
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="gender" value="2">
                        <span class="radio-circle"></span>
                        女性
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="gender" value="3">
                        <span class="radio-circle"></span>
                        その他
                    </label>
                    <div class="form__error">
                        @error('gender')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--email3">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
                <!-- <label for="phone-number">電話番号 <span style="color: red;"> ※</span></label> -->
            </div>
            <div class="form__group-content">
                <div class="form__input--tel4">
                    <input type="text" id="tel1" name="tel1" maxlength="10" size="10" placeholder="080" value="{{ old('tel1') }}" />
                    <span class="separator">-</span>
                    <input type="text" id="tel2" name="tel2" maxlength="10" size="10" placeholder="1234" value="{{ old('tel2') }}" />
                    <span class="separator">-</span>
                    <input type="text" id="tel3" name="tel3" maxlength="10" size="10" placeholder="5678" value="{{ old('tel3') }}" />
                    <div class="form__error">
                        @error('tel1')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text5">
                    <input class="address-input" type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                    <div class="form__error">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text6">
                    <input class="building-input" type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}" />
                    <div class="form__error">
                        @error('building')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="custom-select-container">
                <select class="custom-select" name="category_id">
                    <option value="">選択してください</option>
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                    @endforeach
                </select>
                <div class="form__error">
                    @error('category')
                    {{ $message }}
                    @enderror
                </div>

                <!-- <div class="search-form__item">
                    <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}">
                    <select class="search-form__item-select" name="category_id">
                        <option value="">カテゴリ</option>
                       
                    </select>
                </div> -->

            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="資料をいただきたいです" value="{{ old('detail') }}"></textarea>
                    <div class="form__error">
                        @error('detail')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection