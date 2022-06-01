<?php

echo "tirelink project belongs to gaurav";


/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */
   $time = time();
  $navigation_background_color = get_field('navigation_background_color','options');
  $navigation_hover_color = get_field('navigation_hover_color','options');
  $navigation_text_color = get_field('navigation_text_color','options');
   $navigation_hover_text_color = get_field('navigation_hover_text_color','options');
   $large_button_regular_color = get_field('large_button_regular_color','options');
   $large_button_regular_text_color = get_field('large_button_regular_text_color','options');




   $large_button_highlight_text_color = get_field('large_button_highlight_text_color','options');

   $large_button_highlight_BGcolor = get_field('large_button_highlight_color','options');

   $superClient = $_COOKIE['superClient'];

   $customerid = $_COOKIE['cust_id'];
   $cookie = wp_parse_auth_cookie( '', 'logged_in' );
   $token = $cookie['token'];

   $session_tkn = $_SESSION['session_token'];

   $user = wp_get_current_user();
   $loggin_id = $user->data->user_login;

   if(isset($_COOKIE['class_font']) && !empty($_COOKIE['class_font'])){
      $footer_font = 'footer-large-size';
      $footer_type = 'font_type_style';
    }else{
      $footer_font = '';
      $footer_type = '';   
    }

?>

<!-- Modal -->
       
<!--SET: FOOTER-->
</div>

    <footer>
      <div class ="inner-containerfooter" id = "footer-scroll">
        <div class="container <?php echo $footer_font?> <?php echo $footer_type?>">
            <div class="footer clearfix removemargins">
              <div class="row">
                <div class="col-sm-6 top-margins-left">
                  <a href="https://www.hitstiresoftware.com" target="_blank">
                    <img src="https://hitstiresoftware.com/wp-content/uploads/2020/02/andreoli-logo-tirelink-footer.png
                        "class="footerLogo">
                  </a>

                  <span class="siteBy"><a href="https://www.hitstiresoftware.com" target="_blank"> Tire Software &amp; Site </a> by Andreoli Software </span>

                   <span class ="backtoTop" style="display: none;"><a href ="#" class="back_to_top"> <i class="fa fa-chevron-circle-up iconTOP" style="font-size:24px"></i></a></span>

                 </div>
                <div class="col-sm-6 top-margins-right">
                     <p>&#9400; Copyright <?php echo date('Y')?> <?php echo get_bloginfo( 'name' ); ?></p>
                </div>
              </div>
            </div>
        </div>
      </div>

  <div class="modal fade" id="myModal-display" role="dialog">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <div class="modal-dialog displayOpt">
     <div id="loadingGIF_filter_font"></div>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title ftrPopup">Set Display Options</h4>
            <span class="sucess"></span>
            <span class="error"></span> 
        </div>
        <div class="modal-body">

           <form name="fonts-display" class="displayOptions" action="#">
              <div class="row">
                    <div class="col-sm-12">
                       <div class="fontSize-area">
                          <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Select font size:</label>
                            <div class="col-sm-6">
                          <select name = "font-size" class="fnt-size form-control"> 
                            <option value = "regular" <?php echo ($_COOKIE['font_size'] == 'regular') ? 'selected' : '' ?>> Regular </option>
                            <option value = "large" <?php echo ($_COOKIE['font_size'] == 'large') ? 'selected' : '' ?>> Large</option>
                          </select>
                            </div>
                          </div>
                          </div>
                        </div>
                 </div>
                  <div class="row">
                    <div class="col-sm-12">
                       <div class="fontSize-area">
                          <div class="form-group" style="margin-top: 10px">
                            <label class="control-label col-sm-4" for="email">Select font type:</label>
                            <div class="col-sm-6">
                    <select name = "font-type" class="fnt-type form-control">
                       <option value = "Arial" <?php echo ($_COOKIE['font_type'] == 'Arial') ? 'selected' : '' ?>> Arial </option>
                       <!-- <option value = "Courier" <?php echo ($_COOKIE['font_type'] == 'Courier') ? 'selected' : '' ?>> Courier  </option> -->
                        <option value = "Open Sans" <?php echo ($_COOKIE['font_type'] == 'Open Sans') ? 'selected' : '' ?>> Open Sans </option>
                        <option value = "Roboto" <?php echo ($_COOKIE['font_type'] == 'Roboto') ? 'selected' : '' ?>> Roboto</option>
                         <option value = "Times New Roman" <?php echo ($_COOKIE['font_type'] == 'Times New Roman') ? 'selected' : '' ?>> Times New Roman</option>
                          <option value = "Verdana" <?php echo ($_COOKIE['font_type'] == 'Verdana') ? 'selected' : '' ?>> Verdana</option>
                     </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                 <div class="row">
                    <div class="col-sm-12">
                       <div class="fontSize-area">
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-2">
                              <button type ="button" class="smallbtn11 smallbtn fontSize" data-btn = "loadingGIF_s">Save</button>
                            </div>
                            <div class="col-sm-2">
                              <button type="button" class="smallbtn11 smallbtn cancelBtn-popup" data-dismiss="modal">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>

           </form>
         
        </div>
        <div class="modal-footer">
        </div>
      </div>
      
    </div>
  </div>


    </footer>

    <?php 

     $slug_chk = basename(get_permalink());

     if($slug_chk == 'login-user'){

        $css_sty = '0px';

     }else{
        $css_sty = '70px';
     }


      $sort_result_option = get_field('sort_result','options');
      global $wp;
      $slug = home_url(add_query_arg(array(), $wp->request));


      $url = explode("/",$slug);
      $pageSlug = $url[3];

     if(isset($_COOKIE['font_size']) && !empty($_COOKIE['font_size'])){
        $font_size = $_COOKIE['font_size'];
      }else{
         $font_size = '';     
      }
     
      if(isset($_COOKIE['font_type']) && !empty($_COOKIE['font_type'])){
          $font_type = $_COOKIE['font_type'];
      }else{
          $font_type = '';
      }

    $today_date = date("d-m-Y");      


    $slug = basename(get_permalink());

    ?>


