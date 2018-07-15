<?php $pageName = 'ข้อมูลสาขา'; ?>

@extends('layouts.layout')

@section('title','ระบบกองทุนฯ - '. $pageName)
@section('UserName','นาย Api Innovation')
@section('BchName','สาขา RJ. 4')

@section('header')

<link rel="stylesheet" href="{{asset('css/apiform.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection


@section('content')

<div class="col-md-10 col-md-offset-1">

    <form role="form" id="form" class="form-horizontal" method="post" action="{{ url('branch/save')}}">
        {{ csrf_field()}}
        <input type="hidden" name="_action" value="{{ (@$action ==''?'create':$action )}}">
        <div class="box box-primary well" >
            <div class="box-header with-border">
                <h3 class="box-title">จัดการข้อมูลสาขา</h3>
            </div>
            @include('sweet::alert')

            @if (count($errors) > 0)
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> กรุณากรอกข้อมูลให้ครบถ้วน !</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="box-body">
                <div class="form-group">                    
                    <div class="row">
                        <label class="col-md-2 control-label required" style="text-align: right">รหัสสาขา :</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control " placeholder="" readonly=""  name="XVBchCode" id="XVBchCode" value="{{ $res_edit->XVBchCode or $last_code }} " >
                        </div>    
                        <label class="col-md-1 control-label" style="text-align: left">(Auto)</label>
                    </div>
                </div>

                <div class="form-group ">

                    <div class="row">
                        <label class="col-md-2  control-label required" style="text-align: right" >ชื่อสาขา :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control " placeholder="ชื่อสาขา" name="XVBchName" id="XVBchName" value="{{ $res_edit->XVBchName or '' }}" >
                        </div>  

                        <label class="col-md-2 control-label" style="text-align: right">เบอร์โทร :</label>
                        <div class="col-lg-3">    
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="">
                                    <input type="text" class="form-control " placeholder="เบอร์โทร" name="XVBchPhone" value="{{ $res_edit->XVBchPhone or '' }}" >
                                </div>                                     
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label required" style="text-align: right">ที่อยู่ :</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="ที่อยู่"  name="XVBchAddress" id="XVBchAddress" value="{{ $res_edit->XVBchAddress or '' }}" >
                        </div>
                        <label class="col-md-2 control-label" style="text-align: right">เบอร์แฟกซ์ :</label>
                        <div class="col-lg-3">    
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-fax"></i>
                                </div>
                                <div class="">
                                    <input type="text" class="form-control " placeholder="เบอร์แฟกซ์" name="XVBchFax" value="{{ $res_edit->XVBchFax or '' }}" >
                                </div>                                     
                            </div>
                        </div> 
                    </div>
                </div> 

                <div class="form-group">                     
                    <div class="row text-center">                                
                        <button type="submit" class="popAdd_close btn btn-success " id="btnsubmit">บันทึก</button>
                        <a href="{{ url('/branch/')}}"  class="popAdd_close btn btn-danger">ยกเลิก</a>                        
                    </div>
                </div>                

            </div>

        </div>


    </form>

    <div class="col-md-12">
        <div class="box box-success box-solid" >
            <div class="box-header with-border bg-green-gradient" >
                <h3 class="box-title">ข้อมูลสาขา</h3>
            </div>
            <div class="box-body">

                <table class="table table-hover table-bordered table-striped" style="text-align: center">
                    <thead>
                        <tr>
                            <th style="text-align: center" width="10%">รหัสสาขา</th>
                            <th style="text-align: center" width="25%">ชื่อ</th>
                            <th style="text-align: center" width="40%">ที่อยู่</th>
                            <th style="text-align: center" width="10%">เบอร์โทร</th>
                            <th style="text-align: center" width="20%">จัดการ</th>
                        </tr>
                    </thead>
                    @foreach($res_all as $res)
                    <tr>
                        <td style="text-align: left">{{$res->XVBchCode}}</td>
                        <td style="text-align: left">{{$res->XVBchName}}</td>
                        <td style="text-align: left">{{$res->XVBchAddress}}</td>
                        <td style="text-align: left">{{$res->XVBchPhone}}</td>
                        <td>
                            <!--<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> แสดง </a>-->
                            <a href="{{ url('/branch/'.$res->XVBchCode)}}" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i> แก้ไข </a>
                            <a href="#" tag='{{ $res->XVBchCode}}' class="btn btn-danger btn-xs del"><i class="fa fa-trash-o"></i> ลบ </a>
                        </td>
                    </tr>
                    @endforeach

                </table>

            </div>
        </div>
    </div>

</div>

@endsection

@section('footer')
<!-- InputMask -->
<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>

$(document).ready(function () {

    $('#XVBchName').focus();

    $('a.del').click(function () {

        var code = $(this).attr('tag');
                var url = {!! json_encode(url('/branch/del/')) !!}
        url += '/' + code
        //console.log(url);

        swal({
            title: "ยืนยันการลบข้อมูล ?",
            text: "คุณต้องการลบข้อมูล " + code + " ใช่หรือไม่",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก",
            confirmButtonColor: "#DD6B55",
        }, function () {
            window.location.href = url;
        });
        return false;
    });

})
</script>

@endsection