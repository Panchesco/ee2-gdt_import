<?php
/**
 *	Gdt_import
 *
 *	@package		Gdt_import
 *	@author			Richard Whitmer
 *	@license		If you can figure it out, you're welcome to use it at your own risk.
 *	@link				http://panchesco.com
 *	@since			Version 1.0
 */

	class Gdt_import {
		
		function __construct()
		{
						// Make a local reference to the ExpressionEngine super object
						$this->EE =& get_instance();
			
		}
		
		
						 // --------------------------------------------------------------------
				 
				 public function column_names()
				 {
				 
				 				$html	= '';
				 				
				 				$dbtable	= ee()->input->post('dbtable');
				 				
				 				if($dbtable) 
				 				{
				 					$query = ee()->db->query("SHOW COLUMNS FROM " . $dbtable);

				 					foreach($query->result() as $row)
				 					{
				 					  $html.= '	<option value="' . $row->Field . '">' . $row->Field . '</option>
				 					  ';
				 					}
				 				
				 				} 
				 				
				 				exit($html);
				 }
		
	}

?>