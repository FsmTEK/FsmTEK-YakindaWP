<?php
function add_custom_style_and_script() {
    global $wp_styles;
    global $wp_scripts;

    wp_register_style('_style', 	TEMPLATE_URL.'style.css');
    wp_register_script( '_counter', 	TEMPLATE_URL.'js/countdown.js', 	   'jquery');


    $wp_styles->do_items('_style');

    $wp_scripts->do_items('jquery');
    $wp_scripts->do_items('_counter');
}
add_action('options_style', 'add_custom_style_and_script');


    /**
     * Add stylesheet to the page
     */
    function safely_add_stylesheet() {
        wp_enqueue_style( 'admin-page-css', plugins_url('adminpage.css', __FILE__) );
        wp_enqueue_script( 'boot-js', plugins_url('bootstrap.min.js', __FILE__) );
    }
  add_action( 'admin_enqueue_scripts', 'safely_add_stylesheet' );




	
	


	

add_action('template_redirect', 'fsmmaintenance_template_redirect');

//TEMPLATE REDIRECT 
function fsmmaintenance_template_redirect(){
    $months = array();
    $months["January"]=1;
    $months["February"]=2;
    $months["March"]=3;
    $months["April"]=4;
    $months["May"]=5;
    $months["June"]=6;
    $months["July"]=7;
    $months["August"]=8;
    $months["September"]=9;
    $months["October"]=10;
    $months["November"]=11;
    $months["December"]=12;
    $chk = get_option('fsmmaintenance_settings');
    if(!is_user_logged_in()){
        if($chk['status']=="1"){
            $timestamp = mktime( $chk['hour'], $chk['minute'], 0, $months[$chk['month']], $chk['day'], $chk['year'] );

            if ( time() > $timestamp ) {
                return true;
            }

            //var_dump(TEMPLATE_URL.'index.php');
            //if ( file_exists (TEMPLATE_URL.'index.php')) {
                include_once TEMPLATE_PATH . 'index.php';
                exit;
            //}
        }
    }
    else{
        if($chk['status']=="1"){
            $timestamp = mktime( $chk['hour'], $chk['minute'], 0, $months[$chk['month']], $chk['day'], $chk['year'] );

            if ( time() > $timestamp ) {
                return true;
            }
            global $wp_roles;
            $roles = $wp_roles->get_names();

            $isDeny=false;

            $current_user = wp_get_current_user();
            $uRoles = $current_user->roles;
            //var_dump($uRoles);
            //var_dump($roles);
            foreach($uRoles as $uTemp){
                foreach($roles as $temp){
                    //echo $uTemp."-".$temp."<br>";
                    if(strtoupper($chk[$temp]) == strtoupper($uTemp)){
                        $isDeny=true;
                    }
                }
            }
            if($isDeny == false){
                return true;
            }
            //var_dump(TEMPLATE_URL.'index.php');
            //if ( file_exists (TEMPLATE_URL.'index.php')) {
            include_once TEMPLATE_PATH . 'index.php';
            exit;
            //}
        }
    }
}


function get_custom_page_data(){
    global $wp_roles;
    $roles = $wp_roles->get_names();

    $chk = get_option('fsmmaintenance_settings');
    $fsmSettings = array();
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
    return $fsmSettings;
}
?>