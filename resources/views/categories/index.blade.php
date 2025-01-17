@extends('layouts.app')

@section('content')
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>
    @endif

    <div class="clearfix">
        <a href="{{route('categories.create')}}"
           class="btn float-right btn-success"
           style="margin-bottom: 10px"
        >
           Add Category
        </a>
    </div>
    <div class="card">
        <div class="card-header">
            <h1>All Categories</h1>
        </div>
        @if($categories->count()>0)
        <div class="card-body">


                    <table class="table">
                        <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>

                            <td>
                                <form class="float-right ml-2" action="{{route('categories.destroy',$category->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="{{route('categories.edit',$category->id)}} "
                                   class="btn btn-primary float-right btn-sm">
                                    Edit
                                </a>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>

        </div>
    </div>
    @else
        <div class="card-body">
            <h1 class="text-center">No Categories Yet.</h1>
        </div>
    @endif


@endsection
