@extends('Backend.layouts.app')
@section('title') Client @endsection
@section('page_title') Client @endsection
@section('page_location')
    <li class="breadcrumb-item"><a href="/"> <i class="feather icon-home"></i> Home </a></li>
    <li class="breadcrumb-item"><a href="/client"> Client </a></li>
    <li class="breadcrumb-item"> Edit </li>
@endsection
@section('content')
    <form action="{{route('client.update',$client->client_id)}}" method="post" id="editForm" enctype="multipart/form-data">
        @csrf
        @method('put')
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
                                        {{ Form::file('client_image', ['class'=>'form-control dropify','data-default-file'=> $client->client_image ? '/images/client/'.$client->client_image :'/assets/images/blank.jpg','data-max-file-size'=>"4M"]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('client_name', 'Name*', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('client_name',$client->client_name,['class'=>'form-control','placeholder'=>'Enter Your Name']) }}
                                    </div>
                                </div>

                                <div class="form-group row form-radio">
                                    <label class="col-sm-3 col-form-label">Gender </label>
                                    <div class="radio col-form-label radio-outline radio-inline">
                                        <label class="">
                                            <input class="form-control" type="radio" name="client_gender" value="1" {{$client->client_gender==1 ? 'checked':''}}>
                                            <i class="helper"></i>Male
                                        </label>
                                    </div>
                                    <div class="radio radio-outline radio-inline col-form-label">
                                        <label class="">
                                            <input class="form-control" type="radio" name="client_gender" value="2" {{$client->client_gender==2 ? 'checked':''}}>
                                            <i class="helper"></i>Female
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('client_phone', 'Phone', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('client_phone',$client->client_phone,['class'=>'form-control','placeholder'=>'Enter Your Phone']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('client_email', 'Email*', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::email('client_email',$client->client_email,['class'=>'form-control','placeholder'=>'example@gmail.com']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('client_dob', 'Date of Birth*', ['class' => 'col-sm-7 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::date('client_dob',$client->client_dob,['class'=>'form-control','placeholder'=>'Your Birthday']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('permanent_address', 'Permanent Address', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::textarea('permanent_address',$client->permanent_address,['class'=>'form-control','placeholder'=>'Enter Your Permanent Address']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('present_address', 'Present Address*', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::textarea('present_address',$client->present_address,['class'=>'form-control','placeholder'=>'Enter Your Present Address']) }}
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
                                {{ Form::text('client_code',$client->client_code,['class'=>'form-control','placeholder'=>'Unique Code']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('inst_id', 'Institute*', ['class' => 'col-sm-7 col-form-label']) }}
                            <div class="col-sm-12">
                                <select name="inst_id" class="form-control">
                                    <option hidden selected disabled>---Select Institute---</option>
                                    @foreach($institutes as $institute)
                                        <option value="{{ $institute->inst_id }}" {{ $client->inst_id==$institute->inst_id ? 'selected' : '' }}>{{ $institute->inst_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('client_dept', 'Department*', ['class' => 'col-sm-7 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::text('client_dept',$client->client_dept,['class'=>'form-control','placeholder'=>'Enter Department']) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4">Document</label>
                            <div class="col-sm-12">
                            @foreach($client->clientdoc as $doc)
                                @php $type=null; @endphp
                                    @if($doc->doc_type=='nid')
                                        @php $type="National ID Card"; @endphp
                                    @elseif($doc->doc_type=='bc')
                                        @php $type="Birth Certificate"; @endphp
                                    @else
                                        @php $type="College ID"; @endphp
                                    @endif
                                    <div class='doc_down'><a href='/client/doc/{{$doc->client_doc_id}}'><p class='text-custom'>
                                        {{$type}} &nbsp<i class='fa fa-link'></i></a>&nbsp &nbsp<a href="/client/doc/{{$doc->client_doc_id}}/delete" onclick="event.preventDefault(); Delete( {{$doc->client_doc_id}} );"><i class="fa fa-trash text-danger"></i></a></p> </div>
                            @endforeach
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
                                        {{ Form::textarea('details',$client->details,['class'=>'form-control','placeholder'=>'Any Details','rows'=>'3']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">
                                    {{ Form::label('status', 'Status', ['class' => 'col-sm-7 col-form-label']) }}
                                    <div class="col-sm-12">
                                        <select name="status" class="form-control" id="status">
                                            <option value="1" {{$client->status==1?'selected':''}}>On</option>
                                            <option value="2" {{$client->status==2?'selected':''}}>Off</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <a href="/client/" class="btn">Back</a>
                                {{ Form::submit('Save Changes',['class'=>'btn btn-success']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    <form method="post" id="deleteForm">
        @csrf
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
                        $form.attr('action',`/client/doc/${id}/delete`);
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
