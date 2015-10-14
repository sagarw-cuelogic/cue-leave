<div class="container main-content">

<?php 
	$this->load->view('common/nav_menu');
?>
<div class="cms-right-section col-md-10 col-sm-9">
	<?php switch($navigation){
	case "profile":
		$this->load->view('content/profile_page');
	break;
	case 'add_leaves':
		$this->load->view('content/'.$navigation);
	break;
	case 'view_leaves':
		$this->load->view('content/'.$navigation);
	break;
	case 'manage_employees':
		$this->load->view('content/'.$navigation);
	break;
	case 'view_employees':
		$this->load->view('content/'.$navigation);
	break;
	default:
		$this->load->view('content/profile_page');
	break;
	}?>
</div>
</div>