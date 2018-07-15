<?php $pageName = 'division';?>


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
                <h3 class="box-title">ชื่อแผนกที่ต้องการเพิ่ม</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if (count($errors)>0)
                    <div class="alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                             @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(array('url' => 'TCusTDivision')) !!}
                
                {{ csrf_field() }}
                
                <div class="col-md-10">
                    <div class="form-group">
                        {{ Form::label('Name', 'ชื่อแผนก',null,['class'=>'form-controll']) }}
                        {{ Form::text('XVDivName',null,['class'=>'form-controll']) }}
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group">
                        {{ Form::submit('บันทึก',['class'=>'btn btn-warning pull-right']) }}
                    </div>
                </div>

                
                {!! Form::close() !!}

<!--
                <div class="form-group">
                    <label for="exampleInputEmail1">ชื่อแผนก</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="พิมพ์ชื่อแผนกที่ต้องการเพิ่ม">
                </div>
                <button type="submit" class="btn btn-warning pull-right">บันทึก</button>
-->                
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