<!--END: FOOTER-->


</div>

<style type="text/css">


.addPlus .fa-plus{
    background: <?php echo  $large_button_highlight_BGcolor  ?>;
    text-align: center;
    width: 25px;
    height: 25px;
    border-radius: 100%;
    /*font-size: 20px;*/
    line-height: 27px;
    color:<?php echo  $large_button_highlight_text_color ?>;
}

.addPlus .fa-arrow-right{
    background: <?php echo  $large_button_highlight_BGcolor  ?>;
    text-align: center;
    width: 25px;
    height: 25px;
    border-radius: 100%;
    /*font-size: 20px;*/
    line-height: 27px;
    color:<?php echo  $large_button_highlight_text_color ?>;
}


  #content-wrap{
   padding-bottom: <?php echo $css_sty ?>;
}  

.sizePopup {
    z-index: 999999 !important;
   /* padding-top: 160px !important;*/
}

.displayModal {
    width: 700px !important;
}

.modal-open{
  padding-right: 0px !important;
}

.red{
    color: #dc1919 !important;
  }


  .section4 .alignnone {
    margin: 0px 0px 0px 0 !important;
}

  .section5 .alignnone {
    margin: 0px 0px 0px 0 !important;
}

.section5 p{
      padding-bottom: 0px !important;
}

.innerpage .section4 {
    padding: 0px 0px !important;
}

.fontSize{
    width: auto;
    height: auto; 
    padding: 0 30px;
    display: block;
    background-color: background-color: <?php echo $large_button_regular_color; ?>;  
    color: <?php echo $large_button_regular_text_color; ?>;
    line-height: 36px !important;
    border-radius: 5px !important;
    -webkit-border-radius: 5px !important;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
    /*margin-top: 14px !important;*/
    margin-bottom: 20px !important;
}

.cancelBtn-popup{
    width: auto;
     height: auto; 
    padding: 0 30px;
    display: block;
    background-color: <?php echo $large_button_regular_color; ?>;  
    color: <?php echo $large_button_regular_text_color; ?>;
    line-height: 36px !important;
    border-radius: 5px !important;
    -webkit-border-radius: 5px !important;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
    /*margin-top: 14px !important;*/
    margin-bottom: 20px !important;
}


