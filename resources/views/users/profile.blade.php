@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            Profile
        </div>
        <div class="card-body">
            <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Name:</label>
                    <input  type="text"
                            name="name"
                            class="form-control"
                            value="{{isset($user)? $user->name:""}}"
                    >
                </div>
                <div class="form-group">
                    <label for="">Email:</label>
                    <input  type="email"
                            name="email"
                            class="form-control"
                            value="{{isset($user)? $user->email:""}}"
                    >
                </div>
                <div class="form-group">
                    <label for="">About:</label>
                    <textarea  type="text"
                               name="about"
                               class="form-control"
                               rows="2"
                               placeholder="Tell us about YourSelf"

                    >{{$profile->about}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Facebook:</label>
                    <textarea  type="text"
                            name="facebook"
                            class="form-control"
                               rows="2"

                               placeholder="Tell us about Your Facebook"
                    >{{ $profile->facebook}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Twitter:</label>
                    <textarea  type="text"
                               name="twitter"
                               class="form-control"
                               rows="2"

                               placeholder="Tell us about Your Twitter"

                    >{{ $profile->twitter}}</textarea>
                </div>

                @if (isset($user))
                    <div class="form-group">
                        Picture: <br>
                        <img src="{{$user->hasPicture()?asset('storage/'.$user->getPicture()):$user->getGravatar()}}" style="width: 100px;height: 100px;" />
                    </div>
                @endif
                <div class="form-group">
                    <label for="post image">Image:</label>
                    <input type="file" class="form-control" name="picture">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" >Update Profile</button>
                </div>

            </form>

        </div>
    </div>
@endsection







