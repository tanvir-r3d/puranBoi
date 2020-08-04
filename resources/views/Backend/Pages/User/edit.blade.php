@extends('Backend.layouts.app')
@section('title') User @endsection
@section('page_title') User @endsection
@section('page_location')
<li class="breadcrumb-item"><a href="/"> <i class="feather icon-home"></i> Home </a></li>
<li class="breadcrumb-item"><a href="/user"> User </a></li>
<li class="breadcrumb-item"> Edit </li>
@endsection
@section('content')
{!! Form::open(['route' => ['user.update',$user->id],'id'=>'editForm','files'=>true,'method'=>'PUT']) !!}
<div class="row">

    <div class="col-sm-7">
        <div class="card">
            <div class="card-header">
                <h5>Edit User</h5>
                <span>Those Who can Access This Admin Panel.</span>
                <div class="card-header-right">
                    <i class="icofont icofont-spinner-alt-5"></i>
                </div>
            </div>

            <div class="card-block">
                <h4 class="sub-title"> Basic Info </h4>

                    @csrf
                    <div class="form-group row">
                        {{ Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) }}
                        <div class="col-sm-10">
                            {{ Form::text('name',"$user->name",['class'=>'form-control','placeholder'=>'Enter Your Name']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('phone', 'Phone', ['class' => 'col-sm-2 col-form-label']) }}
                        <div class="col-sm-10">
                            {{ Form::text('phone',"$user->phone",['class'=>'form-control','placeholder'=>'Enter Your Phone']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label']) }}
                        <div class="col-sm-10">
                            {{ Form::email('email',"$user->email",['class'=>'form-control','placeholder'=>'example@gmail.com']) }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            <h5>User Image</h5>
            <div class="card-header-right">
                <i class="icofont icofont-spinner-alt-5"></i>
            </div>
        </div>
        <div class="card-block">
            <div style="text-align: center">
                <img id="previmage" class="img-fluid" height="300" width="300" src="{{ $user->image ? '/images/user/'.$user->image : '/assets/images/blank.jpg' }}" alt="round-img">
            </div>
            <div class="form-group row mt-2">
                {{ Form::label('image', 'Upload Image', ['class' => 'col-sm-2 col-form-label']) }}
                <div class="col-sm-10">
                    {{ Form::file('image', ['class'=>'form-control','onchange'=>'readURL(this);']) }}
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
{!! $validator->selector('#editForm') !!}
@endsection
