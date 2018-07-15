<?php 

$pageName = 'เอกสารขอลดหุ้น'; 
if(@$action ==''){
    $action ='create';
}
$stock_min = 200;
$down_max = 2;
?>

@extends('layouts.layout')

@section('title','ระบบกองทุนฯ - '. $pageName)

@section('header')

@endsection


@section('content')

<div class="col-md-10 col-md-offset-1">
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

    <form role="form" id="frm" class="form-horizontal" method="post" action="{{ url('/stkdown_save')}}">
        {{ csrf_field()}}
        <input type="hidden" name="_action" value="{{ (@$action ==''?'create':$action )}}">        
        <input type="hidden" name="doc_send"  id="doc_send" value="">
        <input type="hidden" name="XVBchCode" id="XVBchCode" value="{{ $res_cus[0]->XVBchCode or '' }}" >    
        
        <div class="row">
            <section class="content-header">
                <div class="col-sm-4">
                    <h1>
                        {{ $pageName }}                         
                    </h1>
                </div>
                <a class="btn btn-app btn-app-find pull-right " href="{{ url('/stkdown_main')}}">              
                    <i class="fa fa-search"></i> ค้นหา
                </a>
                @if (Auth::user()->XBIsPrint )
                <a class="btn btn-app btn-app-print pull-right ">
                    <i class="fa fa-print"></i> พิมพ์
                </a>
                @endif
    
                @if (Auth::user()->XBIsApprove =='1' && @$res_stk[0]->XVDowDocStatus =='1')
                    <button type="button" id="btn_cancel" class="btn btn-app btn-app-cancel pull-right  ">
                    <i class="fa fa-close"></i> ไม่อนุมัติ
                    </button>
                    
                    <button type="button" id="btn_confirm" class="btn btn-app btn-app-approve pull-right  ">
                    <i class="fa fa-check-square"></i> อนุมัติ
                    </button>

                @endif
                
                @if( ((@$res_stk[0]->XVDowDocStatus =='1' || @$res_stk[0]->XVDowDocStatus =='') && @$res_stk[0]->XBDowDocSend == false) || @$action =='create')
                    @if (Auth::user()->XBIsSave =='1')
                        @if (Auth::user()->XBIsApprove ==false )
                        <button type="button" id="btn_send" class="btn btn-app btn-app-send pull-right  ">
                            <i class="fa fa-send-o"></i> ส่งเอกสาร
                        </button>
                        @endif
                    
                        <button type="button" id="btn_save" class="btn btn-app btn-app-save pull-right  ">
                            <i class="fa fa-save "></i> บันทึก
                        </button>
                    @endif
                @endif
                <a class="btn btn-app btn-app-add pull-right  " href="{{ url('/stkdown')}}">
                    <i class="fa fa-file-o"></i> สร้างเอกสาร
                </a>
            </section>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="col-md-2"><h3 class="box-title">ข้อมูลสมาชิก</h3></div>
                <div class="col-md-10" style="text-align: right">
                    <h3 class="box-title text-green"> 
                        @if (@$res_stk[0]->XVDowDocStatus =='1' && (@$res_stk[0]->XBDowDocSend == true ))
                            {{'(รออนุมัติ)'}}
                        @elseif (@$res_stk[0]->XVDowDocStatus =='1' )
                            {{'(บันทึก)'}}
                        @elseif (@$res_stk[0]->XVDowDocStatus =='2' )
                            {{'(อนุมัติ)'}}
                        @endif
                    </h3></div>
            </div>

            <div class="box-body">

                <div class="form-group ">
                    <div class="row " >
                        <div class=" col-md-7"><input type="hidden" name="doc_status" id="doc_status" value="1"></div>                        

                        <label class="col-md-2 control-label" style="text-align: right">วันที่เอกสาร :</label>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker " 
                                       data-date-format="dd/mm/yyyy" 
                                       name="XDDowDocDate" id="XDDowDocDate" 
                                       value="{{ $doc_date }}">
                            </div>
                        </div>

                    </div>
                </div>
                
                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label" style="text-align: right">เลขที่เอกสาร :</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" readonly="" 
                                   name="XVDowDocNo" id="XVDowDocNo" 
                                   value="{{ $res_stk[0]->XVDowDocNo or 'Auto' }}" >
                        </div> 
                                            
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-md-2 control-label required" style="text-align: right">เลขสมาชิก :</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control " 
                                   name="XVCusCode" id="XVCusCode"  
                                   value="{{ $res_cus[0]->XVCusCode or '' }}">
                        </div>
                        <div class="col-sm-1">
                            <a href="#modalForm" data-toggle="modal"  class="btn btn-success">ค้นหา</a>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control " 
                                   placeholder="ชื่อ - นามสกุล" readonly="" 
                                   name="XVCusName" 
                                   value="{{ $res_cus[0]->XVCusName or '' }}">
                        </div>                         

                    </div>
                </div>

                <div class="form-group">    
                    <div class="row">
                        <label class="col-md-2 control-label" style="text-align: right">รหัสพนักงาน :</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control " 
                                   readonly="" 
                                   name="XVEmpCode" id="XVEmpCode" 
                                   value="{{ $res_cus[0]->XVEmpCode or '' }}" >
                        </div>    
                        <label class="col-md-1 control-label" style="text-align: right">สังกัด :</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control " placeholder="สังกัด"  readonly="" 
                                   name="XVBchName" value="{{ $res_cus[0]->XVBchName or '' }}" >
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control " placeholder="ฝ่าย/แผนก"  readonly="" 
                                   name="XVDivName" value="{{ $res_cus[0]->XVDivName or '' }}" >
                        </div>                       
                    </div>
                </div>

                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label " style="text-align: right">จำนวนหุ้นสะสม :</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control " style="text-align: right;" readonly="" 
                                   name="XIDowQtyBalance" id="XIDowQtyBalance" 
                                   value="{{ $qtybalance or '' }}" >                            
                        </div>

                        <label class="col-md-1 control-label" style="text-align: right">เป็นเงิน : </label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control " style="text-align: right;" placeholder="จำนวนเงิน" 
                                   readonly="" 
                                   name="XFDowAmtBalance" id="XFDowAmtBalance" 
                                   value="{{ $amtbalance or '' }}">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control " placeholder="จำนวนเงิน(ตัวอักษร)" readonly="" 
                                   name="XVAmountTxt" id="XVAmountTxt" 
                                   value="{{ $amtbalance_txt or '' }}">
                        </div>
                        <label class="col-md-1 control-label" style="text-align: left">บาท</label>
                    </div>
                </div>
                
            <div class="form-group">                     
                <div class="row">
                    <label class="col-md-2"></label>
                    <div class="col-md-10">
                        เริ่มเป็นสมาชิกเมื่อ…….…จำนวน……หุ้น  เพิ่มหุ้น……ครั้ง จำนวน……..หุ้น  (เพิ่มหุ้นครั้งสุดท้ายเมื่อ............... จำนวน ......หุ้น)
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-2"></label>
                    <div class="col-md-10">
                        ลดหุ้น .....ครั้ง จำนวน ........หุ้น  (ลดหุ้นครั้งสุดท้ายเมื่อ................. จำนวน ........หุ้น)
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-2"></label>
                    <div class="col-md-10">
                        ปัจจุบันมีหุ้นทั้งหมด ………หุ้น  ส่งเงินค่าหุ้นต่อเดือน……..………บาท  เป็นเงินสะสมทั้งสิ้น……..…....………บาท
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-2"></label>
                    <div class="col-md-10">
                        มีภาระหนี้เงินกู้ประเภท…………จำนวน.........…บาท  งวดที่.…….จำนวนหนี้คงเหลือ……………..บาท
                    </div>
                </div>                
            </div>                
            </div>

        </div>

        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">ขอลดหุ้น</h3>
            </div>
            <div class="box-body">
                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label" style="text-align: right">มีผลวันที่ :</label>

                        <div class="col-lg-2">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="datepicker form-control" 
                                       data-date-format="dd/mm/yyyy" 
                                       name="XDDowApproveDate" id="XDDowApproveDate"                                        
                                       value="{{ $doc_approvedate }}">                                  
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="form-group">                     
                    <div class="row">
                        <label class="col-md-2 control-label required" style="text-align: right">ลดหุ้น(จำนวน) :</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control " style="text-align: right;" placeholder="" 
                                   name="XIDowQty" id="XIDowQty" 
                                   value="{{ number_format(@$res_stk[0]->XIDowQty,0) }}">
                        </div>
                        <label class="col-md-1 control-label" style="text-align: right">เป็นเงิน : </label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control " style="text-align: right;" readonly="" 
                                   name="XFDowAmount" id="XFDowAmount" value="{{ number_format(@$res_stk[0]->XFDowAmount,2) }}" >
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control " placeholder="" readonly="" 
                                   name="XVDowAmountTxt" id="XVDowAmountTxt"
                                   value="{{ $addamt_txt or '' }}">
                        </div>
                        <label class="col-md-1 control-label" style="text-align: left">บาท</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-md-2 control-label " style="text-align: right">คงเหลือเป็น(หุ้น) :</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control " style="text-align: right;" placeholder="" readonly="" 
                                   name="XIDowSumQty" id="XIDowSumQty"
                                   value="{{ @number_format($res_stk[0]->XIDowSumQty,0) }}">                            
                        </div>

                        <label class="col-md-1 control-label" style="text-align: right">เป็นเงิน : </label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control " style="text-align: right;" placeholder="" readonly="" 
                                   name="XFDowSumAmount" id="XFDowSumAmount"
                                   value="{{ @number_format($res_stk[0]->XFDowSumAmount,2) }}">
                        </div>
                        
                        <div class="col-sm-4">
                            <input type="text" class="form-control " placeholder="" readonly="" 
                                   name="XVDowSumAmountTxt" id="XVDowSumAmountTxt"
                                   value="{{ $addsumamt_txt or ''}}">
                        </div>
                        <label class="col-md-1 control-label" style="text-align: left">บาท</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">         
                        <label class="col-md-2 control-label " style="text-align: right">เหตุผล :</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="ระบุเหตุผลกรณีไม่ผ่าน" name="XVDowRemark" id="XVDowRemark" 
                                   value="{{ $res_stk[0]->XVDowRemark or '' }}">
                        </div> 
                    </div>
                </div>                

                
            <div class="form-group">                     
                <div class="row">
                    <div class="col-md-5">
                    <label class="col-md-5 control-label " style="text-align: right"></label>
                    <div class="input-group col-md-7">
                        <span class="input-group-addon">
                            <input type="checkbox" class="minimal" name="XBIsApprove" id="XBIsApprove" value="1" >
                        </span>
                        <input type="text" class="form-control bg-red disabled color-palette" value="ขอลดหุ้นกรณีพิเศษ" style="background-color: red" readonly="">

                    </div>
                    </div>
                    
                    <div class="col-md-6">
                        <input type="text" class="form-control  " placeholder="ระบุเหตุผลการขอลดหุ้นกรณีพิเศษ"
                               name="XVDowSumAmountTxt" id="XVDowSumAmountTxt" 
                               value="{{ $addsumamt_txt or ''}}">                        
                    </div>

                </div>
            </div>
                


            </div>
            
            
        </div>
        

    </form>
