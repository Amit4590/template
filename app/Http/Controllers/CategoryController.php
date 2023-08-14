<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use App\Helpers\CustomHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Validator;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        if ($request->ajax()) {
            $data = Category::with('media')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category_image', function($row){
                    $image_url = url('assets/dist/img/default.png');
                    if(!empty($row->media)){
                        $image_url = CustomHelper::getFullUrl($row->media->host_url,$row->media->folder_name,$row->media->image_name);
                    }
                    return '<a href="'.$image_url.'" target="_blank"><img src="'.$image_url.'" height="50px" width="50px" /></a>';
                })
                ->addColumn('action', function($row){
                    $status_url = route('category.status',[$row->is_active,$row->id]);
                    $edit_url = route('category.edit',$row->id);
                    $delete_url = route('category.destroy',$row->id);
                    $btn = CustomHelper::getButton($row->id,$status_url,$edit_url,$delete_url,$row->is_active);
                        return $btn;
                })
                ->rawColumns(['category_image','action'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validation = Validator::make($request->all(),[
            'category_name' => 'required|unique:categories',
            'category_image' => 'required'
        ]);

        if($validation->fails()){
            return CustomHelper::validatorResponse($validation->errors(),'Validation Error !!',3001);
        }

        $res = Category::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name)
        ]);
        if($res){
            if($request->has('category_image')){
                $iamge = uploadImage($request->category_image,false,'category');
                CustomHelper::saveMedia($res->id,$iamge);
            }

            return CustomHelper::returnResponse('Category Saved',2000);
        }
        return CustomHelper::returnResponse("Can't Save Category !!",2001);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        dd("Can't Access !!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category){
        if($category){
            $category = Category::with('media')->find($category->id);
            $category->image = $category->media;
            $category->url = route('category.update',$category->id);
            return CustomHelper::returnResponse('Get edit data',2000,$category);
        }
        return CustomHelper::returnResponse("Can't get data !!",2001);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category){

        $unique = Rule::unique('categories')->ignore($category->id);
        
        $validation = Validator::make($request->all(),[
            'category_name' => ['required',$unique],
        ]);

        if($validation->fails()){
            return CustomHelper::validatorResponse($validation->errors(),'Validation Error !!',3001);
        }

        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name);
        if($category->save()){
            if($request->has('category_image')){
                $iamge = uploadImage($request->category_image,false,'category');
                CustomHelper::updateMedia($category->id,CustomHelper::CATEGORY);
                CustomHelper::saveMedia($category->id,$iamge);
            }
            return CustomHelper::returnResponse('Category Updated',2000);
        }
        return CustomHelper::returnResponse("Can't Update Category !!",2001);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category){
        if($category){
            $category->media()->delete();
            $category->delete();
            return CustomHelper::returnResponse('Category deleted ',2000);   
        }
        return CustomHelper::returnResponse("Can't delete category !!",2001);   
    }

    public function status($status,$id){
        $category = Category::find($id);
        if($category){
            if($status == 1){
                $category->is_active = 0;
            }else{
                $category->is_active = 1;
            }

            if($category->save()){
                return CustomHelper::returnResponse('Category status changed ',2000);
            }
        }
        return CustomHelper::returnResponse("Can't change category status !!",2001);   
    }

}
