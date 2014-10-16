<?php 
$lang	= array(

'gdt_import_module_name'	=>
'Good at Import',

'gdt_import_module_description'	=>
'Import database table rows to EE channel entry records',

'import_table' =>
'DB table to import',

'import_channel'	=>
'Import to Channel',

'import'	=>
'Import',

'import_title_field' =>
'Which column should be used for the entry title?',

'no_import_table' => 
'No tables found for import. Import a CSV file to the database.',

'success'	=>
'Success',

'import_screen' =>
'Import screen',

'import_another' => 
'Import another table',

'records_imported' =>
' records imported',

'help'	=> 
'Help',

'documentation'	=>
'Documentation',

''	=>
'',

'docs_copy'	=>

'<h4>Purpose</h4>	
<p>Putting this together in a pinch to create channel entries for a bunch of spreadsheets of product data a client will use on their new website.</p>
<h4>Preparation</h4>
<p>Using a tool such as phpMyAdmin, import a spreadsheet into the current database.<br>
	Be sure the new table does not use the EE installation db prefix (usually "exp_" ).<br>
	If you have not already, rename the columns to be imported to the short_name values of the field group for the channel you will import to.<br>
	</p>
<h4>Import</h4>
On the Import screen:<br>
Select the new database table from the dropdown.<br>
Select the channel to import the data to.<br>
Select the column to use as the title for each new entry.<br>
Important: the title must not be an integer or a null value, so choose a column you know will be an alpha/alphanumeric string.<br>
Also, if a channel field is required, the import will fail if it encounters a null value. Update the custom fields temporarily or prep the data in the spreadsheet accordingly.
'
);