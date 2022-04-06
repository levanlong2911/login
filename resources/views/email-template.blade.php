<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
    <h3>Xin chào!</h3>
    <p>Thân gửi {!! $mail_data['email'] !!}</p>
    <p>Cảm ơn bạn đã đăng ký, vui lòng click đường link phía dưới để hoàn tất công việc đăng ký và đăng nhập vào tài khoản</p>
    <a href="{{ $mail_data['actionLink'] }}">{{ $mail_data['actionLink'] }}</a>
</body>
</html>