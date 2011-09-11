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
<div id="sub_type_4" class="subtypes">
	<div id="showDownloadProgress"><img src="<?=$theme?>images/loader.gif" /><span id="showPercent"></span></div>
	<span id="spanDownloadPlaceholder"></span></span>
	<input type="hidden" name="require_download" title="<?=lang('br_details').' - '.lang('br_download_file_required').' '.lang('br_is_required')?>" id="sub_type_req_4"  value="1" class="{required:true} sub_type_req" />
	<table id="download_selected" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<th><?=lang('br_title')?></th>
			<th><?=lang('br_file_name')?></th>
			<th><?=lang('br_download_limit')?></th>
			<th><?=lang('br_download_length')?></th>
			<th><?=lang('br_download_version')?></th>
		</tr>
		<?php
			if(isset($products[0]["download"])){
				$a = $products[0]["download"][0];
				echo '	<tr>
							<td>
								<input type="text" name="download_title" value="'.$a['title'].'" /></td>
								<td>
									<input type="hidden" name="download_filenm" value="'.$a['filenm'].'" />
									<input type="hidden" name="download_filenm_orig" value="'.$a['filenm_orig'].'" />'.$a['filenm_orig'].'</td> 
								<td>
									<input type="text" name="download_limit" value="'.$a['download_limit'].'" style="width:30px" /> *</td>
								<td>
									<input type="text" name="download_length" value="'.$a['download_length'].'" style="width:30px" /> *</td>
								<td>
									<input type="text" name="download_version" value="'.$a['download_version'].'" style="width:30px" /></td>
						<tr>';
			}else{
				echo '	<tr>
							<td colspan="5">'.lang('br_upload_download_message').'</td>
						</tr>';
			}
		?>
	</table>
	<div style="text-align:right;padding: 2px">
		<em>*<?=lang('br_download_limit_instruction')?></em>
	</div>
</div>

<script type="text/javascript">

	$(function(){

		uploads = new SWFUpload({
			// Backend Settings
			upload_url: "<?=$download_upload?>",
			post_params: {
							"site_id" : <?=$site_id?>, 
							"PHPSESSID" : "<?=session_id()?>"
						},

			// File Upload Settings
			file_size_limit : "100 MB",	// 4MB
			file_upload_limit : 0,
			
			file_dialog_complete_handler : function fileDialogComplete(numFilesSelected, numFilesQueued) {
												if (numFilesQueued > 0) {
													$('#showDownloadProgress').show();
													this.startUpload(this.getFile(0).ID);
												}
											},
			upload_progress_handler : 	function uploadProgress(file, loaded, total) {
											 var percent = Math.ceil((loaded / total) * 100);
											 $('#showPercent').html(percent);
										}, 
			upload_success_handler : function uploadSuccess(file,serverData){
															var a = serverData.split('|');
																$('#download_selected tr:gt(0)').remove();
																$(	'<tr>'+
																		'<td><input type="text" name="download_title" value="'+a[0]+'" /></td>'+
																		'<td><input type="hidden" name="download_filenm" value="'+a[2]+'" /><input type="hidden" name="download_filenm_orig" value="'+a[1]+'" />'+a[1]+'</td>'+
																		'<td><input type="text" name="download_limit" value="0" style="width:30px" /> *</td>'+
																		'<td><input type="text" name="download_length" value="0" style="width:30px" /> *</td>'+
																		'<td><input type="text" name="download_version" value="1.0" style="width:30px" /></td>'+
																	'<tr>').appendTo($('#download_selected'));
																$('.remove_img').unbind('click').bind('click',function(){
																	$(this).parent().parent().remove();
																	return false;
																});
																$('#sub_type_req_4').val(1);
															},
			upload_complete_handler : function uploadComplete(file,serverData){
											if (this.getStats().files_queued > 0) {
												this.startUpload(this.getFile(0).ID);
											}else{
												$('#showDownloadProgress').hide();
											}
										},
	
			// Button Settings
			button_image_url : "<?=$theme?>images/btn-dl-upload.png",
			button_placeholder_id : "spanDownloadPlaceholder",
			button_width: 70,
			button_height: 25,
			button_text : '<span class="download_button"><?=lang('br_upload')?></span>',
			button_text_style : '.download_button { font-family: Helvetica, Arial, sans-serif; font-size: 14pt; color: #ffffff }',
			button_text_top_padding: 5,
			button_text_left_padding: 10,
			button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			button_cursor: SWFUpload.CURSOR.HAND,
			
			// Flash Settings
			flash_url : "<?=$theme?>script/swfupload/swfupload.swf",
			flash9_url : "<?=$theme?>script/swfupload/swfupload_fp9.swf",
	
			// Debug Settings
			debug: false
			});
		});
</script>