<?php
namespace App\Classes;

class displayClass
{
	var $db='';
	var $tb_display='';
	var $str_field_id = '';
	var $mont= array ();
	var $page='';
	var $error='';
	var $lang='';
	 var $SID='';

  function display ()
	{
		    global $CLASS,$PAGE,$SID;
		    $this->db = $CLASS["db"];
		    $this->tb_display = "disp_tb";
              if (isset($CLASS["error"]))
		        $this->error = $CLASS["error"];
             isset ($CLASS["lang"]) ? $this->lang = $CLASS["lang"] : '';
	        $this->mont_en =  array ("January","February","March","April","May","June","July","August","September","October","November","December"); 
			 $this->mont_en_short =  array ("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"); 
			$this->mont_th = array ("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
            $this->mont_th_short = array ("ม.ค.","ก.พ.","มี.ค","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			$this->str_field_id = "type_page_id";
		    $this->page = $PAGE;
			$this->SID = $SID;
				if (empty($this->page)){
		              $this->page=1;
	           }
			    
    }
	
    function get_disp_html ($disp_name)
	{
		$this->db->fetch_array($this->db->query("SELECT * FROM ".$this->tb_display." WHERE disp_name LIKE '$disp_name' "));
		if ($this->db->record['disp_html']) {
		        $this->db->record['disp_html'] = ereg_replace("\"", "\\\"", $this->db->record['disp_html']);
		}else{
			 return false;
		}
        return $this->db->record['disp_html'];
	}
function show_tb_data ($sql_str,$header,$data,$footer) 
{  
	$sql_query = $sql_str;
	$query = $this->db->query ($sql_str); 
	$i=0;
	$num_rows = mysql_num_rows ($query);

	 eval("\$display_html = \"".$this->get_disp_html ($header)."\";");// Header
	    while ($i < $num_rows) {
			$fields_data = mysql_fetch_array($query);
			
			if ($class_td =="DataTD"){ //สลับสี
                  $class_td ="AltDataTD";
			}else{
				  $class_td ="DataTD";
			}
         // Get data name from system
		   while(list($key, $val) = each($fields_data))
           {
			    if (eregi("_id",$key) && eregi ($key,$this->str_field_id))
               {
					   $key_name = eregi_replace ("_id","_name",$key);
					   $fields_data[$key_name]=$this->get_data_sys_name ($key,$val);
			   }

			   //---------------------  Change number patern ---------------------- 
					$fields_type = $this->db->get_field_type_f_sql ($key,$sql_str);
					 if ($fields_type == "int")
						  $fields_num[$key] = number_format($fields_data[$key],0,'.',',');
					 if ($fields_type == "real")
						 $fields_num[$key] = number_format($fields_data[$key],2,'.',',');
		   }

			eval("\$display_html .= \"".$this->get_disp_html ($data)."\";");// Data
			$i++;
        }
    eval("\$display_html .= \"".$this->get_disp_html ($footer)."\";");// footer
   print $display_html;
  }

   function source_auto_close () 
  { 
	   print   "<script>";
	   print   "       function auto_close () {";
	   print    "                setTimeout(\"closeWin()\",2000)";
       print    "       }";
       print    "       function closeWin() {";
       print    "         self.close();";
       print    "       }";
	   print    "</script>";
   }
  function user_fucn_java ($func_name)
	{
	   print "<script>";
	   print    $func_name.";";
	   print "</script>";
	}

	function print_result ($msg_result) 
	{
		  eval("\$display_html=\"".$this->get_disp_html ("print_result")."\";");
		  print $display_html;
	}

		function button_back () 
	{
		  eval("\$display_html=\"".$this->get_disp_html ("button_back")."\";");
		  print $display_html;
	}

    function show_disp_html ($disp_name){
	
		  eval("\$display_html=\"".$this->get_disp_html ($disp_name)."\";");
		  print $display_html;

	}
	function first_value_list ($f_name,$f_value,$f_str)
    {
           if (empty($f_value) || $f_value == "%"){
			   print "<option value=\"\">".$f_str."</option>";
		   }else{
			   print "<option value=\"$f_value\">".$f_name."</option>";
		   }
	}
 function ddw_list ($sql_str,$f_name,$f_value)
  {
	  $this->db->query ($sql_str);
	   while ($this->db->fetch_array($this->db->result))
	  {
		  print "<option value='".$this->db->record[$f_value]."'>".$this->db->record[$f_name]."</option>";
	  }
  }

  function ddw_list_selected ($sql_str,$f_name,$f_value,$select_value)
  {
	  $this->db->query ($sql_str);
	   while ($this->db->fetch_array($this->db->result))
	  {
          if ($this->db->record[$f_value] == $select_value)
			   $str_selected = "selected";
		  else
               $str_selected = ""; 
		  print "<option value='".$this->db->record[$f_value]."'".$str_selected.">".$this->db->record[$f_name]."</option>";
	  }
  }

   function ddw_list_selected_re ($sql_str,$f_name,$f_value,$select_value)
  {
	  $this->db->query ($sql_str);	 
	   while ($this->db->fetch_array($this->db->result))
	  {
          if ($this->db->record[$f_value] == $select_value)
			   $str_selected = "selected";
		  else
               $str_selected = ""; 
		  $option .= "<option value='".$this->db->record[$f_value]."'".$str_selected.">".$this->db->record[$f_name]."</option>";
	  }
       return $option;
  }

function ddw_list_sys ($field_id) 
{
	  if (eregi ($field_id,$this->str_field_id))
	{
		     $tb_name = eregi_replace ("_id","_tb",$field_id);
	         $field_name = eregi_replace ("_id","_name",$field_id);
             $this->ddw_list ("select * from $tb_name",$field_name,$field_id);
     }
 }

  function delay_goto ($url,$time,$mode) { // Time secound unit
       print   "<script>";
	   print   "       function delay_goto () {";
	   print    "                setTimeout(\"goto()\",$time)";
       print    "       }";
       print    "       function goto() {";
	  if ($mode=="_self")
		    print    "         self.mainFrame.location.href='$url';";
	   if ($mode=="_self1")
		    print    "         self.location.href='$url';";
		   if ($mode=="_parent")
		    print    "         parent.mainFrame.location.href='$url';";
	    if ($mode=="_parent1")
		    print    "         parent.location.href='$url';";
		  if ($mode=="_blank")
		    print    "         opener.parent.location.href='$url';";
	   print    "       }";
	   print    "</script>";
   }

function get_data_sys_name ($field_id,$field_value)
  {
	//Get data name  form sys data 
     if (eregi ($field_id,$this->str_field_id) && !empty($field_value)) {
	      $tb_name = eregi_replace ("_id","_tb",$field_id);
	      $field_name = eregi_replace ("_id","_name",$field_id);
		  $this->db->fetch_array($this->db->query("SELECT * FROM ".$tb_name." WHERE $field_id LIKE '$field_value' "));
          return $this->db->record[$field_name];
	 }else{
		 return '';
	 }
  }
 function ddw_list_date ($selected)
  {
	  for ($date=1;$date<32;$date++)
	  {
		   if (strlen($date) < 2)
			   $date_value = "0".$date;
		   else
			   $date_value = $date;
			   
			if ($date==$selected)
			   $dSelected = 'selected';
			 else
			   $dSelected ='';
			   
		    print "<option value='$date_value' $dSelected >$date</option>";
	  }
   }

   function ddw_list_month ($lang,$selected)
	{
	     //print '<option>'.$selected;
          if ($lang=="th" || $lang=="en") {
			    
				($lang=="th")?$mont=$this->mont_th:$mont=$this->mont_en;

				 for ($i=0;$i < sizeof($mont);$i++)
		       {       
			          $mont_value = $i+1;
			          if (strlen($mont_value) < 2)
				              $mont_value = "0".$mont_value;
							  
					 if ($mont_value==$selected)
			             $mSelected = 'selected';
			        else
			             $mSelected ='';
			   		  
                     $this->set_option ($mont_value,$mont[$i],$mSelected); 
		       }//end for
       	  }else { // number patern
               for ($i=1;$i <=12;$i++)
			  {
                  if (strlen($i) < 2)
					  $mont_value="0".$i;
				  else
                      $mont_value= $i;

                  $this->set_option ($mont_value,$i,'');
			   }//end for
		  }

		 
	}

	function ddw_list_year_next ($amt_next,$lang,$selected)
	{
		if ($lang == "th")
			$dif_year = 543;
		else
			$dif_year = 0;
		 $c_year = date ("Y");
		 for ($i=0;$i<$amt_next;$i++)
		{  
			 $year = $c_year + $i;
			 
		   if ($selected== $year)	
			    $ySelected = 'selected';
		  else
			   $ySelected ='';
			   
						 
			  print "<option value=\"".$year."\" $ySelected >".($year + $dif_year)."</option>";
		}
	}
	function ddw_list_year_last ($amt_last,$lang,$selected)
	{
		if ($lang == "th")
			$dif_year = 543;
		else
			$dif_year = 0;

		 $c_year = date ("Y") ;

		 for ($i=0;$i<$amt_last;$i++)
		{  
			 $year = ($c_year - $i);
			  if ($selected== $year)	
			    $ySelected = 'selected';
		  else
			   $ySelected ='';
			   
			  
			  print "<option value=\"".$year."\" $ySelected>".($year + $dif_year)."</option>";
		}
	}
	
	function ddw_list_year_se ($y_start,$y_end,$lang,$selected)
	{
		if ($lang == "th")
			$dif_year = 543;
		else
			$dif_year = 0;
			
		 $c_year = $y_start;
		 for ($i=0;$i<($y_end - $y_start);$i++)
		{  
			 $year = $c_year + $i;
			 
		   if ($selected== $year)	
			    $ySelected = 'selected';
		  else
			   $ySelected ='';
			   
			  print "<option value=\"".$year."\" $ySelected >".($year + $dif_year)."</option>";
		}
	}

	function ddw_list_year_se_vth ($y_start,$y_end,$lang,$selected)
	{
		if ($lang == "th")
			$dif_year = 543;
		else
			$dif_year = 0;
			
		 $c_year = $y_start;
		 for ($i=0;$i<($y_end - $y_start);$i++)
		{  
			 $year = $c_year + $i;
			 
		   if ($selected== $year)	
			    $ySelected = 'selected';
		  else
			   $ySelected ='';
			   
			  print "<option value=\"".($year + $dif_year)."\" $ySelected >".($year + $dif_year)."</option>";
		}
	}

	function get_mont_name ($mont_value,$lang)
	{
		   if ($lang=="th") {
			    $mont = $this->mont_th;
          }else{
               $mont = $this->mont_en;
		  }
		 return $mont[$mont_value-1];
	}
	function get_month_th($month_num){
				$month_num=$month_num*1;
				switch($month_num){
						case "1" : $month="มกราคม";break;
						case "2" : $month="กุมภาพันธ์";break;
						case "3" : $month="มีนาคม";break;
						case "4" : $month="เมษายน";break;
						case "5" : $month="พฤษภาคม";break;
						case "6" : $month="มิถุนายน";break;
						case "7" : $month="กรกฏาคม";break;
						case "8" : $month="สิงหาคม";break;
						case "9" : $month="กันยายน";break;
						case "10" : $month="ตุลาคม";break;
						case "11" : $month="พฤศจิกายน";break;
						case "12" : $month="ธันวาคม";break;
				}
			return $month;
	}
	function get_year_name ($year_value,$lang)
    {
		  if ($lang == "th")
			$dif_year = 543;
		else
			$dif_year = 0;

		return ($year_value + $dif_year);
	}

 function set_option ($value,$name,$s) 
 {
           $option_str = "<option value=\"".$value."\" $s>".$name."</option>";
		   print $option_str;
  }

  function chk_box_name($sql,$field_show,$field_save,$chkbox_data,$chkbox_name,$amt_chkbox_per_row){ // $chkbox_data is string array
 if ($amt_chkbox_per_row == "") { //Default value
        $amt_chkbox_per_row=4;
 }
 if ($chkbox_data != "") { // case edit data
     $arr_data = explode (":",$chkbox_data); 
     $cnt_data = count ($arr_data);
     $i = 0;
     while ($i < $cnt_data) {
           $num_arr = $arr_data[$i];
           $arr_chk[$num_arr]  = "checked";
          $i++;
     }
 }
       $query = $this->db->query($sql);
	   $num_rows=mysql_num_rows($query);
	   print "<table><tr>";
	      $i=0;
  while($i<$num_rows)
     { 
                $fields_data =mysql_fetch_array($query);
				eval ("\$data_save=\"".$field_save."\";");
				eval ("\$data_show=\"".$field_show."\";");
                $name=$chkbox_name."[".$i."]";
                $str_chkbox="<input type='checkbox' name='$name' value='$data_save' $arr_chk[$data_save]>";  
     if (($i % $amt_chkbox_per_row == 0) && ($i != 0)) {
        print "</tr><tr><td valign='top'>".$str_chkbox."</td><td valign='top'><font color='#000000'>".$data_show."</font></td>";
     }else{
        print "<td valign='top'>".$str_chkbox."</td><td valign='top'><font color='#000000'>".$data_show."</font></td>";
     }
  
             $i++;
	  } 
	
	  print"</table>";
	  $amt_chkbox_name = "amt_".$chkbox_name;
	  print "<input type=\"hidden\" name=\"$amt_chkbox_name\" value=\"$num_rows\">";
}
 function chk_box_name1($sql,$field_show,$field_save,$chkbox_data,$chkbox_name,$amt_chkbox_per_row){ // $chkbox_data is string array
 if ($amt_chkbox_per_row == "") { //Default value
        $amt_chkbox_per_row=4;
 }
 if ($chkbox_data != "") { // case edit data
     $arr_data = explode (":",$chkbox_data); 
     $cnt_data = count ($arr_data);
     $i = 0;
     while ($i < $cnt_data) {
           $num_arr = $arr_data[$i];
           $arr_chk[$num_arr]  = "checked";
          $i++;
     }
     }
       $query = $this->db->query($sql);
	   $num_rows=mysql_num_rows($query);
	   print "<table><tr>";
	      $i=0;
  while($i<$num_rows)
     { 
                $fields_data =mysql_fetch_array($query);
				eval ("\$data_save=\"".$field_save."\";");
				eval ("\$data_show=\"".$field_show."\";");
				$i1 = $i.substr($data_save,"0","2");
                $name=$chkbox_name."[".$i1."]";
                $str_chkbox="<input type='checkbox' name='$name' value='$data_save' $arr_chk[$data_save]>";  
     if (($i % $amt_chkbox_per_row == 0) && ($i != 0)) {
        print "</tr><tr><td valign='top'>".$str_chkbox."</td><td valign='top'><font color='#000000'>".$data_show."</font></td>";
     }else{
        print "<td valign='top'>".$str_chkbox."</td><td valign='top'><font color='#000000'>".$data_show."</font></td>";
     }
             $i++;
	  } 
	
	  print"</table>";
}
  function get_data_f_chkbox ($sql_str,$chkbox)
  {
	  $str_acc_member = "";
	  $amt_chkbox = $this->db->num_rows($this->db->query(stripslashes($sql_str)));
			
	        for ($i=0;$i<$amt_chkbox;$i++)
			{ 
			   $result = mysql_fetch_array ($this->db->result);
			   if (!empty($chkbox[$i])) {   
				  if (empty($str_acc_member))
				        $str_acc_member = $chkbox[$i];
				  else
				        $str_acc_member	 .= ":".$chkbox[$i];	 
				}		
			}//for
			return $str_acc_member;
   }

     function get_data_f_chkbox2 ($chkbox_name)
  {
	  $arr_chkbox = $this->lang->http_value ($chkbox_name);
	  $amt_chkbox = $this->lang->http_value ("amt_".$chkbox_name);

	        for ($i=0;$i<$amt_chkbox;$i++)
			{ 
			   if (!empty($arr_chkbox[$i])) {   
				  if (empty($str_acc_member))
				        $str_acc_member = $arr_chkbox[$i];
				  else
				        $str_acc_member	 .= ":".$arr_chkbox[$i];	 
				}		
			}//for
			return $str_acc_member;
   }
   
function show_tb_data_split_page ($sql_str,$header,$data,$footer,$page_size) 
{  
	$sql_query = $sql_str;
	$all_rows = $this->db->num_rows($this->db->query ($sql_str));

	$rt = $all_rows%$page_size;	// หาจำนวนหน้าทั้งหมด

	if($rt!=0) 
		{ 
			$totalpage = floor($all_rows/$page_size)+1; 
		}
	else 
		{
			$totalpage = floor($all_rows/$page_size); 
		}

	$goto = ($this->page-1)*$page_size;	// หาหน้าที่จะกระโดดไป

   $sql_limit = $sql_str." LIMIT $goto, $page_size";
   $query = $this->db->query ($sql_limit); 

	$i=0;
	$num_rows = mysql_num_rows ($query);

	 eval("\$display_html = \"".$this->get_disp_html ($header)."\";");// Header
	    while ($i < $num_rows) {
			$fields_data = mysql_fetch_array($query);
			
			if ($class_td =="DataTD"){ //สลับสี
                  $class_td ="AltDataTD";
			}else{
				  $class_td ="DataTD";
			}
         // Get data name from system
		   while(list($key, $val) = each($fields_data))
           {
			    if (eregi("_id",$key) && eregi ($key,$this->str_field_id))
               {
					   $key_name = eregi_replace ("_id","_name",$key);
					   $fields_data[$key_name]=$this->get_data_sys_name ($key,$val);
			   }
					$fields_type = $this->db->get_field_type_f_sql ($key,$sql_limit);
					 if ($fields_type == "int")
						  $fields_num[$key] = number_format($fields_data[$key],0,'.',',');
					 if ($fields_type == "real")
						 $fields_num[$key] = number_format($fields_data[$key],2,'.',',');

		   }

			eval("\$display_html .= \"".$this->get_disp_html ($data)."\";");// Data
			$i++;
        }
    eval("\$display_html .= \"".$this->get_disp_html ($footer)."\";");// footer
   print $display_html;
  }
  
  function show_tb_data_split_page_comm ($sql_str,$header,$data,$footer,$page_size) 
{  
	$all_rows = $this->db->num_rows($this->db->query ($sql_str));

	$rt = $all_rows%$page_size;	// หาจำนวนหน้าทั้งหมด

	if($rt!=0) 
		{ 
			$totalpage = floor($all_rows/$page_size)+1; 
		}
	else 
		{
			$totalpage = floor($all_rows/$page_size); 
		}

	$goto = ($this->page-1)*$page_size;	// หาหน้าที่จะกระโดดไป

   $sql_limit = $sql_str." LIMIT $goto, $page_size";
   $query = $this->db->query ($sql_limit); 

	$i=0;
	$num_rows = mysql_num_rows ($query);

	 eval("\$display_html = \"".$this->get_disp_html ($header)."\";");// Header
	    while ($i < $num_rows) {
			$fields_data = mysql_fetch_array($query);
			
			if ($class_td =="DataTD"){ //สลับสี
                  $class_td ="AltDataTD";
			}else{
				  $class_td ="DataTD";
			}
         // Get data name from system
		   while(list($key, $val) = each($fields_data))
           {
			    if (eregi("_id",$key) && eregi ($key,$this->str_field_id))
               {
					   $key_name = eregi_replace ("_id","_name",$key);
					   $fields_data[$key_name]=$this->get_data_sys_name ($key,$val);
			   }
		   }

			eval("\$display_html .= \"".$this->get_disp_html ($data)."\";");// Data
			$i++;
        }
	if($all_rows > $page_size){
    eval("\$display_html .= \"".$this->get_disp_html ($footer)."\";");// footer
	}
   print $display_html;
  }

function ctrl_page_design ($sql,$page_size,$txt_colr,$link_colr,$char_sub,$link_value) {
      $totalpage= $this->find_totalpage ($sql,$page_size);
				if ($totalpage > 1) {
					for($i=1 ; $i<$this->page ; $i++) 
						{
							echo "<a href='$PHP_SELF?page_size=$page_size&PAGE=$i$link_value'><font color=$link_colr>$i</font></a> $char_sub ";
						}

					        echo "<font color=$txt_colr><b>".$this->page."</b></font> $char_sub ";
					for($i=$this->page+1 ; $i<=$totalpage ; $i++) 
						{
							echo "<a href='$PHP_SELF?page_size=$page_size&PAGE=$i$link_value'><font color=$link_colr>$i</font></a> $char_sub ";
						} 
						  if (($this->page != $totalpage) && ($totalpage !=0)){
						    $next_page = $this->page+1;
						    print "<a href='$PHP_SELF?page_size=$page_size&PAGE=$next_page$link_value'><font color='$link_colr'> หน้าต่อไป&gt; </font></a>";
						   }
					    }
					}

function ctrl_page_design_limit_show ($sql,$page_show,$page_size,$txt_colr,$link_colr,$char_sub,$link_value) {
	global $startPage,$endPage;
     $totalpage= $this->find_totalpage ($sql,$page_size);
	  if ($page_show >= $totalpage)
		    $page_show=$totalpage;
			
		   if ($this->page==1){
                $startPage = 1;
			    $endPage = $page_show;
		   }else if ($this->page == $endPage && $this->page != $totalpage)  {
              $startPage = $this->page;
			  $endPage  +=($page_show-1); 
			  if ($endPage > $totalpage)
				      $endPage = $totalpage;
			}else if ($this->page < $startPage) {
				$endPage = $startPage;
				$startPage = ($endPage-$page_show)+1;
			}else if ($this->page == $totalpage){
				$endPage = $totalpage;
				$startPage = ($endPage-$page_show)+1;
			}


     $link_value .="&startPage=$startPage&endPage=$endPage";
      if ($this->page != 1){ // Prvious
						    $ctrlPage.= "<a href='$PHP_SELF?page_size=$page_size&PAGE=1$link_value'><font color='$link_colr'>  [หน้าแรก]  </font></a>";
							$prev_page = $this->page-1;
						    $ctrlPage.= "<a href='$PHP_SELF?page_size=$page_size&PAGE=$prev_page$link_value'><font color='$link_colr'>&lt;&lt;หน้าต่อไป  </font></a>";
						   }
				if ($totalpage > 1) {
					for($i=$startPage ; $i<$this->page ; $i++) 
						{
							$ctrlPage.= "<a href='$PHP_SELF?page_size=$page_size&PAGE=$i$link_value'><font color=$link_colr>[$i]</font></a> $char_sub ";
						}

					        $ctrlPage.= "<font color=$txt_colr><b>[".$this->page."]</b></font> $char_sub ";
				
					for($i=$this->page+1 ; $i<=$endPage ; $i++) 
						{
							$ctrlPage.= "<a href='$PHP_SELF?page_size=$page_size&PAGE=$i$link_value'><font color=$link_colr>[$i]</font></a> $char_sub ";
						} 
						  if (($this->page != $totalpage) && ($totalpage !=0)){
						    $next_page = $this->page+1;
						    $ctrlPage.= "<a href='$PHP_SELF?page_size=$page_size&PAGE=$next_page$link_value'><font color='$link_colr'>หน้าต่อไป&gt;&gt;</font></a>";
						 	$ctrlPage.= "<a href='$PHP_SELF?page_size=$page_size&PAGE=$totalpage$link_value'><font color='$link_colr'>  [หน้าสุดท้าย]  </font></a>";
						   }
					    }
						return $ctrlPage;
					}

function ctrl_page_design_limit_show_mssql ($tbName,$page_show,$page_size,$txt_colr,$link_colr,$char_sub,$link_value) {
   $sql = "select * from $tbName ";
   return $this->ctrl_page_design_limit_show ($sql,$page_show,$page_size,$txt_colr,$link_colr,$char_sub,$link_value);
}

function find_totalpage ($sql_str,$page_size) {
 $rows = $this->db->num_rows($this->db->query($sql_str));
  $rt = $rows%$page_size;	// หาจำนวนหน้าทั้งหมด
     if($rt!=0) 
		{ 
			$totalpage = floor($rows/$page_size)+1; 
		}
	else 
		{
			$totalpage = floor($rows/$page_size); 
		}
		return $totalpage;
	}

	function get_current_time_th ()
    {
		   $date = (date ("d")*1);
		   $mont_num = (date("n")-1);
		   $mont = $this->mont_th[$mont_num];
		   $year = (date("Y")+543);

		   return $date." ".$mont." ".$year;
	}
	function get_current_time_en ()
    {
		   $date = (date ("d")*1);
		   $mont_num = (date("n")-1);
		   $mont = $this->mont_en_sh[$mont_num];
		   $year = (date("Y"));
		   $time = (date(" H:i "));

		   return $date."-".$mont."-".$year."  ".$time;
	}

	function get_current_time ()
    {
		   $date = (date ("d"));
		   $mont = (date("m"));
		   $year = substr(date("Y")+543,-2);
		   $time = (date(" H:i:s"));

		   return $time." ".$date."/".$mont."/".$year;
	}
	
  function get_current_th ()
    {
		   $date = (date ("d"));
		   $mont= (date("m"));
		   $year = (date("Y")+543);

		   return $date."/".$mont."/".$year;
	}
	function substr_disp ($str,$limit_str)
	{
         if (strlen($str) > $limit_str)
		          return  substr($str,0,$limit_str)."..."; 
		 else
			     return $str;
	}

	function set_tag_script ($commd)
    {
		  print "<script>";
          print $commd;
		  print "</script>";
	}

	
function date_patn() {
 $date = date ("Y-m-d");
  return $date; 
}
	function get_date_th ($date_input)
    {
		   $date=substr($date_input,8,2);
		   $mont_num=(substr($date_input,5,2)-1);
		   $mont = $this->mont_th_short[$mont_num];
		   $year_en=substr($date_input,0,4);
           $year=$year_en+543;

		   return $date." ".$mont." ".$year;
	}
function get_date_th_long ($date_input)
    {
		   $date=substr($date_input,8,2);
		   $mont_num=(substr($date_input,5,2)-1);
		  // $mont = $this->mont_th_short[$mont_num];
		   $mont = $this->mont_th[$mont_num];
		   $year_en=substr($date_input,0,4);
           $year=$year_en+543;

		   return $date." ".$mont." ".$year;
	}
	function get_date_en ($date_input)
    {
		   $date=substr($date_input,8,2);
		   $mont_num=(substr($date_input,5,2)-1);
		   $mont = $this->mont_en_sh[$mont_num];
		   $year=substr($date_input,0,4);

		   return $date." ".$mont." ".$year;
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
	function chg_date_full_th($date){
			$d=explode("-",$date);
			$date=$d[2];
			$month=$this->mont_th[(($d[1]*1)-1)];
			$year=($d[0]+543);
			return ($date*1)." ".$month." ".$year;
	}
	function chg_date_short_th($date){
			$d=explode("-",$date);
			$date=$d[2];
			$month=$this->mont_th[(($d[1]*1)-1)];
			$year=($d[0]+543);
			return ($date)."/".$d[1]."/".$year;
	}
	function chg_date_appove ($date_input)
    {
	 $arr_date = explode ("-",$date_input); 
     $date = $arr_date[0];
	 $mont = $arr_date[1];
	 $year_th = $arr_date[2];
	 $year = $year_th-543;
	 
		   return $year."-".$mont."-".$date;
	}
	function chg_date_excel ($date_input)
    {
	 $arr_date = @explode ("-",$date_input); 
	 $date = @date('Y-m-d',@mktime(0,0,0,$arr_date[1],$arr_date[2],$arr_date[0]));
	 return $date;
	}
	
	function chg_int($num) { 
		     // Exe. $num = 200.30 
       $decimal=strchr($num,'.');  //$decimal = .30
     //  $decimal = substr($decimal_1,1,2);
      if ($decimal != "") {
              $num = strrev($num); //$num 03.002
              $num=strchr($num,'.');//$num .002
              $num=strrev($num);
	      }

     $numleng = strlen($num);
     $i = 0;
      while ($i < $numleng) {
            $str = substr($num,$i,1);
	    if (ereg("[0-9]",$str)) {
                 $newnum =$newnum.$str;              
	      }
	        $i++;
	     }
	     if ($decimal !=""){
	            $newnum = $newnum.$decimal;
		 }
	      return $newnum;
	}
	
function del_slashes ($str) {
$char="\\";
$result = strchr ($str,$char);
while ($result != "") {
      $str=stripslashes($str);
      $result = strchr ($str,$char); 
         }
return $str;
}
 	function get_date_time_patn ($date_time,$str_patn) // Specail $str_patn "d_th_short"= 21 ก.ย. 2456,"dt_th_short"= 21 ก.ย. 2456 11:59:59
    {   
       
		 $dtm = split (" ",$date_time,2);
		 $sub_date = split ("-",$dtm[0],3);
      
	       // ---------------------------------------
		   $pdate = $dtm[0];
		   $ptime = $dtm[1];
           // ---------------------------------------
            $date =  ($sub_date[2])*1;
		    $mont = ($sub_date[1])*1;
		    $year =  ($sub_date[0])*1;
		    //-----------------------------------------
	
		switch ($str_patn) {
				case 'd_th_short' ; {
				       return $date." ".$this->mont_th_short[$mont-1]." ".substr(($year+543),2,2);
					   break;
				}
               case 'dt_th_short'; {
                       return $date." ".$this->mont_th_short[$mont-1]." ".($year+543)." ".$ptime;
					   break;
			   }
			   case 'd_th' ; {
				       return $date." ".$this->mont_th[$mont-1]."  ".($year+543);
					   break;
				}
				case 'd_th_p' ; {
				       return $date." ".$this->mont_th[$mont-1]." พ.ศ. ".($year+543);
					   break;
				}				
			   case 'd_th_full' ; {
				       return $date." ".$this->mont_th[$mont-1]." พ.ศ. ".($year+543)." เวลา $ptime น. ";
					   break;
				}
               case 'dt_th'; {
                       return $date." ".$this->mont_th[$mont-1]." ".($year+543)." ".$ptime;
					   break;
			   }
			   case 'd_en_short' ; {
				       return $date." ".$this->mont_en_short[$mont-1]." ".($year);
					   break;
				}
               case 'dt_en_short'; {
                       return $date." ".$this->mont_en_short[$mont-1]." ".($year)." ".$ptime;
					   break;
			   }
			   default ;{
				      if (!empty($dtm[1]))
					{  
							$sub_time = split (":",$dtm[1],3);
							return date ($str_patn,mktime($sub_time[0],$sub_time[1],$sub_time[2],$sub_date[1],$sub_date[2],$sub_date[0]));
					}
					 else
					 {
							return date ($str_patn,mktime(23,59,59,$sub_date[1],$sub_date[2],$sub_date[0]));
					  }
			   }// Case default 
		  }//Switch
	}// function

	 function include_js_file ($js_file) {
		 print "<script language=\"JavaScript\" src=\"".$js_file."\" type=\"text/JavaScript\"></script>";
	}
   function limit_img_size ($img_file,$width_limit,$height_limit) {
        $img_size = getimagesize ($img_file);
         
		if (!empty($width_limit)) {
			 if ($img_size[0] > $width_limit)
				    $img_size[0] = $width_limit;
		}

		if (!empty($height_limit)) {
			 if ($img_size[1] > $height_limit)
				    $img_size[1] = $height_limit;
		}

		return $img_size;
   }

   function get_img_prop ($imgFile,$path_img) {
     
	   $imgSize = getimagesize ($path_img.$imgFile);

	   $sizeX = $imgSize[0];
	   $sizeY = $imgSize[1];	
       if(strval($sizeX != "" OR $sizeY != "")) 
			$dimesion = "$sizeX x $sizeY"; 
		else 
			$dimesion = "Unknown"; 

		$fsize = filesize($path_img.$imgFile);

		         if(strval($fsize >= "1024"))  {
			          $fsize = round($fsize/1024); 
					  $fsize = $fsize. "Kb"; 
				 }else
				     $fsize = $fsize. " "; 

				 $prop[0] = $dimesion;
				 $prop[1] = $fsize;

				 return $prop;
   }

   function resizeImg ($imgFile,$widthLimit,$heightLimit,$path_img) {

	      $imgSize = getimagesize ($path_img.$imgFile);
          if ($imgSize[0] > $imgSize[1]) // Width > Height
		       $mul = $widthLimit/$imgSize[0];
          else 
               $mul = $heightLimit/$imgSize[1];
         
		  $imgSize[0] = $imgSize[0]*$mul;
		  $imgSize[1] = $imgSize[1]*$mul;

		 return $imgSize;  
   }

function thCurrency_basic ($str) { // version is limit less than num=9999999,ไม่มี สตางค์
	    $numTh = array ("ศูยน์","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ด","แปด","เก้า");
		$unit      = array ("หน่วย","สิบ","ร้อย","พัน","หมื่น","แสน","ล้าน"); 
		$strlen = strlen($str);
		$thC=$result=$digit="";
		$pos = $strlen;
		  for ($i=0;$i<$strlen;$i++)
          {     $pos--;
		         $digit = substr($str,$i,1);
				 if ($digit>0) {
				      if ($pos==0){
						if ($strlen>=2 &&  $digit==1) // ไม่อ่าน สิบหนึ่ง
							$numTh[$digit] = "เอ็ด";
						    $thC = $numTh[$digit]; 
                      }else{
					     if ($pos==1 && $digit==2) // ไม่มี สองสิบ
						   $numTh[$digit] = "ยี่";
                         if ($pos==1 && $digit==1) // ไม่มี หนึ่งสิบ
                           $numTh[$digit] = "";
					       $thC = $numTh[$digit].$unit[$pos];
					 }
			  }else{
			     $thC='';
			  }
			  $result .=$thC;
	       }//for
		   return $result;
    }

	function thCurrency_decimal ($str) { // Require thCurrency_basic มีสตางค์
	  $str = number_format($str,2,'.','');
	  $strlen     = strlen ($str);
	  $decimal = strstr($str,".");// Find decimal

        if (!empty($decimal)){  // found decimal
				 $strlen -= strlen($decimal); 
				 if (strlen($decimal) <=2)
                     $footerString = "สิบสตางค์";
				 else
                     $footerString = "สตางค์";
				 $thDecimal = $this->thCurrency_basic (substr($decimal,1,2)).$footerString;
        }
          if (empty($decimal) || $decimal==".00")   
               $thDecimal="ถ้วน";
		
				return $this->thCurrency_basic (substr($str,0,$strlen)).'บาท'.$thDecimal;
  }

function  genjava_ddwlist1call2 ($sql,$fieldGrp,$fieldTxt,$fieldValue,$ddwlistNum,$showFunc,$firstField) {
		 //Use in page : onchange="selectChange(this, form1.sale_id, arrItemsTxt,arrItemsValue ,arrItemsGrp);"
		 $nl = "\n"; // New line
         echo '<SCRIPT LANGUAGE="JavaScript">'.$nl;
         echo '<!-- Begin '.$nl;
		 echo 'var arrItemsTxt'.$ddwlistNum.' = new Array();'.$nl;
		 echo 'var arrItemsValue'.$ddwlistNum.' = new Array();'.$nl;
		 echo 'var arrItemsGrp'.$ddwlistNum.' = new Array();'.$nl.$nl;
         //Create variable
		  $query         = $this->db->query ($sql);
		  $numRows  = $this->db->num_rows ($query);
          for ($i=0;$i < $numRows;$i++) {
          $result = $this->db->fetch_array ($query);
          echo 'arrItemsGrp'.$ddwlistNum.'['.$i.'] = "'.$result[$fieldGrp].'";'.$nl;
          echo 'arrItemsTxt'.$ddwlistNum.'['.$i.'] = "'.$result[$fieldTxt].'";'.$nl;
          echo 'arrItemsValue'.$ddwlistNum.'['.$i.'] = "'.$result[$fieldValue].'";'.$nl;
		  }//for
		 // Java function
		 if ($showFunc=='Y') {
         echo $nl.'function selectChange(control, controlToPopulate, ItemArrayTxt,ItemArrayValue, GroupArray,selectedValue)'.$nl;
         echo '{'.$nl;
         echo 'var myEle ;'.$nl;
         echo 'var x ;'.$nl;
         echo '// Empty the second drop down box of any choices'.$nl;
		 echo 'for (var q=controlToPopulate.options.length;q>=0;q--) controlToPopulate.options[q]=null;'.$nl;
         echo '// ADD Default Choice - in case there are no values'.$nl;
         echo 'myEle = document.createElement("option") ;'.$nl;
		
		 if (!empty($firstField)) {
			  echo 'myEle.value="";'.$nl;
			  echo 'myEle.text="'.$firstField.'";'.$nl;
			  echo 'controlToPopulate.add(myEle) ;'.$nl;
		 }
		 echo 'for ( x = 0 ; x < ItemArrayTxt.length  ; x++ )'.$nl;
         echo   '{'.$nl;
         echo '    if ( GroupArray[x] == control.value)'.$nl;
         echo '   {'.$nl;
         echo 'myEle = document.createElement("option") ;'.$nl;
         echo ' myEle.text = ItemArrayTxt[x] ;'.$nl;
		 echo ' myEle.value= ItemArrayValue[x] ;'.$nl;

		 echo 'if (ItemArrayValue[x]==selectedValue)'.$nl;
		 echo '   myEle.selected=true;'.$nl;
         echo '   controlToPopulate.add(myEle) ;'.$nl;
         echo '   }'.$nl;
         echo ' }'.$nl;
         echo '}'.$nl;
		 }
		 echo '//  End -->'.$nl;
		 echo '</SCRIPT>';

	 }

function  genjava_ddwlist1call3 ($sql,$fieldGrp,$fieldTxt,$fieldValue,$ddwlistNum,$showFunc,$first2Field) {
		 //Use in page : onchange="selectChange(this, form1.sale_id, arrItemsTxt,arrItemsValue ,arrItemsGrp);"
		 $nl = "\n"; // New line
         echo '<SCRIPT LANGUAGE="JavaScript">'.$nl;
         echo '<!-- Begin '.$nl;
		 echo 'var arrItemsTxt'.$ddwlistNum.' = new Array();'.$nl;
		 echo 'var arrItemsValue'.$ddwlistNum.' = new Array();'.$nl;
		 echo 'var arrItemsGrp'.$ddwlistNum.' = new Array();'.$nl.$nl;
         //Create variable
		  $query         = $this->db->query ($sql);
		  $numRows  = $this->db->num_rows ($query);
          for ($i=0;$i < $numRows;$i++) {
          $result = $this->db->fetch_array ($query);
          echo 'arrItemsGrp'.$ddwlistNum.'['.$i.'] = "'.$result[$fieldGrp].'";'.$nl;
          echo 'arrItemsTxt'.$ddwlistNum.'['.$i.'] = "'.$result[$fieldTxt].'";'.$nl;
          echo 'arrItemsValue'.$ddwlistNum.'['.$i.'] = "'.$result[$fieldValue].'";'.$nl;
		  }//for
		 // Java function
		 if ($showFunc=='Y') {
         echo $nl.'function selectChange2(control, controlToPopulate, ItemArrayTxt,ItemArrayValue, GroupArray,selectedValue)'.$nl;
         echo '{'.$nl;
         echo 'var myEle ;'.$nl;
         echo 'var x ;'.$nl;
         echo '// Empty the second drop down box of any choices'.$nl;
		 echo 'for (var q=controlToPopulate.options.length;q>=0;q--) controlToPopulate.options[q]=null;'.$nl;
         echo '// ADD Default Choice - in case there are no values'.$nl;
         echo 'myEle = document.createElement("option") ;'.$nl;
		
		 if (!empty($first2Field)) {
			  echo 'myEle.value="";'.$nl;
			  echo 'myEle.text="'.$first2Field.'";'.$nl;
			  echo 'controlToPopulate.add(myEle) ;'.$nl;
		 }
		 echo 'for ( x = 0 ; x < ItemArrayTxt.length  ; x++ )'.$nl;
         echo   '{'.$nl;
         echo '    if ( GroupArray[x] == control.value)'.$nl;
         echo '   {'.$nl;
         echo 'myEle = document.createElement("option") ;'.$nl;
         echo ' myEle.text = ItemArrayTxt[x] ;'.$nl;
		 echo ' myEle.value= ItemArrayValue[x] ;'.$nl;

		 echo 'if (ItemArrayValue[x]==selectedValue)'.$nl;
		 echo '   myEle.selected=true;'.$nl;
         echo '   controlToPopulate.add(myEle) ;'.$nl;
         echo '   }'.$nl;		 
         echo ' }'.$nl;
         echo '}'.$nl;

		 }
		 echo '//  End -->'.$nl;
		 echo '</SCRIPT>';
	 }
function  genjava_ddwlist1call_all ($sql,$fieldGrp,$fieldTxt,$fieldValue,$ddwlistNum,$showFunc,$firstField) {
		 //Use in page : onchange="selectChange(this, form1.sale_id, arrItemsTxt,arrItemsValue ,arrItemsGrp);"
		 $nl = "\n"; // New line
         echo '<SCRIPT LANGUAGE="JavaScript">'.$nl;
         echo '<!-- Begin '.$nl;
		 echo 'var arrItemsTxt'.$ddwlistNum.' = new Array();'.$nl;
		 echo 'var arrItemsValue'.$ddwlistNum.' = new Array();'.$nl;
		 echo 'var arrItemsGrp'.$ddwlistNum.' = new Array();'.$nl.$nl;
         //Create variable
		  $query         = $this->db->query ($sql);
		  $numRows  = $this->db->num_rows ($query);
          for ($i=0;$i < $numRows;$i++) {
          $result = $this->db->fetch_array ($query);
          echo 'arrItemsGrp'.$ddwlistNum.'['.$i.'] = "'.$result[$fieldGrp].'";'.$nl;
          echo 'arrItemsTxt'.$ddwlistNum.'['.$i.'] = "'.$result[$fieldTxt].'";'.$nl;
          echo 'arrItemsValue'.$ddwlistNum.'['.$i.'] = "'.$result[$fieldValue].'";'.$nl;
		  }//for
		 // Java function
		 if ($showFunc=='Y') {
         echo $nl.'function selectChange_all(control, controlToPopulate, ItemArrayTxt,ItemArrayValue, GroupArray,selectedValue)'.$nl;
         echo '{'.$nl;
         echo 'var myEle ;'.$nl;
         echo 'var x ;'.$nl;
         echo '// Empty the second drop down box of any choices'.$nl;
		 echo 'for (var q=controlToPopulate.options.length;q>=0;q--) controlToPopulate.options[q]=null;'.$nl;
         echo '// ADD Default Choice - in case there are no values'.$nl;
         echo 'myEle = document.createElement("option") ;'.$nl;
		
		 if (!empty($firstField)) {
			  echo 'myEle.value="";'.$nl;
			  echo 'myEle.text="'.$firstField.'";'.$nl;
			 // echo 'controlToPopulate.add(myEle) ;'.$nl;
		 }
		 echo 'for ( x = 0 ; x < ItemArrayTxt.length  ; x++ )'.$nl;
         echo   '{'.$nl;
         echo '    if ( GroupArray[x] == control.value)'.$nl;
         echo '   {'.$nl;
         echo 'myEle = document.createElement("option") ;'.$nl;
         echo ' myEle.text = ItemArrayTxt[x] ;'.$nl;
		 echo ' myEle.value= ItemArrayValue[x] ;'.$nl;
		 echo 'if (ItemArrayValue[x]==selectedValue)'.$nl;
		 echo '   myEle.selected=true;'.$nl;
         echo '   controlToPopulate.add(myEle) ;'.$nl;
         echo '   }'.$nl;	
         echo ' }'.$nl;
		 
         echo 'myEle = document.createElement("option") ;'.$nl;
         echo ' myEle.text = "- ทุกประเภทย่อย -";'.$nl;
		 echo ' myEle.value= "all";'.$nl;
		 echo '   myEle.selected=true;'.$nl;
         echo '   controlToPopulate.add(myEle) ;'.$nl;


         echo '}'.$nl;
		 }
		 echo '//  End -->'.$nl;
		 echo '</SCRIPT>';

	 }

 function gen_code_f_id ($tbName,$fieldID)
	  {	
			  $max = $this->db->find_max ($tbName,$fieldID);
			  $max++;
			  return substr(($max+10000),1,4);
	  }
	function mssql_datefomat($date)
	{
		if($date!="")
		{
			$Array=split(' ',$date);
				$Array[0] = sprintf("%02d",$Array[0]);
			switch(trim($Array[1])){
					case "ม.ค." : $forMat="01/".$Array[0]."/".$Array[2];break;
					case "ก.พ." : $forMat="02/".$Array[0]."/".$Array[2];break;
					case "มี.ค." : $forMat="03/".$Array[0]."/".$Array[2];break;
					case "เม.ย." : $forMat="04/".$Array[0]."/".$Array[2];break;
					case "พ.ค." : $forMat="05/".$Array[0]."/".$Array[2];break;
					case "มิ.ย." : $forMat="06/".$Array[0]."/".$Array[2];break;
					case "ก.ค." : $forMat="07/".$Array[0]."/".$Array[2];break;
					case "ส.ค." : $forMat="08/".$Array[0]."/".$Array[2];break;
					case "ก.ย." : $forMat="09/".$Array[0]."/".$Array[2];break;
					case "ต.ค." : $forMat="10/".$Array[0]."/".$Array[2];break;
					case "พ.ย." : $forMat="11/".$Array[0]."/".$Array[2];break;
					case "ธ.ค." : $forMat="12/".$Array[0]."/".$Array[2];break;
				 }
		}else{
			 $forMat="";
		}
		return $forMat;
	}
	
	function ms2my_datefomat($date)
	{
		if($date!="")
		{
			$Array=split(' ',$date);
				$Array[0] = sprintf("%02d",$Array[0]);
			switch(trim($Array[1])){
			case "ม.ค." : $Array[2]."-01-".$Array[0];break;
					case "ม.ค." : $forMat=$Array[2]."-01-".$Array[0];break;
					case "ก.พ." : $forMat=$Array[2]."-02-".$Array[0];break;
					case "มี.ค." : $forMat=$Array[2]."-03-".$Array[0];break;
					case "เม.ย." : $forMat=$Array[2]."-04-".$Array[0];break;
					case "พ.ค." : $forMat=$Array[2]."-05-".$Array[0];break;
					case "มิ.ย." : $forMat=$Array[2]."-06-".$Array[0];break;
					case "ก.ค." : $forMat=$Array[2]."-07-".$Array[0];break;
					case "ส.ค." : $forMat=$Array[2]."-08-".$Array[0];break;
					case "ก.ย." : $forMat=$Array[2]."-09-".$Array[0];break;
					case "ต.ค." : $forMat=$Array[2]."-10-".$Array[0];break;
					case "พ.ย." : $forMat=$Array[2]."-11-".$Array[0];break;
					case "ธ.ค." : $forMat=$Array[2]."-12-".$Array[0];break;
				 }
		}else{
			 $forMat="";
		}
		return $forMat;
	}
	
	function my2ms_datefomat($date)
	{ 
		$Array=split(' ',$date);
		$mydate = explode('-',$Array[0]);
		//$forMat=$mydate[2].'/'.$mydate[1].'/'.$mydate[0];//Doae
		$forMat=$mydate[1].'/'.$mydate[2].'/'.$mydate[0];//Biz
		if($mydate[1]=='00'&&$mydate[2]=='00'&&$mydate[0]=='00'){
			 $forMat="";
		}
		return $forMat;
	}
	
		function month_thai_full($month_number){
			switch($month_number*1){
					case "1" : $month_name="มกราคม";break;
					case "2" : $month_name="กุมภาพันธ์";break;
					case "3" : $month_name="มีนาคม";break;
					case "4" : $month_name="เมษายน";break;
					case "5" : $month_name="พฤษภาคม";break;
					case "6" : $month_name="มิถุนายน";break;
					case "7" : $month_name="กรกฏาคม";break;
					case "8" : $month_name="สิงหาคม";break;
					case "9" : $month_name="กันยายน";break;
					case "10" : $month_name="ตุลาคม";break;
					case "11" : $month_name="พฤศจิกายน";break;
					case "12" : $month_name="ธันวาคม";break;
					//default $month_name=""; break;
			}
			return $month_name;
	}
	
	function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {  
			$date_from=$datefrom;
			$date_to=$dateto;
			/*    
				$interval can be:    
				yyyy - Number of full years    
				q - Number of full quarters    
				m - Number of full months    
				y - Difference between day numbers      (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)    
				d - Number of full days    
				w - Number of full weekdays   
				 ww - Number of full weeks    
				 h - Number of full hours    n - Number of full minutes    
				 s - Number of full seconds (default)  
			 */    
	
	   if (!$using_timestamps) {
			  $datefrom = strtotime($datefrom, 0);    
			  $dateto = strtotime($dateto, 0);  
	   }
		 
	  $difference = $dateto - $datefrom; // Difference in seconds
			   switch($interval) {
				   
				   case 'yyyy': // Number of full years
						$years_difference = floor($difference / 31536000);
						if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
						 $years_difference--;
					   }
					   if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
						 $years_difference++;
					   }
					   $datediff = $years_difference;
						break;
							
				 case "q": // Number of full quarters
					   $quarters_difference = floor($difference / 8035200);
					   while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
						 $months_difference++;
					   }
					   $quarters_difference--;
					   $datediff = $quarters_difference;
					   break;
						   
				case "m": // Number of full months
					   $months_difference = floor($difference / 2678400);
						while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
						  $months_difference++;
						}
					   $months_difference--;
					   $datediff = $months_difference;
					   break;
					  
				case 'y': // Difference between day numbers
					   $datediff = date("z", $dateto) - date("z", $datefrom);
						break;
				  
				case "d": // Number of full days
						//$datediff = floor($difference / 86400);
						$sql="SELECT TO_DAYS('$date_to')-TO_DAYS('$date_from') AS date_diff";	
						$datediff=$this->db->get_data_field($sql,"date_diff");
						break;
				  
				case "w": // Number of full weekdays
						$days_difference = floor($difference / 86400);
						$weeks_difference = floor($days_difference / 7); // Complete weeks
						$first_day = date("w", $datefrom);
						$days_remainder = floor($days_difference % 7);
						$odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
						if ($odd_days > 7) { // Sunday
							$days_remainder--;
						}
						if ($odd_days > 6) { // Saturday
						 $days_remainder--;
						}
						$datediff = ($weeks_difference * 5) + $days_remainder;
						break;
				  
				case "ww": // Number of full weeks
						  $datediff = floor($difference / 604800);
						  break;
				  
				case "h": // Number of full hours
						  $datediff = floor($difference / 3600);
						  break;
				  
				case "n": // Number of full minutes
						  $datediff = floor($difference / 60);
						  break;
						  
				default: // Number of full seconds (default)
						  $datediff = $difference;
						  break;
						  
			  }    
		return $datediff;
	}
	
	function del_date($date_input,$num_date){
		$D = explode("-",$date_input);
		$date_del = date("Y-m-d", mktime(0, 0, 0,$D[1], $D[2]-$num_date, $D[0]));
		return $date_del;	
	}
	
	function add_date($date_input,$num_date){
		$D = explode("-",$date_input);
		$add_date = date("Y-m-d", mktime(0, 0, 0,$D[1], $D[2]+$num_date, $D[0]));
		return $add_date;	
	}	
	function replace_format($money){
		$money = str_replace(",","",$money);
		return($money);
	}
	function title_name($member_title_name,$member_code){		
		switch($member_title_name){
			case'1':
				$title_name = 'นาย';
			break;
			case'2':
				$title_name = 'นาง';
			break;
			case'3':
				$title_name = 'นางสาว';
			break;
			
			case'9': 
				$title_name = $this->db->get_data_field("SELECT member_prefix_other FROM cad_deposit_member WHERE member_prefix LIKE '$member_title_name' AND member_code LIKE '$member_code'  ",'member_prefix_other');
			break;
			

			default:
			$title_name ='';
			break;
		}
		return $title_name;
	}//end function



	function member_gender($gender){
		switch($gender){
			case'1':
				$gender = 'ชาย';
			break;
			case'2':
				$gender = 'หญิง';
			break;		
		}
		return $gender;
	}

	function chk_number($number){
		switch($number){
			case'':case'0':case'0.00':
				$number = '-';
			break;

			default:
				$number = number_format($number,2);
			break;
		}
		return $number;
	}
	
	function member_code($member_code){
		$count_member = trim(strlen($member_code));
		
						switch ($count_member){
									case 1:
										$zero = "0000000";
									break;
									
									case 2:
										$zero = "000000";
									break;
									case 3:
										$zero = "00000";
									break;
									case 4:
										$zero = "0000";
									break;			
									case 5:
										$zero = "000";
									break;
									case 6:
										$zero = "00";
									break;
									case 7:
										$zero = "0";
									break;
						}
		return  $zero.$member_code;
	}

	function member_group($member_group){
		$count_member = trim(strlen($member_group));
		
						switch ($count_member){
									case 1:
										$zero = "000";
									break;
									
									case 2:
										$zero = "00";
									break;
									case 3:
										$zero = "0";
									break;
						}
		return  $zero.$member_group;
	}
	function user_id_zero($max_zero,$value){
		$max_zero-=strlen($value);
		for ($i=1;$i<=$max_zero;$i++){
			$zero.='0';
		}
		return $zero.$value;
	}
	function get_provide($province_id){
		$province_name = $this->db->get_data_field("SELECT province_name FROM province WHERE province_id LIKE '$province_id' ","province_name");
		($province_name != '')?$name = " จ.".$province_name:$name=$province_name;
		return $name;
	}
	function max_page($bank_account_id,$max_line){
		$sql="SELECT
						IF(CEILING(count(bank_account_id) / $max_line) = 0 ,CEILING(count(bank_account_id) / $max_line)+1,CEILING(count(bank_account_id) / $max_line)) as max_page
					FROM	cad_deposit
					WHERE bank_account_id LIKE '$bank_account_id'					
				";
		return $this->db->get_data_field($sql,'max_page');
	}
}// Class
