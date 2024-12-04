<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    <title>Thanks</title>
</head>

<body>
    <form class="form" action="/" method="get">
        @csrf
        <div class="thank-you-background">
            <p>お問い合わせありがとうございました。</p>
            <button class="form__button-submit" type="submit">HOME</button> <!-- HOMEリンク -->
        </div>
    </form>

</body>

</html>