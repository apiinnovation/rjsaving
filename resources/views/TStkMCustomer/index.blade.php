<?php $pageName = 'ค้นหาข้อมูลสมาชิก'; ?>

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
    <a href="{{url('/TStkMCustomer/create')}}" class="btn btn-app pull-right ">
        <i class="fa fa-file-o"></i> เพิ่ม
    </a>   
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
                            <th style="text-align: center;width:80px;">รหัสสมาชิก</th>
                            <th style="text-align: center;width:200px;">ชื่อ นามสกุล</th>
                            <th style="text-align: center;width:100px;">สังกัดสาขา</th>
                            <th style="text-align: center;width:100px;">หน่วย/ฝ่าย</th>
                            <th style="text-align: center;width:100px;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach($res_all as $rows)
                        <tr style="" data-cus="" >
                            <td style="text-align: center" >{{$rows -> XVCusCode}}</td>  
                            <td>{{$rows -> XVCusName}}</td>  
                            <td>{{$rows->XVBchName}}</td>
                            <td>{{$rows->XVDivName}}</td>                            
                            <td style="text-align: center">
                            <a href="{{ url('/TStkMCustomer/'.$rows->XVCusCode.'/edit/')}}" class="btn btn-warning btn-xs "><i class="fa fa-pencil"></i> แก้ไข </a>
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
        ajaxLoad({!! json_encode(url('/fcustomer')) !!}, 'modalForm');
    });
});

$('#cus_code').keyup(function(e){
    if(e.keyCode == 13)
    {
        var url;
        if ($('#cus_code').val().length > 0 ){
            url = "{{URL::to('/cus_main')}}"+'/'+$('#cus_code').val();
            window.location.href = url;
        }
    }
});

$('#btnMainFind').click(function(){
    var url;
    if ($('#cus_code').val().length > 0 ){
        url = "{{URL::to('/cus_main')}}"+'/'+$('#cus_code').val();
    } else{
        url = "{{URL::to('/cus_main')}}";
    }
    
    
    window.location.href = url;

})

</script>

@endsection