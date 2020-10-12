<!DOCTYPE html>
<html lang="ja">
<style>
    body {
        background-color: #fff;
    }

    h1 {
        font-size: 16px;
    }

    #button {
        width: 200px;
        text-align: center;
    }

    #button a {
        padding: 10px 20px;
        display: block;
        border: 1px solid #2a88bd;
        background-color: #FFFFFF;
        color: #2a88bd;
        text-decoration: none;
    }

    #button a:hover {
        background-color: #2a88bd;
        color: #FFFFFF;
    }
</style>

<body>
    <h1>
        パスワードのリセット
    </h1>
    <p>
        以下のボタンを押下し、パスワードリセットの手続きを行ってください。
    </p>
    <p id="button">
        <a href="{{$reset_url}}">パスワードのリセット</a>
    </p>
    <p>
        ＊有効期間は60分ですのでご注意下さい。
    </p>

    <p>
        もし本メールにお心当たりのない方はお手数ですが本メールを削除するようにお願い致します。
    </p>
</body>

</html>