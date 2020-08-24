@extends('Backend.layouts.app')
@section('title') Book @endsection
@section('page_title') Book @endsection
@section('page_location')
    <li class="breadcrumb-item"><a href="/"> <i class="feather icon-home"></i> Home </a></li>
    <li class="breadcrumb-item"><a href="/book"> Book </a></li>
    <li class="breadcrumb-item"> Create </li>
@endsection
@section('content')
    <form action="{{route('book.store')}}" method="post" id="addForm" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Book</h5>
                        <span>Book Detailed Information.</span>
                        <div class="card-header-right">
                            <i class="icofont icofont-spinner-alt-5"></i>
                        </div>
                    </div>

                    <div class="card-block">
                        <h4 class="sub-title"> Book Info </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('inst_id', 'Institute*', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        <select class="form-control" name="inst_id" id="inst_id">
                                            <option selected hidden disabled>SELECT INSTITUTE</option>
                                            @foreach ($institutes as $institute)
                                                <option value="{{$institute->inst_id}}">{{$institute->inst_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('book_name', 'Name*', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('book_name','',['class'=>'form-control','placeholder'=>'Enter Book Name']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('book_dept', 'Department*', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('book_dept','',['class'=>'form-control','placeholder'=>'Enter Department']) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('book_writter', 'Writter*', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('book_writter','',['class'=>'form-control','placeholder'=>'Enter Book Writter']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    {{ Form::label('book_purchase_price', 'Purchase Price*', ['class' => 'col-sm-10 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::number('book_purchase_price','',['class'=>'form-control','placeholder'=>'Enter Purchase Price']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    {{ Form::label('book_rent_price', 'Rent Price*', ['class' => 'col-sm-10 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::number('book_rent_price','',['class'=>'form-control','placeholder'=>'Enter Rent Price']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    {{ Form::label('book_resell_price', 'Resell Price*', ['class' => 'col-sm-10 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::number('book_resell_price','',['class'=>'form-control','placeholder'=>'Enter Resell Price']) }}
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
                        <h5>Book Images</h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-spinner-alt-5"></i>
                        </div>
                    </div>
                    <div class="card-block">
                            <div class="form-group row">
                                {{ Form::label('book_image', 'Book Cover', ['class' => 'col-sm-7 col-form-label']) }}
                                <div class="col-sm-12">
                                    <input type="hidden" name="image_type[]" value="cover">
                                    {{ Form::file('book_image[]', ['class'=>'form-control dropify','data-default-file'=>'/book.jpg','data-max-file-size'=>"4M"]) }}
                                </div>
                            </div>

                        <div class="form-group row">
                            <label class="col-sm-4">Extra Image</label>
                            <div class="col-sm-12">
                                <table>
                                    <tr>
                                        <td>
                                            <select class='form-control' name="image_type[]">
                                                <option selected hidden disabled>Select Type</option>
                                                <option value='front'>Front</option>
                                                <option value='back'>Back</option>
                                                <option value='other'>Other</option>
                                            </select>
                                        </td>
                                        <td><input type='file' name='book_image[]' class='form-control'></td>
                                        <td><button class='btn btn-success add_field' type="button"><i class="fa fa-plus"></i></button></td>
                                    </tr>
                                </table>
                                <div class="input_field"></div>
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

    <script>
        $('.dropify').dropify();
        $(document).ready(function() {
            var max_field = 6;
            var wrapper = $(".input_field");
            var add_field = $(".add_field");
            var i = 1;
            $(add_field).click(function(e) {
                e.preventDefault();
                if(i < max_field) {
                    i++;
                    $(wrapper).append(`<div>
                    <table>
                      <tr>
                        <td>
                            <select class='form-control' name="image_type[]">
                                <option selected hidden disabled>Select Type</option>
                                <option value='front'>Front</option>
                                <option value='back'>Back</option>
                                <option value='other'>Other</option>
                            </select>
                        </td>
                        <td><input type='file' name='book_image[]' class='form-control'>
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
            });
        });
    </script>
{{--    {!! $validator->selector('#addForm') !!}--}}
@endsection
