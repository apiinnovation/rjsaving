<?php $pageName = 'ผู้ใช้งานระบบ';?>

@extends('layouts.layout')

@section('title','ระบบกองทุนฯ - '. $pageName)

@section('header')


@endsection


@section('content')
<form class="form-horizontal" role="form" id="frm" method="POST" action="{{ url('/updateUser') }}">
    {{ csrf_field() }}
    <input type="hidden" name="_action" id="_action" value="{{ (@$action ==''?'create':$action )}}">
    @include('sweet::alert')

    <section class="content-header">
        <div class="col-md-4">
            <h1>
            {{ $pageName}}
            </h1>
        </div>
        
        <a class="btn btn-app pull-right " href="{{ url('/regis_main')}}">               
        <i class="fa fa-search"></i> ค้นหา
      </a>      
        <a class="btn btn-app pull-right " id="btn_save">
        <i class="fa fa-save"></i> บันทึก
      </a>  
      <a class="btn btn-app pull-right" href="{{ url('/regis')}}">
        <i class="fa fa-file-o"></i> เพิ่ม
      </a> 
    </section>
    
    <br>


    <div class="col-md-12">
        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลผู้ใช้งาน</h3>                
            </div>
            
                <div class="box-body">
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
                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label " style="text-align: right"></label>
                        <div class="input-group col-md-2">
                            <span class="input-group-addon">
                                <input type="checkbox" class="minimal" name="XBIsActive" id="XBIsActive" value="1" {{ (@$res->XBIsActive ==1 || $action == "create" ?'checked':'' )}} >
                            </span>
                            <input type="text" class="form-control" value="ใช้งาน" readonly="" >
                         </div>
                    </div>
                </div>                    
                    <div class="form-group">    
                        <div class="row">
                        <label class="col-md-2 control-label required" style="text-align: right">ชื่อ-นามสกุล :</label>
                        <div class="col-md-2"><?php //print $res->XVPreCode;?>
                            <select class="form-control " name="XVPreCode" id="XVPreCode">
                                @foreach ($res_prefix as $prefix)
                                <option  value="{{ $prefix->XVPreCode}}" {{ (@$res->XVPreCode == $prefix->XVPreCode?'selected':'') }}  >{{ $prefix->XVPreName}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" class="form-control " name="XVPreName" id="XVPreName" value=" {{ @$res->XVPreName}}" >
                        </div>

                        <div class="col-md-3">
                            <input type="text" class="form-control " placeholder="ชื่อ" name="XVUserFName" id="XVUserFName"  value="{{ @$res->XVUserFName}}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control " placeholder="นามสกุล" name="XVUserLName" id="XVUserLName" value="{{ @$res->XVUserLName}}">
                        </div>
                        
                        </div>

                    </div>

                    <div class="form-group">                     
                        <div class="row">
                            <label class="col-md-2 control-label required" style="text-align: right">รหัสพนักงาน :</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control " placeholder="" id="XVEmpCode" name="XVEmpCode" value="{{ @$res->XVEmpCode}}"  >
                            </div>        
                            <label class="col-md-1 control-label" style="text-align: right">สังกัด :</label>
                            <div class="col-md-5">
                                <select class="form-control" id="XVBchCode" name="XVBchCode" id="XVBchCode">
                                @foreach ($res_bch as $arr_bch)
                                <option  value="{{ $arr_bch->XVBchCode}}" {{ (@$res->XVBchCode == $arr_bch->XVBchCode?'selected':'') }}  >{{ $arr_bch->XVBchName}}</option>
                                @endforeach                                  
                                </select>
                                <input type="hidden" class="form-control " placeholder="" id="XVBchName" name="XVBchName" value="{{ @$res->XVBchName}}" >
                            </div>     

                        </div>
                    </div>
                    
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2 control-label required" style="text-align: right">สาขาที่ดูแล :</label>
                    <div class="col-md-3">
                    <select class="form-control select2" multiple="multiple" data-placeholder="เลือกสาขา"
                            style="width: 100%;" id="XVBchCodeRef" name="XVBchCodeRef[]">
                        <?php 
                           
                           foreach ($res_bch as $arr_bch){
                               $selected="";
                               if ($res_userBch!=""){
                                foreach($res_userBch as $struct){
                                    if ($arr_bch->XVBchCode == $struct->XVBchCode){
                                        $selected="selected";
                                        break;
                                    }
                                }
                               }
                        ?>
                        <option value="{{ $arr_bch->XVBchCode}}"  {{ $selected }}  >{{ $arr_bch->XVBchName}}</option>
                        <?php
                           }
                        ?>

                    </select>
                    </div>
                </div>
            </div>
                    
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2 control-label " style="text-align: right"></label>
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">
                            <input type="checkbox" class="minimal" name="XBIsSave"  id="XBIsSave" value="1" {{ (@$res->XBIsSave ==1 || $action == "create"?'checked':'' )}} >
                        </span>
                        <input type="text" class="form-control" value="อนุญาตบันทึกเอกสาร" readonly="">
                     </div>

                </div>
            </div>
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2 control-label " style="text-align: right"></label>
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">
                            <input type="checkbox" class="minimal" name="XBIsApprove" id="XBIsApprove" value="1" {{ (@$res->XBIsApprove ==1 || $action == "create"?'checked':'' )}}>
                        </span>
                        <input type="text" class="form-control" value="อนุญาตอนุมัติเอกสาร" readonly="">
                     </div>

                </div>
            </div>
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2 control-label " style="text-align: right"></label>
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">
                            <input type="checkbox" class="minimal" name="XBIsReport" id="XBIsReport" value="1"  {{ (@$res->XBIsReport ==1 || $action == "create"?'checked':'' )}}>
                        </span>
                        <input type="text" class="form-control" value="อนุญาตดูรายงาน" readonly="">
                     </div>

                </div>
            </div>
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2 control-label " style="text-align: right"></label>
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">
                            <input type="checkbox" class="minimal" name="XBIsPrint" id="XBIsPrint" value="1" {{ (@$res->XBIsPrint ==1 || $action == "create"?'checked':'' )}} >
                        </span>
                        <input type="text" class="form-control" value="อนุญาติพิมพ์" readonly="" >
                     </div>

                </div>
            </div>   
                    
            <hr>
            <div class="form-group">    
                <div class="row">
                <label class="col-md-2 control-label" style="text-align: right">User :</label>
                <div class="col-md-2">
                    <input type="text" class="form-control " placeholder="User" name="username" id="username" value="{{ @$res->username }}" >
                </div>
                </div>

            </div>                    
            <div class="form-group">    
                <div class="row">
                <label class="col-md-2 control-label" style="text-align: right">Password :</label>
                <div class="col-md-2">
                    <input type="password" class="form-control " placeholder="Password" name="password" id="password1">
                </div>
                </div>

            </div>   
            <div class="form-group">    
                <div class="row">
                <label class="col-md-2 control-label" style="text-align: right">Confirm Password :</label>
                <div class="col-md-2">
                    <input type="password" class="form-control " placeholder="Confirm Password" id="password2" name="confirmpass">
                </div>
                </div>

            </div>                     
            </div>                
          </div>
    </div>
</form>       
@endsection


@section('footer')



<script>
  $(function () {
    $('.select2').select2()

    $('[data-mask]').inputmask()
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    
    if ($('#XVBchCode').val() ==""){
        $("#XVBchCode").val($("#XVBchCode option:first").val());
        
    }
    $('#XVBchName').val($( "#XVBchCode option:selected" ).text());
    
    if ($('#XVPreCode').val() ==""){
        $("#XVPreCode").val($("#XVPreCode option:first").val());       
    }
     $('#XVPreName').val($( "#XVPreCode option:selected" ).text());
    
    
   
    $('#XVBchCode').on('change', function() {
        var bch_select = $("option:selected", this);               
        $('#XVBchName').val(bch_select.text())
       // console.log(bch_select.text(),$('#XVBchName').val())
     });
     
    $('#XVPreCode').on('change', function() {
        var pre_select = $("option:selected", this);               
        $('#XVPreName').val(pre_select.text())
        //console.log(pre_select.text(),$('#XVPreName').val())
     });     
     
    $( "#btn_save" ).click(function() {
        var password1 = $("#password1").val();
        var password2 = $("#password2").val();

       
        if ($('#XVUserFName').val() == "" || $('#XVUserLName').val() == "")
        {
            swal("กรุณากรอก ชื่อนามสกุล !", "", "warning");
            return false;
        }
        
        if ($('#XVEmpCode').val() == "")
        {
            swal("กรุณากรอก รหัสพนักงาน !", "", "warning");
            return false;
        }        
        
        if ($('#XVBchCodeRef').val() == "")
        {
            swal("กรุณาเลือก สาขาที่ดูแล !", "", "warning");
            return false;
        }
        
        if(password1 != password2) {
            swal("กรุณากรอก Password ให้ตรงกัน !", "", "warning");
            return false;
        }        
        
        
    
        $( "#frm" ).submit();
    });
    
  })
 </script>
    
@endsection
