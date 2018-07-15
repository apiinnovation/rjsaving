<?php $pageName = 'ประเภทเงินกู้';?>


@extends('layouts.layout')

@section('title','ระบบกองทุนฯ - '. $pageName)
@section('UserName','นาย Api Innovation')
@section('BchName','สาขา RJ. 4')

@section('header')

  <link rel="stylesheet" href="{{asset('css/apiform.css')}}">

@endsection


@section('content')


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->


<!-- ทดสอบ -->
    <div class="col-md-10">
        <div class="box box-success box-solid">
            <div class="box-header with-border bg-aqua-active" >
                <h3 class="box-title">เอกสารรอส่งอนุมัติ 3 ฉบับ</h3>
                <!-- 
                <div class="box-tools pull-right">
                   <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> 
                </div>
                -->
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-hover" style="text-align: center">
                <tr>
                  <th style="text-align: center">ลำดับ</th>
                  <th style="text-align: left">รายการ</th>
                  <th style="text-align: center">หมายเหตุ</th>
                </tr>
                <tr>
                    <td>1</td>
                  <td  style="text-align: left">รับสมัครสมาชิก นายอดิศร</td>
                  <td><a href="{{url('/tmem01')}}" class="btn btn-xs btn-primary">ดูข้อมูล</a></td>
                </tr>
                <tr>
                    <td>2</td>
                  <td  style="text-align: left">รับสมัครสมาชิก น.ส.สวยเสริมใส</td>
                  <td><a href="{{url('/tmem02')}}" class="btn btn-xs btn-primary">ดูข้อมูล</a></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td  style="text-align: left">เอกสารการขอกู้ นายจดจ่อ</td>
                  <td><a href="#" class="btn btn-xs btn-primary">ดูข้อมูล</a></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>


<!--        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>20</h3>

              <p>ขอเปลี่ยเงื่อนไขเงินกู้</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/loanChange')}}" class="small-box-footer">รายละเอียด <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>-->

      <!-- /.row -->

      
      <!-- Main row -->

      <!-- /.row (main row) -->

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