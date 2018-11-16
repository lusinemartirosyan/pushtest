@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Notification</div>
                    <form enctype="multipart/form-data" method="post" action="{{route('create.notification')}}">
                        {{csrf_field()}}
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Notification Title">
                            </div>
                            <div class="form-group">
                                <textarea id="body" name="body" class="form-control" placeholder="Notification body"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="link" name="link" placeholder="Link">
                            </div>
                            <div class="form-group">
                                <input type="file" name="file" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input class="btn" type="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection