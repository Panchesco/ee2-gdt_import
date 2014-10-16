<?php
    
    $this->table->set_template($cp_table_template);
    
    
       $this->table->set_heading(
        '',
        ''
        );

    $this->table->add_row(
    						lang('docs_copy'),
    						'<a href="' . BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$module_name.'&method=index' . '">'.lang('import_screen').'</a>'
    						);

		echo $this->table->generate();

?>