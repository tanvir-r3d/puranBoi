@extends('Backend.layouts.app')
@section('title') Institute @endsection
@section('page_title') Institute @endsection
@section('page_location')
<li class="breadcrumb-item"><a href="/"> <i class="feather icon-home"></i> Home </a></li>
<li class="breadcrumb-item"> Institute </li>
@endsection
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header table-card-header">
                <div class="row">
                    <div class="col-md-10"><h4>Institute List</h4></div>
<div class="col-md-2"><button class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal" >Add Institute</button></div>

                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th width=10>Action</th>
                        </tr>
                    </thead>
                    <form method="post" id="deleteForm">
                        @method('delete')
                        @csrf
                    </form>
                        <tbody>
                            @foreach ($institutes as $institute)
                            <tr>
                                <td><input type="checkbox" data-id="{{ $institute->inst_id }}"></td>
                                <td>{{ $institute->inst_name }}</td>
                                <td>{{ $institute->inst_details }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit" data-id="{{$institute->inst_id}}" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>
                                    <a href="{{ route('institute.destroy',($institute->inst_id)) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault(); Delete({{ $institute->inst_id }});"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
            </div>
        </div>

    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Insitute Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'institute.store','id'=>'addForm']) !!}
                <div class="form-group row">
                    {{ Form::label('inst_name', 'Name*', ['class' => 'col-sm-5 col-form-label']) }}
                    <div class="col-sm-12">
                        {{ Form::text('inst_name','',['class'=>'form-control','placeholder'=>'Enter Institute Name']) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('inst_details', 'Details', ['class' => 'col-sm-5 col-form-label']) }}
                    <div class="col-sm-12">
                        {{ Form::textarea('inst_details','',['class'=>'form-control','placeholder'=>'Enter Institute Details']) }}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                {{ Form::reset('Reset',['class'=>'btn']) }}
                {{ Form::submit('Submit',['class'=>'btn btn-success']) }}
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insitute Update</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id'=>'editForm','method'=>'put']) !!}
                    <div class="form-group row">
                        {{ Form::label('inst_name', 'Name*', ['class' => 'col-sm-5 col-form-label']) }}
                        <div class="col-sm-12">
                            {{ Form::text('inst_name','',['class'=>'form-control','placeholder'=>'Enter Institute Name','id'=>'e_inst_name']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('inst_details', 'Details', ['class' => 'col-sm-5 col-form-label']) }}
                        <div class="col-sm-12">
                            {{ Form::textarea('inst_details','',['class'=>'form-control','placeholder'=>'Enter Institute Details','id'=>'e_inst_details']) }}
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    {{ Form::reset('Reset',['class'=>'btn']) }}
                    {{ Form::submit('Submit',['class'=>'btn btn-success']) }}
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    $("#dataTable").DataTable();
    $(".edit").click(function(){
        var id=$(this).attr("data-id");
        $.ajax({
            url:"/institute/"+id+"/edit",
            type:'get',
            data:{"_token":"{{ csrf_token() }}"},
            dataType:"json",
            success:function(data)
            {
                $("#e_inst_name").val(data.inst_name);
                $("#e_inst_details").val(data.inst_details);
                $("#editForm").attr("action","/institute/"+id);
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

                $form.attr('action','/institute/'+id);
                $form.submit()
            }, true],
            ['<button>NO</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
        ],
    });
}
</script>
{!! $validator->selector('#addForm') !!}
@endsection
