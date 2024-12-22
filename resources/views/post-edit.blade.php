<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <section>
    <div class="container py-5">
      <div class="row">
        <div class="col-md-5">
          @if(session()->has('success'))
          <div class="alert alert-success">
            {{ session()->get('success') }}
          </div>
          @endif
          <div class="card p-3">
            <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <h2>Post Title: {{$post->title}}</h2>
              <div class="mb-3">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" id="" value="{{$post->title}}">
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="">Image</label>
                <input type="file" class="form-control" name="image" id="">
                <img style="width:80px" src="{{asset('uploads/image/'.$post->image)}}" alt="">
                @error('image')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="">Body</label>
                <textarea name="body" class="form-control" cols="30" rows="10" id="" value="{{$post->body}}">{{$post->body}}</textarea>
                @error('body')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>