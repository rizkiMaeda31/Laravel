<?php

namespace App\Http\Controllers;

use App\Models\WishlistProduct;
use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistProductController extends Controller
{
    public function index()
    {
        //
        if (Auth::check()) {
            return response()->json([
                'no trash'=>WishlistProduct::withoutTrashed()->get(),
                'trashed'=>WishlistProduct::onlyTrashed()->get(),
                'mix'=>WishlistProduct::withTrashed()->get()
            ],200);
        }
        // redirect();
        return response()->json(['message' => 'Not Authenticated User!', 'isValid'=>false], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $product=new WishlistProduct();
        $data=$request->data;
        // return response()->json($request->data->data,200);
        $t=$product;
        $product->isPublished=$data['isPublished'];
        $product->wishlistId=$data['wishlistId'];
        $product->productId=$data['productId'];
        $product->api=json_encode([
            'wishlistId'=>$data['wishlistId'],
            'productId'=>$data['productId'],
            'isPublished'=>$data['isPublished'],
        ]);
        $task='Insert Wishlist '.$product->name;
        try {
            $product->save();
            $this->logging($task,json_encode($product->api),1);
        } catch (\Throwable $th) {
            //throw $th;
            $this->logging($task,json_encode($product->api),0);
            return response()->json(['message' => 'Operation is failed!',$data], 404);
        }
        return response()->json(['message'=>'Success!','resBefore'=>$t,'resAfter'=>$product, 'send data'=>$data],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(WishlistProduct $product)
    {
        //
        // $product->restore();
        if(!$product) return response()->json(['message'=> 'WishlistProduct is not found!'],404);
        return response()->json(['data'=>$product],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WishlistProduct $product)
    {
        if (!$product) {
            return response()->json(['message' => 'WishlistProduct not found'], 404);
        }
        $data=$request->data->data?$request->data->data:$request->data;
        $t=$product;
        $product->isPublished=$data['isPublished'];
        $product->wishlistId=$data['wishlistId'];
        $product->productId=$data['productId'];
        $product->api=array_merge($product->api,[
            'wishlistId'=>$data['wishlistId'],
            'productId'=>$data['productId'],
            'isPublished'=>$data['isPublished'],
        ]);
        $task='Update WishlistProduct from '.$product->name.' to '.$data['name'];
        try {
            $product->saveOrFail();
            $this->logging($task,json_encode($product->api),1);
        } catch (\Throwable $th) {
            //throw $th;
            $this->logging($task,json_encode($product->api),0);
            return response()->json(['message' => 'Operation is failed!'], 404);
        }
        return response()->json(['message'=>'Success!','resBefore'=>$t,'resAfter'=>$product, 'send data'=>$data],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WishlistProduct $product)
    {
        //
        // $product->restore();
        
        $task='Soft Delete Wishlist '.$product->name;
        try {
            $product->deleteOrFail();
            $this->logging($task,json_encode($product->api),1);
        } catch (\Throwable $th) {
            //throw $th;
            $this->logging($task,json_encode($product->api),0);
            return response()->json(['message' => 'Operation is failed!'], 404);
        }
        return response()->json(['message'=>'Success!','resAfter'=>$product, 'isSoftDeleted'=>$product->trashed()],200);
    }

    public function restoreAllSoftDeleted(){
        $t=WishlistProduct::onlyTrashed()->get();
        if(count($t)<= 0 || !$t) return response()->json(['message' => 'Invalid Request!'], 404);
        if($t){
            foreach ($t as $r) {
                try {
                    $r->restore();
                    $this->logging('Restore Soft Deleted Data',json_encode($r->api),1);
                } catch (\Throwable $th) {
                    $this->logging('Failed To Restore Soft Deleted Data',json_encode($r->api),0);
                }
            }
        }
        return response()->json(['message' => 'Success!', 'isSuccess'=>true], 200);
    }

    public function restoreSoftDeleted(Request $req){
        if (!$req) {
            return response()->json(['message' => 'Invalid Request!'], 404);
        }
        $t=WishlistProduct::onlyTrashed()->where('id',$req->id)->get();
        return response()->json(['message' => 'Success!', 'isSuccess'=>true], 200);
    }

    public function Filtering(Request $req){
        if ($req->ajax()) {
            $res="";
            $s=$req->filterIdx;
            $api=null;
            try {
                if ($s >= 0 && $s < 3) {
                    $isExist= WishlistProduct::withoutTrashed()->where('id',$s)->count();
                    switch ($s) {
                        case 0:
                            $api = WishlistProduct::withoutTrashed()->get();
                            break;
                        case 0 < $s && $isExist > 0:
                            break;
                        default:
                            $products=WishlistProduct::find($s)->products()->get();
                            $api=$products->filter(function ($product) {
                                return $product->deleted_at != null;
                            });
                            // $api = Product::withoutTrashed()->where('categoryId',$s)->get();
                            break;
                    }   
                }
        
                if ($api) {
                    foreach ($api as $k => $v) {
                        // return something
                        // $res .= '<tr>
                        //             <td>' . $v->ArtistId . '</td>
                        //             <td>' . $v->Name . '</td>
                        //             <td>
                        //                 <div class="btn-group">
                        //                     <a type="button" class="btn btn-warning" href="' . url('view/artist/update/' . $v->ArtistId) . '">Update</a>
                        //                     <a type="button" class="btn btn-danger" href="' . url('view/artist/delete/' . $v->ArtistId) . '">Delete</a>
                        //                 </div>
                        //             </td>
                        //         </tr>';
                    }
                } else {
                    $res = "No data found";
                }
            } catch (\Exception $e) {
                $res = "Error: " . $e->getMessage();
            }
            $c=count($api);
            return response()->json([],200);
            // return response(["res" => $res, "count" => $c]);
        }
        else {
            $text="currently i'm in ".$req->s."!";
            $s=$req->s;
            $api = WishlistProduct::withoutTrashed()->where([
                ['name','like',('%'.$s.'%')],['brand','like',('%'.$s.'%')]
            ]);
            return response()->json([],200);
        }
    }

    public function Search(Request $req){
        if ($req->ajax()) {
            $res="";
            $s=$req->searchText;
            $api=null;
            try {
                if ($s != "") {
                    $api = WishlistProduct::withoutTrashed()->where([
                        ['name','like',('%'.$s.'%')],['brand','like',('%'.$s.'%')]
                    ]);
                    // $api=DB::table('products')->leftJoin('categories','categoryId','=','id')->where('deleted_at','not','null')->get();
                } else {
                    $api = WishlistProduct::withoutTrashed()->get();
                }
        
                if ($api) {
                    foreach ($api as $k => $v) {
                        // return something
                        // $res .= '<tr>
                        //             <td>' . $v->ArtistId . '</td>
                        //             <td>' . $v->Name . '</td>
                        //             <td>
                        //                 <div class="btn-group">
                        //                     <a type="button" class="btn btn-warning" href="' . url('view/artist/update/' . $v->ArtistId) . '">Update</a>
                        //                     <a type="button" class="btn btn-danger" href="' . url('view/artist/delete/' . $v->ArtistId) . '">Delete</a>
                        //                 </div>
                        //             </td>
                        //         </tr>';
                    }
                } else {
                    $res = "No data found";
                }
            } catch (\Exception $e) {
                $res = "Error: " . $e->getMessage();
            }
            $c=count($api);
            return response()->json([],200);
            // return response(["res" => $res, "count" => $c]);
        }
        else {
            $text="currently i'm in ".$req->s."!";
            $s=$req->s;
            $api = WishlistProduct::withoutTrashed()->where([
                ['name','like',('%'.$s.'%')],['brand','like',('%'.$s.'%')]
            ]);
            return response()->json([],200);
        }
    }

    public function Sorting(Request $req){
        if ($req->ajax()) {
            $res="";
            $index=$req->cdix;
            $order=$req->order;
            $api=null;
            try {
                if ($index == 0) $api = WishlistProduct::withoutTrashed()->orderBy('name',$order)->get();
                if ($index == 1) $api = WishlistProduct::withoutTrashed()->orderBy('brand',$order)->get();
        
                if ($api) {
                    foreach ($api as $k => $v) {
                        // $res .= '<tr>
                        //             <td>' . $v->ArtistId . '</td>
                        //             <td>' . $v->Name . '</td>
                        //             <td>
                        //                 <div class="btn-group">
                        //                     <a type="button" class="btn btn-warning" href="' . url('view/artist/update/' . $v->ArtistId) . '">Update</a>
                        //                     <a type="button" class="btn btn-danger" href="' . url('view/artist/delete/' . $v->ArtistId) . '">Delete</a>
                        //                 </div>
                        //             </td>
                        //         </tr>';
                    }
                } else {
                    $res = "No data found";
                }
            } catch (\Exception $e) {
                $res = "Error: " . $e->getMessage();
            }
            $c=count($api);
            return response(["res" => $res, "count" => $c]);
        }
    }

    
    private function logging($task='',$detailEncoded,$status=false){
        $log = new Log();
        $log->task=$task;
        $log->status=$status?'Success!':'Failed!';
        $log->detail=$detailEncoded;
        $log->save();
    }
}