.fontType{
   width: auto;
     height: auto; 
    padding: 0 30px;
    display: block;
    background-color: #3b3b3b;
    line-height: 36px !important;
    border-radius: 5px !important;
    -webkit-border-radius: 5px !important;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
     margin-top: 14px !important;
    margin-bottom: 20px !important;
}

.displayOpt{
  padding-top: 183px;
    width: 50% !important;
}



.ftrPopup{
  padding-top: 8px;
  font-size: 22px;
}

.section h3{
  color: <?php echo $navigation_background_color; ?> !important ;
}

.footer .row{
  margin-right: 0px !important;;
    margin-left: 0px !important;;
}

.top-margins-left{
    padding-right: 0px !important;
  padding-left: 0px !important; 
  padding-top: 10px !important;
  text-align: left;
}

.top-margins-right{
  padding-right: 0px !important;
  padding-left: 0px !important;
  padding-top: 10px !important;
  text-align: right;
}



  #loadingGIF_filter_font{
     position:fixed; 
     top: 30%;
    left: 50% ;
    z-index:99999; 
    display:none;
  }

#loadingGIF_filter_font.show-spiner {
    display: block !important;
    position: fixed;
    z-index: 99999;
    background-image: url(/wp-content/uploads/2019/05/25.gif);
    background-color: #a29999ad;
    opacity: 1.5;
    background-repeat: no-repeat;
    background-position: center;
    left: 0;
    bottom: 0;
    right: 0;
    top: 0;
}

.siteBy a{ color: <?php echo $navigation_text_color?>  }
.siteBy a:hover{ color: <?php echo $navigation_hover_color ?>}

  @media screen and (max-width: 1024px){
  header nav { border-radius: 0; }
  header nav ul li { border-radius: 0; }
  header nav ul li a { border-radius: 0; }
  header nav ul li:first-child.current-menu-item a { border-radius: 0; }
  .tabsec .resp-tabs-list li { padding-left: 38px; padding-right: 38px; }
  .tabsec .resp-tabs-list li.resp-tab-active, .tabsec .resp-tabs-list li:hover { padding-left: 38px!important; padding-right: 38px!important; }
}

@media screen and (max-width: 1000px){
  #logo { padding-left: 0; max-width: 260px; }
  .headtext { padding-right: 0; }
  #logo img { max-width: 260px; }
  header nav { border-radius: 0; }
  header nav ul li { border-radius: 0; }
  header nav ul li a { padding: 0 35px; }
  header nav ul li:last-child a { border-radius: 0; }
  header nav ul li:last-child:after { display: none; }
}

@media screen and (max-width: 991px){
  .boxgroup { padding:18px }
  header nav ul li a { padding: 0 21.95px; }
  .tablist { padding: 0 20px; }
  .tabsec .resp-tabs-list li { padding-left: 16px; padding-right: 16px; }
  .tabsec .resp-tabs-list li.resp-tab-active, .tabsec .resp-tabs-list li:hover { padding-left: 16px!important; padding-right: 16px!important; }
  .sizing ul li:first-child { max-width: 160px; }
  .addons { max-width: 218px; }
  .retail_price { max-width: 170px; }
}
@media screen and (max-width: 768px){
  .tabsec ul.resp-tabs-list { display: block; }
  .tabsec h2.resp-accordion { display: none; }
}

