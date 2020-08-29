@extends('Backend.layouts.app')
@section('title') Book Stock @endsection
@section('page_title') Book Stock @endsection
@section('page_location')
    <li class="breadcrumb-item"><a href="/"> <i class="feather icon-home"></i> Home </a></li>
    <li class="breadcrumb-item"> Book Stock </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header table-card-header">
                    <div class="row">
                        <div class="col-md-10"><h4>Book Stock</h4></div>
                        <div class="col-md-2"><a class="btn btn-primary float-right" href="/book_stock/create">Stock Book</a></div>

                    </div>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width=10>#</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th width=10>Action</th>
                            </tr>
                            </thead>
                            <form method="post" id="deleteForm">
                                @method('delete')
                                @csrf
                            </form>
                            <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td><input type="checkbox" data-id="{{ $book->book_id }}"></td>
                                    <td>{{ $book->book_name }}</td>
                                    <td>{{ $book->book_quantity }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info show" data-toggle="modal" data-target="#showModal" data-id="{{ $book->book_id }}"><i class="icofont icofont-eye-alt"></i></button>
                                        <a href="/book/{{ $book->book_id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('book.destroy',($book->book_id)) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault(); Delete({{ $book->book_id }});"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Quantity</th>
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
                        <h4 class="modal-title">Book Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Multiple image card start -->

                                    <div class="card-header">
                                        <h5>Books Images</h5>

                                    </div>
                                    <div class="card-block">
                                        <p>Click on the picture to see it properly.</p>
                                        <div class="row"  id="book_img">
                                        </div>
                                    </div>
                                    <!-- Multiple image card end -->
                                </div>
                            </div>


                            <div class="card-block">
                                <div class="row invoive-info">
                                    <div class="col-md-4 col-xs-12 invoice-client-info">
                                        <h6>Book Information :</h6>
                                        <h6 class="m-0 text-primary">Name: </h6>
                                        <p id="book_name"></p>
                                        <h6 class="m-0 text-primary">Writter: </h6>
                                        <p id="book_writter"></p>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <table class="table table-responsive invoice-table invoice-order table-borderless">
                                            <tbody>
                                            <tr>
                                                <th class="text-primary">Purchase Price: </th>
                                                <td id="book_purchase_price"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-primary">Rent Price: </th>
                                                <td id="book_rent_price"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-primary">Resell Price: </th>
                                                <td id="book_resell_price"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <h6 class="m-b-20">Institute: <span id="inst"></span></h6>
                                        <h6 class="text-uppercase">Department :
                                            <span id="book_dept"></span>
                                        </h6>
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
                            url:"/book/"+id,
                            type:'get',
                            data:{"_token":"{{ csrf_token() }}"},
                            dataType:"json",
                            success:function(data)
                            {
                                let value=data[0];
                                $("#book_name").text(value.book_name);
                                $("#book_writter").text(value.book_writter);
                                $("#book_purchase_price").text(value.price.book_purchase_price+'tk');
                                $("#book_rent_price").text(value.price.book_rent_price+'tk');
                                $("#book_resell_price").text(value.price.book_resell_price+'tk');
                                $("#inst").text(value.institute.inst_name);
                                $("#book_dept").text(value.book_dept);
                                $(".book_slides").remove();
                                let image=value.image;
                                if(image){
                                    $.each(image, function (k,v){
                                        $("#book_img").append(`<div class="book_slides col-xl-2 col-lg-3 col-sm-3 col-xs-12">
                                                    <a href="/images/book/${v.book_image}" data-lightbox="example-set">
                                                        <img src="/images/book/${v.book_image}" class="img-fluid m-b-10" alt="" style="max-height: 100px;">
                                                    </a>
                                                </div>`);
                                    });
                                }
                                else {
                                    $("#book_img").html(`<div class="book_slides col-xl-2 col-lg-3 col-sm-3 col-xs-12">
                                        <a href="/book.jpg" data-lightbox="example-set">
                                            <img src="/book.jpg" class="img-fluid m-b-10" alt="">
                                        </a>
                                    </div>`);
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

                                $form.attr('action','/book/'+id);
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
