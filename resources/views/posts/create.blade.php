@extends('layouts.app')
@section('stylesheets')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

    <div class="card card-default">
        <div class="card-header">

            {{isset($post)?"Update Post" :"Add a New Post"}}
        </div>
        <div class="card-body">
            <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="post">Title:</label>
                    <input  type="text"
                            placeholder="Enter a Post Title"
                            name="title"
                            class="@error('title') is-invalid @enderror form-control"
                            value="{{isset($post)? $post->title:old('title')}}"
                    >
                    @error('title')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="selectcategory">Categories:</label>--}}
{{--                    <select class="form-control" id="selectcategory" name="category">--}}
{{--                        @foreach($categories as $category)--}}
{{--                            <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                            @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="form-group">
                    <label for="selectcategory">Categories:</label>
                    <select class="form-control" id="selectcategory" name="category">
                        @foreach($categories as $category)
                           @if(isset($post))
                                @if($post->category_id==$category->id)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>



                @if(!$tags->count()<=0&&isset($post))
                    <div class="form-group">
                        <label for="selectTag">Select a tag ( ' can choose multiple tag by CTRL + Click ' )</label>
                        <select name="tags[]" class="form-control tags" id="selectTag" multiple>
                        @foreach ($tags as $tag)
                                <option value="{{$tag->id}}"
                                @if($post->hasTag($tag->id))
                                    selected
                                @endif
                                >
                                    {{$tag->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class="form-group">
                        <label for="selectTag">Select a tag ( ' can choose multiple tag by CTRL + Click ' )</label>
                        <select name="tags[]" class="form-control tags" id="selectTag" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">
                                    {{$tag->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="form-group">
                    <label for="post description">Description:</label>
                    <textarea class="form-control" rows="2" name="description" placeholder="Add a description">{{ isset($post) ? $post->description : old('description')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="post content">content:</label>
                    {{-- <textarea class="form-control" rows="3" name="content" placeholder="Add a content"></textarea> --}}
                    <input id="x" type="hidden" name="content" value="{{ isset($post) ? $post->content : old('content') }}">
                    <trix-editor input="x"></trix-editor>

                </div>

                @if (isset($post))
                    <div class="form-group">
                        <img src="{{asset('storage/' . $post->image)}}" style="width: 100%" />
                    </div>
                @endif
                <div class="form-group">
                    <label for="post image">Image:</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <input type="hidden" class="form-control" name="user_id" value="{{Auth()->user()->id}}">
                <div class="form-group">
                    <button type="submit" class="btn btn-success" >{{isset($post)?"Update" :"Add"}}</button>
                </div>

            </form>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.tags').select2();

        });

    </script>

@endsection




