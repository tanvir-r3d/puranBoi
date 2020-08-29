@extends('Backend.layouts.app') @section('title') Book @endsection @section('page_title') Book @endsection @section('page_location')
    <li class="breadcrumb-item">
        <a href="/"> <i class="feather icon-home"></i> Home </a>
    </li>
    <li class="breadcrumb-item"><a href="/book"> Book </a></li>
    <li class="breadcrumb-item"> Edit</li>
@endsection @section('content')
    <form action="{{route('book.update',$book->book_id)}}" method="post" id="editForm" enctype="multipart/form-data">
        @csrf @method('put')
        <div class="row">

            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Book</h5>
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
                                                <option
                                                    value="{{$institute->inst_id}}" {{$book->inst_id==$institute->inst_id ? 'selected' : ''}}>{{$institute->inst_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('book_name', 'Name*', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('book_name',$book->book_name,['class'=>'form-control','placeholder'=>'Enter Book Name']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('book_dept', 'Department*', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('book_dept',$book->book_dept,['class'=>'form-control','placeholder'=>'Enter Department']) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('book_writter', 'Writter*', ['class' => 'col-sm-5 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('book_writter',$book->book_writter,['class'=>'form-control','placeholder'=>'Enter Book Writter']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    {{ Form::label('book_purchase_price', 'Purchase Price*', ['class' => 'col-sm-10 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::number('book_purchase_price',$book->price->book_purchase_price,['class'=>'form-control','placeholder'=>'Enter Purchase Price']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    {{ Form::label('book_rent_price', 'Rent Price*', ['class' => 'col-sm-10 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::number('book_rent_price',$book->price->book_rent_price,['class'=>'form-control','placeholder'=>'Enter Rent Price']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    {{ Form::label('book_resell_price', 'Resell Price*', ['class' => 'col-sm-10 col-form-label']) }}
                                    <div class="col-sm-12">
                                        {{ Form::number('book_resell_price',$book->price->book_resell_price,['class'=>'form-control','placeholder'=>'Enter Resell Price']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-4">Previous Image</label>
                                <div class="col-sm-12">
                                    <div class="card-block">
                                        <p>Click on the picture to see it properly.</p>
                                        <div class="row" id="book_img">
                                            @foreach($book->image as $img) @php $type=null; @endphp @if($img->image_type=='cover') @php $type="Cover Image"; @endphp @elseif($img->image_type=='back') @php $type="Back Image"; @endphp @elseif($img->image_type=='front') @php $type="Front Image"; @endphp @else @php $type="Other"; @endphp @endif
                                            <div class="book_slides col-xl-4 col-lg-4 col-sm-6 col-xs-12">
                                                <a href="/images/book/{{$img->book_image}}" data-lightbox="example-set">
                                                    <img src="/images/book/{{$img->book_image}}"
                                                         class="img-fluid m-b-10" alt="" style="max-height: 100px;">
                                                </a>

                                                <div class='doc_down'>
                                                    <a href='/book/image/{{$img->image_id}}'>
                                                        <p class='text-custom'>{{$type}} &nbsp<i class='fa fa-link'></i>
                                                    </a>&nbsp &nbsp
                                                    <a href="/book/image/{{$img->image_id}}/delete"
                                                       onclick="event.preventDefault(); Delete( {{$img->image_id}} );">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                    </p>
                                                </div>

                                            </div>
                                            @endforeach
                                        </div>
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
                            <label class="col-sm-4">Extra Image</label>
                            <div class="col-sm-12">
                                <table>
                                    <tr>
                                        <td>
                                            <select class='form-control' name="image_type[]">
                                                <option selected hidden disabled>Select Type</option>
                                                <option value="cover">Cover</option>
                                                <option value='front'>Front</option>
                                                <option value='back'>Back</option>
                                                <option value='other'>Other</option>
                                            </select>
                                        </td>
                                        <td><input type='file' name='book_image[]' class='form-control'></td>
                                        <td>
                                            <button class='btn btn-success add_field' type="button"><i
                                                    class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </table>
                                <div class="input_field"></div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <a href="/book" class="btn">Back</a>
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
@endsection @section('script')

    <script>
        function Delete(id) {
            var id = id;
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
                        $form.attr('action', `/book/image/${id}/delete`);
                        $form.submit()
                    }, true],
                    ['<button>NO</button>', function (instance, toast) {

                        instance.hide({transitionOut: 'fadeOut'}, toast, 'button');

                    }],
                ],
            });
        }

        $(document).ready(function () {
            var max_field = 6;
            var wrapper = $(".input_field");
            var add_field = $(".add_field");
            var i = 1;
            $(add_field).click(function (e) {
                e.preventDefault();
                if (i < max_field) {
                    i++;
                    $(wrapper).append(`<div>
                    <table>
                      <tr>
                        <td>
                            <select class='form-control' name="image_type[]">
                                <option selected hidden disabled>Select Type</option>
                                <option value='cover'>Cover</option>
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
            $(wrapper).on("click", ".remove_field", function (e) {
                e.preventDefault();
                $(this).closest('div').remove();
                i--;
            });
        });
    </script>
    {{-- {!! $validator->selector('#addForm') !!}--}} @endsection
