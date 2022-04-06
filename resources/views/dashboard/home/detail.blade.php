<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Detail</title>
</head>
<body>
  <h3>{{ $posts->title }}</h3>
  <p>{{ $posts->content }}</p>
  <h5>Bình luận bài viết</h5>
  <form action="{{ route('user.comment.add') }}" method="post">
    @csrf
    <div class="form-group">
      <label for=""></label>
      <textarea name="comment" id="comment" cols="60" rows="5"></textarea>
    </div>
    <input type="hidden" name="post_id" value="{{ $posts->id }}">
    {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> //so sánh với id bài --}}  
    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Gửi bình luận">
  </form>
  <div>
    <h4>Hiển thị bình luận</h4>
    <div>
      
      @foreach ($posts->comments as $comment )
        <h5>{{ $comment->user->name }}</h5>
        <p>{{ $comment->comment }}</q>
      @endforeach
      
    </div>
  </div>
</body>
</html>