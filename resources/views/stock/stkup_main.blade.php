<?php $pageName = 'ค้นหารายการขอเพิ่มหุ้น'; ?>

@extends('layouts.layout')

@section('title','ระบบกองทุนฯ - '. $pageName)
@section('UserName','นาย Api Innovation')
@section('BchName','สาขา RJ. 4')

@section('header')


@endsection


@section('content')


<section class="content-header">
    <div class="col-sm-4">
        <h1>
            {{ $pageName}}
        </h1>
    </div>
    @if (Auth::user()->XBIsSave =='1' )
    <a href="{{url('/stkup')}}" class="btn btn-app btn-app-add pull-right ">
        <i class="fa fa-file-o"></i> สร้างเอกสาร
    </a>   
    @endif
</section>
<br>
<div class="col-sm-12">

        <div class="box box-primary">
            <div class="box-header with-border">
                <label><h3 class="box-title">ค้นหา</h3></label>
            </div>


            <div class="box-body">
                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label" style="text-align: right">เลขสมาชิก :</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control " placeholder="" name="cus_code" id="cus_code" autofocus=""  >
                        </div>
                        <div class="col-md-1">
                            <a href="#" class="btn btn-success " id="btnMainFind" > ค้นหา</a>
                        </div> 
                    </div>
                </div>
                <table class="table table-bordered table-hover" id="cusdatatable"  style="width: 100%" >
                    <thead>
                        <tr>                            
                            <th style="text-align: center;width:80px;">เลขที่เอกสาร</th>
                            <th style="text-align: center;width:80px;">วันที่เอกสาร</th>
                            <th style="text-align: center;width:80px;">รหัสสมาชิก</th>
                            <th style="text-align: center;width:200px;">ชื่อ นามสกุล</th>
                            <th style="text-align: center;width:100px;">สังกัดสาขา</th>
                            <th style="text-align: center;width:100px;">หน่วย/ฝ่าย</th>
                            <th style="text-align: center;width:70px;">สถานะ</th>
                            <th style="text-align: center;width:100px;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach($res_all as $res)
                        <tr style="" data-cus="" >
                            <td style="text-align: center" >{{$res->XVAddDocNo}}</td>  
                            <td style="text-align: center" >{{$res->XDAddDocDate}}</td>  
                            <td>{{$res->XVCusCode}}</td>
                            <td>{{$res->XVCusName}}</td>
                            <td>{{$res->XVBchName}}</td>
                            <td>{{$res->XVDivName}}</td>                            
                            <td style="text-align: center"><?php
                            switch ($res->XVAddDocStatus){
                                case '1':case '':
                                    if ($res->XBAddDocSend == true){
                                        print '<div class="bg-light-blue-active color-palette"><span>รออนุมัติ</span></div>';
                                    }else{
                                        print '<div class="bg-aqua color-palette"><span>บันทึก</span></div>';
                                    }                                    
                                    break;
                                case '2':
                                    print '<div class="bg-green-active color-palette"><span>ผ่าน</span></div>';
                                    break;
                                case '3':
                                    print '<div class="bg-red color-palette"><span>ไม่ผ่าน</span></div>';
                                    break;
                            }
                            ?></td>
                            <td style="text-align: center">
                            <a href="{{ url('/stkup/'.$res->XVAddDocNo)}}" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i> จัดการ </a>
                            <!--<a href="{{ url('/stkUp/'.$res->XVAddDocNo)}}" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i> แก้ไข </a>-->
                            <!--<a href="#" tag='{{ $res->XVAddDocNo}}' class="btn btn-danger btn-xs del"><i class="fa fa-trash-o"></i> ลบ </a>-->
                        </td>                            
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                <div style="text-align: right">
                    <?php echo $res_all->links(); ?>
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
    if ($('#cus_code').val().length > 0 ){
        url = "{{URL::to('/stkup_main/')}}"+'/'+$('#cus_code').val();
    } else{
        url = "{{URL::to('/stkup_main/')}}";
    }
    
    
    window.location.href = url;

})

</script>

@endsection