@extends('Backend.layouts.app')
@section('title') Client @endsection
@section('page_title') Client @endsection
@section('page_location')
<li class="breadcrumb-item"><a href="/"> <i class="feather icon-home"></i> Home </a></li>
<li class="breadcrumb-item"> Client </li>
@endsection
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header table-card-header">
                <div class="row">
                    <div class="col-md-10"><h4>Client List</h4></div>
<div class="col-md-2"><a class="btn btn-primary float-right" href="/client/create">Add Client</a></div>

                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Institute</th>
                            <th>Department</th>
                            <th width=10>Action</th>
                        </tr>
                    </thead>
                    <form method="post" id="deleteForm">
                        @method('delete')
                        @csrf
                    </form>
                        <tbody>
                            @foreach ($clients as $client)
                            <tr>
                                <td><input type="checkbox" data-id="{{ $client->client_id }}"></td>
                                <td>{{ $client->client_name }}</td>
                                <td>{{ $client->client_code }}</td>
                                <td>{{ $client->client_phone }}</td>
                                <td>{{ $client->client_email }}</td>
                                <td>{{ $client->institute->inst_name }}</td>
                                <td>{{ $client->client_dept }}</td>
                                <td>
                                <button class="btn btn-sm btn-info show" data-toggle="modal" data-target="#showModal" data-id="{{ $client->client_id }}"><i class="icofont icofont-eye-alt"></i></button>
                                    <a href="/client/{{ $client->client_id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('client.destroy',($client->client_id)) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault(); Delete({{ $client->client_id }});"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Institute</th>
                            <th>Department</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Client Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row invoice-contact">
                        <div class="col-md-7">
                            <div class="invoice-box row">
                                <div class="col-sm-12">
                                    <table class="table table-responsive invoice-table table-borderless">
                                        <tbody>
                                        <tr>
                                            <td id="client_code"></td>
                                        </tr>
                                        <tr>
                                            <td id="client_name"></td>
                                        </tr>
                                        <tr>
                                            <td id="client_email"></td>
                                        </tr>
                                        <tr>
                                            <td id="client_phone"></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5" style="text-align: center">
                            <img class="img-fluid" id="client_image" width="270">
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row invoive-info">
                            <div class="col-md-4 col-xs-12 invoice-client-info">
                                <h6>Client Information :</h6>
                                <h6 class="m-0 text-primary">Present Address</h6>
                                <p class="m-0 m-t-10" id="present_address"></p>
                                <h6 class="m-0 text-primary">Permanent Address</h6>
                                <p class="m-0 m-t-10" id="permanent_address"></p>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                    <tbody>
                                    <tr>
                                        <th class="text-primary">Birth Date:</th>
                                        <td id="client_dob"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">Gender:</th>
                                        <td id="client_gender"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">Details:</th>
                                        <td id="details"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <h6 class="m-b-20">Institute: <span id="inst"></span></h6>
                                <h6 class="text-uppercase">Department :
                                    <span id="client_dept"></span>
                                </h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="text-primary">Docuements:</h6>
                                <div id="docs"></div>
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
            url:"/client/"+id,
            type:'get',
            data:{"_token":"{{ csrf_token() }}"},
            dataType:"json",
            success:function(data)
            {
                $("#client_code").text(data.client_code);
                $("#client_name").text(data.client_name);
                $("#client_email").text(data.client_email);
                $("#client_dob").text(data.client_dob);
                $("#present_address").text(data.present_address);
                $("#permanent_address").text(data.permanent_address);
                $("#client_gender").text(data.client_gender=='1'?'Male':'Female');
                $("#details").text(data.details);
                $("#inst").text(data.institute.inst_name);
                $("#client_dept").text(data.client_dept);
                $(".doc_down").remove();
                $.each(data.clientdoc, function(k,v){
                    var type=null;
                    if(v.doc_type=='nid') { type="National ID Card" ; }
                    else if(v.doc_type=='bc') { type="Birth Certificate"; }
                    else{ type="College ID"; }
                    $("#docs").append(`<div class='doc_down'><a href='/client/doc/${v.client_doc_id}'><p class='text-custom'>${type}&nbsp<i class='fa fa-link'></i></a></p></div>`);
                });
                if(data.client_phone){
                    $("#client_phone").text(data.client_phone);
                }
                else{
                    $("#client_phone").text("Not Set")
                }
                if(data.client_image){
                    $("#client_image").attr('src','/images/client/'+data.client_image);
                }
                else{
                    $("#client_image").attr('src','/images/blank.jpg');
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

                $form.attr('action','/client/'+id);
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
