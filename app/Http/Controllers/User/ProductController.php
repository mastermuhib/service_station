<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Fungsi;
use App\Classes\upload;
use App\Model\ProdukModel;
use App\Model\ProductMonggoDB;
use App\Model\TipeProdukModel;
use App\Model\CabangModel;
use App\Model\RoleModel;
use Auth;
use DB;
use Redirect;
use App\Exceptions\Handler;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $role_id = Auth::guard('admin')->user()->role_id;
            $data = parent::sidebar();
            if ($data['access'] == 0) {
                return redirect('/');
            } else {
                $data['name_adm'] = Auth::guard('admin')->user()->name;
                $nama_role = RoleModel::where('id',$role_id)->pluck('name');
                $data['category_product'] = DB::table('t_master_category_products')->where('status',1)->select('id','master_name')->get();
                $data['gudang'] = DB::table('relation_product_warehouses as r')->join('t_warehouses as w','w.id','r.warehouse_id')->join('cities as c','c.id','w.id_city')->where('c.status',1)->select('c.id','c.name')->distinct('c.id')->get();
                
                $data['header_title'] = "List Produk";

                return view('product.index', $data);
            }
        } catch (\Exception $e) {
            $data['code']    = 500;
            $data['message'] = $e->getMessage();
            $data['line'] = $e->getLine();
            $data['controller'] = 'ProductController@index';
            $insert_error = parent::InsertErrorSystem($data);
            $error = parent::sidebar();
            $error['id'] = $insert_error;
            return view('errors.index',$error); // jika Metode Get
            //return response()->json($data); // jika metode Post
        }
        
    }

    public function list_data(Request $request)
    {
        $product = DB::table('t_products as p')->join('t_shops as s','s.id','p.id_shop')->whereNull('s.deleted_at')->whereNull('p.deleted_at');
        if ($request->id_category1 != null) {
            $product = $product->where('p.id_category1',$request->id_category1);
        }

        if ($request->id_category2 != null) {
            $product = $product->where('p.id_category2',$request->id_category2);
        }

        if ($request->id_category3 != null) {
            $product = $product->where('p.id_category3',$request->id_category3);
        }

        if ($request->id_category4 != null) {
            $product = $product->where('p.id_category4',$request->id_category4);
        }

        if ($request->id_shop != null) {
            $product = $product->where('id_shop',$request->id_shop);
        }

        if ($request->id_seller != null) {
            $in_shop = DB::table('t_shops')->where('id_seller',$request->id_seller)->pluck('id')->toArray();
            $product = $product->whereIn('id_shop',$in_shop);
        }

        if ($request->id_etalase != null) {
            $in_etalase = DB::table('relation_product_etalase')->where('id_etalase',$request->id_etalase)->pluck('id_product')->toArray();
            $product = $product->whereIn('p.id',$in_etalase);
        }

        if ($request->id_city != null) {
            
            $in_array_city = DB::table('relation_product_warehouses as r')->join('t_warehouses as w','w.id','r.warehouse_id')->where('w.id_city',$request->id_city)->pluck('product_id')->toArray();
            $product = $product->whereIn('p.id',$in_array_city);
        }

        if ($request->search != null) {
            $product = $product->where(function ($query) use ($request) {
                $search = $request->search;
                $query->where('product_name','ilike', "%{$search}%");
                $query->orWhere('shop_name','ilike', "%{$search}%");
            });
        }
        
        if ($request->sort == 1) {
            $product = $product->orderBy('s.created_at','desc');
        }
        if ($request->sort == 2) {
            $product = $product->orderBy('stock','desc');
        }
        if ($request->sort == 3) {
            $product = $product->orderBy('number_of_sale','desc');
        }
        if ($request->sort == 4) {
            $product = $product->orderBy('rating','desc');
        }
        if ($request->sort == 5) {
            $product = $product->orderBy('selling_price','desc');
        }
        
        $product = $product->limit(8)->offset($request->start)->select('p.id','product_name','selling_price','discount','variant_color','variant_model','shop_name','p.description','sold_count as number_of_sale','stock','p.rating','p.status','p.suspend_date_active','p.reason')->get();
        $data['product'] = $product;
        if ($data['product']->isNotEmpty()) {
            foreach ($data['product'] as $k => $v) {
                $data['product'][$k]->image = parent::GetImageProduct($v->id);
            }
        }      
        return view('product.data', $data);
        
    }

    //cek_load_more_product
    public function cek_load_more_product(Request $request)
    {
        $product = DB::table('t_products as p')->join('t_shops as s','s.id','p.id_shop')->whereNull('s.deleted_at')->whereNull('p.deleted_at');
        if ($request->id_category1 != null) {
            $product = $product->where('p.id_category1',$request->id_category1);
        }

        if ($request->id_category2 != null) {
            $product = $product->where('p.id_category2',$request->id_category2);
        }

        if ($request->id_category3 != null) {
            $product = $product->where('p.id_category3',$request->id_category3);
        }

        if ($request->id_category4 != null) {
            $product = $product->where('p.id_category4',$request->id_category4);
        }

        if ($request->id_shop != null) {
            $product = $product->where('id_shop',$request->id_shop);
        }

        if ($request->id_seller != null) {
            $in_shop = DB::table('t_shops')->where('id_seller',$request->id_seller)->pluck('id')->toArray();
            $product = $product->whereIn('id_shop',$in_shop);
        }

        if ($request->id_etalase != null) {
            $in_etalase = DB::table('relation_product_etalase')->where('id_etalase',$request->id_etalase)->pluck('id_product')->toArray();
            $product = $product->whereIn('p.id',$in_etalase);
        }

        if ($request->id_city != null) {
            
            $in_array_city = DB::table('relation_product_warehouses as r')->join('t_warehouses as w','w.id','r.warehouse_id')->where('w.id_city',$request->id_city)->pluck('product_id')->toArray();
            $product = $product->whereIn('p.id',$in_array_city);
        }

        if ($request->search != null) {
            $product = $product->where(function ($query) use ($request) {
                $search = $request->search;
                $query->where('product_name','ilike', "%{$search}%");
                $query->orWhere('shop_name','ilike', "%{$search}%");
            });
        }
        
        $data['jumlah'] = 0;
        $product = $product->offset($request->start)->count();
        if ($product > 8) {
            $data['jumlah'] = 1;
        }      
        return $data;
        
    }

    public function get_data_produk(Request $request)
    {
        
        $return = 40;
        return $return;
    }

    public function BranchProduct($id){

        $data = DB::table('relation_product_branchs')->where('id_product',$id)->get();
        if ($data->isEmpty()) {
            $return = '<label class="text-danger">Belum di set</label>';
        } else {
            $return = '<button class="btn btn-info btn-sm d_cabang" data="produk" id="'.$id.'" type="button">Lihat Cabang</button>';
        }

        return $return;

    }

    public function nonactive(Request $request)
    {
        $nonactive         = ProdukModel::find($request->id);
        $nonactive->status = 0;
        $nonactive->save();

        if ($nonactive) {
            $id_admin    = Auth::guard('admin')->user()->id;
            
            $data['code']    = 200;
            $data['message'] = 'Berhasil Menon aktifkan Data Produk';
            $insert_log      = parent::LogAdmin(\Request::ip(),Auth::guard('admin')->user()->id,'Menon Aktifkan Data Produk '.$nonactive->_product_name.'','Produk');
            return response()->json($data);
        } else {
            $data['code']    = 500;
            $data['message'] = 'Maaf Ada yang Error ';
            return response()->json($data);
        }
    }

    public function active(Request $request)
    {
        $nonactive         = ProdukModel::find($request->id);
        $nonactive->status = 1;
        $nonactive->save();

        if ($nonactive) {
            $id_admin    = Auth::guard('admin')->user()->id;
           
            $data['code']    = 200;
            $data['message'] = 'Berhasil Megaktifkan Data Produk';
            $insert_log      = parent::LogAdmin(\Request::ip(),Auth::guard('admin')->user()->id,'Mengaktifkan Data Produk '.$nonactive->product_name.'','Produk');
            return response()->json($data);
        } else {
            $data['code']    = 500;
            $data['message'] = 'Maaf Ada yang Error ';
            return response()->json($data);
        }
    }

    public function delete(Request $request)
    {
        $delete             = ProdukModel::find($request->id);
        $delete->status     = 0;
        $delete->deleted_at = date('Y-m-d');
        $delete->save();

        if ($delete) {
            $id_admin    = Auth::guard('admin')->user()->id;
            
            $data['code']    = 200;
            $data['message'] = 'Berhasil Menghapus Data Produk';
            $insert_log      = parent::LogAdmin(\Request::ip(),Auth::guard('admin')->user()->id,'Menghapus Data Produk '.$delete->name.'','Produk');
            return response()->json($data);
        } else {
            $data['code']    = 500;
            $data['message'] = 'Maaf Ada yang Error ';
            return response()->json($data);
        }
    }

    public function detail($id)
    {
        try {
            $id = base64_decode($id);
            $id = parent::cleanHazard($id);
            
            $data = parent::sidebar();
            $data['header_title'] = "Edit Data Produk";
            //dd($data);
            if ($data['access'] == 0) {
                return redirect('/');
            } else {
                $role_id           = Auth::guard('admin')->user()->id_role;
                $data['data_role'] = RoleModel::whereNull('deleted_at')->where('status', 1)->get();
                $isUuid = Str::isUuid($id);
                if ($isUuid == true) {
                    $product = ProdukModel::where('id',$id)->first();
                    $data['data'] = $product;
                    if ($product != null ) {
                        
                        $data['data']->image = parent::AllImageID($product->id);
                        if ($product->main_product == 1) {
                            $data['variant'] = ProdukModel::where('group_product',$product->group_product)->where('main_product',0)->select('id','variant_color','variant_model','stock','description','selling_price','sku_code')->get();
                            if (count($data['variant']) > 0) {
                                foreach ($data['variant'] as $k => $v) {
                                    $data['variant'][$k]->image = parent::GetImageID($v->id);
                                }
                            }
                        }
                    }
                    //gudang
                    $in_gudang = DB::table('relation_product_warehouses')->where('product_id',$id)->pluck('warehouse_id')->toArray();
                    $data['gudang_in'] =  DB::table('t_warehouses')->whereIn('id',$in_gudang)->where('status',1)->select('warehouses_name as name','id')->get();
                    $data['gudang_all'] =  DB::table('t_warehouses')->whereNotIn('id',$in_gudang)->where('status',1)->select('warehouses_name as name','id')->get();

                    //categories
                    $data['master_category'] = DB::table('t_master_category_products')->where('status',1)->select('id','master_name')->get();
                    $data['sub_category1'] = DB::table('t_sub_category_products')->where('id_master_category',$product->id_category1)->where('status',1)->select('id','sub_category_name')->get();
                    $data['sub_category2'] = DB::table('t_sub_sub_category_products')->where('id_sub_category',$product->id_category2)->where('status',1)->select('id','sub_sub_category_name')->get();
                    $data['sub_category3'] = DB::table('t_category_products')->where('id_sub_category2',$product->id_category3)->where('status',1)->select('id','category_product_name')->get();
                    $shop = DB::table('t_shops')->where('id',$product->id_shop)->first();

                    //deliveries
                    $in_delivery = DB::table('relation_delivery_products')->where('id_product',$id)->pluck('id_delivery')->toArray();
                    $data['delivery_in'] =  DB::table('t_master_deliveries')->whereIn('id',$in_delivery)->select('master_delivery_name as name','id')->get();
                    $data['delivery_all'] =  DB::table('t_master_deliveries')->whereNotIn('id',$in_delivery)->where('status',1)->where(function ($query) use ($shop) {
                        $query->whereNull('id_user');
                        $query->orWhere('id_user',$shop->id_seller);
                    })->select('master_delivery_name as name','id')->get();
                    
                    return view('product.dialog_edit', $data);
                } else {
                    $data['error_message'] = "Data dengan ID tersebut tidak ditemukan";
                    $data['link_back'] = "/product/list-produk";
                    return view('errors.empty_data',$data);
                }
            }
        } catch (\Exception $e) {
            $data['code']    = 500;
            $data['message'] = $e->getMessage();
            $data['line'] = $e->getLine();
            $data['controller'] = 'ProductController@detail';
            $insert_error = parent::InsertErrorSystem($data);
            $error = parent::sidebar();
            $error['id'] = $insert_error;
            return view('errors.index',$error); // jika Metode Get
            //return response()->json($data); // jika metode Post
        }
        
    }

    public function data_cabang($tipe,$id){
        if ($tipe == 'produk') {
            $data['data'] = DB::table('relation_product_branchs as r')->join('table_branchs as b','b.id','r.id_branch')->where('id_product',$id)->select('branch_name','address')->get();
        } else {
            $data['data'] = DB::table('relation_package_branchs as r')->join('table_branchs as b','b.id','r.id_branch')->where('id_package',$id)->select('branch_name','address')->get();

        }

        return view('produk.data_cabang', $data);
    }

    public function set_promosi(Request $request){

        try {

            if ($request->data == 'paket') {
                DB::table('packages')->where('id',$request->id)->update(['discount'=>$request->discount]);
                $data_x = DB::table('packages')->where('id',$request->id)->first();
                // Notif
                if ($request->discount != '0') {
                   
                    $title = 'Promo Untuk Paket '.$data_x->package_name;
                    $message = 'Ada promo terbaru nih dari paket '.$data_x->package_name.' Sebesar '.$request->discount.'%, segera dapatkan promo tersebut ya';
                    $insertadmin = array(
                        'id_user'   => null,
                        'file'       => null,
                        'text' => $message,
                        'title' => $title,
                        'status'      => 1,
                        'tipe'      => 4,
                        'is_umum' => 1,
                        'id_detail' => $request->id,
                        'created_by' => Auth::guard('admin')->user()->id,
                        'created_at'  => date('Y-m-d H:i:s'),
                        'updated_at'  => date('Y-m-d H:i:s'),
                        );
                    $insert = DB::table('notifications')->insertGetId($insertadmin);
                    $id_object = $data_x->id;
                    $action = "activities.others.NotificationActivity";
                    //
                    $user = DB::table('users')->whereNotNull('firebase_android')->orWhereNotNull('firebase_ios')->select('id')->get();
                    foreach ($user as $k => $v) {
                        $notif_android  = Fungsi::NotifeAndroid($v->id,$action,$id_object,$request->title,$message,4,2);
                    }
                }
                $data['message'] = "Berhasil Mengupdate Diskon Untuk Paket";
            } else {
                DB::table('products')->where('id',$request->id)->update(['discount'=>$request->discount]);
                $data_x = DB::table('products')->where('id',$request->id)->first();
                // Notif
                if ($request->discount != '0') {
                    $title = 'Promo Untuk Produk '.$data_x->product_name;
                    $message = 'Ada promo perbaru nih dari Produk '.$data_x->product_name.' Sebesar '.$request->discount.'%, segera dapatkan promo tersebut ya';
                    $insertadmin = array(
                        'id_user'   => null,
                        'file'       => null,
                        'text' => $message,
                        'title' => $title,
                        'status'      => 1,
                        'tipe'      => 3,
                        'is_umum' => 1,
                        'id_detail' => $request->id,
                        'created_by' => Auth::guard('admin')->user()->id,
                        'created_at'  => date('Y-m-d H:i:s'),
                        'updated_at'  => date('Y-m-d H:i:s'),
                        );
                    $insert = DB::table('notifications')->insertGetId($insertadmin);
                    $id_object = $data_x->id;
                    $action = "activities.others.NotificationActivity";
                    //
                    $user = DB::table('users')->whereNotNull('firebase_android')->orWhereNotNull('firebase_ios')->select('id')->get();
                    foreach ($user as $k => $v) {
                        $notif_android  = Fungsi::NotifeAndroid($v->id,$action,$id_object,$request->title,$message,3,1);
                    }
                }
                $data['message'] = "Berhasil Mengupdate Diskon Untuk Produk";
            }
            $data['code']    = 200;
            return response()->json($data);
        } catch (\Exception $e) {
            $data['code']    = 500;
            $data['message'] = $e->getMessage();
            $data['line'] = $e->getLine();
            $data['controller'] = 'ProdukController@set_promosi';
            $insert_error = parent::InsertErrorSystem($data);
            return response()->json($data); // jika metode Post
        }
    }

    public function relation_cabang_produk(){

        $cabang = DB::table('table_branchs')->whereNull('deleted_at')->get();
        foreach ($cabang as $k => $v) {
            
            $array_in = DB::table('relation_product_branchs')->where('id_branch',$v->id)->whereNotNull('id_product')->pluck('id_product')->toArray();
            $product = DB::table('products')->whereNotIn('id',$array_in)->get();
            foreach ($product as $a => $b) {
                $insertadmin = array(
                    'id_product' => $b->id,
                    'id_branch' => $v->id,
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s'),
                    );
                $insert = DB::table('relation_product_branchs')->insert($insertadmin);
            }
        }
        dd("success");
    }

    public function relation_cabang_paket(){

        $cabang = DB::table('table_branchs')->whereNull('deleted_at')->get();
        foreach ($cabang as $k => $v) {
            
            $array_in = DB::table('relation_package_branchs')->where('id_branch',$v->id)->whereNotNull('id_package')->pluck('id_package')->toArray();
            $product = DB::table('packages')->whereNotIn('id',$array_in)->get();
            foreach ($product as $a => $b) {
                $insertadmin = array(
                    'id_package' => $b->id,
                    'id_branch' => $v->id,
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s'),
                    );
                $insert = DB::table('relation_package_branchs')->insert($insertadmin);
            }
        }
        dd("success");
    }

    public function add_variant_product($no,$model){
        $data['no'] = $no;
        $data['sku_code'] = 'M_'.$no.'_'.date('YmdHis');
        $data['variant_model_name'] = $model;
        return view('product.add_variant', $data);
    }

    public function add_image_product($no){
        $data['no'] = $no;
        return view('product.add_image', $data);
    }

    public function delete_image_product(Request $request){
        $delete = DB::table('t_product_images')->where('image',$request->val)->update(['deleted_at'=>date('Y-m-d')]);
        $data['message'] = "Foto Berhasil Dihapus";
        return json_encode($data);
    }

    public function delete_variant_product(Request $request){

        $delete = DB::table('t_products')->where('id',$request->val)->update(['deleted_at'=>date('Y-m-d'),'status'=>0]);
        $data['message'] = "Berhasil menghapus variant produk";
        return json_encode($data);

    }

    public function upload_image(Request $request){

        $data = parent::uploadFileS3($request->source);
        return json_encode($data);

    }

    public function update(Request $request){
        $data['code'] = 500;
        $data['message'] = "Tredapat kesalahan";
        if ($request->assurance == 1) {
            $optional = 0;
            $must = 1;
        } else {
            $optional = 1;
            $must = 0;
        }

        $slug = str_replace(array(' ', '/', '(', ')', '[', ']', '?', ':', ';','<', '>', '&', '{', '}', '*'), array('-'),$request->product_name);
        $slug  = strtolower($slug);
        $price = intval(preg_replace('/\D/', '', $request->selling_price));
        $product = DB::table('t_products')->where('id',$request->id)->first();

        $data_insert = ['product_name'=>$request->product_name,
                        'selling_price'=>$price,
                        'slug'=>$slug,
                        'type_of_weight'=>$request->type_of_weight,
                        'weight'=>$request->weight,
                        'stock'=>$request->stock,
                        'minimum_order'=>$request->minimum_order,
                        'pre_order'=>$request->pre_order,
                        'is_optional_assurance'=>$optional,
                        'is_must_assurance'=>$must,
                        'description'=>$request->description,
                        'variant_model_name'=>$request->variant_model_name,
                        'discount'=> $request->discount,
                        'sku_code'=>$request->sku_code,
                        'id_category1'=>$request->id_category1,
                        'id_category2'=>$request->id_category2,
                        'id_category3'=>$request->id_category3,
                        'id_category4'=>$request->id_category4,
                        'updated_at'=>date('Y-m-d H:i:s')
            ];

        $insert = DB::table('t_products')->where('id',$request->id)->update($data_insert);
        
        //relasi category product
        DB::table('relation_delivery_products')->where('id_product',$request->id)->delete();
        if (isset($request->id_delivery)) {
            $delivery = $request->id_delivery;
            if (count($delivery) > 0) {
                foreach ($delivery as $k => $v) {
                    $insert_delivery = DB::table('relation_delivery_products')->insert(['id_product'=>$request->id,'id_delivery'=>$delivery[$k],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
                }
            }
        }
        
        //relasi gudang product 
        DB::table('relation_product_warehouses')->where('product_id',$request->id)->delete();
        if (isset($request->id_warehouse)) {
            $warehouse = $request->id_warehouse;
            if (count($warehouse) > 0) {
                foreach ($warehouse as $k => $v) {
                    $insert_warehouse = DB::table('relation_product_warehouses')->insert(['product_id'=>$request->id,'warehouse_id'=>$warehouse[$k],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'stock'=>$request->stock]);
                }
            }
        }
        // relasi image 
        if (isset($request->image)) {
            $image = $request->image;
            if (count($image) > 0) {
                $no_img = 0;
                foreach ($image as $k => $v) {
                    $is_thumb = 0;
                    $no_img = $no_img + 1;
                    if ($no_img == 1) {
                        $is_thumb = 1;
                    }
                    $cek_image = DB::table('t_product_images')->where('image',$image[$k])->get();
                    if ($cek_image->isEmpty()) {
                        $insert_image = DB::table('t_product_images')->insert(['id_product'=>$request->id,'is_thumbnail'=>$is_thumb,'image'=>$image[$k],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
                    } else {
                        $insert_image = DB::table('t_product_images')->where('id',$cek_image[0]->id)->update(['is_thumbnail'=>$is_thumb,'updated_at'=>date('Y-m-d H:i:s')]);
                    }
                }
            }
        }

        //jika memiliki vaiant
        if (isset($request->i_id_variant)) {
            $id_variant = $request->i_id_variant;
            if (count($id_variant) > 0) {
                $no = 0;
                foreach ($id_variant as $k => $v) {
                $sku = $request->i_variant_sku[$k];
                $price_variant = intval(preg_replace('/\D/', '',$request->i_selling_price[$k]));
                $stock = $request->i_stock[$k];
                $color = $request->i_variant_color[$k];
                $model = $request->i_variant_model[$k];
                $description = $request->i_variant_model[$k];
                $image_variant = $request->image_variant[$k];

                    if ($id_variant[$k] != '' || $id_variant[$k] != null) {
                        $update_variant = DB::table('t_products')->where('id',$id_variant[$k])->update(['sku_code'=>$sku,'selling_price'=>$price_variant,'stock'=>$stock,'variant_color'=>$color,'variant_model'=>$model,'description'=>$description,'updated_at'=>date('Y-m-d H:i:s')]);
                        $update_image = DB::table('t_product_images')->where('id_product',$id_variant[$k])->update(['image'=>$image_variant,'updated_at'=>date('Y-m-d H:i:s')]);
                        //relasi category product
                        DB::table('relation_product_category')->where('id_product',$id_variant[$k])->delete();
                        if (isset($request->id_category)) {
                            $category = $request->id_category;
                            if (count($category) > 0) {
                                foreach ($category as $c => $v) {
                                    $insert_category = DB::table('relation_product_category')->insert(['id_product'=>$id_variant[$k],'id_category'=>$category[$c],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
                                }
                            }
                            
                        }

                        //relasi category product
                        DB::table('relation_delivery_products')->where('id_product',$id_variant[$k])->delete();
                        if (isset($request->id_delivery)) {
                            $delivery = $request->id_delivery;
                            if (count($delivery) > 0) {
                                foreach ($delivery as $c => $v) {
                                    $insert_delivery = DB::table('relation_delivery_products')->insert(['id_product'=>$id_variant[$k],'id_delivery'=>$delivery[$c],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
                                }
                            }
                        }
                        
                        //relasi gudang product 
                        DB::table('relation_product_warehouses')->where('product_id',$id_variant[$k])->delete();
                        if (isset($request->id_warehouse)) {
                            $warehouse = $request->id_warehouse;
                            if (count($warehouse) > 0) {
                                foreach ($warehouse as $c => $v) {
                                    $insert_warehouse = DB::table('relation_product_warehouses')->insert(['product_id'=>$id_variant[$k],'warehouse_id'=>$warehouse[$c],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'stock'=>$request->stock]);
                                }
                            }
                        }
                    } else {
                        //insert variant
                        $data_variant = ['product_name'=>$request->product_name,
                                'selling_price'=>$price_variant,
                                'slug'=>$slug,
                                'type_of_weight'=>$request->type_of_weight,
                                'weight'=>$request->weight,
                                'stock'=>$stock,
                                'minimum_order'=>$request->minimum_order,
                                'pre_order'=>$request->pre_order,
                                'id_shop'=>$product->id_shop,
                                'is_optional_assurance'=>$optional,
                                'is_must_assurance'=>$must,
                                'description'=>$description,
                                'main_product'=> 0,
                                'group_product'=> $product->group_product,
                                'sku_code'=>$sku,
                                'variant_color'=>$color,
                                'variant_model'=>$model,
                                'created_at'=>date('Y-m-d H:i:s'),
                                'updated_at'=>date('Y-m-d H:i:s')
                            ];

                        $insert_variant = DB::table('t_products')->insertGetId($data_variant);
                        //image variant
                        $insert_image = DB::table('t_product_images')->insert(['id_product'=>$insert_variant,'image'=>$image_variant,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'is_thumbnail'=>1]);
                        
                        if (isset($request->id_category)) {
                            $category = $request->id_category;
                            if (count($category) > 0) {
                                foreach ($category as $c => $v) {
                                    $insert_category = DB::table('relation_product_category')->insert(['id_product'=>$insert_variant,'id_category'=>$category[$c],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
                                }
                            }
                            
                        }

                        //relasi category product
                        if (isset($request->id_delivery)) {
                            $delivery = $request->id_delivery;
                            if (count($delivery) > 0) {
                                foreach ($delivery as $c => $v) {
                                    $insert_delivery = DB::table('relation_delivery_products')->insert(['id_product'=>$insert_variant,'id_delivery'=>$delivery[$c],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
                                }
                            }
                        }
                        
                        //relasi gudang product 
                        if (isset($request->id_warehouse)) {
                            $warehouse = $request->id_warehouse;
                            if (count($warehouse) > 0) {
                                foreach ($warehouse as $c => $v) {
                                    $insert_warehouse = DB::table('relation_product_warehouses')->insert(['product_id'=>$insert_variant,'warehouse_id'=>$warehouse[$c],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'stock'=>$request->stock]);
                                }
                            }
                        }
                    }
                }
            }
        }
        $data['code'] = 200;
        $data['message'] = "Sukses Edit Produk";
        return response($data);
    }

    public function status(Request $request)
    {
        try {
            $admin         = ProdukModel::find($request->id);
            $admin->status = $request->status;
            $admin->reason = $request->reason;
            $admin->suspend_date_active = $request->suspend_date_active;
            $admin->save();
            if ($admin) {
                $data['code']    = 200;
                $data['message'] = 'Berhasil Mengatur Status Produk';
                $insert_log      = parent::LogAdmin(\Request::ip(),Auth::guard('admin')->user()->id,'Mengatur status produk '.$request->id.'','Produk');
                return response()->json($data);
            } else {
                $data['code']    = 500;
                $data['message'] = 'Maaf Ada yang Error ';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            $data['code']    = 500;
            $data['message'] = $e->getMessage();
            $data['line'] = $e->getLine();
            $data['controller'] = 'ProductController@status';
            $insert_error = parent::InsertErrorSystem($data);
            return response()->json($data); // jika metode Post
        }
    }
}