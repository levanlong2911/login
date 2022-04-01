<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Post</title>
</head>
<body>
    <h3>Danh sách Post</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            @php
                $slug = Str::slug($post->title);
                $url_post = route('news.detail', ['slug' => $slug, 'id' => $post->id]);
            @endphp
            <tr>
                <td scope="row">{{ $post->id }}</td>
                <td>
                    <a href="{{ $url_post }}">{{ $post->title }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>