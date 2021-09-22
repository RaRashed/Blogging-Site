@extends('layouts.app')
@section('content')

<div class="card card-default">
    <div class="card-header">
       {{isset($post) ? 'Edit Post' : 'Create Post'}}
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card-body">
        <form action="{{isset($post) ? route('posts.update',$post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($post))
            @method('PUT')

            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" value="{{isset($post) ? $post->title :'' }}" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" cols="5" rows="5" name="description" id="description">
                    {{isset($post) ? $post->description : ''}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                 <input id="content" type="hidden" value="{{isset($post) ? $post->content :''}}" name="content">
                <trix-editor input="content"></trix-editor>
            </div>
            @if (isset($post))
            <div class="form-group">
                <label for="image">Image</label>
                <img src="{{asset('storage/'.$post->image)}}" alt="" style="width:100%;">
            </div>

            @endif
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach ($categories as $category )
                    <option value="{{$category->id}}"
                       @if (isset($post))
                       @if ($category->id == $post->category_id)
                       selected

                       @endif

                       @endif

                        >{{$category->name}}</option>

                    @endforeach
                </select>

            </div>


            @if ($tags->count() > 0)

            <div class="form-group">
                <label for="tag">tags</label>
                <select name="tags[]" id="tag" class="form-control tags_selector" multiple>
                    @foreach ($tags as $tag )
                    <option value="{{$tag->id}}"
                        @if (isset($post))

                        @if ($post->hasTag($tag->id))

                        selected

                        @endif

                        @endif


                        >{{$tag->name}}</option>

                    @endforeach
                </select>

            </div>

            @endif

            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="text" class="form-control" value="{{isset($post) ? $post->published_at :''}}" name="published_at" id="published_at">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{isset($post) ? 'Update Post' : 'Create Post'}}
                </button>
            </div>



        </form>

    </div>
</div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    flatpickr('#published_at',{
        enableTime:true,
        enableSeconds:true
    })

    $(document).ready(function() {
        $('.tags_selector').select2();
    })
</script>

@endsection


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@endsection
