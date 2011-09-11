<?php
/************************************************************/
/*	BrilliantRetail 										*/
/*															*/
/*	@package	BrilliantRetail								*/
/*	@Author		Brilliant2.com 								*/
/* 	@copyright	Copyright (c) 2010, Brilliant2.com 			*/
/* 	@license	http://brilliantretail.com/license.html		*/
/* 	@link		http://brilliantretail.com 					*/
/* 	@since		Version 1.0.0 Beta							*/
/*															*/
/************************************************************/
/* NOTICE													*/
/*															*/
/* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF 	*/
/* ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED	*/
/* TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 		*/
/* PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT 		*/
/* SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY */
/* CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION	*/
/* OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR 	*/
/* IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 		*/
/* DEALINGS IN THE SOFTWARE. 								*/	
/************************************************************/

	$cp_pad_table_template["table_open"] = '<table cellspacing="0" id="site_edit" cellpadding="0" border="0" class="mainTable edit_form">';

	$this->table->set_template($cp_pad_table_template);
	
	$this->table->set_heading(array('data' => lang('br_general_configuration'), 
									'colspan' => 2));
	
	$this->table->add_row(	
							array(
								lang('br_site_logo'),
								'	<input type="hidden" name="max_file_size" value="10000000" />  
									<img src="'.rtrim($store[0]["media_url"],'/').'/'.$store[0]['logo'].'" style="border:1px #ccc solid;margin-bottom:10px" /><br />'.
									form_upload('logo')
								)
						);
						
	// Add the fields
		$fields = array('license','phone','fax','address1','address2','city','state','zipcode','country','secure_url','media_url','media_dir','cart_url','checkout_url','thankyou_url','customer_url','product_url');
	    foreach($fields as $f){
			$this->table->add_row(array(lang('br_site_'.$f),
							form_input(
										array(	'name' => $f, 
												'id' => $f,
												'value' => $store[0][$f],
												'class' => '',
												'title' => lang('br_site_'.$f))
										)
							)
					);
	    }
	    
	    $options = array();
		foreach($currencies as $c){
			$options[$c["currency_id"]] = $c["title"].' ('.$c["marker"].')'; 
		}
		$this->table->add_row(array(lang('br_site_currency'),
								form_dropdown(
												'currency_id', 
												$options, 
												$store[0]["currency_id"]).'<br /><br />'.lang('br_currency_instructions')
							));
							
	    $options = array(
	    					0 => lang('br_no'),
	    					1 => lang('br_yes')
	    				);
	    $this->table->add_row(array(lang('br_guest_checkout'),
								form_dropdown(
												'guest_checkout', 
												$options, 
												$store[0]["guest_checkout"])
							));
							
		foreach($groups as $g){
			$options[$g["group_id"]] = $g["group_title"];
		}
		
		$this->table->add_row(array(lang('br_register_group'),
								form_dropdown(
												'register_group', 
												$options, 
												$store[0]["register_group"])
							));
							
		$options = array();
		$selected = array();
		foreach($countries as $c){
			$options[$c["zone_id"]] = $c["title"];
			if($c["enabled"] == 1){
				$selected[] = $c["zone_id"];
			}
		}
		
		$this->table->add_row(array(lang('br_countries'),
								form_multiselect(
												'countries[]', 
												$options, 
												$selected)
							));
		
		$general = $this->table->generate();
		$this->table->clear();
		
		// CATALOG TAB
			$this->table->set_template($cp_pad_table_template);

  			$this->table->set_heading(array('data' => lang('br_product_config'), 
											'colspan' => 2));

      		$fields = array("low_stock","result_limit","result_per_page","result_paginate");
			foreach($fields as $f){
				$this->table->add_row(array(lang($f),
								form_input(
											array(	'name' => $f, 
													'id' => $f,
													'value' => $store[0][$f],
													'class' => '{required:true}',
													'title' => lang($f))
											)
								)
						);
			}
				
			$catalog = $this->table->generate();
			$this->table->clear();
		
		// Subscription Tab
			$this->table->set_template($cp_pad_table_template);
      		
  			$this->table->set_heading(array('data' => lang('br_subscription'), 
											'colspan' => 2));

		    $options = array(
				0 => lang('br_no'),
				1 => lang('br_yes')
			);
			
      		$this->table->add_row(array(lang('br_enabled'),
								form_dropdown(
												'subscription_enabled', 
												$options, 
												$store[0]["subscription_enabled"]))
							);

      		$fields = array('first_notice','second_notice','third_notice','cancel_subscription');
			foreach($fields as $f){
				$this->table->add_row(array(lang($f),
								form_input(
											array(	'name' => $f, 
													'id' => $f,
													'value' => $store[0][$f],
													'class' => '{required:true}',
													'title' => lang($f))
											)
								)
						);
			}
				
			$subscription = $this->table->generate();
			$this->table->clear();
			
		// SEO TAB
			$this->table->set_template($cp_pad_table_template);

  			$this->table->set_heading(array('data' => lang('br_seo'), 
								'colspan' => 2));

			$fields = array('meta_title','meta_keywords');
		    foreach($fields as $f){
				$this->table->add_row(array(lang('br_site_'.$f),
								form_input(
											array(	'name' => $f, 
													'id' => $f,
													'value' => $store[0][$f],
													'class' => '',
													'title' => lang('br_site_'.$f))
											)
								)
						);
		    }
		    
		    $this->table->add_row(array(lang('br_site_meta_descr'),
									form_textarea(
											array(	'name' => 'meta_descr', 
													'id' => 'meta_descr',
													'value' => $store[0]['meta_descr'],
													'class' => '',
													'title' => lang('br_meta_descr'))
											)
									)
								);			
		
		$seo = $this->table->generate();
		$this->table->clear();

		echo form_open_multipart('&D=cp&C=addons_modules&M=show_module_cp&module=brilliant_retail&method=config_site_update',array('method' => 'POST', 'id' => 'storeForm'),$hidden);
?>
<div id="b2r_page" class="b2r_category">
	
	<?=$general?>
	<?=$catalog?>
	<?=$subscription?>
	<?=$seo?>
	
	<div id="header_buttons">
	    <?=form_submit(array('name' => 'submit', 'value' => lang('save'), 'class'=>'submit'))?>
		<p class="b2r_cancel"><a href="<?=$base_url.'&method=config_site'?>"><?= lang('br_cancel'); ?></a></p>
    	<div class="b2r_clearboth"><!-- --></div>
    </div>

	<div class="b2r_clearboth"><!-- --></div>

</div>

</form>
<script type="text/javascript">
	$(function() {
		$('#storeForm').validate();
	});
</script>