@extends('Backend.layouts.app')
@section('title') Stock @endsection
@section('page_title') Stock @endsection
@section('page_location')
    <li class="breadcrumb-item"><a href="/"> <i class="feather icon-home"></i> Home </a></li>
    <li class="breadcrumb-item"><a href="/book_stock"> Book Stock </a></li>
    <li class="breadcrumb-item"> Create</li>
@endsection
@section('content')
    <form action="{{route('book_stock.store')}}" method="post" id="addForm">
        @csrf
        <div class="row">

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Stock</h5>
                        <span>Unique Code For every book.</span>
                        <div class="card-header-right">
                            <i class="icofont icofont-spinner-alt-5"></i>
                        </div>
                    </div>

                    <div class="card-block">
                        <h4 class="sub-title"> Book Info </h4>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="book">Book</label>
                                    <input name="book_name" class="form-control" value="{{$book->book_name}}" readonly disabled>
                                    <input name="book" class="form-control" value="{{$book->book_id}}" hidden>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input class="form-control" type="number" min=0 max=100 name="book_quantity"
                                           id="quantity">
                                </div>
                            </div>

                        </div>
                        <div id="book_unique_code"></div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-8">

                            </div>
                            <div class="col-md-4">
                                {{ Form::reset('Reset',['class'=>'btn']) }}
                                {{ Form::submit('Submit',['class'=>'btn btn-success']) }}
                            </div>
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
        $("#quantity").change(function () {
            let quantity = $(this).val();
            let i = 0;
            $(".book_code").remove();
            while (i < quantity) {
                i++;
                $("#book_unique_code").append(`<div class="form-group row book_code">
                                <label class="col-sm-2 col-form-label">Code #${i}</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="book_unique_code[]" >
                                </div>
                            </div>`);
            }
        });
    </script>
    {{--    {!! $validator->selector('#addForm') !!}--}}
@endsection
