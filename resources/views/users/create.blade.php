@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">

            {{isset($user)?"Update User" :"Add a New User"}}
        </div>
        <div class="card-body">
            <form action="{{isset($user)?route('users.update',$tag->id):route('users.store')}}" method="POST">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="">UserName:</label>
                    <input  type="text"
                            placeholder="Enter a User Name"
                            name="name"
                            class="@error('name') is-invalid @enderror form-control"
                            value="{{isset($tag)? $tag->name:""}}"
                    >

                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Role:</label>
                    <input  type="text"
                            placeholder="Enter a User Role"
                            name="role"
                            class="@error('role') is-invalid @enderror form-control"
                            value="{{isset($tag)? $tag->name:""}}"
                    >

                    @error('role')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button class="btn btn-success" >{{isset($user)?"Update" :"Add"}}</button>
                </div>

            </form>

        </div>
    </div>
@endsection







