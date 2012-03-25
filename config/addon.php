<?php
/*
FluxCP Vote For Points
Developed By: JayPee Mateo
Email: mandark022@yahoo.com
*/

return array(
	'IP_BLOCKING' => true, //Set false the blocking system is Account per Site not Both Account and IP per Site
	'MAX_FILE_SIZE'=> 100, //In kilobytes/kb
	
	'MenuItems' => array(
		'Vote For Points' => array(
			'Voting Sites' => array('module' => 'voteforpoints'),
		),
	),
	'SubMenuItems' => array(
        'voteforpoints' => array(
            'add'   => 'Add new Voting Site',
            'list'   => 'Edit - Delete Voting Site',
        ),
    ),

	// Do not touch this.
    'FluxTables' => array(
        'Voters' => 'cp_v4p_voters',			//Contains the record of the Players Vote Points
        'Sites' => 'cp_v4p_sites',			//Contains the list of sites
        'Logs' => 'cp_v4p_votelogs',		//Contains the record the player vote date
    ),

)
?>