@media screen and (max-width: 767px){
  .container{padding: 0 15px !important}
  .innerpage .section{padding: 0px !important}
  #logo { max-width: 100%; text-align: center; margin-bottom: 35px; padding-left: 0; }
  .headtext { float: none; display: block; width: 100%; text-align: center; margin-bottom: 25px; }
  #nav-toggle { display: block; }
  header { height: auto; padding-left: 0; padding-right: 0; padding-top: 25px; padding-bottom: 0; border-bottom: none; }
  header .container { padding-left: 0; padding-right: 0; }
    header nav { display: none; float: none; width: 100%; }
    .menu { width: 100%; margin-top: 0; padding-right: 0; position: relative; background-color: #3b3b3b; bottom: 0; display: inline-block; vertical-align: top; min-height: 60px; padding-top: 60px; }
  header nav ul li:first-child { border-radius: 0; }
  header nav ul li:first-child a { border-radius: 0; }
  header nav ul li:after { display: none; }
    header nav ul li { display: block; float: none; border-bottom: 1px solid #ffffff; padding-left: 0; padding-right: 0; border-radius: 0; }
    header nav ul li a { border-radius: 0; }
    header nav ul li:last-child { border: none; }
  .menu nav ul > li > ul { position: relative; width: 100%; border: none; }
  .menu nav ul > li > ul li { text-align: center; }
  .leftside { width: 100%; float: none; display: inline-block; vertical-align: top; }
  .searchsec { margin-bottom: 25px; }
  .homepage .heading { height: 65px; padding: 0 15px 0 90px; cursor: pointer; }
  .homepage .heading h6 { line-height: 65px; }
  .heading h6 { padding: 0; font-size: 30px; line-height: 54px; }
  .heading .icons { display: block; vertical-align: middle; position: absolute; top: 50%; transform: translateY(-50%); left: 15px; }
  .heading.active .icons  { background-image: url(<?php bloginfo('template_directory'); ?>/assets/images/minus_icon.png); }
  .listing { display: none; }
  .rightside { width: 100%; padding-left: 0; float: none; display: inline-block; vertical-align: top; }
  .rightside .heading { display: block; }
  body { background-color: #ffffff; }
  .boxgroup { box-shadow: none; padding : 10px;   }
  .searchsec input { height: 65px; font-size: 36px; }
  .tablist { display: none; }
  .tabsec ul.resp-tabs-list { display: none; }
  .tabsec h2.resp-accordion { display: block; }
  .tabsec h2.resp-accordion { border: none; background-color: <?php echo $navigation_background_color ?> !important; font-weight: normal; font-size: 16px; line-height: 44px; padding-top: 0!important; padding-bottom: 0!important; margin-bottom: 10px; border-radius: 7px; -wekit-border-radius: 7px; -moz-border-radius: 7px; -ms-border-radius: 7px; -o-border-radius: 7px; color: #ffffff; position: relative; padding-left: 45px!important; }
  .tabsec h2.resp-accordion i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); -webkit-transform: translateY(-50%); -moz-transform: translateY(-50%); -ms-transform: translateY(-50%); -o-transform: translateY(-50%); }
  .tabsec h2.resp-accordion i img { display: block; }
  .resp-arrow { margin-top: 15px; border-left: 6px solid transparent; border-right: 6px solid transparent; border-top: 12px solid #ffffff; }
  .tabsec .resp-tabs-container { border-radius: 7px; -wekit-border-radius: 7px; -moz-border-radius: 7px; -ms-border-radius: 7px; -o-border-radius: 7px; }
  .tabsec h2.resp-accordion.resp-tab-active { border: none!important; background-color: <?php echo $navigation_hover_color ?> !important; color:<?php echo $navigation_hover_text_color ?> ; } 
  .tabsec h2.resp-tab-active span.resp-arrow { border: none; border-left: 6px solid transparent; border-right: 6px solid transparent; border-bottom: 12px solid #ffffff; }
  .sizing ul li { margin-bottom: 5px; } 
  .radiosec ul li { margin-bottom: 5px; } 
  /*.padtop { padding-top: 32px; }*/
  .boxgroup.innerpage, .boxgroup.postList { text-align: center; }
  main { padding-top: 15px; }

@media screen and (max-width: 640px){
  .loginform_sec ul { max-width: 375px; }
  .headtext ul li { float: none; display: block; }
  .headtext ul li:after { display: none; }
  .loginform_sec ul li label { width: 120px; }
  .loginform_sec input { width: 255px; }
}
@media screen and (max-width: 479px){

  .sizePopup .modal-dialog {
      width: 383px !important;
  }


  #logo img { max-width: 260px; }
  .homepage .heading { height: 44px; padding: 0 0 0 76px; }
  .icons { width: 30px; height: 30px; }
  .homepage .heading h6 { font-size: 24px; line-height: 44px; }
  .searchsec input { height: 44px; font-size: 16px; }
  .loginform_sec .section { padding: 30px 15px }
  .loginform_sec ul li label { width: 100%; margin-bottom: 10px; border-radius: 7px; -wekit-border-radius: 7px; -moz-border-radius: 7px; -ms-border-radius: 7px; -o-border-radius: 7px; }
  .loginform_sec input { width: 100%; border-radius: 7px; -wekit-border-radius: 7px; -moz-border-radius: 7px; -ms-border-radius: 7px; -o-border-radius: 7px; }
  .sizing ul li { padding: 0; text-align: left; }
  .sizing ul li:first-child { max-width: 100%; }
  .qty, .retail_price, .addons { max-width: 100%; }
  .radiosec ul li { width: 100%; text-align: left; }
  .allbtn ul li { width: 100%; text-align: center; }
  h1 { font-size: 32px; }

  .tabsec h2.resp-accordion.resp-tab-active { border: none!important; background-color: <?php echo $navigation_hover_color ?> !important; color:<?php echo $navigation_hover_text_color ?> ; } 

}




</style>


<!--SET: SCRIPT HERE-->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery-1.12.4.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.matchHeight.js?v=<?php echo $time ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/easyResponsiveTabs.js?v=<?php echo $time ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/custom.js?v=<?php echo $time ?>"></script>

<!--END: SCRIPT HERE-->


  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap-glyphicons.css">   
<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<script src="/wp-content/themes/tirelinkTheme/assets/js/dataTable.js"></script>
 <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap_3.7.css?v=<?php echo $time ?>"> 

<!--  <link rel="stylesheet" href="<?php //bloginfo('template_url'); ?>/assets/css/bootstrap.css" type="text/css"  /> -->

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 


<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/jquery.skeleton.css" type="text/css"  />

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.scheletrone.js"></script>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/printThis.js"></script>


<script type="text/javascript">


  var now = new Date().toLocaleString();

var usertokens = '<?php echo $token;?>';
var sesstokens = '<?php echo $session_tkn;?>';

jQuery(window).scroll(function() {

  var sticky = jQuery('.menus'),
    scroll = jQuery(window).scrollTop();
   
        if (scroll >= 40) { 
          sticky.addClass('fixed'); }
        else { 
         sticky.removeClass('fixed');
      }
  
});

          var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
            if (isMobile) {
            }  else {

                  jQuery(window).scroll(function() {

                       scroll_tp = jQuery(window).scrollTop();

                        if (scroll_tp >= 315) { 
                        } 

                        var sticky_header_search = jQuery('.headerSection');
                        var sticky_footer = jQuery('.inner-containerfooter');

                        if (scroll_tp >= 207) { 
                              sticky_header_search.addClass('fixed-search-bar'); 
                              jQuery('.sticky-header-wh').addClass('onscroll-sticky');
                              jQuery('.tube-sticky').addClass('onscroll-sticky-tube');
                              jQuery('.sticky-wheel').addClass('onscroll-sticky-wheel');
                              jQuery('.sticky-accs').addClass('onscroll-sticky-accs');

                          } else { 
                             sticky_header_search.removeClass('fixed-search-bar');
                             jQuery('.sticky-header-wh').removeClass('onscroll-sticky');
                             jQuery('.tube-sticky').removeClass('onscroll-sticky-tube');
                              jQuery('.sticky-wheel').removeClass('onscroll-sticky-wheel');
                              jQuery('.sticky-accs').removeClass('onscroll-sticky-accs');
                          }
                          
                        if (scroll_tp >= 207) { 

                              if (jQuery(".headerSection").hasClass("fixed-search-bar")) {
                                  jQuery('.backtoTop').show();
                                  jQuery('.backtoTop').addClass('icon-style');
                                  sticky_footer.addClass('fixed-footer-bar'); 
                              }
                              
                          } else { 
                             sticky_footer.removeClass('fixed-footer-bar');
                             jQuery('.backtoTop').hide();
                             jQuery('.backtoTop').removeClass('icon-style');
                          }

                    });



            }



jQuery(".back_to_top").click(function () {
   jQuery("html, body").animate({scrollTop: 0}, 1000);
   return false;
});


  var pageSlug = '<?php echo $pageSlug ?>';
  var font_size  = '<?php echo $font_size ?>';
  var font_type  = '<?php echo $font_type ?>';

   if( pageSlug == 'help' && font_size == 'large' && font_type != ''){
          jQuery('.container').addClass("center-size-width large-size-active-help font_type_active_help");
  }

  var default_sorting =  '<?php echo $sort_result_option;?>';

//------------------------------Tube sorting-----------------------------//
if(default_sorting == 'Qty + Cost'){

  jQuery('#searchOutput_tube').DataTable( {
        "info":     false,
        "paging": false,
        "stripeClasses": [],
        'aaSorting': [ [0,'asc'] , [1,'asc'] , [ 15, "asc" ]  ],
    } );

}else{
   jQuery('#searchOutput_tube').DataTable( {
        "info":     false,
        "paging": false,
        // "autoWidth": false,
         'aaSorting': [ [0,'asc'] , [1,'asc'] , [ 15, "asc" ]  ],
    } );

}

//------------------------------Tube sorting end ---------------------------//

//------------------------------serach  sorting-----------------------------//
 if(default_sorting == 'Qty + Cost'){

        jQuery('#searchOutput_search').DataTable( {
        "info":     false,
        "paging": false,
        "stripeClasses": [],
          'aaSorting': [ [0,'asc'] , [1,'asc'] , [ 17, "asc" ]  ],
    } );

 }else{

  var t = jQuery('#searchOutput_search').DataTable( {
        "info":     false,
        "paging": false,
        'aaSorting': [ [0,'asc'] , [1,'asc'] , [ 17, "asc" ]  ],

    } );
 }

//------------------------------search sorting- end ----------------------------//



//------------------------------simple view   sorting-----------------------------//

 if(default_sorting == 'Qty + Cost'){

        jQuery('.simplePageView-table').DataTable( {
        "info":     false,
        "paging": false,
        'autoWidth' : false,
         'responsive': true,
        "stripeClasses": [],
          'aaSorting': [ [0,'asc'] , [1,'asc'] , [ 17, "asc" ]  ],
    } );

 }else{

  var t = jQuery('.simplePageView-table').DataTable( {
        "info":     false,
        "paging": false,
        'autoWidth' : false,
        'responsive': true,
        'aaSorting': [ [0,'asc'] , [1,'asc'] , [ 17, "asc" ]  ],

    } );
 }

//------------------------------view- end ----------------------------//




//------------------------------wheel sorting-----------------------------//
if(default_sorting == 'Qty + Cost'){

        jQuery('#searchOutput_wheel').DataTable( {
        "info":     false,
        "paging": false,
        "stripeClasses": [],
        "aaSorting": [  [0,'asc'] , [1,'asc'] , [ 14, "asc" ] ],
    } );

 }else{
      jQuery('#searchOutput_wheel').DataTable( {
              "info":     false,
              "paging": false,
              "aaSorting": [  [0,'asc'] , [1,'asc'] , [ 14, "asc" ] ],
      } );
}


//------------------------------wheel sorting  end -----------------------------//


//------------------------------Accs sorting-----------------------------//
if(default_sorting == 'Qty + Cost'){

   jQuery('#searchOutput_accs').DataTable( {
        "info":     false,
        "paging": false,
        "stripeClasses": [],
         "aaSorting": [ [0,'asc'] , [1,'asc'] , [ 14, 'asc' ]],
    } );

 }else{
  
    jQuery('#searchOutput_accs').DataTable( {
            "info":     false,
            "paging": false,
             "aaSorting": [ [0,'asc'] , [1,'asc'] ,  [ 14, 'asc' ]],
        } );
}


 jQuery('.account_summary').DataTable( {
        "info":     false,
        "paging": false,
        "bPaginate": false,
        "bFilter": false,
        "stripeClasses": [],
        order: [],
         columnDefs : [{
              "orderable": false
          }]
    } );

 jQuery('.order_history').DataTable( {
        "info":     false,
        "paging": false,
        "bPaginate": false,
        "bFilter": false,
        "stripeClasses": [],
        order: [],
         columnDefs : [{
              "orderable": false
          }]
    } );
  


jQuery('.sub-menu > .popup-display > a').click(function(){
 
      jQuery('#myModal-display').modal('show');
})


jQuery('.fontSize').click(function(){

      var nm =  jQuery('.displayOptions').serialize();

          var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
            jQuery.ajax({
                url: ajaxurl ,
                type : 'post',
                dataType : "html",
                data : {
                    action : 'set_font_size',
                    fontItem: nm,
                },
                 beforeSend: function() {
                         jQuery("#loadingGIF_filter_font").addClass('show-spiner');
                  },
                success : function( res) {
                   var response = JSON.parse(res);
                   console.log(response);
                       if(response.code = '1'){
                           jQuery("#loadingGIF_filter_font").removeClass('show-spiner');
                           setTimeout(function() {
                            var msg = '<div class="alert alert-success"><strong>Success!</strong> Font size saved succesfully</div>';
                             jQuery('.sucess').append(msg)
                        }, 2000);

                            setTimeout(function() {
                                jQuery('#myModal').modal('hide');
                        }, 2700);

                             setTimeout(function() {
                                  location.reload();
                        }, 3500);
                   }
                    
                  }  
              });


})

//------------------------------accs sorting end-----------------------------//

//Dropdown Menu
jQuery("a.slide-dropdown").click(function slideMenu() 
{
	jQuery(this).next('div').slideToggle();
	jQuery(this).parent().siblings().children().next('div').slideUp();
	
});

//Arrows
jQuery( ".crossRotate" ).click(function() {
    //alert($( this ).css( "transform" ));
    if (jQuery(this).css( "transform" ) == 'none' ){
        jQuery(this).css( "transform" , "rotate(-180deg)" );
    } 
	else{
        jQuery(this).css("transform","" ) ;
    }
});

// Dropdown toggle
jQuery('.dropdown-toggle').click(function(){
  jQuery(this).next('.admin-dropdown').toggle();
  return false;
});

// Dropdown toggle
jQuery('.dropdown-toggle').click(function(){
   jQuery(this).next('.dropdown').toggle();
   return false;
});


function is_safari_browser() { 


    if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
    {
        return 'Opera';
    }
    else if(navigator.userAgent.indexOf("Chrome") != -1 )
    {
        return 'Chrome';
    }
    else if(navigator.userAgent.indexOf("Safari") != -1)
    {
        return 'Safari';
    }
    else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
    {
         return 'Firefox';
    }
    else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
    {
      return 'IE'; 
    }  
    else 
    {
       return 'unknown';
    }
 }


 function print_safari(div_print , path){
 
          var d = new Date();
          var n = d.getTime();

          //Works with Chome, Firefox, IE, Safari
          //Get the HTML of div
          var divElements = document.getElementById(div_print).innerHTML;
          var printWindow = window.open("", "_blank", "");
          printWindow.document.open();
          printWindow.document.write('<html><head><title></title><link rel="stylesheet" type="text/css" href="'+path+'"><link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap_3.7.css?v='+n+'"> </head><body>');
          printWindow.document.write(divElements);
          printWindow.document.write('</body></html>');
          printWindow.focus();
          //The Timeout is ONLY to make Safari work, but it still works with FF, IE & Chrome.
          setTimeout(function() {
              printWindow.print();
              printWindow.close();
          },500);
          return false;
    }

</script>


<style type="text/css">

  table.brand-units  {
    clear: both;
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    /*max-width: 60% !important;*/
    border-collapse: separate 
  }

  .brand-units tr td.align-cntr{
  text-align: right;
  padding: 8px 30px !important;
}
  
    table.brandTotal tr td{
    padding: 8px 18px !important;
  }

   table.brandTotal tr th{
    padding: 8px 35px !important;
  }

  .brand-units tr th{
  padding: 8px 31px !important;
}

</style>

<?php wp_footer(); ?>
</body>
</html>
