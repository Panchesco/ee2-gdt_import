<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *	Gdt_import_mcp
 *
 *	@package		Gdt_import
 *	@author			Richard Whitmer
 *	@license		If you can figure it out, you're welcome to use it at your own risk.
 *	@link				http://panchesco.com
 *	@since			Version 1.0
 */


		class Gdt_import_mcp {
		
				public	$module_name	= 'Gdt_import';
				public	$version			= '0.1';
				public	$site_id			= 1;
				public	$full_path		= '';
				public	$field_ids		= array();
			
			
			
				function __construct()
				{
						// Make a local reference to the ExpressionEngine super object
						$this->EE =& get_instance();
						
						$this->field_ids	= $this->field_ids();

				}
				
				

					
					// --------------------------------------------------------------------
					
					
				public function index()
				{
				
					$channels	= array();
					$table 		= array();
					$tables		=	ee()->db->list_tables();
					
					
					$table[0]	= ' -- ';
					foreach($tables as $row)
					{
						if( ! preg_match('/^exp_/',$row))
						{	
							$table[$row]	= $row;
						}
					}
					
					
					ee()->load->library('api'); 
					ee()->api->instantiate('channel_structure');
					
					$channel_rows	= ee()->api_channel_structure->get_channels($this->site_id)->result();
					
					
					foreach($channel_rows as $row)
					{
						$channels[$row->channel_id] = $row->channel_title;
					}
					
					ee()->load->library('javascript');
					ee()->load->library('table');
					ee()->load->helper('form');

					ee()->view->cp_page_title = lang('gdt_import_module_name');

					$vars['action_url'] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=gdt_import'.AMP.'method=save_entries';
					$vars['form_hidden'] = NULL;
					$vars['options'] = array('import'=>lang('import_csv'));	
					$vars['channels']	= $channels;
					$vars['fields']		= array(0=>' -- ');
					$vars['module_name']	= $this->module_name;
					
					$vars['tables']	= $table;
					
					$vars['action_id']	= $this->action_id('column_names');
					
					return ee()->load->view('index',$vars,TRUE);

				}
				
				
				// --------------------------------------------------------------------
				
				/**
				 *	Fetch action id for a method.
				 *	@param string
				 *	@return integer
				 */
				 private function action_id($method='')
				 {
					 if( ! empty($method))
					 {
						 	$query =  ee()->db
						 					->select('action_id')
						 					->limit(1)
						 					->where('class',$this->module_name)
						 					->where('method',$method)
						 					->get('actions');
						 					
						 					return $query->row()->action_id;
						 
					 }
					 
					 return '';
				 }
				
				
				// --------------------------------------------------------------------
				
				public function save_entries()
				{
							ee()->view->cp_page_title = lang('gdt_import_module_name');
							ee()->load->library('api');
							ee()->api->instantiate('channel_entries');
							ee()->api->instantiate('channel_fields');
					
							$dbtable			= ee()->input->post('dbtable');
							$channel_id		= ee()->input->post('channel_id');
							$title_column	=	ee()->input->post('title_column');
							
							$entries =	ee()->db->query("SELECT * FROM " . $dbtable)->result_array();
							
							$i=0;
							foreach($entries as $key=>$row)
							{

								$data['title']	= $row[$title_column];
								$data['entry_date']	= time();
								$data['edit_date']	= time();
								
								foreach($row as $index => $value)
								{
									if(isset($this->field_ids[$index]))
									{
										$field_id = $this->field_ids[$index];
										$data[$field_id]	= $value;
									}
								}
								
								$data['status']	= 'open';

								ee()->api_channel_fields->setup_entry_settings($channel_id, $data);

								$success = ee()->api_channel_entries->save_entry($data, $channel_id);

								if ( ! $success)
								{
									//show_error(implode('<br />', $this->api_channel_entries->errors));
									ee()->session->set_flashdata('message_failure', $i . lang('records_imported'));
									ee()->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name.'&method=failed');
									
									} else {
										$i++;
									}
								
							}
							
							if($i>0)
							{
								ee()->session->set_flashdata('message_success', $i . lang('records_imported'));
								ee()->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->module_name.'&method=success');
							}
		
				}
				
				// --------------------------------------------------------------------
				
				public function failed()
				{
					
				}
				
				
				
				// --------------------------------------------------------------------
				
				public function docs()
				{
				
				
					ee()->load->library('table');
					
					ee()->view->cp_page_title = lang('gdt_import_module_name') . ' / ' . lang('documentation');
					
					$vars	= array('module_name'=>$this->module_name);
					
					return ee()->load->view('documentation',$vars,TRUE);
					
				
				}
				
				
				
				
				
				
				
				// --------------------------------------------------------------------
				
				
				public function success()
				{
					ee()->view->cp_page_title = lang('gdt_import_module_name');
					ee()->load->library('table');
					
					$vars['message_success']	= ee()->session->flashdata('message_success');
					$vars['module_name']	= $this->module_name;
					
					return ee()->load->view('success',$vars,TRUE);
				}

				
				// --------------------------------------------------------------------
				
				/**
				 * Return array of field_names = field_id pairs
				 *	@return array
				 */
				 public function field_ids()
				 {
					 	$data	= array();
					 	
					 	$fields = ee()->db
					 							->select('field_id,field_name')
					 							->get('channel_fields')
					 							->result();
					 							
					 	foreach($fields as $key=>$row)
					 	{
					 		$data[$row->field_name]	= 'field_id_' . $row->field_id;
					 	}
					 	
					 	return $data;
				 }
				 
				
				// --------------------------------------------------------------------
				
		
					
					
}
/* END Class */
/* End of file mcp.gdt_import.php */
/* Location: ./system/expressionengine/third_party/modules/gdt_import/mcp.gdt_import.php */