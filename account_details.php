<?php
/**
 * Template Name: Account detials
 * Description: A Page Template that display order data.
 */
get_header();
	
	  $navigation_background_color = get_field('navigation_background_color','options');
      $navigation_text_color = get_field('navigation_text_color','options');
      $small_button_highlight_color = get_field('small_button_highlight_color','options');
      $small_button_highlight_text_color = get_field('small_button_highlight_text_color', 'options');

	    if(isset($_COOKIE['class_font']) && !empty($_COOKIE['class_font'])){
	        $comman_class = $_COOKIE['class_font'];
	     }else{
	       $comman_class = '';  
	     }

	   if(isset($_COOKIE['center-section-width']) && !empty($_COOKIE['center-section-width'])){
	        $center_section_width = $_COOKIE['center-section-width'];
	    }else{
	       $center_section_width = '';  
	    }

	    if(isset($_COOKIE['font_style_active']) && !empty($_COOKIE['font_style_active'])){
	        $font_style_active = $_COOKIE['font_style_active'];
	    }else{
	        $font_style_active = '';
	    }
?>

<?php
if ( is_user_logged_in() ) {

	$superClient = $_COOKIE['superClient'];
	if($superClient == '1'){

	$password = $_COOKIE['password'];	

	// make API CALL TO GET ACCOUN DATA //
	  $user_id = get_current_user_id();
	  $user = wp_get_current_user();

	  $SIGNATURE_SECRET_KEY  = "01123aca5813b00b";  
	  $date1 = date("Y-m-d H:i:s");
	  $timestamp =  date("Y-m-d\TH:i:s\Z", strtotime($date1)) ;  
	  $signature_token = hash_hmac('sha256', $timestamp , $SIGNATURE_SECRET_KEY ,  true);
	  $signature =  base64_encode($signature_token);

		$account_id =  get_field('account_id','options');
		// $customerid = $user->data->user_login;
		$customerid = $_COOKIE['cust_id'];

	    if( get_field('api_environment','options') == 'Production'){
	        $url = 'https://www.aasys-portal.com:60002/aapublic/tirelink.asmx?WSDL';
	    }elseif( get_field('api_environment','options') == 'Development'){
	        $url = 'https://www.aasys-dev.com:60002/aapublic/tirelink.asmx?WSDL';
	    }

	    $wsdlUrl = $url;
	     $opts = array(
        	'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false )
    	);
   
	    $soapClientOptions = array (
	        'trace' => 1, 
	        'exceptions' => 0, 
	        'keep_alive' => false, 
	        'stream_context' => stream_context_create($opts) 
	    );

	    $client = new SoapClient($wsdlUrl, $soapClientOptions );
	    $checkVatParameters = array(
	        'request'=>[
	                  'integratorId' => '667',
	                  'account' =>    $account_id,   
	                  'timestamp' =>  $timestamp,    
	                  'signature' =>  $signature,      //'IKhHSbgr0ZlqMJ0nTQ3Sw1GqUsDmdvopPcXFvqtq2PA=',
	                  'customer' =>   $customerid,  
	                  'password'=> $password,
	                  'cutoffDate'=> ''
	            ]
	    );

	    $result = $client->TLFetchAR($checkVatParameters);
	    if (is_soap_fault($result)) {
	     	wp_redirect( home_url().'/update/?api_sp=true&code='.$result->faultcode); 
	     	exit; 
	    }else{
	       	$array = json_encode($result);
	    	$Account = json_decode($array , true);
	    }

	    // -- check if API ERROR CODE IS 1003 MEAN USER IS IN-ACTIVE MODE AND REDIRECT TO ERROR PAGE AND SHOW ERROR MESSAGE -----//
        if(!empty($Account) && $Account['TLFetchARResult']['errorCode'] == '1003' ){
           $code = $Account['TLFetchARResult']['errorCode']; 
           wp_redirect( home_url().'/error?code='.$code ); 
           exit; 
        }
       // -- check if API ERROR CODE IS 1002 MEAN USER password has changed AND REDIRECT TO ERROR PAGE AND SHOW ERROR MESSAGE -----//
        if(!empty($Account) && $Account['TLFetchARResult']['errorCode'] == '1002' ){
           $code = $Account['TLFetchARResult']['errorCode']; 
           wp_redirect( home_url().'/error?code='.$code ); 
           exit; 
        }
?> 
 <style type="text/css" media="print" id = "print-spec"></style>
<?php 
	if(!empty($Account) && $Account['TLFetchARResult']['errorCode'] != '999'){

		$time = time();
?>

<main id ="if_printatble">
<div class="container <?php echo $center_section_width ?> <?php echo $comman_class?> <?php echo $font_style_active?>">	
<div class="boxgroup innerpage padtop" >
<section class="section">

	<div class="if_print_selected">
      <?php   $domain = get_bloginfo( 'name' ); 
      ?>
        <div class ="row">
         <div class="colDiv"  style="width: 40% !important"> <p class ="domain-size"> <?php echo $domain ?> </p></div>
         <div class="colDiv" style="width: 55% !important">  <p class ="domain-date"> <?php echo date('m/d/Y')?></p> </div>
     </div>
    <hr class ="hr_line">
  </div>

<h3 class ="if_print_call">Account Summary</h3>
	<!-- <hr class ="hr_line"> -->
	<div class ="row if_summary_call">
		<div class ="col-sm-7">
			<ul class ="accounttext">
				<p class ="clientName"> <span> Name :  <?php echo $Account['TLFetchARResult']['name']?> </span> </p>
				<li>
						<label class="control-labels">Address1:</label>
						<span class="textOut"><?php echo $Account['TLFetchARResult']['address1'] ?> </span>
				</li>
				<li>
					<label class="control-labels">Address2: </label>
						<span class="textOut"><?php echo $Account['TLFetchARResult']['address2'] ?> </span>
				</li>
				<li>
						<label class="control-labels">City:</label>
						<span class="textOut"><?php echo $Account['TLFetchARResult']['city']; ?> </span>
				</li>
				<li>
					<label class="control-labels">State: </label>
						<span class="textOut"><?php echo $Account['TLFetchARResult']['state']; ?> </span>
				</li>
				<li>
						<label class="control-labels">Zip:</label>
						<span class="textOut"><?php echo $Account['TLFetchARResult']['zip']; ?> </span>
				</li>
				<li>
					<label class="control-labels">Phone: </label>
						<span class="textOut"><?php //echo $Account['TLFetchARResult']['phone']; ?> </span>
				</li>
				<li>
						<label class="control-labels">Contact:</label>
						<span class="textOut"><?php echo $Account['TLFetchARResult']['contact']; ?> </span>
				</li>
				<li>
					<label class="control-labels">COD?: </label>
						<span class="textOut"><?php echo $Account['TLFetchARResult']['cod']; ?> </span>
				</li>
				<li>
						<label class="control-labels">Credit Limit:</label>
						<span class="textOut"><?php echo $Account['TLFetchARResult']['creditLimit']; ?> </span>
				</li>
				<div class ="col-sm-6 removepadding">
					<li>
						<label class="control-labels">Last Sold Amount: </label>
							<span class="textOut"><?php echo $Account['TLFetchARResult']['lastSoldAmount']; ?> </span>
					</li>
					<li>
						<label class="control-labels">Last Paid Amount: </label>
							<span class="textOut"><?php echo $Account['TLFetchARResult']['lastPaidAmount']; ?> </span>
					</li>
				</div>
				<div class ="col-sm-6 removepadding">
					<li>
							<label class="control-labels">Last Sold Date:</label>
							<span class="textOut"><?php echo $Account['TLFetchARResult']['lastSoldDate']; ?> </span>
					</li>	
					<li>
							<label class="control-labels">Last Paid Date:</label>
							<span class="textOut"><?php echo $Account['TLFetchARResult']['lastPaidDate']; ?> </span>
					</li>	
				</div>
		</ul>
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-4">
				<p class ="balance"> <span> Balance :   <?php echo number_format($Account['TLFetchARResult']['balance'], 2, '.', ''); ?></span> </p>
				<ul class ="accounttext">
					<div class="moveLeft">
						<li>
								<label class="control-labels sideLable">Future:</label>
								<span class="textOut leftspace1"><?php echo number_format($Account['TLFetchARResult']['futureDue'], 2, '.', '');    ?> </span>
						</li>
						<li>
							<label class="control-labels sideLable">Current: </label>
								<span class="textOut leftspace2"><?php echo number_format($Account['TLFetchARResult']['currentDue'], 2, '.', '');?> </span>
						</li>
				</div>

				<hr class ="hrspace">
				<li>
						<label class="control-labels sideLable">Past Due 1:30:</label>
						<span class="textOut leftspace3"><?php echo number_format($Account['TLFetchARResult']['due1_30'], 2, '.', ''); ?> </span>
				</li>

				<li>
					<label class="control-labels sideLable">Past Due 31-60: </label>
						<span class="textOut leftspace4"><?php echo number_format($Account['TLFetchARResult']['due31_60'], 2, '.', '');   ?> </span>
				</li>
				
				<li>
						<label class="control-labels sideLable">Past Due 61-90:</label>
						<span class="textOut leftspace5"><?php echo number_format($Account['TLFetchARResult']['due61_90'], 2, '.', ''); ?> </span>
				</li>
				<li>
						<label class="control-labels sideLable">Past Due 90+:</label>
						<span class="textOut leftspace6"><?php echo number_format($Account['TLFetchARResult']['due90Plus'], 2, '.', ''); ?> </span>
				</li>
				<hr class ="hrspace">
				<li>

					<?php
						$total_due = $Account['TLFetchARResult']['due1_30'] + $Account['TLFetchARResult']['due31_60'] + $Account['TLFetchARResult']['due61_90'] +  $Account['TLFetchARResult']['due90Plus']; 
					 ?>
					<label class="control-labels">Total Past Due:</label>
					<span class="textOut leftspace7"><?php echo number_format($total_due, 2, '.', ''); ?> </span>
				</li>
			</ul>
		</div>
	</div>
	<div class ="tablebox">
	    <h4>Open A/R Transactions - Last 12 Months</h4>
	     <div id="loadingGIF_filter"></div>
	    <hr class="pr-hide">

	    <?php 
	    	if(isset($_COOKIE['trans_filter']) && !empty($_COOKIE['trans_filter'])){
	    		$trans_fl =  $_COOKIE['trans_filter'];
	    	}else{
	    		$trans_fl = '';
	    		$default_trans = 'checked';
	    	}		
	    ?>


	    <form name ="check-trans" class = "trans-record" method="POST">
		   <div class="radiosec" style="margin-top: 9px; margin-bottom: 9px;">
				<ul class="clearfix labelset">
				<li class="li-f1">
					<input type="radio" name="month_select" id="radio1" <?php echo ($trans_fl == '12') ?  'checked'  : '';?>  <?php echo $default_trans?> class="searchRadio_month" value="12" onclick="trans_filter(12)">
					<label for="radio1">Last 12 Months</label>
				</li>
				<li>
					<input type="radio" name="month_select" id="radio2" <?php echo ($trans_fl == '6') ?  'checked'  : '';?> class="searchRadio_month" value="6" onclick="trans_filter(6)" >
					<label for="radio2">Last 6 Months</label>
				</li>
				<li>
					<input type="radio" name="month_select" id="radio3" <?php echo ($trans_fl == '30') ?  'checked'  : '';?> class="searchRadio_month" value="30" onclick="trans_filter(30)">
					<label for="radio3">Last 30 days</label>
				</li>
				
			</ul>
		</div>

	</form> 

	<div class ="mobileTable">	
	<div class="table-responsive barScroll">
	  <table class="table table-striped borderBottTable filter-data account_summary">
	    <thead>
	      <tr class="fr1">
	      	<th>Calculate</th>
		        <th>Date</th>
		        <th>Type</th>
		        <th>Ticket</th>
		        <th>Description</th>
		        <th>Balance</th>
		        <th>Due Date</th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php  //------------   here we use loop to show all order data in table  ----------------?>

			    	<?php 

			    	// make  multi dim array to make sure code not break, if single item is coming from api call  //
	                    $acount_array =  array();
	                    if(is_array($Account['TLFetchARResult']['transactions']['TLARTransaction'][0])){
	                          $Account['TLFetchARResult']['transactions']['TLARTransaction'];
	                      }else{
	                          $acount_array[] = $Account['TLFetchARResult']['transactions']['TLARTransaction'];
	                          $Account['TLFetchARResult']['transactions']['TLARTransaction'] = $acount_array;
	                      }


	    			$cnt =  count($Account['TLFetchARResult']['transactions']['TLARTransaction']); 
	    			$trans =  $Account['TLFetchARResult']['transactions']['TLARTransaction'];
	    			$acct =  array();
	    			$trac;
	    // 			if (count($trans) == count($trans, COUNT_RECURSIVE)){
					//   $acct[] = $trans;
					//   $trac = $acct;
					// }
					// else{
					//   	$trac = $trans;
					// }

	    			/*
		    		for( $k = 0 ;  $k < $cnt;  $k++){

			    	?>
	    			<tr>
				    	<td> <input type="checkbox" name="calculate_price" value="<?php echo number_format($trac[$k]['balance'], 2, '.', '')?>" data-invoice = "<?php echo $trac[$k]['transactionNum'] ?>" class="acct-sumr" ></td>
				        <td><?php echo $trac[$k]['ticketDate'] ?></td>
				        <td><?php echo $trac[$k]['type'] ?></td>
				        <td><a href ="#" style ="text-decoration: underline;"> <?php echo $trac[$k]['transactionNum'] ?> </a></td>
				        <td><?php echo $trac[$k]['description'] ?>  </td>
				        <td><?php echo number_format($trac[$k]['balance'], 2, '.', '');  ?></td>
				        <td><?php echo $trac[$k]['dueDate'] ?></td>
	    			</tr>	
	     		 <?php 
	      		}

	      		*/
	      ?>
	      	
	    </tbody>
	    
	  </table>
	  	<?php 
	  			/*
	  			||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

					@ code added for Augest Release  	
					@ description : showing calculate total amount of invoices selected by user 
					@ return :  Invoice price total and invoice number

				||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	  			*/
	  	?>

	  		<div class="error-total"></div>
	  		<ul class ="account-bnts">
	  			<li> <a href="#" class="btn btn-info btn-lg total_due">Calculate Total<img src="/wp-content/uploads/2019/09/ajax-loader.gif" class="img-responsive invoice-loader"  style="display: none" /> </a> </li>
	  			<li> <a href="#" class="btn btn-info btn-lg print-btn"><i class="fa fa-print" aria-hidden="true"></i> Print Account Summary</a> </li>
	  		 </ul>


	  		 <!-- Modal for showimh invocing data  -->
			<div id="myModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">

			        <h4 class="modal-title invocies-center">Total For Selected Invoices</h4>
			      </div>
			      <div class="modal-body">
			       <ul class="list-group">
						  <li class="list-group-item inc-padding">
						  	<span class="inv-lable"> Total: </span> <span class="price_total"> </span>
						  </li>
						  <li class="list-group-item">
						  	<span class="inv-lable"> Invoice: </span> <span class="inv-list"> </span>
						  </li>
					</ul>
			      </div>
			      <div class="modal-footer">
			      	<div class="row">
			      		<div class="col-sm-2"></div>
			      			<div class="col-sm-6"><a href="#" class="btn btn-default print-invoice"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
			      				<a href ="#" class="btn btn-default cancel-invoice"><i class="fa fa-times" aria-hidden="true"></i> Close</a>
			      			</div>
			      			
			      		<div class="col-sm-2"></div>
			      	</div>
			      </div>
			    </div>
			  </div>
			</div>
			  <!------------------------- Print Invoice screen code --------------------------------->
			  		<div class="print-box" id = "invoice-print" style="display: none">
			  			<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/bootstrap.css" type="text/css"  />
			  			 <div class="modal-content topopt" >
					      <div class="modal-header">
					      	<div class="if_print_selected">
						      <?php   $domain = get_bloginfo( 'name' ); 
						      ?>
						        <div class ="row">
						         <div class="colDiv"  style="width: 40% !important"> <p class ="domain-size"> <?php echo $domain ?> </p></div>
								 <div class="colDiv" style="width: 55% !important">  <p class ="domain-date"> <?php echo date('m/d/Y')?></p> </div>
								     </div>
								    <hr class ="hr_line">
								  </div>
					        <h4 class="modal-title invocies-center">Total For Selected Invoices</h4>
					      </div>
					      <div class="modal-body">
					       <ul class="list-group">
								  <li class="list-group-item inc-padding">
								  	<span class="inv-lable"> Total: </span> <span class="price_total"> </span>
								  </li>
								  <li class="list-group-item">
								  	<span class="inv-lable"> Invoice: </span> <span class="inv-list"> </span>
								  </li>
							</ul>
					      </div>
					    </div>
			  		</div>

			    <!-- -------------------- print invoice end here-------------------->
			    <?php 

	  			/*
	  			||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

					showing calculate price with print option end here 

				||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	  			*/
	  	?>

	</div>
</div>
</div>
</section>

</div>
</div>

<?php 

			for($k = 0 ; $k < count($trans); $k++){
				$desc  = str_replace( array( '"', "'" , '$' , '&' , '@' , '#' , '%' , '*' , '_' , '!' , '~' , '(' , ')' , '<' , '>' , '.' , '|' , '\\' ) , '' ,  $trans[$k]['description']);
				$trans[$k]['description'] = trim($desc);
			}	
			
?>


</main>



<?php

		}else{

			echo "<main class ='orderError'><div class='set-retail-wrapper'><div class='container'><div class='boxgroup innerpage padtop'><div class='alert alert-success nosuperclient'><strong class='error-lable'> Whoops! </strong> <br> Account  summary not found. please try agian later. <p class='refreshLink'> <a href='/home'>Refresh</a></div></p></div></div></div></main>";
		}

		}else{
 			 echo "<main><div class='set-retail-wrapper'><div class='container'><div class='boxgroup innerpage padtop'><div class='alert alert-success nosuperclient'>
                      You do not have permission to access this page
                    </div></div></div></div></main>";
 		}
 }else{
		$current_user = wp_get_current_user(); 
	  	wp_redirect( home_url().'/login-user?acc='.$current_user->user_login ); 
	    exit; 
}?>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/css/bootstrap.css" type="text/css"  />
<style type="text/css">


	table.dataTable thead tr th:after {
		opacity: 0.8 !important;
	    content: "\e150";
	    color: #fff !important;
	    font-size: 11px !important;
}


