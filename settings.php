<?php
//PLUGIN MENU
add_action('admin_menu', 'fsmmaintenance');

wp_enqueue_script('jquery');

function fsmmaintenance()
{
//TOP LEVEL MENU
    add_menu_page('Yakında Yönetim',
        'Yakında Yönetim',
        'administrator',
        'fsmmaintenance_option',
        'fsmmaintenance_option_page',
        plugins_url('/images/favicon16.ico', __FILE__),
        100
    );

	
}



// ADMIN VALUE
function fsmmaintenance_option_page()
{
    global $wp_roles;
    $roles = $wp_roles->get_names();

    $fsmSettings['pageTitle'] = "Yapım Aşamasında - Fsm Teknoloji Servislerii";
    $fsmSettings['companyName'] = "Fsm Teknoloji Servisleri";
    $fsmSettings['companylogo'] = "/images/site_logo.png";
    $fsmSettings['message'] = "Bu Site Yapım Aşamasında. Çok Yakında ";
    $fsmSettings['template'] = "Animasyon1";
    $fsmSettings['youtubeid'] = "";
    $fsmSettings['socialpartkey'] = "Göster";
    $fsmSettings['countdownpartkey'] = "Göster";
    $fsmSettings['year'] = "2016";
    $fsmSettings['month'] = "01";
    $fsmSettings['day'] = "01";
    $fsmSettings['hour'] = "01";
    $fsmSettings['minute'] = "00";
    $fsmSettings['status'] = "1";
    $fsmSettings['contactEmail'] = "name@youremail.com";
    $fsmSettings['contactNumber'] = "+905420000000";
    $fsmSettings['facebookLink'] = "http://www.facebook.com/fsmtek";
    $fsmSettings['twitterLink'] = "http://www.twitter.com/fsmtek";
    $fsmSettings['googleLink'] = "http://www.google.com/+fsmtek";
//DEFAULT DATA VARIABLES
    $templates = array();
    $templates[0]="Animasyon1";
    $templates[1]="Youtube";

    $socialpartkey = array();
    $socialpartkey[0]="Göster";
    $socialpartkey[1]="Gizle";
   
    $countdownpartkey = array();
    $countdownpartkey[0]="Göster";
    $countdownpartkey[1]="Gizle";
   
	
    $months = array();
    $months[0]="January";
    $months[1]="February";
    $months[2]="March";
    $months[3]="April";
    $months[4]="May";
    $months[5]="June";
    $months[6]="July";
    $months[7]="August";
    $months[8]="September";
    $months[9]="October";
    $months[10]="November";
    $months[11]="December";
    $errorMessage = "";
//DEFAULT DATA VARIABLES
    if (isset($_POST['SaveSettings'])) {

        $fsmSettings['pageTitle'] = trim($_POST['pageTitle']);
        $fsmSettings['companyName'] = trim($_POST['companyName']);
        $fsmSettings['companylogo'] = trim($_POST['companylogo']);
        $fsmSettings['message'] = trim($_POST['message']);
        $fsmSettings['template'] = trim($_POST['template']);
        $fsmSettings['youtubeid'] = trim($_POST['youtubeid']);
        $fsmSettings['socialpartkey'] = trim($_POST['socialpartkey']);
        $fsmSettings['countdownpartkey'] = trim($_POST['countdownpartkey']);
        $fsmSettings['year'] = trim($_POST['year']);
        $fsmSettings['month'] = trim($_POST['month']);
        $fsmSettings['day'] = trim($_POST['day']);
        $fsmSettings['hour'] = trim($_POST['hour']);
        $fsmSettings['minute'] = trim($_POST['minute']);
        $fsmSettings['status'] = trim($_POST['status']);
        $fsmSettings['contactEmail'] = trim($_POST['contactEmail']);
        $fsmSettings['contactNumber'] = trim($_POST['contactNumber']);
        $fsmSettings['facebookLink'] = trim($_POST['facebookLink']);
        $fsmSettings['twitterLink'] = trim($_POST['twitterLink']);
        $fsmSettings['googleLink'] = trim($_POST['googleLink']);
        foreach($roles as $temp){
            if($temp != "Administrator"){
                if (isset($_POST[$temp])) {
                    $fsmSettings[$temp] = $_POST[$temp];
                }
            }
        }

        $chk = get_option('fsmmaintenance_settings');

        if($errorMessage ==""){
            if($chk == false){
                add_option('fsmmaintenance_settings', $fsmSettings);
		echo '<div class="col-md-12 alert_message"><div class="alert alert-warning" role="alert">Ayarlamanız Eklendi</div></div>';
            }
            else{
                update_option('fsmmaintenance_settings', $fsmSettings);
				echo '<div class="col-md-12 alert_message"><div class="alert alert-success" role="alert">Başarıyla Keydedildi!</div></div>';
            }
        }
    }
    $chk = get_option('fsmmaintenance_settings');

    if($chk == true){
        $fsmSettings['pageTitle'] = $chk['pageTitle'];
        $fsmSettings['companyName'] = $chk['companyName'];
        $fsmSettings['companylogo'] = $chk['companylogo'];
        $fsmSettings['message'] = $chk['message'];
        $fsmSettings['template'] = $chk['template'];
        $fsmSettings['youtubeid'] = $chk['youtubeid'];
        $fsmSettings['socialpartkey'] = $chk['socialpartkey'];
        $fsmSettings['countdownpartkey'] = $chk['countdownpartkey'];
        $fsmSettings['year'] = $chk['year'];
        $fsmSettings['month'] = $chk['month'];
        $fsmSettings['day'] = $chk['day'];
        $fsmSettings['hour'] = $chk['hour'];
        $fsmSettings['minute'] = $chk['minute'];
        $fsmSettings['status'] = $chk['status'];
        $fsmSettings['contactEmail'] = $chk['contactEmail'];
        $fsmSettings['contactNumber'] = $chk['contactNumber'];
        $fsmSettings['facebookLink'] = $chk['facebookLink'];
        $fsmSettings['twitterLink'] = $chk['twitterLink'];
        $fsmSettings['googleLink'] = $chk['googleLink'];

        foreach($roles as $temp){
            if($temp != "Administrator"){
                if (isset($chk['status'])) {
                    $fsmSettings[$temp] = $chk[$temp];
                }
            }
        }
    }
    if($errorMessage ==""){
        echo $errorMessage."";
    }

    $adminBody = '	<div class="col-md-6 fc_rampro_body">
    <form  class="form-horizontal" role="form" style="background: none repeat scroll 0 0 #FFFFFF;clear: both;display: block;margin-left: -20px;overflow: hidden;padding: 20px 20px 20px 40px;position: relative;
z-index: 6;" name="settings" action="" method="post">
 
<div class="panel panel-default panel-primary">
   <div class="panel-heading"><h1>FsmTEK Yakında Sayfası</h1></div>
  <div class="panel-body">
   <p>Bu Sayfadan Tüm Ayarlamanızı Yapabilirsiniz...</p>
  </div>
</div>
    <div class="panel panel-default panel-info">
   <div class="panel-heading">Genel Ayarlar</div>
  <div class="panel-body">
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Yakında Sistemi</label>
    <div class="col-sm-10">
     <select name="status" id="status" class="form-control">';
    if ($fsmSettings['status'] == "1") {
        $adminBody = $adminBody . '<option value="1" selected="selected">Açık</option>
            	<option value="0">Kapalı</option>';
    } else {
        $adminBody = $adminBody . '  
  <option value="1">Açık</option>
            	<option value="0" selected="selected">Kapalı</option>';
    }
    $adminBody = $adminBody . '</select>
    </div>
  </div>  
  <div class="form-group">
    <label for="pageTitle" class="col-sm-2 control-label">Site Başlığı</label>
    <div class="col-sm-10">
<input type="text" name="pageTitle" class="form-control" placeholder="Page Title" id="pageTitle" value=\'' . $fsmSettings['pageTitle'] . '\' />
    </div>
  </div>
   <div class="form-group">
    <label for="companyName" class="col-sm-2 control-label">Firma İsmi</label>
    <div class="col-sm-10">
<input type="text" name="companyName" class="form-control" placeholder="Your Company Name" id="companyName" value=\'' . $fsmSettings['companyName'] . '\' />
    </div>
  </div>    
  
  <div class="form-group">
    <label for="companylogo" class="col-sm-2 control-label">Logo Linki</label>
    <div class="col-sm-10">
<input type="text" name="companylogo" class="form-control" placeholder="http://www.fsmtek.com/logo.png" id="companylogo" value=\'' . $fsmSettings['companylogo'] . '\' />
    </div>
  </div> 
  
     <div class="form-group">
    <label for="message" class="col-sm-2 control-label">Siteye Not veya Mesaj</label>
    <div class="col-sm-10">
<input type="text"  class="form-control" name="message" id="message" value=\'' . $fsmSettings['message'] . '\' />
</div>
  </div> 
   <div class="form-group">
    <label for="template" class="col-sm-2 control-label">Yakında Teması</label>
    <div class="col-sm-10">
<select name="template" id="template" class="form-control">';
    foreach($templates as $temp){
        if ($fsmSettings['template'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select>
    </div>
  </div>
  
       <div class="form-group">
    <label for="youtubeid" class="col-sm-2 control-label" >Video ID <span style="font-size:9px">Youtbe Teması Seçili İse Çalışır</span></label>
    <div class="col-sm-10"><input type="text" class="form-control" placeholder="Youtube ID sini buraya Giriniz"  name="youtubeid" id="youtubeid" value=\'' . $fsmSettings['youtubeid'] . '\' />
    </div>
  </div> 
  
       <div class="form-group">
    <label for="socialpartkey" class="col-sm-2 control-label"> Sosyal Ağ</label>
    <div class="col-sm-10">
		<div class="col-sm-1">
	<select name="socialpartkey" id="socialpartkey">';
	 foreach($socialpartkey as $temp){
            if ($fsmSettings['socialpartkey'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
        }
    $adminBody = $adminBody . '</select>
    </div>	
    </div>
  </div>   
       
	   <div class="form-group">
    <label for="countdownpartkey" class="col-sm-2 control-label"> Geri Sayım Sayacı</label>
    <div class="col-sm-10">
		<div class="col-sm-1">
	<select name="countdownpartkey" id="countdownpartkey">';
	 foreach($countdownpartkey as $temp){
            if ($fsmSettings['countdownpartkey'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
        }
    $adminBody = $adminBody . '</select>
    </div>	
    </div>
  </div> 
  
  
  
  
  </div>
  </div>

    <div class="panel panel-default panel-info">
   <div class="panel-heading">Yetki Kontrolu</div>
  <div class="panel-body">
  
   <div class="form-group">
    <label class="col-sm-2 control-label">Kimler Yetkili?</label>
    <div class="col-sm-10">
		';

    foreach($roles as $temp){
        if($temp != "Administrator"){
            if ($fsmSettings[$temp] == $temp) {
                $adminBody = $adminBody . '<input type="checkbox" name="'.$temp.'" id="'.$temp.'" value="'.$temp.'" checked="checked" />'.$temp.'<br />';
            } else {
                $adminBody = $adminBody . '<input type="checkbox" name="'.$temp.'" id="'.$temp.'" value="'.$temp.'" />'.$temp.'<br />';
            }
        }
    }
    $adminBody = $adminBody . '		
  </div>   
  </div>  
  </div>  
  </div>  
  
  
  <div class="panel panel-default panel-info">
   <div class="panel-heading">Sayaç Ayarları</div>
  <div class="panel-body">
  <div class="form-group">
    <label for="year" class="col-sm-2 control-label">Lütfen İşi Teslim Tarihini Giriniz <span class="label label-danger">Önemli</span></label>
    <div class="col-sm-1 year_sec">
	<label for="year">Yıl</label>
     <select name="year" id="year"  class="form-control">';
    for($temp=date("Y");$temp<date("Y")+10;$temp++){
        if ($fsmSettings['year'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select>
    </div>    
	<div class="col-sm-1 month_sec">
	<label for="month">AY</label>
<select name="month" id="month">';
    foreach($months as $temp){
        if ($fsmSettings['month'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select>
    </div>	
	<div class="col-sm-1">
	<label for="day">Gün</label>
<select name="day" id="day">';
    for($temp=1;$temp<32;$temp++){
        if ($fsmSettings['day'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select>
    </div>	
	<div class="col-sm-1">
	<label for="hour">Saat</label>
<select name="hour" id="hour">';
    for($temp=0;$temp<24;$temp++){
        if ($fsmSettings['hour'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select>
    </div>	
	<div class="col-sm-1">
	<label for="minute">Dakika</label>
<select name="minute" id="minute">';
    for($temp=0;$temp<61;$temp++){
        if ($fsmSettings['minute'] == $temp) {
            $adminBody = $adminBody . '<option value="'.$temp.'" selected="selected">'.$temp.'</option>';
        } else {
            $adminBody = $adminBody . '<option value="'.$temp.'">'.$temp.'</option>';
        }
    }
    $adminBody = $adminBody . '</select>
    </div>
  </div>  
  </div>  
  </div>  

  
  <div class="panel panel-default panel-info">
   <div class="panel-heading">İletişim ve Sosyal Ağ Bilgileriniz</div>
  <div class="panel-body">
      <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Elektronik Posta Adresiniz</label>
    <div class="col-sm-10">
<input type="email" class="form-control"  placeholder="Email Address" name="contactEmail" id="contactEmail" value=\'' . $fsmSettings['contactEmail'] . '\' />
    </div>
  </div> 
     <div class="form-group">
    <label for="contactNumber" class="col-sm-2 control-label">Telefon Numaranız</label>
    <div class="col-sm-10"><input type="text" class="form-control" placeholder="+905420000000"  name="contactNumber" id="contactNumber" value=\'' . $fsmSettings['contactNumber'] . '\' />
    </div>
  </div> 
     <div class="form-group">
    <label for="facebookLink" class="col-sm-2 control-label">Facebook Linkiniz</label>
    <div class="col-sm-10"><input type="text" class="form-control" placeholder="http://facebook.com/fsmtek"  name="facebookLink" id="facebookLink" value=\'' . $fsmSettings['facebookLink'] . '\' />
    </div>
  </div>  
     <div class="form-group">
    <label for="twitterLink" class="col-sm-2 control-label">Twitter Linkiniz</label>
    <div class="col-sm-10"><input type="text" class="form-control" placeholder="http://twitter.com/fsmtek"  name="twitterLink" id="twitterLink" value=\'' . $fsmSettings['twitterLink'] . '\' />
    </div>
  </div> 
      <div class="form-group">
    <label for="googleLink" class="col-sm-2 control-label">Google+ Linkiniz</label>
    <div class="col-sm-10"><input type="text" class="form-control" placeholder="http://google.com/+fsmtek"  name="googleLink" id="googleLink" value=\'' . $fsmSettings['googleLink'] . '\' />
    </div>
  </div> 

  </div>
</div>

  
  
  <div class="panel panel-default panel-info">
   <div class="panel-heading">Bilgileri Kaydetme </div>
  <div class="panel-body">
      <div class="form-group">
    <label for="#" class="col-sm-8 control-label">   <p><span style="color: #7c909a;font-size: 13px;font-weight: normal;">Kaydet Butonuna Tıklayarak Kaydebilirsiniz... Gelişmemiz ve Size daha İYİ HİZMET verebilmemiz Lütfen Destek Olunuz... 3 TL Bagışlayınız</span></p></label>    
	<label for="#" class="col-sm-2 "> 
	<a class="btn btn-success" href="" role="button"> Lütfen Bagış Yapınız</a>
	</label>
    <div class="col-sm-2"><input type="SUBMIT" id="SaveSettings" name="SaveSettings" value="KAYDET" class="btn btn-primary" />
    </div>
  </div> 
    

  
  
  </div> 
  </div> 
	<div class="panel panel-default panel-info">
   <div class="panel-heading">Diğer Hizmetlerimiz</div>
  <div class="panel-body">
      <div class="form-group">
  
	
	
	
	<label for="#" class="col-sm-2 "> <a class="btn btn-success" href="http://www.fsmtek.com" role="button"> Web Sitemiz</a>
	</label>	
	
	<label for="#" class="col-sm-2 "> <a class="btn btn-success" href="http://www.fsmtek.com/web" role="button"> Bilişim Hizmetlerimiz</a>
	</label>
	
	<label for="#" class="col-sm-2 "> <a class="btn btn-success" href="mailto:admin@fsmte.com" role="button"> Bana Email Gönderin</a>
	</label>	


    </div>
  </div> 


</form>
</div>
	
';
    echo $adminBody;
}

?>