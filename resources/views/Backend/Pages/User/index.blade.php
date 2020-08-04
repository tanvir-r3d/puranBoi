@extends('Backend.layouts.app')
@section('title') User @endsection
@section('page_title') User @endsection
@section('page_location')
<li class="breadcrumb-item"><a href="/"> <i class="feather icon-home"></i> Home </a></li>
<li class="breadcrumb-item"> User </li>
@endsection
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header table-card-header">
                <div class="row">
                    <div class="col-md-10"><h4>User List</h4></div>
<div class="col-md-2"><a class="btn btn-primary float-right" href="/user/create">Add User</a></div>

                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Profile</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th width=10>Action</th>
                        </tr>
                    </thead>
                    <form method="post" id="deleteForm">
                        @method('delete')
                        @csrf
                    </form>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td><input type="checkbox" data-id="{{ $user->id }}"></td>
                                <td>{{ $user->name }}</td>
                                <td style="text-align: center"><img src="{{ $user->image ? '/images/user/'.$user->image : '/images/blank.jpg'}}" alt="profile" width="45"></td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                <button class="btn btn-sm btn-info show" data-toggle="modal" data-target="#showModal" data-id="{{ $user->id }}"><i class="icofont icofont-eye-alt"></i></button>
                                    <a href="/user/{{ Crypt::encryptString($user->id) }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('user.destroy',($user->id)) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault(); Delete({{ $user->id }});"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Profile</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
            </div>
        </div>

    </div>
</div>

{{-- Show Modal --}}
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card user-card">
                    <div class="card-header-img">
                        <img class="img-fluid img-radius" id="image" alt="user-img">
                        <h4 id="name"></h4>
                        <h5 id="email"></h5>
                        <h6 id="phone"></h6>
                        <h6>Systems Administrator</h6>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="label-icon">
                                <i class="icofont icofont-bell-alt"></i>
                                <label class="badge badge-primary badge-top-right">9</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="label-icon">
                                <i class="icofont icofont-heart"></i>
                                <label class="badge badge-success badge-top-right">9</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="label-icon">
                                <i class="icofont icofont-bag-alt"></i>
                                <label class="badge badge-danger badge-top-right">9</label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    $("#dataTable").DataTable();
    $(".show").click(function(){
        var id=$(this).attr("data-id");
        $.ajax({
            url:"/user/"+id,
            type:'get',
            data:{"_token":"{{ csrf_token() }}"},
            dataType:"json",
            success:function(data)
            {
                $("#name").text(data.name);
                $("#email").text(data.email);
                if(data.phone){
                    $("#phone").text(data.phone);
                }
                else{
                    $("#phone").text("Not Set")
                }
                if(data.image){
                    $("#image").attr('src','/images/user/'+data.image);
                }
                else{
                    $("#image").attr('src','/images/blank.jpg');
                }
            }
        });
    });
});
function Delete(id){
    var id=id;
    iziToast.question({
        timeout: 20000,
        close: true,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Wait!',
        message: 'Are you sure? Once Deleted Can\'t be undone!',
        position: 'center',
        buttons: [
            ['<button><b>YES</b></button>', function () {
                var $form = $("#deleteForm").closest('form');

                $form.attr('action','/user/'+id);
                $form.submit()
            }, true],
            ['<button>NO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
        ],
    });
}
</script>
@endsection
