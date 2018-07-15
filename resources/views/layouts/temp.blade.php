<?php $pageName = 'editdivision';?>


@extends('layouts.layout')

@section('title','ระบบกองทุนฯ - '. $pageName)
@section('UserName','นาย Api Innovation')
@section('BchName','สาขา RJ. 4')

@section('header')

  <link rel="stylesheet" href="{{asset('css/apiform.css')}}">

@endsection


@section('content')


    <!-- Main content -->
  <section class="content-header">
      <!-- Small boxes (Stat box) 
                <a class="btn btn-app pull-right ">
                    <i class="fa fa-print"></i> พิมพ์
                </a>     
      -->


<!-- ทดสอบ -->
    <div class="col-md-4">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-green-gradient" >
                <h3 class="box-title">title</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
                
                
            </div>
        </div>
     </div>



    </section>
    <!-- /.content -->


@endsection


@section('footer')
<!-- InputMask -->
<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<script>
  $(function () {

    $('[data-mask]').inputmask()



    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    
  })
 </script>
    
@endsection
