<?php
/**
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class BuyerController extends CI_Controller
{
	public $em;
	function __construct()
	{
		parent::__construct();
		$this->load->library('doctrine');
		$this->em = $this->doctrine->em;

		$this->load->library('Files');

		// $this->load->library('Dx');
	}

	public function index(){

	}
	public function create(){
		$this->load->view('buyer/create', []);
	}
	public function clear(){
		$this->session->sess_destroy();
	}
	public function test(){
		echo time();
	}
	public function addRequest(){
		// add request to session

		$request = new \Entity\OrderDetail();		

		// add asset
		$asset_config = array();
	    $asset_config['upload_path']          = $this->config->item('asset_temp_dir');
	    $asset_config['allowed_types']        = $this->config->item('asset_allowed_types');
	    $asset_config['max_size']             = $this->config->item('asset_max_size');
	    $asset_config['max_width']            = $this->config->item('asset_max_width');
	    $asset_config['max_height']           = $this->config->item('asset_max_height');
	    print_r($_FILES);
	    if(isset($_FILES['images']) && count($_FILES['images']['name']) > 0){
	    	$uploads = $this->files->do_upload_multiple('images', $asset_config);

			print_r($uploads);
				foreach ($uploads['uploads_data'] as $index => $upload_data) {
					$asset = new \Entity\Asset();
					$asset->name = $upload_data['client_name'];
					$asset->path = $upload_data['public_path'];
					$request->assets[] = $asset;
					print_r($asset);
				}
	    }

		// add size
		foreach ($_POST['bannerSizeX'] as $index => $value) {
			$size = new \Entity\Size();
			$size->width = $value;
			$size->height = $_POST['bannerSizeY'][$index];
			$request->sizes[] = $size;
			$size->order_detail = $request;
		}

		$request->content = $_POST['bannerContent'];
		$request->note .= strip_tags($_POST['bannerNote']);

		$requestList = isset($this->session->requestList) ? $this->session->requestList : array();
		$requestList[] = $request;
		$this->session->requestList = $requestList;
	}
	public function completeOrder(){
    header('Content-Type: application/json');
		$customer = false;
		$customers = \Entity\Customer::findBy([
			'email'=>$_POST['email']
			], '\Entity\Customer', $this->em);
		if(count($customers) > 0){
			$customer = $customers[0];
		}else{
			$customer = new \Entity\Customer();
			$customer->fullname = $_POST['name'];
			$customer->email = $_POST['email'];
			$customer->phone = $_POST['phone'];
			$this->em->persist($customer);
		}
		if($customer != false){
			$order = new \Entity\Order();
			$order->customer = $customer;
			$customer->orders[] = $order;
			$this->em->persist($order);


			$requestList = isset($this->session->requestList) ? $this->session->requestList : array();
			// save asset
			foreach($requestList as $i=>$request){
				$this->em->persist($request);
				$order->order_details[] = $request;
				$request->order = $order;
				foreach($request->assets as $j=>$asset){
					$this->em->persist($asset);
				}
				foreach($request->sizes as $size){
					$this->em->persist($size);
				}

			}
			// save final
			$this->em->flush();
			foreach($requestList as $i=>$request){
				foreach($request->assets as $j=>$asset){
					$local_path = $asset->path;
					$dropbox_path = $this->config->item('asset_dropbox_path') . date("/Y/M/") . $customer->id . "/" . $asset->name;
					$data_upload = $this->files->upload_to_dropbox($local_path, $dropbox_path, false);

					$asset->d_json = json_encode($data_upload);
					$asset->path = $data_upload->path;
					$this->em->persist($asset);
					$this->em->flush();

					// create thumb
		            if(strpos($data_upload->mime_type, "image") != -1 ){
		              $thumb_image = $this->files->get_image_from_dropbox( $asset->path, "m", "jpeg", false);
		              file_put_contents($this->config->item("asset_thumbnail_dir") . "/" . $asset->id.".jpeg", $thumb_image);
		              $asset->thumb = $this->config->item("asset_thumbnail_dir") . "/" . $asset->id.".jpeg";

		              $this->em->merge($asset);
		              $this->em->flush();
		            }
		            $asset_order_detail = new \Entity\AssetOrderDetail();
		            $asset_order_detail->aid = $asset->id;
		            $asset_order_detail->oid = $request->id;
		            $this->em->persist($asset_order_detail);
	              	$this->em->flush();
					unlink($local_path);
				}
			}
			$this->session->unset_userdata('requestList');
			if(is_numeric($order->id))
				echo json_encode(array(
						'success'		=>	TRUE,
						'orderID'		=>	$order->id
					));
			else{
				echo json_encode(array(
						'success'		=>	FALSE,
						'code'	=> 1,
						'error'			=>	'Có lỗi sảy ra, vui lòng thử lại hoặc liên hệ 0918 126 800 để được hỗ trợ.'
					));
			}
			return;
		}
		$this->session->unset_userdata('requestList');
		echo json_encode(array(
				'success'		=>	FALSE,
				'code'	=> 2,
				'error'			=>	'Có lỗi sảy ra, vui lòng thử lại hoặc liên hệ 0918 126 800 để được hỗ trợ.'
			));
	}
}
?>