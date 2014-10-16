<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *	Gdt_import_upd
 *
 *	@package		Gdt_import
 *	@author			Richard Whitmer
 *	@license		If you can figure it out, you're welcome to use it at your own risk.
 *	@link				http://panchesco.com
 *	@since			Version 1.0
 */
 
 // ------------------------------------------------------------------------



		class Gdt_import_upd {
		
				public	$module_name	= 'Gdt_import';
				public	$version			= '1.0';
			
			
			
				function __construct()
				{
						// Make a local reference to the ExpressionEngine super object
						$this->EE =& get_instance();
					
				}
				
				
					// --------------------------------------------------------------------
					

					function tabs()
					{
						$tabs['download'] = array(
						);	
						return $tabs;	
					}
			
					// --------------------------------------------------------------------
				
					/**
					* Module Installer
					*
					* @access public
					* @return bool
					*/	
					function install()
					{

					  $data = array(
					  'module_name' => $this->module_name,
					  'module_version' => $this->version,
					  'has_cp_backend' => 'y',
					  'has_publish_fields' => 'n'
					  );
					  
					  $this->EE->db->insert('modules', $data);
					  unset($data);
					  
					  $data	= array('class'=>$this->module_name,'method'=>'save_entries');
					  $this->EE->db->insert('actions', $data);
					  unset($data);
					  
					  $data	= array('class'=>$this->module_name,'method'=>'column_names');
					  $this->EE->db->insert('actions', $data);
					  unset($data);
					
					  return TRUE;
					}
					
					// --------------------------------------------------------------------
					
					/**
					* Module Uninstaller
					*
					* @access public
					* @return bool
					*/
					function uninstall()
					{
					  $this->EE->load->dbforge();
					  $this->EE->db->select('module_id');
					  $query = $this->EE->db->get_where('modules', array('module_name' => $this->module_name));
					  $this->EE->db->where('module_id', $query->row('module_id'));
					  $this->EE->db->delete('module_member_groups');
					  $this->EE->db->where('module_name', $this->module_name);
					  $this->EE->db->delete('modules');
					  $this->EE->db->where('class', $this->module_name);
					  $this->EE->db->delete('actions');
					
					/*
					$this->EE->load->library('layout');
					$this->EE->layout->delete_layout_tabs($this->tabs(), 'download');
					*/
					
					
					return TRUE;
					}
					
					// --------------------------------------------------------------------
					
					/**
					* Module Updater
					*
					* @access public
					* @return bool
					*/	
					function update($current='')
					{
					return TRUE;
					}
					
					// --------------------------------------------------------------------
}
/* END Class */
/* End of file upd.gdt_import.php */
/* Location: ./system/expressionengine/third_party/modules/gdt_import/upd.gdt_import.php */