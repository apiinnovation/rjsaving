<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;
use App\Http\Requests;

class mainController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }   
    
    function thCurrency_basic($str) { // version is limit less than num=9999999,ไม่มี สตางค์
        $numTh = array("ศูยน์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $unit = array("หน่วย", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
        $strlen = strlen($str);
        $thC = $result = $digit = "";
        $pos = $strlen;
        for ($i = 0; $i < $strlen; $i++) {
            $pos--;
            $digit = substr($str, $i, 1);
            if ($digit > 0) {
                if ($pos == 0) {
                    if ($strlen >= 2 && $digit == 1) // ไม่อ่าน สิบหนึ่ง
                        $numTh[$digit] = "เอ็ด";
                    $thC = $numTh[$digit];
                }else {
                    if ($pos == 1 && $digit == 2) // ไม่มี สองสิบ
                        $numTh[$digit] = "ยี่";
                    if ($pos == 1 && $digit == 1) // ไม่มี หนึ่งสิบ
                        $numTh[$digit] = "";
                    $thC = $numTh[$digit] . $unit[$pos];
                }
            }else {
                $thC = '';
            }
            $result .= $thC;
        }//for
        return $result;
    }

    function thCurrency_decimal($str) { // Require thCurrency_basic มีสตางค์
        $str = number_format($str, 2, '.', '');
        $strlen = strlen($str);
        $decimal = strstr($str, "."); // Find decimal

        if (!empty($decimal)) {  // found decimal
            $strlen -= strlen($decimal);
            if (strlen($decimal) <= 2)
                $footerString = "สิบสตางค์";
            else
                $footerString = "สตางค์";
            $thDecimal = $this->thCurrency_basic(substr($decimal, 1, 2)) . $footerString;
        }
        if (empty($decimal) || $decimal == ".00")
            $thDecimal = "ถ้วน";

        return $this->thCurrency_basic(substr($str, 0, $strlen)) . 'บาท' . $thDecimal;
    }
    
    function gen_docno($table,$fild,$prefix)
    {
        $res_prefix = DB::table('TComMDocPrifix')
                        ->where('XVDocCode',$prefix)
                        ->first();
        
        $last_code = "";
        $sql = "SELECT '".$prefix."'+ FORMAT(GETDATE(),'yyMM') +'-'+ RIGHT('00000'+CAST((SELECT ISNULL(
		(SELECT  MAX(RIGHT(".$fild.",5)) as DocNo  
		FROM ".$table."
		WHERE LEFT(".$fild.",6) = '".$prefix."'+ FORMAT(GETDATE(),'yyMM'))
		,0)+1 )as varchar(10)),5) as DocNo";
        //print $sql;
        $res = DB::select($sql );

        return  $res[0]->DocNo;                      
    }

    public function chg_sqldate($date_input)
    {
        
        $arr_date = explode ("/",$date_input); 
        $date = $arr_date[0];
        $mont = $arr_date[1];
        $year_th = $arr_date[2];
        $year = $year_th-543;

        return $year."-".$mont."-".$date;
        
    }
    
    function chg_date ($date_input)
    {
        $arr_date = explode ("/",$date_input); 
        $date = $arr_date[0];
        $mont = $arr_date[1];
        $year_th = $arr_date[2];
        $year = $year_th-543;
        return $year."-".$mont."-".$date;
    }   
    
    function chg_date_th ($date_input)
    {
        $date = substr($date_input,8,2);
        $mont= substr($date_input,5,2);
        $year_en = substr($date_input,0,4);
        $year=$year_en+543;

        return $date."/".$mont."/".$year;
    }    
    function get_current_th ()
    {
        $date = (date ("d"));
        $mont= (date("m"));
        $year = (date("Y")+543);

        return $date."/".$mont."/".$year;
    }
    
    public function chg_repnumber($value)
    {        
        return str_replace(',', '', $value);
    }
    
    
    public function get_data_cus($cuscode)
    {
        $sql = "SELECT TOP 1 a.*,XVCusFname +' ' + XVCusLname as XVCusName ,XVBchName,XVDivName,XITrnQty,XFTrnAmount
                FROM [dbo].[TStkMCustomer] a
                INNER JOIN [dbo].[TComMBranch] b ON a.XVBchCode = b.XVBchCode
                INNER JOIN [dbo].[TComMDivision] c ON a.XVDivCode = c.XVDivCode
                INNER JOIN (SELECT XVCusCode, SUM(XITrnQty) as XITrnQty, SUM(XFTrnAmount) XFTrnAmount  
                            FROM TStkTTransaction
                            GROUP BY XVCusCode) d ON a.XVCusCode = d.XVCusCode
                Where XVCusStatus = '2'
                    AND ISNULL(a.XVCusCode,'') <> ''
                    AND a.XVCusCode = '$cuscode'
                ";

        $res = DB::select($sql);
        return $res;        
    }
    
    public function get_data_down($cuscode)
    {
        $sql = "SELECT *
                FROM [dbo].[TStkTDownStock] a
                Where XVDowDocStatus = '2'
                    AND ISNULL(a.XVCusCode,'') <> ''
                    AND a.XVCusCode = '$cuscode'
                ";        
        $res_all = DB::select($sql);
        return $res_all;        
    }
    
    public function get_count_down($cuscode)
    {
       $sql = "SELECT count(*) cnt_down
                FROM [dbo].[TStkTDownStock] a
                Where XVDowDocStatus = '2'
                    AND ISNULL(a.XVCusCode,'') <> ''
                    AND a.XVCusCode = '$cuscode'   
                    AND YEAR(XTWhenedit) = YEAR(GETDATE())
                ";      

        $res_all = DB::select($sql);
        return $res_all;
    }    
    
    public function get_data_up($cuscode)
    {
        $sql = "SELECT *
                FROM [dbo].[TStkTAddStock] a
                Where XVAddDocStatus = '2'
                    AND ISNULL(a.XVCusCode,'') <> ''
                    AND a.XVCusCode = '$cuscode'   
                ";

        $res_all = DB::select($sql);
        return $res_all;        
    }
    
    public function get_count_up($cuscode)
    {
       $sql = "SELECT count(*) cnt_add
                FROM [dbo].[TStkTAddStock] a
                Where XVAddDocStatus = '2'
                    AND ISNULL(a.XVCusCode,'') <> ''
                    AND a.XVCusCode = '$cuscode'   
                    AND YEAR(XTWhenedit) = YEAR(GETDATE())
                ";

        $res_all = DB::select($sql);
        return $res_all;        
    }
    
    
    
    
    
}