.account-bnts {
	list-style: none;
}


.account-bnts li{
	display: inline-block;
}



 #loadingGIF_filter{
     position:fixed; 
     top: 30%;
    left: 50% ;
    z-index:99999; 
    display:none;
  }

#loadingGIF_filter.show-spiner {
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


.modal-dialog {
    width: 50% !important;
    margin: 10px auto;
}


.accounttext li{
	list-style: none;
	padding-top: 6px;
}

.textOut{
	font-size: 15px;
	color: <?php echo the_field('body_text_color','options') ?>;
}

.clientName{
	background: #eee;
    padding: 11px;
    border-radius: 7px;
    color: <?php echo the_field('body_text_color','options') ?>;
    font-size: 17px;
}
a {
    color: #3cacd6;
    text-decoration: none;
    outline: 0 none;
}
.nosuperclient {
    font-size: 17px;
    text-align: center;
}

.refreshLink a {
    background: #1e73be;
    color: #ffffff;
    padding: 8px 9px 10px 10px;
    width: 100px;
    margin: 0 auto;
    display: block;
    margin-top: 16px;
    border-radius: 13px;
    text-align: center;
}


.modal-body{
	padding: 0px !important;
}

.invocies-center{
	font-size: 22px;
    text-align: center;
    font-weight: bold;
}

