<?php

if(!function_exists('uploadImage')){
    function uploadImage($image, $chkext = false, $destinationFolder = "uploads"){
        $imageArray = array("png", "jpg", "jpeg", "gif", "bmp");
        $imagename = "";
        if ($image) {
            $imageExt = $image->getClientOriginalExtension();
            $imgname = $image->getClientOriginalName();

            if (!in_array($imageExt, $imageArray) && $chkext) {
                return "";
            }

            $imagename = rand(100, 999).'_'.time().str_replace(' ','',$imgname);
            $destinationPath = public_path($destinationFolder);
            $image->move($destinationPath, $imagename);
        }

        return [$imagename,$imageExt];
    }
}

if(!function_exists('loadDataTableCss')){
    function loadDataTableCss(){
        return "<link rel='stylesheet' type='text/css' href=".url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')."/>
            <link rel='stylesheet' type='text/css' href=".url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').">";
    }
}

if(!function_exists('loadDataTableJs')){
    function loadDataTableJs(){
        return "
            <script src=".url('assets/plugins/datatables/jquery.dataTables.min.js')."></script>
            <script src=".url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')."></script>
            <script src=".url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')."></script>";
    }
}

