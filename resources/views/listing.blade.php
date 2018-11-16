@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Body</th>
                            <th scope="col">Image</th>
                            <th scope="col">Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ $notification->id  }}</td>
                                <td>{{ $notification->title  }}</td>
                                <td>{{ $notification->body  }}</td>
                                <td> <img src="{{URL::asset('/images/'.$notification->image)}}" alt="profile Pic" height="auto" width="80"></td>
                                <td>{{ $notification->created_at  }}</td>
                                <td>@if($notification->id == 1)
                                        <button>Notification is sent</button>
                                    @else
                                        <button id="sendpushbtn" onclick="update({{ $notification->id  }});" >Send push notification</button><br></td>
                                    @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    function update(id)
    {
        $.ajax({
            type: "post",
            url: "/admin/notification/send",
            data: {
                id: id
            },
            success: function(result) {
                var el = document.getElementById('sendpushbtn');
                el.firstChild.data = "Notification is sent";
            },
            error: function(result) {
                alert('error');
            }
        });
    }
</script>
@endsection