.list-group{
	text-align: center;
}

.inv-lable{
	color: #000;
	font-size: 16px;
}

.price_total{
	font-size: 22px;
	color: #000;
}

.inv-list{
	font-size: 17px;
}

.modal-dialog {
    margin: 120px auto !important;
}

.modal-footer{
	border: 0px !important;
}

a:hover {
    color: #3cacd6;
}
.clientName span{
	/*padding-left: 16px;*/
}

.price_mesg{
	color: red;
    margin-top: 0px;
    font-size: 15px;
    padding-top: 11px;
    margin: 0 0 0px !important;
}

.orderError{
  margin-top: 75px;
}

.boxgroup.innerpage .section p {
    padding-bottom: 10px !important;
}

.removepadding{
	padding-right: 0px !important;
    padding-left: 0px !important;
}
.innerpage .section {
    height: auto;
    margin-bottom: 0;
    padding: 8px 20px;
    background-color: transparent;
}
.balance{
	background:  #6feaaf;
	  padding: 11px;
    border-radius: 7px;
     color: <?php echo the_field('body_text_color','options') ?>;
     font-size: 17px;
}
.balance span{
	/*text-align: center;*/
	display: block;
}
.moveLeft{
	/*padding-left: 44px*/
}

.hrspace{
	margin-top: 3px !important;
    margin-bottom: 3px !important;
    border: 0;
    border-top: 1px solid #eee;
}

