<?php
    
    $this->table->set_template($cp_table_template);
    
    
       $this->table->set_heading(
        lang('success'),
        ''
        );

    $this->table->add_row($message_success,'<a href="' . BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$module_name.'&method=index' . '">'.lang('import_another').'</a>');

		echo $this->table->generate();

?>