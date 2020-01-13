@extends('layouts.backend.master')
@section('content')
    <div class="authorized">
        <img src="{{ asset('assets/admin/img/autho.png') }}"><br>
        {{--<button class="btn btn-warning">Lorem</button>--}}
        {{--<button class="btn btn-warning">Lorem</button>--}}
        {{--<button class="btn btn-warning">Lorem</button>--}}
        {{--<button class="btn btn-warning">Lorem</button>--}}
        <a href="{!! URL::previous() !!}" class="btn btn-warning">Back</a>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/authorization.css') }}">
@endpush