.sideLable{
	font-weight: 500 !important;
	    color: #6d6d6d;
}

.leftspace1{
	padding-left: 14px;
}
.leftspace2{
	padding-left: 14px;
}
.leftspace3{
	padding-left: 14px;
}
.leftspace4{
	padding-left: 14px;
}
.leftspace5{
	padding-left: 14px;
}

.leftspace6{
	padding-left: 28px;
}

.leftspace7{
	padding-left: 14px;
	font-weight: 600;
}

.boxgroup {
    padding: 18px !important;
}

.fr1{
	background: <?php echo $navigation_background_color; ?>;
}


.if_print_selected{
	display: none;
}

.print-invoice{
		background: #111111 !important;
    color: #ffffff !important;
    padding: 8px 27px 8px 27px !important;
}


.cancel-invoice{
		background: #111111 !important;
    color: #ffffff !important;
    padding: 8px 27px 8px 27px !important;
}


.table-responsive {
    min-height: .01%;
    overflow-x: auto;
}
.showMore{
	/* width: 173px;
    height: 37px;*/
    margin-top: 24px;
}

.showMore a{
	background: <?php echo the_field('large_button_highlight_color','options') ?>;
    padding: 11px;
    text-align: center;
    width: 21%;
    border: 1px solid #16b0e9;
    border-radius: 4px;
    color: <?php echo the_field('large_button_regular_text_color','options') ?>;
}

