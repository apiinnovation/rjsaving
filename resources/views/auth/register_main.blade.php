<?php $pageName = 'ค้นหาผู้ใช้งานระบบ'; ?>

@extends('layouts.layout')

@section('title','ระบบกองทุนฯ - '. $pageName)

@section('header')


@endsection


@section('content')


<section class="content-header">
    <div class="col-sm-4">
        <h1>
            {{ $pageName }}
        </h1>
    </div>
    @if (Auth::user()->XBIsSave =='1' )
    <a href="{{url('/regis')}}" class="btn btn-app pull-right ">
        <i class="fa fa-file-o"></i> เพิ่ม
    </a>       
    @endif
</section>
<br>
    @include('sweet::alert')
<div class="col-sm-12">

        <div class="box box-primary">
            <div class="box-header with-border">
                <label><h3 class="box-title">ค้นหา</h3></label>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-2 control-label" style="text-align: right">ชื่อผู้ใช้งาน :</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control " placeholder="" name="XVUserFName" id="XVUserFName" autofocus=""  >
                        </div>
                        <div class="col-md-1">
                            <a href="#" class="btn btn-success " id="btnMainFind" > ค้นหา</a>
                        </div> 
                    </div>
                </div>
                <table class="table table-bordered table-hover" id="cusdatatable"  style="width: 100%" >
                    <thead>
                        <tr>                            
                            <th style="text-align: center;width:20px;">#</th>
                            <th style="text-align: left;width:200px;">ชื่อ - นามสกุล</th>
                            <th style="text-align: left;width:100px;">สังกัด</th>
                            <th style="text-align: center;width:30px;">อนุญาตบันทึก</th>
                            <th style="text-align: center;width:30px;">อนุญาตอนุมัติ</th>
                            <th style="text-align: center;width:30px;">อนุญาตดูรายงาน</th>
                            <th style="text-align: center;width:30px;">อนุญาตดูพิมพ์</th>
                            
                            <th style="text-align: center;width:30px;">สถานะ</th>
                            <th style="text-align: center;width:30px;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody >
                       <?php $i = ($res_all->currentpage()-1)* $res_all->perpage() + 1;?>
                        @foreach($res_all as $res)
                        <tr style="" data-cus="" >
                            <td style="text-align: center" >{{ $i ++}}</td>  
                            <td style="text-align: left" >{{$res->XVUserName}}</td>  
                            <td>{{$res->XVBchName}}</td>
                            <td style="text-align: center"><?php
                            switch ($res->XBIsSave){
                                case '1':
                                    print '<div class="bg-green-active color-palette"><i class="fa fa-check-square"></i></div>';
                                    break;                                
                                default :
                                    print '<div class="bg-red color-palette btn-flat"> <i class="fa fa-fw fa-close"></i></div>';
                                    break;
                            }
                            ?></td>
                            <td style="text-align: center"><?php
                            switch ($res->XBIsApprove){
                                case '1':
                                    print '<div class="bg-green-active color-palette"><i class="fa fa-check-square"></i></div>';
                                    break;                                
                                default :
                                    print '<div class="bg-red color-palette btn-flat"> <i class="fa fa-fw fa-close"></i></div>';
                                    break;
                            }
                            ?></td>
                            <td style="text-align: center"><?php
                            switch ($res->XBIsReport){
                                case '1':
                                    print '<div class="bg-green-active color-palette"><i class="fa fa-check-square"></i></div>';
                                    break;                                
                                default :
                                    print '<div class="bg-red color-palette btn-flat"> <i class="fa fa-fw fa-close"></i></div>';
                                    break;
                            }
                            ?></td>
                            <td style="text-align: center"><?php
                            switch ($res->XBisPrint){
                                case '1':
                                    print '<div class="bg-green-active color-palette"><i class="fa fa-check-square"></i></div>';
                                    break;                                
                                default :
                                    print '<div class="bg-red color-palette btn-flat"> <i class="fa fa-fw fa-close"></i></div>';
                                    break;
                            }
                            ?></td>                            
                            <td style="text-align: center"><?php                            
                            switch ($res->XBIsActive){
                                case '1':
                                    print '<div class="bg-green-active color-palette"><span>ใช้งาน</span></div>';                                  
                                    break;                                
                                default :
                                    print '<div class="bg-red color-palette"><span>ไม่ใช้งาน</span></div>';
                                    break;
                            }
                            ?></td>
                            <td style="text-align: center">
                            <a href="{{ url('/regis/'.$res->username)}}" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i> จัดการ </a>
                            <!--<a href="{{ url('/stkUp/'.$res->username)}}" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i> แก้ไข </a>-->
                            <!--<a href="#" tag='{{ $res->username}}' class="btn btn-danger btn-xs del"><i class="fa fa-trash-o"></i> ลบ </a>-->
                        </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                
                <div style="text-align: right">
                   {{ @$res_all->links()}}
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

<script>
$(document).ready(function () {

$('#modalForm').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
        ajaxLoad({!! json_encode(url('/findcus')) !!}, 'modalForm');
    });
});

$('#cus_code').keyup(function(e){
    if(e.keyCode == 13)
    {
        var url;
        if ($('#cus_code').val().length > 0 ){
            url = "{{URL::to('/stkup_main/')}}"+'/'+$('#cus_code').val();
            window.location.href = url;
        }
    }
});

$('#btnMainFind').click(function(){
    var url;
    if ($('#XVUserFName').val().length > 0 ){
        url = "{{URL::to('/regis_main/')}}"+'/'+$('#XVUserFName').val();
    } else{
        url = "{{URL::to('/regis_main/')}}";
    }
    
    
    window.location.href = url;

})

</script>

@endsection