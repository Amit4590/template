<?php

namespace App\Helpers;
use App\Models\Media;


class Customhelper {

    const CATEGORY = 1;
    const SUBCATEGORY = 2;
    const BOOK = 3;

    public static $getFolderName = [
        self::CATEGORY => 'category',
        self::SUBCATEGORY => 'subcategory',
        self::BOOK => 'books'
    ];

    public static function validatorResponse($data = array(),$message,$status = 3001){
        return response()->json(array('validator' => $data,'message' => $message, 'status' => $status));
    }

    public static function returnResponse($message,$status = 2000,$data = array()){
        return response()->json(array('data' => $data, 'message' => $message, 'status' => $status));
    }

    public static function getButton($id,$status_url,$edit_url,$delete_url,$is_active = 1,$action = 0){
        if($is_active == 1){
            $msg = '<i class="fas fa-check"></i>';
        }else{
            $msg = '<i class="fas fa-power-off"></i>';
        }
        $btn = '<a href="javascript:void(0);" title="Active/Deactive" class="status" onclick="__status(`'.$status_url.'`)" data-action="Status">'.$msg.'</a>
            <a href="javascript:void(0);" class="edit" title="Edit" onclick="__edit(`'.$edit_url.'`)" data-act="ajax-modal" data-title="Edit"><i class="fas fa-pencil-alt"></i></a>
            <a href="javascript:void(0);" title="Delete" class="delete" onclick="__delete(`'.$delete_url.'`)" data-action="delete"><i class="fas fa-times fa-fw"></i></a>';
        return $btn;
    }

    public static function saveMedia($id,$imagename = array()){
        $media = Media::create([
            'attr_id' => $id,
            'host_url' => url('/'),
            'folder_name' => 'category',
            'image_name' => $imagename[0],
            'image_type' => $imagename[1],
            'type' => CustomHelper::CATEGORY,
        ]);
        return $media;
    }

    public static function updateMedia($id,$type){
        $result = Media::where(['attr_id' => $id,'type' => $type,'is_active' => 1])->get();
        foreach ($result as $key => $value) {
            Media::where('id',$value->id)->update(['is_active' => 0]);
        }
        return true;
    }

    public static function getFullUrl($url,$folder,$name){
        return $url.'/'.$folder.'/'.$name;
    }

}

