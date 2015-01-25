@extends('layouts.page')

@section('head')
    @parent
@stop  

@section('footer')
    @parent
    {{HTML::script('packages/qwerbit/assets/qb/0.0.1/js/qMessage.js')}}
    {{HTML::script('packages/qwerbit/assets/qb/0.0.1/js/qLoader.js')}}
    {{HTML::script('packages/qwerbit/assets/qb/0.0.1/js/qform.js')}}
@stop                