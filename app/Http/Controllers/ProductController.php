<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'data' => $product
        ]);
    }
        
    //get Sub 1 category datatable friendly formated data
    public function getDataTableFilterData(Request $request){
        
        if($request->search['value'] != null){
            $products = DB::table('products')
            ->where('sub2category', $request->sub2category)
            ->where('name', 'LIKE', '%'.$request->search['value'].'%')            
            ->offset($request->start)
            ->limit($request->length)
            ->orderBy('id', 'desc')
            ->get();
        }else{            
            $products = DB::table('products')
            ->where('sub2category', $request->sub2category)  
            ->offset($request->start)
            ->limit($request->length)
            ->orderBy('id', 'desc')
            ->get();
        }        
        return response()->json([      
            'data' => $products
        ]);
    }

    public function rules(){
        $rules = [
            'maincategory' => 'required',
            'sub1category' => 'required',
            'sub2category' => 'required',
            'product_code' => 'required|unique:products,product_code',
            'qty' => 'required',
            'price' => 'required',
            'wholesale_price' => 'required',
            'last_sold_price' => 'required',
            'description' => 'required',
            'product' =>  [
                         'required', 
                         Rule::unique('products')
                                ->where('product_code', $request->product_code)
                                ->where('product', $request->product)
                        ]
        ];
        return $rules; 
    }

    public function messages(){
        $messages = [
            'maincategory.required' => 'Main category is required', 
            'sub1category.required' => 'Sub category is required', 
            'sub2category.required' => 'Sub category 2 is required', 
            'product_code.required' => 'Product code is required', 
            'product_code.unique' => 'Product code already available', 
            'product.required' => 'Product is required', 
            'product.unique' => 'This product already available',  
            'qty.required' => 'Quantity is required',
            'price.required' => 'Selling Price is required',
            'wholesale_price.required' => 'Wholesale price is required',
            'last_sold_price.required' => 'Last sold price is required',
            'description.required' => 'Product Description is required',
        ];

        return $message;
    }
            
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        try { 
            // $rules = [
            //     'maincategory' => 'required',
            //     'sub1category' => 'required',
            //     'sub2category' => 'required',
            //     'product_code' => 'required|unique:products,product_code',
            //     'qty' => 'required',
            //     'price' => 'required',
            //     'wholesale_price' => 'required',
            //     'last_sold_price' => 'required',
            //     'description' => 'required',
            //     'product' =>  [
            //                  'required', 
            //                  Rule::unique('products')
            //                         ->where('product_code', $request->product_code)
            //                         ->where('product', $request->product)
            //                 ]
            // ];            
            
            // //custom message for validation initiate.if not need custom message remove $mssage from validator method.
            // //if we not set custom message for any validation it message will pop as default from laravel
            // $messages = [
            //     'maincategory.required' => 'Main category is required', 
            //     'sub1category.required' => 'Sub category is required', 
            //     'sub2category.required' => 'Sub category 2 is required', 
            //     'product_code.required' => 'Product code is required', 
            //     'product_code.unique' => 'Product code already available', 
            //     'product.required' => 'Product is required', 
            //     'product.unique' => 'This product already available',  
            //     'qty.required' => 'Quantity is required',
            //     'price.required' => 'Selling Price is required',
            //     'wholesale_price.required' => 'Wholesale price is required',
            //     'last_sold_price.required' => 'Last sold price is required',
            //     'description.required' => 'Product Description is required',
            // ];
            
            //custom validation
            $validator = Validator::make($request->all(),$this->rules(),$this->messages());
            
            $errorsMsgObject = $validator->errors();
            $allErrorMsgArray = array();
            $globalErrorMsg = "";
            $msgType = 0;
            
            //create model object
            $product = new Product;
            
            if ($validator->fails()) { 
                //validation failed warning message block  
                $jsonMsgtype = 2;            
                foreach ($errorsMsgObject->all() as $message) {
                    $allErrorMsgArray[] = $message;
                } 
                if(isset($allErrorMsgArray) && !empty($allErrorMsgArray)){
                    $globalErrorMsg = implode(' | ',$allErrorMsgArray);
                } else{
                    $globalErrorMsg = "A problem has been occurred while saving data. Please Try again later.";
                } 
            }else{
                //validation ok success message                 
                $product->create($request->all());                
                $msgType = 1;
                $globalErrorMsg = "Successfully Saved.";                                             
            }
            
            return response()->json([
                'msgType' => $msgType,
                'message' => $globalErrorMsg,
                'category' => $product
                ]); 
                
            } catch (\Throwable $th) {
                return response()->json([
                    'msgType' => 0,
                    'message' => $th->getMessage()               
                ]);
            } 
        }
                    
        /**
        * Display the specified resource.
        *
        * @param  \App\Models\Product  $product
        * @return \Illuminate\Http\Response
        */
        public function show(Product $product)
        {
            $query = DB::table('products')
            ->join('sub2categories', 'products.sub2category', '=', 'sub2categories.id')           
            ->join('sub1categories', 'products.sub1category', '=', 'sub1categories.id')           
            ->join('maincategories', 'products.maincategory', '=', 'maincategories.id')           
            ->select('products.*', 'sub2categories.sub2category AS sub2catname','sub1categories.subcategory AS sub1catname','maincategories.category AS maincatname','maincategories.code AS maincatcode')
            ->where('products.id', $product->id) 
            ->get();
            return response()->json($query);
        }
                    
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\Models\Product $product
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, Product $product)
        {
            try {
                // $rules = [
                //     'sub1category' => 'required',
                //     'sub2category' =>  [
                //                  'required', 
                //                  Rule::unique('sub2categories')
                //                         ->where('sub2category', $request->sub2category)
                //                         ->where('sub1category', $request->sub1category)
                //                 ]
                // ]; 
                
                // //custom message for validation initiate.if not need custom message remove $mssage from validator method.
                // //if we not set custom message for any validation it message will pop as default from laravel
                // $messages = [
                //     'sub1category.required' => 'Sub Category 1 is required', 
                //     'sub2category.unique' => 'This sub category 2 already available.Please try again',  
                //     'sub2category.required' => 'Sub category 2 is required'
                // ];
                
                //custom validation
                $validator = Validator::make($request->all(),$this->rules(),$this->messages());
                // $validator = Validator::make($request->all(),$rules,$messages);
                
                $errorsMsgObject = $validator->errors();
                $allErrorMsgArray = array();
                $globalErrorMsg = "";
                $msgType = 0;
                
                if ($validator->fails()) { 
                    //validation failed warning message block  
                    $jsonMsgtype = 2;            
                    foreach ($errorsMsgObject->all() as $message) {
                        $allErrorMsgArray[] = $message;
                    } 
                    if(isset($allErrorMsgArray) && !empty($allErrorMsgArray)){
                        $globalErrorMsg = implode(' | ',$allErrorMsgArray);
                    } else{
                        $globalErrorMsg = "A problem has been occurred while updating data. Please Try again later.";
                    } 
                }else{
                    //validation ok success message
                    $product->update($request->all());
                    $msgType = 1;
                    $globalErrorMsg = "Successfully Updated.";                                             
                }
                
                return response()->json([
                    'msgType' => $msgType,
                    'message' => $globalErrorMsg,
                    'category' => $product
                ]); 
                    
            } catch (\Throwable $th) {
                return response()->json([
                    'msgType' => 0,
                    'message' => $th->getMessage()               
                ]);
            }            
        }
        
                
        /**
        * Remove the specified resource from storage.
        *
        * @param  \App\Models\Product $product
        * @return \Illuminate\Http\Response
        */
        public function destroy(Product $product)
        {
            try {
                $product->delete();
                return response()->json([
                    'msgType' => 1,
                    'message' => 'Successfully Deleted.'
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'msgType' => 0,
                    'message' => $th->getMessage()               
                ]);
            }
        }
}
