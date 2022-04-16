<?php /**
 * 
 */
class Home extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return redirect(base_url('dashboard/'));
	}
}