@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">

            {{isset($tag)?"Update Tag" :"Add a New Tag"}}
        </div>
        <div class="card-body">
            <form action="{{isset($tag)?route('tags.update',$tag->id):route('tags.store')}}" method="POST">
                @csrf
                @if (isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="">Tag Name:</label>
                    <input  type="text"
                            placeholder="Enter a Tag Name"
                            name="name"
                            class="@error('name') is-invalid @enderror form-control"
                            value="{{isset($tag)? $tag->name:""}}"
                    >

                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button class="btn btn-success" >{{isset($tag)?"Update" :"Add"}}</button>
                </div>

            </form>

        </div>
    </div>
@endsection







