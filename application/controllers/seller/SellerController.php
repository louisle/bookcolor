<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SellerController extends SellerBaseController{
  function __construct(){
    parent::__construct();
  }

  public function index(){
    $qb = $this->em->createQueryBuilder();
    $qb->select('u')
     ->from('Entity\Blog', 'u')
     ->where('u.title LIKE :title')
     ->setParameter('title', '%Blog%');
     // ->orderBy('u.name', 'ASC');
    echo json_encode($qb->getQuery()->getResult());
    die;
    $data = array();
    $this->loadView('dashboard', $data);
  }  


  public function handleUploadImage(){
    if(isset($_FILES['image']) > 0){
      $this->load->library('files');
      $uploadConf = array();
      $uploadConf['upload_path']          = 'public/uploads';
      $uploadConf['allowed_types']        = 'gif|jpg|jpeg|png';
      $uploadConf['max_size']             = 5120;
      $upload = $this->files->do_upload('image', $uploadConf);
      if($upload['success']){
        $this->loadView(null, array(
          'success'=>TRUE,
          'url'=>base_url() . '/' . $upload['upload_data']['public_path'],
        ));
      }else{
        $this->loadView(null, array(
          'success'=>FALSE,
          'error'=>$upload['error'],
        ));
      }
    }else{
      $this->loadView(null, array(
        'success'=>FALSE,
        'error'=>'Có lỗi khi upload image, vui lòng kiểm tra lại định dạng và kích thước.',
      )); 
    }
  }


  public function _reset_asset_thumb(){
    $this->load->library('files');
    $oqr = $this->em->createQueryBuilder()
        ->select('a')
        ->from('\Entity\Asset','a')
        ->getQuery();
    $assets = $oqr->getResult();
    foreach ($assets as $key => $asset) {
      $data_upload = json_decode($asset->d_json);
      if(strpos($data_upload->mime_type, "image") != -1 ){
        $thumb_image = $this->files->get_image_from_dropbox( $asset->path, "m", "jpeg", false);
        file_put_contents($this->config->item("asset_thumbnail_dir") . "/" . $asset->id.".jpeg", $thumb_image);
        $asset->thumb = $this->config->item("asset_thumbnail_dir") . "/" . $asset->id.".jpeg";

        $this->em->merge($asset);
        $this->em->flush();
      }      
    }
  }


}