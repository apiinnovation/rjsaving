@extends('layouts.layout')

@section('title','ระบบกองทุนฯ รัจนาการ')
@section('UserName',Auth::user()->XVPreName ." ".Auth::user()->XVUserFName ." ".Auth::user()->XVUserLName )
@section('BchName',Auth::user()->XVBchName)


@section('content')
<!--    <section class="content-header">
      <h1>
      วันนี้คุณจะทำอะไร ?
      </h1>
    </section>-->
    @include('layouts.controlpanel')
@endsection


@section('footer')
@endsection