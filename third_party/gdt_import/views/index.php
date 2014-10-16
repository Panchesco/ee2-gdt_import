<?php echo form_open_multipart($action_url, '', $form_hidden)?>


<?php
    $this->table->set_template($cp_table_template);
    
if( empty($tables))
{

	$this->table->add_row(lang('no_import_table'));

	} else {
    
    $this->table->set_heading(
        lang('import_table'),
        lang('import_channel'),
        lang('import_title_field'),
        lang('help')
        
        );
        
     $this->table->add_row(
               
                
                form_dropdown('dbtable',$tables),
                form_dropdown('channel_id',$channels),
                '<select id="title_column" name="title_column">
                	<option value=""> -- </option>
                </select>',
                '<a href="' . BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$module_name.'&method=docs'  . '">' . lang('documentation') . '</a>'
            );

}

echo $this->table->generate();

?>

<?php foreach($tables as $key=>$row) {?>


<?php } ?>

<?php if( ! empty($tables))
{ ?>

<div class="tableFooter">
    <div class="tableSubmit">
        <?=form_submit(array('name' => 'submit', 'value' => lang('import'), 'class' => 'submit'))?>
    </div>

    <span class="js_hide"><?=$pagination?></span>
    <span class="pagination" id="filter_pagination"></span>
</div>
<?php } ?>

<?php echo form_close()?>
<script>
	(function($){
		
		fetchCols	= function(dbTable)
		{
					$.ajax({
						type: 'POST',
						url: '/?ACT=<?php echo $action_id;?>',
						data: {dbtable: dbTable},
						success: function(data){

							$('#title_column').html(data);
						}
						
					});
		}
		
		$('[name=dbtable]').on('change',function(){
			
			var dbTable = $(this).val();
			fetchCols(dbTable);
		});

	})(jQuery)
</script>