.total_due{
		background: <?php echo the_field('large_button_highlight_color','options') ?> !important;
		color: <?php echo the_field('large_button_regular_text_color','options') ?> !important;
		margin-top: 22px !important;
    	padding: 10px 15px 10px 15px !important;
    	border-radius: 5px !important;
    	font-size: 16px !important;
    	border: 1px solid !important;
}

.print-btn{
		background: <?php echo the_field('large_button_regular_color','options') ?> !important;
   		 color: <?php echo the_field('large_button_highlight_text_color','options') ?> !important;
		margin-top: 22px !important;
    	padding: 10px 15px 10px 15px !important;
    	border-radius: 5px !important;
    	font-size: 16px !important;
    	margin-left: 10px;
    	border: 1px solid !important;
}


.showMore a:hover{
color:#fff !important;
}

.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
    border: 1px solid #eee !important;
    border-top-left-radius: 8px !important;
    border-top-right-radius: 8px !important;
    border-collapse: initial !important;
}
table tr:nth-child(even) {background-color: #fff; border: 1px solid #eee;}

.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #ebebeb !important;
}

.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
    color: #fff !important;
}

.tablebox{
	padding-top: 30px;
}
ul, ol {
    margin-left: 0em;
}

.large-size_active ul.accounttext li p{
	font-size: 16px !important;
}

