<?php

class Image_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }
    
    //add image data in attachment table
    function add_image_data($att_data){
        $this->db->insert(ATTACHMENTS, $att_data);
        $last_id = $this->db->insert_id();
        if($last_id){
            return $last_id;
        }
        else{
            return FALSE;
        }
    }
    
    function image_sizes($folder){
        $img_sizes = array();
        switch($folder){
            case 'userImage' :
                $img_sizes['thumbnail'] = array('width'=>50, 'height'=>50, 'folder'=>'/thumb');
                $img_sizes['medium'] = array('width'=>250, 'height'=>250, 'folder'=>'/medium');
                break;
            case 'courseImage' :
                $img_sizes['thumbnail'] = array('width'=>100, 'height'=>100, 'folder'=>'/thumb');
                $img_sizes['medium'] = array('width'=>250, 'height'=>250, 'folder'=>'/medium');
                break;
        }  
        return $img_sizes;
    }

    function makedirs($folder='', $mode=DIR_WRITE_MODE, $defaultFolder='uploads/'){

        if(!@is_dir(FCPATH . $defaultFolder)) {

            mkdir(FCPATH . $defaultFolder, $mode);
        }
        if(!empty($folder)) {

            if(!@is_dir(FCPATH . $defaultFolder . '/' . $folder)){
                mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode,true);
            }
        } 
    }//End Function
    function makedirsBk($folder='', $mode=DIR_WRITE_MODE, $defaultFolder='../uploads/'){

        if(!@is_dir(FCPATH . $defaultFolder)) {

            mkdir(FCPATH . $defaultFolder, $mode);
        }
        if(!empty($folder)) {

            if(!@is_dir(FCPATH . $defaultFolder . '/' . $folder)){
                mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode,true);
            }
        } 
    }//End Function
     
    function updateMedia1($image,$folder,$height=768,$width=1024,$path=FALSE){

        if($path){
            $this->makedirsBk($folder);
        }else{
            $this->makedirs($folder);
        }

        $realpath = $path ?'../uploads/':'uploads/';
        $allowed_types = "jpg|gif|png|jpeg|JPG|PNG|JPEG"; 
        
        $img_name = random_string('alnum', 16);  //generate random string for image name
        $config = array(
            'upload_path'       => $realpath.$folder,
            'allowed_types'     => $allowed_types,
            'max_size'          => "10240",   // Can be set to particular file size , for now it is 10mb
            'max_height'        => "10000",
            'max_width'         => "10000",
            'min_width'         => "50",
            'min_height'        => "50",
            'file_name'         => $img_name,
            'overwrite'         => false,
            'remove_spaces'     => TRUE,
            'quality'           => '100%',
        );
        
        $this->load->library('upload');
        $this->upload->initialize($config);
 
        if(!$this->upload->do_upload($image)){
            $error = array('error' => $this->upload->display_errors());
            return $error;

        } else {
            $image_data = $this->upload->data();
            $this->load->library('image_lib');

            $folder_thumb = $folder.'/thumb/';// create for thumb image
            if($path){
                $this->makedirsBk($folder_thumb);
            }else{
                $this->makedirs($folder_thumb);
            }

            $folder_resize = $folder.'/medium/';// createfor medium image 
            if($path){
                $this->makedirsBk($folder_resize);
            }else{
                $this->makedirs($folder_resize);
            }
            $large = '/large';
            $folder_large = $folder.$large;// create for large image 
            if($path){
                $this->makedirsBk($folder_large);
            }else{
                $this->makedirs($folder_large);
            }

            $img_sizes_arr = $this->image_sizes();  //predefined sizes in model
            $thumb_img = '';
            $resize = array();
            foreach($img_sizes_arr as $k=>$v){
                
                $real_path = realpath(FCPATH .$realpath .$folder);
                $resize['image_library']    = 'gd2';
                $resize['source_image']     = $image_data['full_path'];
                $resize['new_image']        = $real_path.$v['folder'].'/'.$image_data['file_name'];
                $resize['maintain_ratio']   = FALSE;
                $resize['width']            = $v['width'];
                $resize['height']           = $v['height'];
                $resize['quality']          = '100%';
                $this->image_lib->initialize($resize);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
                
            //custom size 
            $real_path = realpath(FCPATH .$realpath .$folder);
            $resize1 = array();
            $resize1['source_image']    = $image_data['full_path'];
            $resize1['new_image']       = $real_path.$large.'/'.$image_data['file_name'];
            $resize1['maintain_ratio']  = FALSE;
            $resize1['width']           = $width;
            $resize1['height']          = $height;
            $resize1['quality']         = '100%';
            $this->image_lib->initialize($resize1);
            $this->image_lib->resize();
            $this->image_lib->clear();
            
            //return uploaded image name (resized image names will be same as original uploaded image name)
            return $image_data['file_name']; 
        }

    } // End Function


    function updateMedia($image,$folder,$height=768,$width=1024,$path=FALSE){

        $this->makedirs($folder);
        
        $realpath = $path ?'../uploads/':'uploads/';
        $allowed_types = "jpg|png|jpeg";    
        $img_name = authToken();  //generate random string for image name
        
        $img_sizes_arr = $this->image_sizes($folder);  //predefined sizes in model
       
        //We will set min height and width according to thumbnail size
        $min_width = $img_sizes_arr['thumbnail']['width'];
        $min_height = $img_sizes_arr['thumbnail']['height'];
                
        $config = array(
                'upload_path'       => $realpath.$folder,
                'allowed_types'     => $allowed_types,
                //'max_size'          => "10240",   // File size limitation, initially w'll set to 10mb (Can be changed)
                //'max_height'        => "4000", // max height in px
                //'max_width'         => "4000", // max width in px
                //'min_width'         => $min_width, // min width in px
                //'min_height'        => $min_height, // min height in px
                'file_name'         => $img_name,
                'overwrite'         => FALSE,
                'remove_spaces'     => TRUE,
                'quality'           => '100%',
            );
        
        $this->load->library('upload'); //upload library
        $this->upload->initialize($config);
 
        if(!$this->upload->do_upload($image)){
            $error = array('error' => $this->upload->display_errors());
            return $error; //error in upload
        }
        
        //image uploaded successfully - We will now resize and crop this image
        
        $image_data = $this->upload->data(); //get uploaded image data
        $this->load->library('image_lib'); //Load image manipulation library
        $thumb_img = '';

        foreach($img_sizes_arr as $k=>$v){
            
            // create resize sub-folder
            $sub_folder = $folder.$v['folder'];
            $this->makedirs($sub_folder);

            $real_path = realpath(FCPATH .$realpath .$folder);

            $resize['image_library']      = 'gd2';
            $resize['source_image']       = $image_data['full_path'];
            $resize['new_image']          = $real_path.$v['folder'].'/'.$image_data['file_name'];
            $resize['maintain_ratio']     = TRUE; //maintain original image ratio
            $resize['width']              = $v['width'];
            $resize['height']             = $v['height'];
            $resize['quality']            = '100%';
            // We need to know whether to use width or height edge as the hard-value. 
            // After the original image has been resized, either the original image width’s edge or 
            // the height’s edge will be the same as the container
            $dim = (intval($image_data["image_width"]) / intval($image_data["image_height"])) - ($v['width'] / $v['height']);
            $resize['master_dim'] = ($dim > 0)? "height" : "width";

            $this->image_lib->initialize($resize);
            $is_resize = $this->image_lib->resize();   //create resized copies
            
            //image resizing maintaining it's aspect ratio is done. Now we will start cropping the resized image
            $source_img = $real_path.$v['folder'].'/'.$image_data['file_name'];
            
            if($is_resize && file_exists($source_img)){
                
                $source_image_arr = getimagesize($source_img);
                $source_image_width = $source_image_arr[0];
                $source_image_height = $source_image_arr[1];
                
                $source_ratio = $source_image_width / $source_image_height;
                $new_ratio = $v['width'] / $v['height'];
                
                if($source_ratio != $new_ratio){
                    
                    //image cropping config
                    $crop_config['image_library'] = 'gd2';
                    $crop_config['source_image'] = $source_img;
                    $crop_config['new_image'] = $source_img;
                    $crop_config['quality'] = "100%";
                    //$crop_config['maintain_ratio'] = FALSE;
                    $crop_config['maintain_ratio'] = TRUE;
                    $crop_config['width'] = $v['width'];
                    $crop_config['height'] = $v['height'];
                    
                    if($new_ratio > $source_ratio || (($new_ratio == 1) && ($source_ratio < 1))){
                        $crop_config['y_axis'] = round(($source_image_width - $crop_config['width'])/2);
                        $crop_config['x_axis'] = 0;
                    }else{
                        $crop_config['x_axis'] = round(($source_image_height - $crop_config['height'])/2);
                        $crop_config['y_axis'] = 0;
                    }
                    //$crop_config['x_axis'] = 0;
                    //$crop_config['y_axis'] = 0;
                    
                    $this->image_lib->initialize($crop_config); 
                    $this->image_lib->crop();
                    $this->image_lib->clear();
                }
            }
        }

        if(empty($thumb_img))
            $thumb_img = $image_data['file_name'];

        return $thumb_img;

    } // End Function

	function updateGallery($fileName,$folder,$hieght=250,$width=250)
	{
	  	$this->makedirs($folder);

		$storedFile 		= array();
		$allowed_types 		= "gif|jpg|png|jpeg"; 
		$files 				= $_FILES[$fileName];
		$number_of_files 	= sizeof($_FILES[$fileName]['tmp_name']);

		// we first load the upload library
		$this->load->library('upload');
		// next we pass the upload path for the images
		$configG['upload_path'] 		= 'uploads/'.$folder;
		$configG['allowed_types'] 		= $allowed_types;
		$configG['max_size']    		= '2048000';
		$configG['encrypt_name']  		= TRUE;
		$configG['quality'] 			= '100%';
   
		// now, taking into account that there can be more than one file, for each file we will have to do the upload
		for ($i = 0; $i < $number_of_files; $i++)
		{
			$_FILES[$fileName]['name'] 		= $files['name'][$i];
			$_FILES[$fileName]['type'] 		= $files['type'][$i];
			$_FILES[$fileName]['tmp_name'] 	= $files['tmp_name'][$i];
			$_FILES[$fileName]['error'] 	= $files['error'][$i];
			$_FILES[$fileName]['size'] 		= $files['size'][$i];

			//now we initialize the upload library
			$this->upload->initialize($configG);
			if ($this->upload->do_upload($fileName))
			{
				$savedFile = $this->upload->data();//upload the image
			
				$folder_thumb = $folder.'/thumb/';
				$this->makedirs($folder_thumb);
				//your desired config for the resize() function
				$config1 = array(
					'image_library' 	=> 'gd2',
					'source_image' 		=> $savedFile['full_path'], //get original image
					'maintain_ratio' 	=> false,
					//'create_thumb' 		=> TRUE,
					'width' 			=> 100,
					'height' 			=> 100,
					'new_image' 		=> realpath(FCPATH .'uploads/'.$folder_thumb),
					'quality'			=> '100%'
				);	
				$this->load->library('image_lib'); //load image_library
				$this->image_lib->initialize($config1);
				$this->image_lib->resize();
				$folder_resize = $folder.'/resize/';
				$this->makedirs($folder_resize);

				$resize1['source_image'] 	= $savedFile['full_path'];
				$resize1['new_image'] 		= realpath(FCPATH .'uploads/'.$folder_resize);
				$resize1['maintain_ratio'] 	= FALSE;
				$resize1['width'] 			= $width;
				$resize1['height'] 			= $hieght;
				$resize1['quality'] 		= '100%';

				$this->image_lib->initialize($resize1);
				$this->image_lib->resize();

				$storedFile[$i]['name'] = $savedFile['file_name'];
				$storedFile[$i]['type'] = $savedFile['file_type'];
				
				$this->image_lib->clear();
                
			} else {
				$storedFile[$i]['error'] = $this->upload->display_errors();
			}
		} // END OF FOR LOOP
		 
		return $storedFile;
		  
	}//FUnction

    function uploadPDF($profile_image,$folder){ 
        $this->makedirs($folder);
        $config = array(
            'upload_path' => FCPATH.'uploads/'.$folder,
            'allowed_types' => "*",
            'overwrite' => false,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'encrypt_name'=>TRUE ,
            'remove_spaces'=>TRUE
        );
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!$this->upload->do_upload($profile_image)){
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $pdf = $this->upload->data(); //upload the image
            return $pdf['file_name'];
        }
    }

	function unlinkFile($path,$file){

            $main   = $path.$file;
            $thumb  = $path.'thumbnail/'.$file;
            $medium = $path.'medium/'.$file;
            $large = $path.'large/'.$file;

            if(file_exists(FCPATH.$main)):
                unlink( FCPATH.$main);
            endif;
            if(file_exists(FCPATH.$thumb)):
                unlink( FCPATH.$thumb);
            endif;
            if(file_exists(FCPATH.$medium)):
                unlink( FCPATH.$medium);
            endif;
            if(file_exists(FCPATH.$large)):
                unlink( FCPATH.$large);
            endif;
            return TRUE;
	}//End function

}// End of class Image_model

?>
