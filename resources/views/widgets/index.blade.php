@extends('layouts.main')
@section('body-class') @parent()widgets index @stop()

@section('content')
    <h1>List of Widgets</h1>
    <section>
        <ul>
            @foreach($widgets as $w) 
                <li>{{ $w->wname }} | {{ $w->guid }} </li>
            @endforeach
        </ul>
    </section>

    <section>
        {{ Form::open(['route'=>'widgets.store','method'=>'POST','class'=>'store widget']) }}
        {{ Form::label('wname', 'Widget Name') }}
        {{ Form::text('wname',null,['class'=>'', 'placeholder'=>'Type name...', 'autocomplete'=>'off']) }}
        {{ Form::close() }}
    </section>


    </div>
@endsection

@push('blade_inlinejs')
    <script type="text/javascript">

        $( document ).ready(function() {
            console.log('running...');
        });

    </script>
@endpush
