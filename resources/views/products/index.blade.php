@extends('layouts.main')
@section('body-class') @parent()products index @stop()

@section('content')
    <section class="row">
        <div class="col">
            {{--
                Create a webpage with a form that has the following text input fields: Product name, Quantity in stock, Price per item.
                The submitted data of the form should be saved in an XML / JSON file with valid XML / JSON syntax.
                NOTE: price is in cents just to keep things simple, given the limited time period
            --}}
            {{ Form::open(['route'=>'products.store','method'=>'POST','class'=>'store product']) }}

            <div id="validation-errors" style="display:none"></div>

            <div class="form-group">
                {{ Form::label('pname', 'Product Name') }}
                {{ Form::text('pname',null,['class'=>'form-control', 'placeholder'=>'Type name...', 'autocomplete'=>'off']) }}
            </div>

            <div class="form-group">
                {{ Form::label('qty', 'Quantity in Stock') }}
                {{ Form::text('qty',null,['class'=>'form-control', 'placeholder'=>'Enter quantity...', 'autocomplete'=>'off']) }}
            </div>

            <div class="form-group">
                {{ Form::label('price', 'Price per Item (cents)') }}
                {{ Form::text('price',null,['class'=>'form-control', 'placeholder'=>'Enter price in cents...', 'autocomplete'=>'off']) }}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

            {{ Form::close() }}
        </div>
    </section>

    <hr />

    <section class="row">
        <div class="col">
            <h1>List of Products</h1>
            {{--
                Underneath of the form, the web page should display all of the data which has been submitted in rows ordered by date time submitted, the order of the data columns should be: Product name, Quantity in stock, Price per item, Datetime submitted, Total value number.
                The "Total value number" should be calculated as (Quantity in stock * Price per item).
            --}}
            <div id="crate-table">
            @include('products._table', ['products'=>$products, 'total'=>$total??null])
            </div>
        </div>
    </section>
@endsection

@push('blade_inlinejs')
    <script type="text/javascript">

        $( document ).ready(function() {

            console.log('running...');

            $(document).on('submit', 'form.store.product', function(e) {
                e.preventDefault();
                var context = $(this);

                // Submit the form
                return $.ajax({
                    url: context.attr('action'),
                    type: 'POST',
                    data: context.serializeArray(),
                }).done( function(response) {
                    // Update the table with the latest data
                    $.getJSON('/products', function(response) {
                        $('#crate-table').html(response.html);
                    });
                    return response;
                }).fail( function(response) {
                    // Handle errors
                    switch (response.status) {
                        case 422:
                            // %TODO: render validation errors on the page
                            console.log('ajax returned status code: '+response.status);
                            break;
                        default:
                            console.log('ajax returned other');
                    }
                    return response;
                });
            });
        });

    </script>
@endpush
