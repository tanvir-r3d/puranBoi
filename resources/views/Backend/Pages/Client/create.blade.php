@extends('Backend.layouts.app')
@section('title') Client @endsection
@section('page_title') Client @endsection
@section('page_location')
<li class="breadcrumb-item"><a href="/"> <i class="feather icon-home"></i> Home </a></li>
<li class="breadcrumb-item"><a href="/client"> Client </a></li>
<li class="breadcrumb-item"> Create </li>
@endsection
@section('content')
    <form action="{{route('client.store')}}" method="post" id="addForm" enctype="multipart/form-data">
        @csrf
        <div class="row">

    <div class="col-sm-7">
        <div class="card">
            <div class="card-header">
                <h5>Create Client</h5>
                <span>Those Service Users Information.</span>
                <div class="card-header-right">
                    <i class="icofont icofont-spinner-alt-5"></i>
                </div>
            </div>

            <div class="card-block">
                <h4 class="sub-title"> Basic Info </h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('client_image', 'Client Image', ['class' => 'col-sm-7 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::file('client_image', ['class'=>'form-control dropify','data-default-file'=>'/assets/images/blank.jpg','data-max-file-size'=>"4M"]) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            {{ Form::label('client_name', 'Name*', ['class' => 'col-sm-5 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::text('client_name','',['class'=>'form-control','placeholder'=>'Enter Your Name']) }}
                            </div>
                        </div>

                        <div class="form-group row form-radio">
                            <label class="col-sm-3 col-form-label">Gender </label>
                            <div class="radio col-form-label radio-outline radio-inline">
                                    <label class="">
                                        <input class="form-control" type="radio" name="client_gender" value="1">
                                        <i class="helper"></i>Male
                                    </label>
                                </div>
                                <div class="radio radio-outline radio-inline col-form-label">
                                    <label class="">
                                        <input class="form-control" type="radio" name="client_gender" value="2">
                                        <i class="helper"></i>Female
                                    </label>
                                </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('client_phone', 'Phone', ['class' => 'col-sm-5 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::text('client_phone','',['class'=>'form-control','placeholder'=>'Enter Your Phone']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            {{ Form::label('client_email', 'Email*', ['class' => 'col-sm-5 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::email('client_email','',['class'=>'form-control','placeholder'=>'example@gmail.com']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            {{ Form::label('client_dob', 'Date of Birth*', ['class' => 'col-sm-7 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::date('client_dob','',['class'=>'form-control','placeholder'=>'Your Birthday']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            {{ Form::label('permanent_address', 'Permanent Address', ['class' => 'col-sm-5 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::textarea('permanent_address','',['class'=>'form-control','placeholder'=>'Enter Your Permanent Address']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            {{ Form::label('present_address', 'Present Address*', ['class' => 'col-sm-5 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::textarea('present_address','',['class'=>'form-control','placeholder'=>'Enter Your Present Address']) }}
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            <h5>Client Credentials</h5>
            <div class="card-header-right">
                <i class="icofont icofont-spinner-alt-5"></i>
            </div>
        </div>
        <div class="card-block">

            <div class="form-group row">
                {{ Form::label('client_code', 'Code*', ['class' => 'col-sm-7 col-form-label']) }}
                <div class="col-sm-12">
                    {{ Form::text('client_code','',['class'=>'form-control','placeholder'=>'Unique Code']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('inst_id', 'Institute*', ['class' => 'col-sm-7 col-form-label']) }}
                <div class="col-sm-12">
                    <select name="inst_id" class="form-control">
                        <option hidden selected disabled>---Select Institute---</option>
                        @foreach($institutes as $institute)
                            <option value="{{ $institute->inst_id  }}">{{ $institute->inst_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('client_dept', 'Department*', ['class' => 'col-sm-7 col-form-label']) }}
                <div class="col-sm-12">
                    {{ Form::text('client_dept','',['class'=>'form-control','placeholder'=>'Enter Department']) }}
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4">Document</label>
                <div class="col-sm-12">
                    <table>
                        <input type="hidden" name="row_no" id="row_no" value=1>
                        <tr>
                            <td>
                                <select class='form-control' name="doc_type[]">--}}
                                    <option selected hidden disabled>Select Type</option>
                                    <option value='nid'>NID</option>
                                    <option value='bc'>Birth Certificate</option>
                                    <option value='collegeid'>College ID</option>
                                </select>
                            </td>
                            <td><input type='file' name='client_doc[]' class='form-control'></td>
                            <td><button class='btn btn-success add_field' type="button"><i class="fa fa-plus"></i></button></td>
                        </tr>
                    </table>
                    <div class="input_field"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group row">
                        {{ Form::label('details', 'Details', ['class' => 'col-sm-7 col-form-label']) }}
                        <div class="col-sm-12">
                            {{ Form::textarea('details','',['class'=>'form-control','placeholder'=>'Any Details','rows'=>'3']) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group row">
                        {{ Form::label('status', 'Status', ['class' => 'col-sm-7 col-form-label']) }}
                        <div class="col-sm-12">
                            <select name="status" class="form-control" id="status">
                                <option value="1">on</option>
                                <option value="2">Off</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-7">

                </div>
                <div class="col-md-5">
                {{ Form::reset('Reset',['class'=>'btn']) }}
                {{ Form::submit('Submit',['class'=>'btn btn-success']) }}
            </div>
            </div>
        </div>
    </div>
</div>
</form>

</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var max_field = 6;
            var wrapper = $(".input_field");
            var add_field = $(".add_field");
            var i = 1;
            $(add_field).click(function(e) {
                e.preventDefault();
                if(i < max_field) {
                    i++;
                    $("#row_no").val(i);
                    $(wrapper).append(`<div>
                    <table>
                      <tr>
                          <td>
                            <select class='form-control' name="doc_type[]">
                                <option selected hidden disabled>Select Type</option>
                                <option value='nid'>NID</option>
                                <option value='bc'>Birth Certificate</option>
                                <option value='collegeid'>College ID</option>
                            </select>
                          </td>
                          <td>
                           <input type='file' name='client_doc[]' class='form-control'>
                          </td>
                          <td>
                            <button class='btn btn-danger remove_field' style='margin-left: 8px;'><i class='fa fa-trash'></i></button>
                          </td>
                      </tr>
                    </table></div>`);
                }
            });
            $(wrapper).on("click", ".remove_field", function(e) {
                e.preventDefault();
                $(this).closest('div').remove(); i--;
                $("#row_no").val(i);
            });
        });
    </script>
<script>
$('.dropify').dropify();
</script>
{!! $validator->selector('#addForm') !!}
@endsection
