
<div class="modal-dialog modal-lg" role="document" style="width:80%;">
    <div class="modal-content">
        <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             <h4 class="modal-title" id="myModalLabel">ค้นหาสมาชิก</h4>
        </div>
        <div class="modal-body">          
            <div class="box">
                <div class="box-body"  >
                    @if (count($errors) > 0)
                    <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif      

                    <table class="table table-bordered table-hover" id="cusdatatable"  style="width: 100%" >
                        <thead>
                            <tr>
                                <th style="text-align: center;width: 10px;">#</th>
                                <th style="text-align: center;width: 83px;">รหัสสมาชิก</th>
                                <th style="text-align: center;width: 83px;">รหัสพนักงาน</th>
                                <th style="text-align: center;width: 267px;">ชื่อ สกุล</th>
                                <th style="text-align: center;width: 166px;">สังกัดสาขา</th>
                                <th style="text-align: center;width: 168px;">หน่วย/ฝ่าย</th>
                                <th style="text-align: center;width: 80px;">หุ้นสะสม</th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php $i = 1; ?>
                            @foreach($res_all as $res)  
                            <tr style="cursor: pointer" data-cus="{{$res->XVCusCode}}" >
                                <td style="text-align: center" ><?php print $i++; ?></td>
                                <td>{{$res->XVCusCode}}</td>
                                <td>{{$res->XVEmpCode}}</td>
                                <td>{{$res->XVCusName}}</td>
                                <td>{{$res->XVBchName}}</td>
                                <td>{{$res->XVDivName}}</td>
                                <td style="text-align: right">{{ number_format($res->XITrnQty,0)}}</td>
                            </tr>
                            @endforeach                                
                        </tbody>

                    </table>


                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <button type="button" id="btnSelect" class="btn btn-primary">ยืนยัน</button>
        </div>
    </div>
</div>

<script>
    
    $(document).ready(function() {
        
        $('#btnSelect').click(function (e) {

            var selrow = $('tr.selected');
            //console.log(selrow);
            if (selrow.attr('data-cus') != undefined)
                window.location.href = {!! json_encode(url('/'.$url_return.'/')) !!} +'/'+ selrow.attr('data-cus')
            else
                swal("เกิดข้อผิดพลาด", "กรุณาเลือกรายการที่ต้องการ" , "warning");
        });
        
        $('#cusdatatable tr').dblclick(function(){
            console.log( $(this).attr('data-cus'));
            if ($(this).attr('data-cus') != undefined)                
                window.location.href = {!! json_encode(url('/'.$url_return.'/')) !!} +'/'+ $(this).attr('data-cus')
            else
                swal("เกิดข้อผิดพลาด", "กรุณาเลือกรายการที่ต้องการ" , "warning");
          })
          
        //$('#cusdatatable').modal({backdrop: 'static', keyboard: false})  
        $('#cusdatatable').DataTable({
            "language": {
                "search": "ค้นหา : ",
                "info": "รายการที่ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                "infoEmpty": "ไม่มีรายการ",
                "lengthMenu": "แสดง _MENU_ รายการ",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ย้อนกลับ"
                }
            },
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            //"scrollY":        "200px",
            "scrollCollapse": true,
            //"paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "select": true,
            fixedHeader: true
        })
        


    })
</script>

