<?php $pageName = 'ข้อมูลบริษัท';?>

@extends('layouts.layout')

@section('title','ระบบกองทุนฯ - '. $pageName)
@section('UserName','นาย Api Innovation')
@section('BchName','สาขา RJ. 4')

@section('header')

  <link rel="stylesheet" href="{{asset('css/apiform.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection


@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="col-sm-4">
            <h1>
            {{ $pageName}}
            </h1>
        </div>
        <?php
        $menu =2;
        
        ?>
        
        @include('layouts.menu')    
    </section>
    
    <br>
    <div class="col-sm-12">
        
        <form role="form" class="form-horizontal">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลบริษัท</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            
            <div class="box-body">

                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label" style="text-align: right">ชื่อบริษัท :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control " placeholder=""  >
                        </div>        
                    </div>
                </div>
                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label" style="text-align: right">ที่อยู่ :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control " placeholder=""  >
                        </div>        
                    </div>
                </div> 
                
                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label" style="text-align: right">เบอร์โทร :</label>
                           <div class="col-lg-2">    
                            <div class="input-group">
                                    <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="">
                                        <input type="text" class="form-control " >
                                    </div>                                     
                                </div>
                            </div>    
                    </div>
                </div> 
                
                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label" style="text-align: right">เบอร์แฟกซ์ :</label>
                           <div class="col-lg-2">    
                            <div class="input-group">
                                    <div class="input-group-addon">
                                    <i class="fa fa-fax"></i>
                                    </div>
                                    <div class="">
                                        <input type="text" class="form-control " >
                                    </div>                                     
                                </div>
                            </div>    
                    </div>
                </div>                  
                    
            </div>
                <!-- /.box-body -->
          </div>
              
          </form>
          <!-- /.box -->
    </div>

@endsection


@section('footer')
<!-- InputMask -->
<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    $('.select2').select2()

    $('[data-mask]').inputmask()



    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    
  })
 </script>
    
@endsection