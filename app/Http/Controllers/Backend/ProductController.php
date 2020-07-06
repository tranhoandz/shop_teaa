<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attr;
use App\Models\Img_pro;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product= Product::all();
        $category = Category::all();
        return view('backend.product.index',compact('product','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all();
        return view('backend.product.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $file_name = $request->image->getClientOriginalName();
        // // đẩy file vào thư mục uploads
        // $request->image->move(base_path('public/uploads/'),$file_name);
        $image= trim($request->image,url('/public/uploads/'));
        // dump($image);
        
        /*xử lý nhiều ảnh*/

        /*end nhieu anh*/

        /*định dạng dữ liệu*/
        $request->validate([
            'name' => 'required|unique:products|max:255',
            'id_cate' => 'required',
            'image' => 'required|ends_with:jpg,jpeg,gif,png',
        ],[
            'name.required' =>'Tên sản phẩm không được bỏ trống',
            'name.unique' =>'Tên sản phẩm đã tồn tại',
            'name.max' =>'Tên sản phẩm không vượt quá 255 kí tự',
            'image.required' =>'Ảnh không được bỏ trống',
            'image.ends_with' =>'Ảnh phải là đuôi jpg,jpeg,gif,png',

        ]);
        $product =Product::create([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'id_cate'=>$request->id_cate,
            'image'=>$image,
            'description'=>$request->description,
            'meta_title'=>$request->meta_title,
            'meta_keyword'=>$request->meta_keyword,
            'meta_desc'=>$request->meta_desc,
            'status'=>$request->status,
        ]);
        $images=json_decode($request->images);
        foreach ($images as $key => $value) {
            $anh = trim($value,url('/public/uploads/'));
            Img_pro::create([
                'id_product' => $product->id,
                'image' =>$anh
            ]);
        };
        return redirect()->route('product.index')->with('success','Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $category = Category::all();
        $img_pro= Img_pro::where('id_product',$id)->get();
        // dd($img_pro);
        return view('backend.product.edit',compact('category','product','img_pro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $product_id=Product::find($id);
        if ($request->image=='') {
            $image=$product_id->image;
        }else{
         $image= trim($request->image,url('/public/uploads/'));
        }
        // dump($image);
        
        /*xử lý nhiều ảnh*/

        /*end nhieu anh*/

        /*định dạng dữ liệu*/
        $request->validate([
            'name' => 'required|max:255',
            'id_cate' => 'required',
        ],[
            'name.required' =>'Tên sản phẩm không được bỏ trống',
            // 'name.unique' =>'Tên sản phẩm đã tồn tại',
            'name.max' =>'Tên sản phẩm không vượt quá 255 kí tự',

        ]);
       
        $product_id->update([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'id_cate'=>$request->id_cate,
            'image'=>$image,
            'description'=>$request->description,
            'meta_title'=>$request->meta_title,
            'meta_keyword'=>$request->meta_keyword,
            'meta_desc'=>$request->meta_desc,
            'status'=>$request->status,
        ]);
        return redirect()->route('product.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
         return redirect()->route('product.index')->with('success','Xóa thành công');
    }
}
