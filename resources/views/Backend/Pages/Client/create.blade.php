@extends('Backend.layouts.app')
@section('title') Client @endsection
@section('page_title') Client @endsection
@section('page_location')
<li class="breadcrumb-item"><a href="/"> <i class="feather icon-home"></i> Home </a></li>
<li class="breadcrumb-item"><a href="/user"> Client </a></li>
<li class="breadcrumb-item"> Create </li>
@endsection
@section('content')
{!! Form::open(['route' => 'user.store','id'=>'addForm','enctype'=>'multipart/form-data']) !!}
<div class="row">

    <div class="col-sm-8">
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

                    @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div style="text-align: center">
                            <img id="previmage" class="img-fluid" width="200" src="/assets/images/blank.jpg" alt="round-img">
                        </div>
                        <div class="form-group row mt-2">
                            {{-- {{ Form::label('image', 'Upload Image', ['class' => 'col-sm-5 col-form-label']) }} --}}
                            <div class="col-sm-12">
                                {{ Form::file('image', ['class'=>'form-control','onchange'=>'readURL(this);']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            {{ Form::label('name', 'Name', ['class' => 'col-sm-5 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::text('name','',['class'=>'form-control','placeholder'=>'Enter Your Name']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('phone', 'Phone', ['class' => 'col-sm-5 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::text('phone','',['class'=>'form-control','placeholder'=>'Enter Your Phone']) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('email', 'Email', ['class' => 'col-sm-5 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::email('email','',['class'=>'form-control','placeholder'=>'example@gmail.com']) }}
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
                            {{ Form::label('present_address', 'Present Address', ['class' => 'col-sm-5 col-form-label']) }}
                            <div class="col-sm-12">
                                {{ Form::textarea('present_address','',['class'=>'form-control','placeholder'=>'Enter Your Present Address']) }}
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h5>User Image</h5>
            <div class="card-header-right">
                <i class="icofont icofont-spinner-alt-5"></i>
            </div>
        </div>
        <div class="card-block">



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
{!! Form::close() !!}

</div>
@endsection

@section('script')
<script>
function readURL(input) {
if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function(e) {
    $('#previmage')
      .attr('src', e.target.result)
      .width(300)
      .height(300);
  };
  reader.readAsDataURL(input.files[0]);
}
}
</script>
{!! $validator->selector('#addForm') !!}
@endsection