</div>


<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>
<div class="loading">
    <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><br/>
    <span>Loading</span>
</div>


@endsection


@section('footer')

<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<script>



$(document).ready(function () {

    $('.datepicker').datepicker({
       language:'th-th',format:'dd/mm/yyyy',
        autoclose: true,
    });
    
    $('.datepicker').keydown(function(event) { 
        return false;
    });

    $( "#btn_save" ).click(function() {
        $('#doc_send').val('0');        
        $("#doc_status").val('1');
        $( "#frm" ).submit();
        return;
    });
    
    $( "#btn_confirm" ).click(function() {
        $('#doc_send').val('1');
        $('#doc_status').val('2');
        //return;
        $( "#frm" ).submit();
        return;
    });    
    
    $( "#btn_cancel" ).click(function() {
        $('#doc_send').val('1');
        $('#doc_status').val('3');
       
        if ($('#XVDowRemark').val() == ''){
            swal("กรุณาระบุเหตุผลกรณีไม่อนุมัติ", "", "error")
            return;
        }
        $( "#frm" ).submit();
        return;
    });     

    $( "#btn_send" ).click(function() {
        $('#doc_send').val('1');
        $('#doc_status').val('1');
        $( "#frm" ).submit();
        return;
    });
    
    $( "form" ).submit(function( event ) {
        
        var $sum_amt = $('#XIDowQty').val().replace(/,/g, "");
        var $stock_min = '<?php print $stock_min;?>';
        

        if ($sum_amt =='' || parseFloat($sum_amt) == 0){
            swal("กรุณากรอกจำนวนหุ้นที่ต้องการลด","","warning");
            return false;
        }

        if (parseFloat($('#XFDowSumAmount').val().replace(/,/g, "")) < parseFloat($stock_min) ){
            swal("ไม่สามารถลดหุ้นได้ เนื่องจากมูลค่าหุ้นคงเหลือขั้นต่ำต้องไม่น้อยกว่า " + $stock_min,"","warning")
            return false;
        }

     });
    
    $('#modalForm').on('show.bs.modal', function (event) {
        ajaxLoad({!! json_encode(url('/findcus/stkdown_getcus/')) !!}, 'modalForm');
    });


    $('#XVCusCode').keyup(function(e){
        if(e.keyCode == 13)
        {
            var url;
            if ($('#XVCusCode').val().length > 0 ){
                url = "{{URL::to('/stkdown_getcus/')}}"+'/'+$('#XVCusCode').val();
                window.location.href = url;
            }
        }
    });
    
   
    var $qty = $('#XIDowQty'),
            $sumqty = $('#XIDowSumQty'),
            $sumamt = $('#XFDowSumAmount'),
            $sumamttxt = $('#XVDowSumAmountTxt'),
            $qtytxt = $('#XVDowAmountTxt'),
            $amount = $('#XFDowAmount'),
            $qtytotal = $('#XIDowQtyBalance')
            ;
    var $price = 200;
    var $newPrice = $('#XVDowAmount');

    $qty.on('keypress', function (e)
    {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            e.stopImmediatePropagation();
            return false;
        }
    })
    .on('keyup change', function (e)
    {
        if ($.isNumeric($qty.val())) {
            $amount.val(Math.round(parseInt($qty.val()) * parseInt($price)));
            $sumqty.val(parseInt($qtytotal.val()) - parseInt($qty.val()));
            $sumamt.val(parseInt($sumqty.val()) * $price);


            $amount.val(addCommas(parseInt($amount.val()).toFixed(2)))
            $sumamt.val(addCommas(parseInt($sumamt.val()).toFixed(2)))

            $qtytxt.val(thaibaht($amount.val()))
            $sumamttxt.val(thaibaht($sumamt.val()));
        } else {
            $amount.val('');
            $qtytxt.val('');
            $sumqty.val('');
            $sumamt.val('');
            $sumamttxt.val('');
        }

    });
});

</script>

@endsection