.large-size_active ul.accounttext li label{
	font-size: 16px !important;
}

.large-size_active ul.accounttext li span{
	font-size: 16px !important;
}


.large-size_active h3{
	font-size: 24px !important;
}

.large-size_active h4{
	font-size: 20px !important;
}

.large-size_active .borderBottTable tr th{
  font-size: 16px;
}


.large-size_active .borderBottTable tr td{
  font-size: 16px;
}


.inc-padding{
	padding: 17px 15px !important;
}

/*.large-size_active a{
  font-size: 16px !important;
}*/


.invoice-loader{
	width: 28px !important;
    /*display: inline-block !important;*/
}

.img-block{
	display: inline-block !important;
}

.large-size_active .clientName span , .large-size_active .balance span{
  font-size: 18px !important;
}


@media only screen and (max-width: 480px){

		.mobileTable {
						overflow-x:auto;
						width: 100%;
				}

}


@media only screen and (max-width:400px) {
			.mobileTable {
						overflow-x:auto;
						width: 100%;
			}

}


@media print {

@page { size: auto ; margin: 5mm;   }  

body{ height:auto;   -webkit-print-color-adjust: exact !important;   }  

html, body { height: 100vh !important ; padding: 8px !important  overflow: visible !important ;   } 

 .my-main-header , .inner-containerfooter{
  	display: none !important;
  }

  .section{
  	display: none !important;
  }


  #printSection, #printSection * {
    display: block !important; 
  }

  #printSection {
    position:absolute;
    left:0;
    top:0;
    width: 100% !important;
    display: block!important;
  }

  .trans-record{
	display: none !important; 
}
.account-bnts{
	display: none !important;
}

.print-invoice , .cancel-invoice{
	display: none !important;
}

.modal-content{
	 margin: 10px !important;
	 border: 0px solid #e5e5e5 !important;
}
.modal-header {
    padding: 2px !important;
    border: 0px solid #e5e5e5 !important;
   
}
	

    main {
    margin-top: 0px !important;
}

.hide-on-summary{
	display: none !important;
}

  .print-box{
  	 width: auto;
     display: block!important;
     margin-top: 100px !important;
  }

  .modal-content{
  	border-radius: 0px !important;
  }

  .modal-body {
	    padding: 15px !important;
	}




.if_print_selected{width: 100% !important;display: block !important;} .domain-size{ font-size: 20px !important; padding-left: 10px !important} .domain-date{font-size: 20px !important;  text-align:right; } .custom-section-data{display: none !important;  } .flat-line{ padding-bottom: 20px !important; color: #000 !important;font-weight: 600 !important; }  .col-sm-4 {width:35% !important;}  .col-sm-6 {width:50% !important;}  .col-sm-8 {width:60% !important;} .colDiv{float:left !important}  .boxgroup.innerpage .section p { padding-bottom:0px !important }  #invoice-print { margin-top: 40px !important }
  
}





</style>





