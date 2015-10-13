<?php 
	$this->load->view('common/nav_menu');
?>
<div class="cms-right-section col-md-9 col-sm-9">
	<?php switch($navigation){
	case "profile":
		$this->load->view('content/profile_page');
	break;
	case 'add':
		$this->load->view('content/add_leaves');
	break;
	case 'view':
		$this->load->view('content/view_leaves');
	break;
	default:
		$this->load->view('content/profile_page');
	break;
	}?>
</div>