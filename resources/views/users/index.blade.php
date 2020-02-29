@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">All Users</div>
        @if($users->count()>0)
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>UserName</th>
                        <th>Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><img src="{{$user->hasPicture()?asset('storage/'.$user->getPicture()):$user->getGravatar()}}"
                                     class="rounded-circle"
                                     alt=""
                                     width="60px"
                                     height="60px"
                                     ></td>

                            <td>{{$user->name}}</td>
                            <td>
                            @if(!$user->isAdmin())
                                    <form class="" action="{{route('users.make-admin',$user->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm" type="submit">Make Admin</button>
                                    </form>
                                @else
                                    {{$user->role}}
                                @endif
                            </td>
{{--                            <td>--}}
{{--                                <form class="float-right ml-2" action="{{route('users.destroy',$user->id)}}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button class="btn btn-danger btn-sm">{{$post->trashed()?'Delete':'Trash'}}</button>--}}
{{--                                </form>--}}
{{--                                @if(!$post->trashed())--}}
{{--                                    <a href="{{route('posts.edit',$post->id)}} "--}}
{{--                                       class="btn btn-primary float-right btn-sm">--}}
{{--                                        Edit--}}
{{--                                    </a>--}}
{{--                                @else--}}
{{--                                    <a href="{{route('trashed.restore',$post->id)}} "--}}
{{--                                       class="btn btn-primary float-right btn-sm">--}}
{{--                                        Restore--}}
{{--                                    </a>--}}
{{--                                @endif--}}

{{--                            </td>--}}

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        @else
            <div class="card-body">
                <h1 class="text-center">No Users Yet.</h1>
            </div>
        @endif


    </div>



@endsection