<script type="text/javascript">
	/*
	  	||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

					@ code added for Augest Release  	
					@ description : javascript code for invoice calculator   
					@ return :  Invoice price total and invoice number

		||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	  			*/
	jQuery(document).ready(function() {
		
			    jQuery('.total_due').click(function(){

			    		var item = [];
			    		var invoices = [];
			    		var checked_item =  document.querySelectorAll('input[name=calculate_price]:checked');
			    		console.log(checked_item.length);
			    		if(checked_item.length > 0 ){
		    				jQuery("input[name=calculate_price]:checked").each(function(){
									    var itm = jQuery(this).val();
									    var tt = jQuery(this).data('invoice');
									    invoices.push(tt);
									     item.push({ price : itm,  invoice : tt});
								});

			    		}else{

							jQuery('.error-total').empty().append('<p class="price_mesg">Please select checkbox to Calculate Price </p>');
						
			    		}

			    		if(item.length > 0 ){


			    				jQuery.ajax({
				                url: ajaxurl ,
				                type : 'post',
				                dataType : "html",
				                data : {
				                    action : 'calculate_price_for_invoice',
				                    inv_item: item
				                },
				                 beforeSend: function() {
				                         jQuery(".invoice-loader").show();
				                         jQuery(".invoice-loader").addClass('img-block');
				                         jQuery(".total_due").css('pointer-events', 'none');
				                  },
				                success : function( res) {
				                   var response = JSON.parse(res);


				                   console.log(response);

				                   jQuery(".invoice-loader").removeClass('img-block');
				                   jQuery(".total_due").css('pointer-events' , '');
				                   jQuery(".invoice-loader").hide();
				                   if(response.code = '1'){
			                   			var prices = response.price;
			                   			var invoices = response.invoice;
			                   			console.log(invoices);
			                   			var new_prc = prices.toFixed(2);
			                   			jQuery('.price_total').text('$'+new_prc);
			                   				
			                   			jQuery('.inv-list').text(invoices);

			                   				if (localStorage.getItem('popup_dyn_class') === null){
				                                localStorage.setItem("popup_dyn_class", 'invoices_total_popup');
				                           }else{

				                                   localStorage.removeItem('popup_dyn_class');
				                                   localStorage.setItem("popup_dyn_class", 'invoices_total_popup');
				                           }

			                   			jQuery('#myModal').modal('show');

				                   }

				               }
						    })

			    		}
						return false;

			    })

			    jQuery('.print-invoice').click(function(){

				    	 var agent =   is_safari_browser();  
			             if(agent == 'Safari'){
			                var d = new Date();
			                var n = d.getTime();
			                var css_path = '<?php bloginfo('template_url'); ?>/assets/css/print_summary_invoice.css?v='+n+''; 
			                print_safari('invoice-print' , css_path);
			                return false;  
			             }else{
			                printInvoice();
		    				return false; 
			             }	
			    			
			    })


			    function printInvoice() { 

				    var elem = document.getElementById('invoice-print');
				    var domClone = elem.cloneNode(true);
				    var $printSection = document.getElementById("printSection");

				    if (!$printSection) {
				        var $printSection = document.createElement("div");
				        $printSection.id = "printSection";
				        document.body.appendChild($printSection);
				        console.log($printSection);	
				    }
				    
				    $printSection.innerHTML = "";
				    $printSection.appendChild(domClone);
				    window.print();
        		} 

		        jQuery('.cancel-invoice').click(function(){

		        	jQuery('#myModal').modal('hide');

		        	 if (localStorage.getItem('popup_dyn_class') === null){
	                 }else{
	                        localStorage.removeItem('popup_dyn_class');
	                 }
		        	setTimeout(function() {
			             location.reload(true);
			          }, 200);
		        	return false;
		        })


		         jQuery('.print-btn').click(function(){
         			 var agent =   is_safari_browser();  
		             if(agent == 'Safari'){
		                var d = new Date();
		                var n = d.getTime();
		                var css_path = '<?php bloginfo('template_url'); ?>/assets/css/account_print.css?v='+n+''; 
		                print_safari('if_printatble' , css_path);
		                return false;  
		             }else{
		                print_summary();
	    				return false; 
		             }	

			    })


		          function print_summary() {

			            jQuery('.account_summary').removeClass('table-striped')
			            jQuery('.account_summary').addClass('table-bordered');

			            var contents = document.getElementById("if_printatble").innerHTML;

			            var frame1 = document.createElement('iframe');
			            frame1.name = "frame1";
			            frame1.style.position = "absolute";
			            frame1.style.top = "-1000000px";
			            document.body.appendChild(frame1);
			            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
			            frameDoc.document.open();
			            frameDoc.document.write('<html><head><title>Account Summary</title>');
			            frameDoc.document.write('<style type="text/css"> @page { size: auto ; margin: 5mm;    }  body{ height:auto;   -webkit-print-color-adjust: exact !important;  }  html, body { height:auto ; padding: 10px !important  ;overflow: visible !important ;  font-family:open_sansregular !important; } .my-main-header , .inner-containerfooter{display: none !important;}  .account-bnts{display: none !important;} .tablebox {margin-top: 20px !important; page-break-before: always !important;} .removepadding {padding-right: 0px !important;padding-left: 0px !important;} .col-sm-7 { width: 50.% !important;} .col-sm-1 {width: 2% !important; }  .col-sm-4 {width: 33% !important;} .clientName {background: #eee !important; padding: 10px !important; border-radius: 7px; color: #000000 !important;font-size: 18px !important; width: 60% !important } .balance {background: #6feaaf !important; padding: 11px !important ; border-radius: 7px; color: #000000 !important; font-size: 18px !important;} .accounttext li {  list-style: none; padding-top: 6px;} .textOut {font-size: 18px !important; color: #000000 !important;} .hrspace { margin-top: 3px !important; margin-bottom: 3px !important; border: 0; border-top: 1px solid #eee;}  .mobileTable{margin-top: -10px !important;} .domain-size{ font-size: 18px !important; font-weight:400 !important;}  .domain-date{font-size: 18px !important; font-weight:400 !important; float: right !important; text-align: right !important } .if_print_selected{width: 100% !important; display: block !important; }   .col-md-6 {width:50% !important;}  .col-md-8 {width:50% !important;} .colDiv{ float:left !important} .flat-line{ padding-bottom: 10px !important; color: #000 !important;font-weight: 400 !important; }  #invoice-print { margin-top: 40px !important } .labelset{display:none !important} table tr>th:nth-of-type(1),   table tr>td:nth-of-type(1){ display: none !important;} ul, ol { margin-left: -1em !important;} .accounttext {margin-left: -30px !important } .pr-hide{display:none !important}  .boxgroup.innerpage .section p {padding-bottom: 10px !important;} .if_print_call{margin-top: 10px !important; margin-bottom: 4px !important;} .hr_line{margin-top: 2px !important; margin-bottom: 2px!important;} #header{display:none !important} #footer{display:none !important}' ) ;
			           
			            frameDoc.document.write('</style>');
			            frameDoc.document.write('</head><body>');
			            frameDoc.document.write(contents);
			            frameDoc.document.write('</body></html>');
			           
			            window.frames["frame1"].focus();
			            window.frames["frame1"].print();
			             frameDoc.document.close();
				         setTimeout(function() {
				              document.body.removeChild(frame1);
				          }, 500);
			            	
			            jQuery('.account_summary').addClass('table-striped')
			            jQuery('.account_summary').removeClass('table-bordered');

			            return false;
			           
			        }	

         });

		/*
	  	||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

					@ code added for Augest Release  	
					@ description : javascript code for invoice calculator   
					@ return :  Invoice price total and invoice number

		||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	  	*/	
		

		//---------check if trans filter is set and get its cokkie value and hit ajax call again to get ffilter data//

			
			jQuery(window).on("load", function () {

				var filter_cookie = '<?php echo $_COOKIE['trans_filter'];?>';

					if(filter_cookie !='' && typeof filter_cookie != 'undefined'){
						trans_filter(filter_cookie);
					}else{
						trans_filter(12);
					}

			});

			

	  	function trans_filter(flt){

	  		var trans =  '<?php echo json_encode($trans) ?>';
	  		var month_select = flt;
	  		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	  		jQuery.ajax({
		                url: ajaxurl ,
		                type : 'post',
		                dataType : "html",
		                data : {
		                    action : 'get_last_trans_using_date',
		                    inv_item: trans ,  month :  month_select,
		                },
		                 beforeSend: function() {
		                       jQuery("#loadingGIF_filter").addClass('show-spiner');
		                  },
		                success : function( res) {
		                   var response = JSON.parse(res);
		                   console.log(response.trans);
		                   jQuery("#loadingGIF_filter").removeClass('show-spiner');
		                   if(response.code = '1'){
	                   		

		                   	if(response.trans != '' && typeof response.trans != 'undefined'){

		                   		var filter_trans =  response.trans;

		                   		var filter_html =  '';

		                   		for (var i = 0 ;  i < filter_trans.length; i++) {

		                   			var balance = filter_trans[i]['balance'].toFixed(2);
		                   			var transactionNum = filter_trans[i]['transactionNum'];
		                   			var description = filter_trans[i]['description'];
		                   			var ticketDate = filter_trans[i]['ticketDate'];
		                   			var type = filter_trans[i]['type'];
		                   			var dueDate = filter_trans[i]['dueDate'];

		                   				filter_html +='<tr>';		
		                   				filter_html +='<td><input type="checkbox" name="calculate_price" value="'+balance+'" data-invoice = "'+transactionNum+'" 	class="acct-sumr"></td>';
		                   				filter_html +='<td>'+ticketDate+'</td>';
		                   				filter_html +='<td>'+type+'</td>';
		                   				filter_html +='<td><a href ="#" style ="text-decoration: underline;">'+transactionNum+'</a> </td>';
		                   				filter_html +='<td>'+description+'</td>';
		                   				filter_html +='<td>'+balance+'</td>';
		                   				filter_html +='<td>'+dueDate+'</td>';
		                   				filter_html +='</tr>';
		                   		}

		                   		jQuery('.filter-data tbody tr').remove(); 
		                   		jQuery('.pop-error').remove();

		                   		if (jQuery.fn.DataTable.isDataTable(".account_summary")) {
			                        jQuery('.account_summary').DataTable().clear().destroy();
			                      }

			                     jQuery('.filter-data tbody').empty(); 

                    			jQuery('.filter-data tbody').append(filter_html); 

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
                    			
		                   	}else{

		                   			jQuery('.filter-data tbody tr').remove(); 
		                   			$(".filter-data").after("<div class='alert alert-danger pop-error' style='margin-top: 15px; text-align: center; margin-bottom: 0px !important;'>Record not found, please try with different search. </div>");
		                   	}
		                   		 
		                   }
		               }
				    })
	  			return false

	  	}



	  	// on ctrl key + p  print evnnt check view mode type, pass the div id value and call print function 
			jQuery(document).bind("keyup keydown", function(e){

			    if(e.metaKey && e.keyCode == 80 || e.ctrlKey && e.keyCode == 80){

			    		if(localStorage.getItem("popup_dyn_class") === null) {
								jQuery('.print-btn').trigger('click');
			    		}else{
			    				var div_class =  localStorage.getItem('popup_dyn_class');
			    				jQuery('.print-invoice').trigger('click');
			    		}
			    		
			    		
			    		return false;
			    }	
			});


</script>


<?php 
get_footer();
?>