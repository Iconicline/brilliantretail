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
?>
<div id="b2retail">

	<?=$br_header?>
   
    <div id="b2r_content">

    	<?=$br_menu?>
        
        <div id="b2r_main">
        
            <?=$br_logo?>
            
			<?=form_open_multipart('&D=cp&C=addons_modules&M=show_module_cp&module=brilliant_retail&method=product_update',array('method' => 'POST', 'id' => 'productForm'),$hidden)?>
					
            <div id="b2r_panel">
                
                <div id="b2r_panel_int">
                
                	<div id="b2r_settings">
                
						<div id="b2r_page" class="b2r_category">
					
                	        <div id="error" style="display:none">
								<p>
									<?=lang('br_form_error_message')?>
								</p>
							</div>
                        
					<?php
						$tabs = array(
										'details' => $tab_detail,
										'attributes' => $tab_attributes,
										'pricing' => $tab_price,
										'sale_pricing' => $tab_sale_price,
										'categories' => $tab_category,
										'images' => $tab_image,
										'options' => $tab_option,
										'related' => $tab_related,
										'seo' => $tab_seo,
										'feed' => $tab_feed
										);
						foreach($tabs as $key=>$val){
							echo $val;
							echo '<p>&nbsp;</p>';
						}
					?>

							<div class="b2r_clearboth"><!-- --></div>
			    			<div id="footer_buttons">
								 <?php 
									if($products[0]["product_id"] != 0){ 
								?>
										<?=form_submit(array('name' => 'delete', 'id' => 'delete', 'value' => lang('delete'), 'class'=>'submit'))?>
										<?=form_submit(array('name' => 'duplicate', 'value' => lang('br_duplicate'), 'class'=>'submit'))?>
								<?php
									}
								?>
								<?=form_submit(array('name' => 'save', 'value' => lang('save'), 'class'=>'submit'))?>
								<?=form_submit(array('name' => 'save_continue', 'value' => lang('br_save_continue'), 'class'=>'submit'))?>
								<p class="b2r_cancel"><a href="<?=$base_url.'&method=product'?>"><?= lang('br_cancel'); ?></a></p>
						    	<div class="b2r_clearboth"><!-- --></div>
							</div>
							<p>&nbsp;</p>
					</div> <!-- b2r_dashboard --> 
                </div> <!-- b2r_panel_int -->
				<div class="b2r_clearboth"><!-- --></div>
            </div> <!-- b2r_panel -->
            <div class="b2r_clearboth"><!-- --></div>
    	</div> <!-- b2r_main -->
        <div class="b2r_clearboth"><!-- --></div>
					
		</form>	
        
        <?=$br_footer?>
        
    </div> <!-- b2r_content -->
	<div class="b2r_clearboth"><!-- --></div>    
</div> <!-- #b2retail -->

<script type="text/javascript">
	var field = 10000;
	var imgCount = 10000;
	var swfu;
	
	$(function() {
		$('#productForm').validate({'errorLabelContainer': $("#error")});
		
		$('#delete').bind('click',function(){
			if(confirm('<?=lang('br_confirm_delete_product')?>')){
				return true;
			}else{
				return false;
			}
		});
		$('.mainTable tr:odd').addClass('odd');
	});
</script>
