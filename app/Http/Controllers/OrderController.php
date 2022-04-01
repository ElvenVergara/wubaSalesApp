<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Item;
use App\Models\Unit;
use App\Models\ItemCategory;
use App\Models\PO;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\StockOut;
use App\Models\Userlog;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_order(Request $request)
    {

            $this->validate($request,[
                'item_id' => 'required',
                'quantity' => 'required',
                'transaction_code' => 'required',
            ]);  
            

            $getItem = Item::where('id', $request->item_id)->first();
            $supplier_total = $getItem['suppliers_price'] * $request->quantity;
            $seller_total = ($getItem['sellers_price'] - ($getItem['sellers_price'] * $getItem['discount'])) * $request->quantity;
            $quantity = $request->quantity;


            if ($getItem['stock'] >= $quantity && $quantity > 0 ) {

                $update = Item::where('id', $request->item_id)->update([

                                    'stock' => $getItem['stock'] - $quantity,

                                ]);


                $profit = ($getItem['sellers_price'] - ($getItem['sellers_price'] * $getItem['discount'])) - $getItem['suppliers_price'];
                $total_profit = $profit * $quantity;
                

                $newdata = New Order;
                $newdata->status = 'Pending';
                $newdata->transaction_code = $request->transaction_code;
                $newdata->item_code = $getItem['item_code'];
                $newdata->supplier_id = $getItem['supplier_id'];
                $newdata->company = $getItem['company'];
                $newdata->category = $getItem['category'];
                $newdata->item_id = $getItem['id'];
                $newdata->item_name = $getItem['item_name'];
                $newdata->unit = $getItem['unit'];
                $newdata->quantity = $request->quantity;
                $newdata->suppliers_price = $getItem['suppliers_price'];
                $newdata->sellers_price = $getItem['sellers_price'];
                $newdata->supplier_total = $supplier_total;
                $newdata->seller_total = $seller_total;
                $newdata->profit = $total_profit;
                $newdata->discount = $getItem['discount'];
                $newdata->date = date('Y-m-d');
                $newdata->save();


                if ($getItem['stock'] == 0) {
                    
                    $update = Item::where('id', $request->item_id)->update([

                                    'status' => 'Out of Stock',

                                ]);

                } else {

                    $update = Item::where('id', $request->item_id)->update([

                                    'status' => 'Available',

                                ]);

                }

                return 'good';


            } else {

                return 'bad';

            }





            

    }





   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getOrders(Request $request)
    {
        
        $get = Order::where('transaction_code', $request->transaction_code)->get();
        $total = Order::where('transaction_code', $request->transaction_code)->sum('seller_total');

        $transactionData = Transaction::where('transaction_code', $request->transaction_code)->first();

        return [

                    'alldata' => $get,
                    'total' => $total,
                    'data' => $transactionData,

               ];  

    }

    






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuantityForEdit(Request $request)
    {
        
        return $get = Order::where('id', $request->data_id)->first();
       
    }










    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit_order(Request $request)
    {   
        
        
        $this->validate($request,[
            'quantity' => 'required',
        ]);  


        $getItem = Item::where('item_code', $request->item_code)->first();
        $getOrder = Order::where('id', $request->id)->first();
        $stock = $getItem['stock'] + $getOrder['quantity'];


        $supplier_total = ($getItem['suppliers_price'] - ($getItem['suppliers_price'] * $getItem['discount'])) * $request->quantity;
        $seller_total = ($getItem['sellers_price'] - ($getItem['sellers_price'] * $getItem['discount'])) * $request->quantity;
        $quantity = $request->quantity;


        if ($stock >= $quantity && $quantity > 0 ) {

            $update = Item::where('item_code', $request->item_code)->update([

                                'stock' => $stock - $quantity,

                            ]);

            $update = Order::where('id', $request->id)->update([

                                  'supplier_total' => $supplier_total,  
                                  'seller_total' => $seller_total,  
                                  'quantity' => $quantity,  
                                  'date' => date('Y-m-d'),  

                             ]);



            if ($stock == 0) {
                
                $update = Item::where('item_code', $request->item_code)->update([

                                'status' => 'Out of Stock',

                            ]);

            } else {

                $update = Item::where('id', $request->item_id)->update([

                                'status' => 'Available',

                            ]);

            }

            return 'good';

        } else {

            return 'bad';

        }


       
    }













    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_order(Request $request)
    {   

        $getOrder = Order::where('id', $request->id)->first();

        $quantity = $getOrder['quantity'];

        $getItem = Item::where('item_code', $getOrder['item_code'])->first();

        $updateItem = Item::where('item_code', $getOrder['item_code'])->update([
                
                                'stock' => $getItem['stock'] + $quantity,

                            ]);

        $delete = Order::where('id', $request->id)->delete();
        
    }









    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_transaction(Request $request)
    {   

        $update = Transaction::where('transaction_code', $request->transaction_code)->update([

                                    'status' => 'Saved',

                               ]);
        
    }








    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTransactionCode(Request $request)
    {   

        $getPendingTransaction = Transaction::where('status', 'Pending')->get();

        if (count($getPendingTransaction) == 0) {

            $newdata = New Transaction;
            $newdata->status = 'Pending';
            $newdata->transaction_code = $request->testCode;
            $newdata->number_of_items = 0;
            $newdata->total_amount = 0.00;
            $newdata->user_id = auth()->user()->id;
            $newdata->issued_by = auth()->user()->firstname.' '.auth()->user()->middlename.' '.auth()->user()->lastname;
            $newdata->customer_id = '';
            $newdata->date = date('Y-m-d');
            $newdata->save();

            return $request->testCode;

        } else {
            $get = Transaction::where('status', 'Pending')->first();
            return $get['transaction_code'];
        }
        
        
    }








    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkTransactionCode(Request $request)
    {   

        $get = Transaction::where('transaction_code', $request->transaction_code)->get();

        if (count($get) == 0) {
            
            return 'bad';

        } else {

            $get = Transaction::where('transaction_code', $request->transaction_code)->first();
            return $get['transaction_code'];

        }

        
    }






















    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSavedTransactions(Request $request)
    {   

        $textSearch = $request->textSearch;

        // pagenumberview
        $pagenumber = $request->tablenum;


        $all = Transaction::where('status', 'Saved')->get();

        foreach ($all as $k) {

            $getAllOrders = Order::where('transaction_code', $k['transaction_code'])->get();
            $getSum = Order::where('transaction_code', $k['transaction_code'])->sum('seller_total');

            $update = Transaction::where('transaction_code', $k['transaction_code'])->update([

                                        'number_of_items' => count($getAllOrders),
                                        'total_amount' => $getSum,

                                  ]);

        }


        if ( $textSearch == '') {

                 $alldata_count = Transaction::orderBy('status')
                                            ->where('status', 'Saved')
                                            ->get();
 
                 //total row Count
                 $rows = count($alldata_count);

                 //number of rows per page
                 $page_rows = intval($pagenumber);

                 //divide total rows
                 $last = ceil($rows/$page_rows);

                 // This makes sure $last cannot be less than 1
                 if($last < 1){
                     $last = 1;
                 }


                if(isset($request['pn'])){

                    $pn = intval($request['pn']);

                    $pagenum = session(['pn' => $pn]);
                    $pagenum = $pn;

                  } else if ($request->session()->exists('pn') == 1) {

                    $pagenum = $request->session()->get('pn');
                     
                  } else {

                    $pagenum = session(['pn' => 1]);

                  }



                  //check if its on the last page
                  if ($pagenum < 1) {

                      $pagenum = 1; 

                  } else if ($pagenum > $last) { 

                      $pagenum = $last; 

                  }



                 $offset = ($pagenum - 1) * $page_rows;
                 $limit = $page_rows;


             $alldata = Transaction::limit($limit)
                          ->offset($offset)
                          ->orderBy('status')
                          ->where('status', 'Saved')
                          ->get();


             $textline1 = $rows;
             $currentpagenumber = number_format($pagenum);
             $currentpage = number_format($pagenum);
             $totalpagenumber = number_format($last);


             $previews = '';
             $next = '';
             $leftsidenumbers = '';
             $rightsidenumbers = '';

             if($last != 1){

                      if ($pagenum > 1) {

                       $previews = $pagenum - 1;

                       //previews
                       $previews = $previews;

                               for($i = $pagenum-4; $i < $pagenum; $i++){


                                         if($i > 0){
                                              //left side numbers
                                               $leftsidenumbers .= $i.',';
                                         }

                                 }

                       }


                      //current page
                       $currentpage = $pagenum;

                       for($i = $pagenum+1; $i <= $last; $i++){

                              //right side number
                              $rightsidenumbers .= $i.',';

                         if($i >= $pagenum+4){

                           break;

                         }

                       }

                       if ($pagenum != $last) {

                           $next = $pagenum + 1;
                           //next
                           $next = $next;

                       }


                }



               $textline1 = $rows;
               $currentpagenumber = number_format($pagenum);
               $currentpage = number_format($pagenum);
               $totalpagenumber = number_format($last);


               $numberofresults = number_format($textline1);



        } else {

                $alldata_count = Transaction::where('status', 'LIKE', '%'.$textSearch.'%')
                                      ->where('status', 'Saved')
                                      ->orWhere('transaction_code', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Saved')
                                      ->orWhere('issued_by', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Saved')
                                      ->orWhere('customer_name_number', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Saved')
                                      ->orWhere('number_of_items', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Saved')
                                      ->orWhere('date', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Saved')
                                      ->get();


                 //total row Count
                 $rows = count($alldata_count);

                 //number of rows per page
                 $page_rows = intval($pagenumber);

                 //divide total rows
                 $last = ceil($rows/$page_rows);

                 // This makes sure $last cannot be less than 1
                 if($last < 1){
                     $last = 1;
                 }


                if(isset($request['pn'])){

                    $pn = intval($request['pn']);

                    $pagenum = session(['pn' => $pn]);
                    $pagenum = $pn;

                  } else if ($request->session()->exists('pn') == 1) {

                    $pagenum = $request->session()->get('pn');
                     
                  } else {

                    $pagenum = session(['pn' => 1]);

                  }



                  //check if its on the last page
                  if ($pagenum < 1) {

                      $pagenum = 1; 

                  } else if ($pagenum > $last) { 

                      $pagenum = $last; 

                  }



                 $offset = ($pagenum - 1) * $page_rows;
                 $limit = $page_rows;


                $alldata = Transaction::where('status', 'LIKE', '%'.$textSearch.'%')
                                      ->where('status', 'Saved')
                                      ->orWhere('transaction_code', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Saved')
                                      ->orWhere('issued_by', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Saved')
                                      ->orWhere('customer_name_number', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Saved')
                                      ->orWhere('number_of_items', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Saved')
                                      ->orWhere('date', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Saved')
                                      ->limit($limit)->offset($offset)->get();


                 $previews = '';
                 $next = '';
                 $leftsidenumbers = '';
                 $rightsidenumbers = '';

                 $paginationCtrls = '';



                      if($last != 1){

                           if ($pagenum > 1) {

                           $previews = $pagenum - 1;

                           //previews
                           $previews = $previews;

                                   for($i = $pagenum-4; $i < $pagenum; $i++){


                                             if($i > 0){

                                                  //left side numbers
                                                   $leftsidenumbers .= $i.',';

                                             }

                                     }

                           }



                          //current page
                          $currentpage = $pagenum;

                           for($i = $pagenum+1; $i <= $last; $i++){

                                        //right side number
                                     $rightsidenumbers .= $i.',';

                             if($i >= $pagenum+4){

                               break;

                             }
                           }

                             if ($pagenum != $last) {

                                 $next = $pagenum + 1;
                                 //next
                                 $next = $next;

                             }
                      }




                 $textline1 = $rows;
                 $currentpagenumber = number_format($pagenum);
                 $currentpage = number_format($pagenum);
                 $totalpagenumber = number_format($last);

                 $numberofresults = number_format($textline1);


        }



        $allcount = Transaction::where('status', 'Saved')->get();

        return $data = [

                'alldata' => $alldata,
                'heading' => [
                        'currentpagenumber' => $currentpagenumber,
                        'totalpagenumber' => $totalpagenumber,
                        'numberofresults' => $numberofresults,

                    ],
                'footer' => [

                        'previews' => $previews,
                        'leftsidenumbers' => explode(',', $leftsidenumbers),
                        'currentpage' => $currentpage,
                        'rightsidenumbers' => explode(',', $rightsidenumbers),
                        'next' => $next,
                        'numberofresults' => $numberofresults,
                        'allcount' => count($allcount),
                ],

        ];



    }


























































    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getAllTransactions(Request $request)
    {   

        $textSearch = $request->textSearch;

        // pagenumberview
        $pagenumber = $request->tablenum;


        $all = Transaction::where('status', 'Saved')->get();

        foreach ($all as $k) {

            $getAllOrders = Order::where('transaction_code', $k['transaction_code'])->get();
            $getSum = Order::where('transaction_code', $k['transaction_code'])->sum('seller_total');

            $update = Transaction::where('transaction_code', $k['transaction_code'])->update([

                                        'number_of_items' => count($getAllOrders),
                                        'total_amount' => $getSum,

                                  ]);

        }


        if ( $textSearch == '') {

                 $alldata_count = Transaction::orderBy('status')
                                            ->where('status', 'Locked')
                                            ->get();
 
                 //total row Count
                 $rows = count($alldata_count);

                 //number of rows per page
                 $page_rows = intval($pagenumber);

                 //divide total rows
                 $last = ceil($rows/$page_rows);

                 // This makes sure $last cannot be less than 1
                 if($last < 1){
                     $last = 1;
                 }


                if(isset($request['pn'])){

                    $pn = intval($request['pn']);

                    $pagenum = session(['pn' => $pn]);
                    $pagenum = $pn;

                  } else if ($request->session()->exists('pn') == 1) {

                    $pagenum = $request->session()->get('pn');
                     
                  } else {

                    $pagenum = session(['pn' => 1]);

                  }



                  //check if its on the last page
                  if ($pagenum < 1) {

                      $pagenum = 1; 

                  } else if ($pagenum > $last) { 

                      $pagenum = $last; 

                  }



                 $offset = ($pagenum - 1) * $page_rows;
                 $limit = $page_rows;


             $alldata = Transaction::limit($limit)
                          ->offset($offset)
                          ->orderBy('status')
                          ->where('status', 'Locked')
                          ->get();


             $textline1 = $rows;
             $currentpagenumber = number_format($pagenum);
             $currentpage = number_format($pagenum);
             $totalpagenumber = number_format($last);


             $previews = '';
             $next = '';
             $leftsidenumbers = '';
             $rightsidenumbers = '';

             if($last != 1){

                      if ($pagenum > 1) {

                       $previews = $pagenum - 1;

                       //previews
                       $previews = $previews;

                               for($i = $pagenum-4; $i < $pagenum; $i++){


                                         if($i > 0){
                                              //left side numbers
                                               $leftsidenumbers .= $i.',';
                                         }

                                 }

                       }


                      //current page
                       $currentpage = $pagenum;

                       for($i = $pagenum+1; $i <= $last; $i++){

                              //right side number
                              $rightsidenumbers .= $i.',';

                         if($i >= $pagenum+4){

                           break;

                         }

                       }

                       if ($pagenum != $last) {

                           $next = $pagenum + 1;
                           //next
                           $next = $next;

                       }


                }



               $textline1 = $rows;
               $currentpagenumber = number_format($pagenum);
               $currentpage = number_format($pagenum);
               $totalpagenumber = number_format($last);


               $numberofresults = number_format($textline1);



        } else {

                $alldata_count = Transaction::where('status', 'LIKE', '%'.$textSearch.'%')
                                      ->where('status', 'Locked')
                                      ->orWhere('transaction_code', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Locked')
                                      ->orWhere('issued_by', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Locked')
                                      ->orWhere('customer_name_number', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Locked')
                                      ->orWhere('number_of_items', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Locked')
                                      ->orWhere('date', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Locked')
                                      ->get();


                 //total row Count
                 $rows = count($alldata_count);

                 //number of rows per page
                 $page_rows = intval($pagenumber);

                 //divide total rows
                 $last = ceil($rows/$page_rows);

                 // This makes sure $last cannot be less than 1
                 if($last < 1){
                     $last = 1;
                 }


                if(isset($request['pn'])){

                    $pn = intval($request['pn']);

                    $pagenum = session(['pn' => $pn]);
                    $pagenum = $pn;

                  } else if ($request->session()->exists('pn') == 1) {

                    $pagenum = $request->session()->get('pn');
                     
                  } else {

                    $pagenum = session(['pn' => 1]);

                  }



                  //check if its on the last page
                  if ($pagenum < 1) {

                      $pagenum = 1; 

                  } else if ($pagenum > $last) { 

                      $pagenum = $last; 

                  }



                 $offset = ($pagenum - 1) * $page_rows;
                 $limit = $page_rows;


                $alldata = Transaction::where('status', 'LIKE', '%'.$textSearch.'%')
                                      ->where('status', 'Locked')
                                      ->orWhere('transaction_code', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Locked')
                                      ->orWhere('issued_by', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Locked')
                                      ->orWhere('customer_name_number', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Locked')
                                      ->orWhere('number_of_items', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Locked')
                                      ->orWhere('date', 'LIKE', '%'.$textSearch.'%' )
                                      ->where('status', 'Locked')
                                      ->limit($limit)->offset($offset)->get();


                 $previews = '';
                 $next = '';
                 $leftsidenumbers = '';
                 $rightsidenumbers = '';

                 $paginationCtrls = '';



                      if($last != 1){

                           if ($pagenum > 1) {

                           $previews = $pagenum - 1;

                           //previews
                           $previews = $previews;

                                   for($i = $pagenum-4; $i < $pagenum; $i++){


                                             if($i > 0){

                                                  //left side numbers
                                                   $leftsidenumbers .= $i.',';

                                             }

                                     }

                           }



                          //current page
                          $currentpage = $pagenum;

                           for($i = $pagenum+1; $i <= $last; $i++){

                                        //right side number
                                     $rightsidenumbers .= $i.',';

                             if($i >= $pagenum+4){

                               break;

                             }
                           }

                             if ($pagenum != $last) {

                                 $next = $pagenum + 1;
                                 //next
                                 $next = $next;

                             }
                      }




                 $textline1 = $rows;
                 $currentpagenumber = number_format($pagenum);
                 $currentpage = number_format($pagenum);
                 $totalpagenumber = number_format($last);

                 $numberofresults = number_format($textline1);


        }



        $allcount = Transaction::where('status', 'Locked')->get();

        return $data = [

                'alldata' => $alldata,
                'heading' => [
                        'currentpagenumber' => $currentpagenumber,
                        'totalpagenumber' => $totalpagenumber,
                        'numberofresults' => $numberofresults,

                    ],
                'footer' => [

                        'previews' => $previews,
                        'leftsidenumbers' => explode(',', $leftsidenumbers),
                        'currentpage' => $currentpage,
                        'rightsidenumbers' => explode(',', $rightsidenumbers),
                        'next' => $next,
                        'numberofresults' => $numberofresults,
                        'allcount' => count($allcount),
                ],

        ];



    }












































    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel_transaction(Request $request)
    {   

        $get = Order::where('transaction_code', $request->transaction_code)->get();


        foreach ($get as $k) {

              $getItem = Item::where('item_code', $k['item_code'])->first();

              $stock = $getItem['stock'];
              $storage = $getItem['storage'];
              $quantity = $k['quantity'];

                     
              $update = Item::where('item_code', $k['item_code'])->update([

                                'stock' => $getItem['stock'] + $quantity,

                              ]);

                                
              $newItem = Item::where('item_code', $k['item_code'])->first();

              if ($newItem['stock'] == 0) {
                
                  $newItem = Item::where('item_code', $k['item_code'])->update([

                                          'status' => 'Out of Stock', 

                                    ]);


              } else {

                  $newItem = Item::where('item_code', $k['item_code'])->update([

                                          'status' => 'Available', 

                                    ]);

              }


            $delete = Order::where('id', $k['id'])->delete();

        }
                               
                
        $delete = Transaction::where('transaction_code', $request->transaction_code)->delete();


    }

       



    














    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCustomer(Request $request)
    {   

            $this->validate($request,[
                'name' => 'required',
                'address' => 'required',
                'transaction_code' => 'required',
            ]); 

        $update = Transaction::where('transaction_code', $request->transaction_code)->update([

                                    'customer_name_number' => $request->name,
                                    'address' => $request->address,

                              ]);

    }









    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTotalCost(Request $request)
    {   

      $get = Order::where('transaction_code', $request->transaction_code)->sum('seller_total');

      return $get;

    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTotalCostNumber(Request $request)
    {   

      $get = Order::where('transaction_code', $request->transaction_code)->sum('seller_total');

      return $get;

    }

    











    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paymentProcess(Request $request)
    {   

            $this->validate($request,[
                'payment' => 'required',
                'discount' => 'required',
                'transaction_code' => 'required',
            ]);

      $totalCost = Order::where('transaction_code', $request->transaction_code)->sum('seller_total');
      $totalPay = $request->payment;
      $discount = $request->discount;
      $change = 0;


      $dis = $discount * $totalCost;

      $totalCost = $totalCost - $dis;

      if ($totalCost > $totalPay) {
         return 'bad';
      } else if ($totalCost == $totalPay || $totalCost < $totalPay) {
  
         $change = $totalPay - $totalCost;

         $AllOrders = Order::where('transaction_code', $request->transaction_code)->get();

         $orderCount = count($AllOrders);

         $disPerOrder = $dis / $orderCount;



         foreach ($AllOrders as $k) {

            $update = Order::where('id', $k['id'])->update([

                                    'sellers_price' => $k['sellers_price'] - $disPerOrder,
                                    'seller_total' => ($k['sellers_price'] - $disPerOrder) * $k['quantity'],

                            ]);

         }



         $update = Transaction::where('transaction_code', $request->transaction_code)->update([
 
                                        'status' => 'Locked',
                                        'payment_status' => 'Paid',
                                        'number_of_items' => $orderCount,
                                        'total_amount' => $totalCost,
                                        'total_payment' => $totalPay,
                                        'total_change' => $change,
                                        'discount' => $dis,

                                ]);


         $update = Order::where('transaction_code', $request->transaction_code)->update([

                                'status' => 'Locked',

                          ]);

         return 'good';
      }
      
    }







    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getdataforreceipt(Request $request)
    {   

        $this->validate($request,[
            'transaction_code' => 'required',
        ]);

      $transaction = Transaction::where('transaction_code', $request->transaction_code)->first();
      $orders = Order::where('transaction_code', $request->transaction_code)->get();

      return [

                  'transactionData' => $transaction,
                  'ordersData' => $orders,

              ];

    }





















    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkTransactionCodeStatus(Request $request)
    {   

       $get = Transaction::where('transaction_code', $request->transaction_code)->first();

       return $get['status'];

    }




























    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSalesReport(Request $request)
    {   

        $this->validate($request,[
                'date_from' => 'required',
                'date_to' => 'required',
        ]); 



        $from = $request->date_from;
        $to = $request->date_to;
        $quantity = $request->quantity;
        $item_name = $request->item_name;
        $sellers_price = $request->sellers_price;
        $seller_total = $request->seller_total;
        $date = $request->date;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if (  $quantity == '' &&
              $item_name == '' &&
              $sellers_price == '' &&
              $seller_total == '' &&
              $date == ''
            ) {

                 $alldata_count = Order::whereBetween('date',[$from , $to])
                                             ->where('status', 'Locked')
                                             ->orderBy('created_at')->get();
 
                 //total row Count
                 $rows = count($alldata_count);

                 //number of rows per page
                 $page_rows = intval($pagenumber);

                 //divide total rows
                 $last = ceil($rows/$page_rows);

                 // This makes sure $last cannot be less than 1
                 if($last < 1){
                     $last = 1;
                 }


                if(isset($request['pn'])){

                    $pn = intval($request['pn']);

                    $pagenum = session(['pn' => $pn]);
                    $pagenum = $pn;

                  } else if ($request->session()->exists('pn') == 1) {

                    $pagenum = $request->session()->get('pn');
                     
                  } else {

                    $pagenum = session(['pn' => 1]);

                  }



                  //check if its on the last page
                  if ($pagenum < 1) {

                      $pagenum = 1; 

                  } else if ($pagenum > $last) { 

                      $pagenum = $last; 

                  }



                 $offset = ($pagenum - 1) * $page_rows;
                 $limit = $page_rows;


             $alldata = Order::whereBetween('date',[$from , $to])
                              ->where('status', 'Locked')
                              ->limit($limit)
                              ->offset($offset)
                              ->orderBy('created_at')
                              ->get();


             $textline1 = $rows;
             $currentpagenumber = number_format($pagenum);
             $currentpage = number_format($pagenum);
             $totalpagenumber = number_format($last);


             $previews = '';
             $next = '';
             $leftsidenumbers = '';
             $rightsidenumbers = '';

             if($last != 1){

                      if ($pagenum > 1) {

                       $previews = $pagenum - 1;

                       //previews
                       $previews = $previews;

                               for($i = $pagenum-4; $i < $pagenum; $i++){


                                         if($i > 0){
                                              //left side numbers
                                               $leftsidenumbers .= $i.',';
                                         }

                                 }

                       }


                      //current page
                       $currentpage = $pagenum;

                       for($i = $pagenum+1; $i <= $last; $i++){

                              //right side number
                              $rightsidenumbers .= $i.',';

                         if($i >= $pagenum+4){

                           break;

                         }

                       }

                       if ($pagenum != $last) {

                           $next = $pagenum + 1;
                           //next
                           $next = $next;

                       }


                }



               $textline1 = $rows;
               $currentpagenumber = number_format($pagenum);
               $currentpage = number_format($pagenum);
               $totalpagenumber = number_format($last);


               $numberofresults = number_format($textline1);



        } else {

                $alldata_count = Order::where('quantity', 'LIKE', '%'.$quantity.'%')
                                      ->whereBetween('date',[$from , $to])
                                      ->where('status', 'Locked')
                                      ->where('item_name', 'LIKE', '%'.$item_name.'%' )
                                      ->whereBetween('date',[$from , $to])
                                      ->where('status', 'Locked')
                                      ->where('sellers_price', 'LIKE', '%'.$sellers_price.'%' )
                                      ->whereBetween('date',[$from , $to])
                                      ->where('status', 'Locked')
                                      ->where('seller_total', 'LIKE', '%'.$seller_total.'%' )
                                      ->whereBetween('date',[$from , $to])
                                      ->where('status', 'Locked')
                                      ->where('date', 'LIKE', '%'.$date.'%' )
                                      ->whereBetween('date',[$from , $to])
                                      ->where('status', 'Locked')
                                      ->get();


                 //total row Count
                 $rows = count($alldata_count);

                 //number of rows per page
                 $page_rows = intval($pagenumber);

                 //divide total rows
                 $last = ceil($rows/$page_rows);

                 // This makes sure $last cannot be less than 1
                 if($last < 1){
                     $last = 1;
                 }


                if(isset($request['pn'])){

                    $pn = intval($request['pn']);

                    $pagenum = session(['pn' => $pn]);
                    $pagenum = $pn;

                  } else if ($request->session()->exists('pn') == 1) {

                    $pagenum = $request->session()->get('pn');
                     
                  } else {

                    $pagenum = session(['pn' => 1]);

                  }



                  //check if its on the last page
                  if ($pagenum < 1) {

                      $pagenum = 1; 

                  } else if ($pagenum > $last) { 

                      $pagenum = $last; 

                  }



                 $offset = ($pagenum - 1) * $page_rows;
                 $limit = $page_rows;


                $alldata = Order::where('quantity', 'LIKE', '%'.$quantity.'%')
                                  ->whereBetween('date',[$from , $to])
                                  ->where('status', 'Locked')
                                  ->where('item_name', 'LIKE', '%'.$item_name.'%' )
                                  ->whereBetween('date',[$from , $to])
                                  ->where('status', 'Locked')
                                  ->where('sellers_price', 'LIKE', '%'.$sellers_price.'%' )
                                  ->whereBetween('date',[$from , $to])
                                  ->where('status', 'Locked')
                                  ->where('seller_total', 'LIKE', '%'.$seller_total.'%' )
                                  ->whereBetween('date',[$from , $to])
                                  ->where('status', 'Locked')
                                  ->where('date', 'LIKE', '%'.$date.'%' )
                                  ->whereBetween('date',[$from , $to])
                                  ->where('status', 'Locked')
                                  ->limit($limit)->offset($offset)->get();


                 $previews = '';
                 $next = '';
                 $leftsidenumbers = '';
                 $rightsidenumbers = '';

                 $paginationCtrls = '';



                      if($last != 1){

                           if ($pagenum > 1) {

                           $previews = $pagenum - 1;

                           //previews
                           $previews = $previews;

                                   for($i = $pagenum-4; $i < $pagenum; $i++){


                                             if($i > 0){

                                                  //left side numbers
                                                   $leftsidenumbers .= $i.',';

                                             }

                                     }

                           }



                          //current page
                          $currentpage = $pagenum;

                           for($i = $pagenum+1; $i <= $last; $i++){

                                        //right side number
                                     $rightsidenumbers .= $i.',';

                             if($i >= $pagenum+4){

                               break;

                             }
                           }

                             if ($pagenum != $last) {

                                 $next = $pagenum + 1;
                                 //next
                                 $next = $next;

                             }
                      }




                 $textline1 = $rows;
                 $currentpagenumber = number_format($pagenum);
                 $currentpage = number_format($pagenum);
                 $totalpagenumber = number_format($last);

                 $numberofresults = number_format($textline1);


        }



        $allcount = Order::whereBetween('date',[$from , $to])
                         ->where('status', 'Locked')
                         ->get();

        $sales = 0;
        $profit = 0;
        foreach ($alldata as $k) {
           $sales = $sales + $k['seller_total'];
           $profit = $profit + $k['profit'];
        }

        return $data = [

                'alldata' => $alldata,
                'sales' => number_format($sales,2),
                'profit' => number_format($profit,2),
                'issued_by' => auth()->user()->firstname.' '.auth()->user()->middlename.' '.auth()->user()->lastname,
                'heading' => [
                        'currentpagenumber' => $currentpagenumber,
                        'totalpagenumber' => $totalpagenumber,
                        'numberofresults' => $numberofresults,

                    ],
                'footer' => [

                        'previews' => $previews,
                        'leftsidenumbers' => explode(',', $leftsidenumbers),
                        'currentpage' => $currentpage,
                        'rightsidenumbers' => explode(',', $rightsidenumbers),
                        'next' => $next,
                        'numberofresults' => $numberofresults,
                        'allcount' => count($allcount),
                ],

        ];



    }































































    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getPayoutReport(Request $request)
    {   

        $this->validate($request,[
                'supplier' => 'required',
                'date_from' => 'required',
                'date_to' => 'required',
        ]); 


            $from = $request->date_from;
            $to = $request->date_to;


        if ($request->supplier == "0") {
            
            $getSuppliers = User::where('usertype', 'Supplier')
                                ->where('status', 'Active')
                                ->get();

            
            $alldata = [];
            $total_sales = 0;
            $x = 0;

            foreach ($getSuppliers as $k) {
              
                $getItems = Item::where('supplier_id', $k->id)->get();
                $getSupplier = Item::where('supplier_id', $k->id)->first();

                $sum_total = 0;

                foreach ($getItems as $k) {

                    $item_id = $k['id'];

                    $sum = Order::where('item_id', $item_id)
                                      ->whereBetween('date',[$from , $to])
                                      ->where('status', 'Locked')
                                      ->sum('suppliers_price');
                                            
                    $sum_total = $sum_total + $sum;

                }


                 $alldata[$x] = [

                                  'supplier' => $getSupplier['company'],
                                  'from' => $from,
                                  'to' => $to,
                                  'sum' => number_format($sum_total,2),

                                ]; 
                 $x++;

                 $total_sales = $total_sales + $sum_total;

            }




            return [

                        'supplier' => 'All',
                        'alldata' => $alldata,
                        'total_sales' => number_format($total_sales,2),
                        'issued_by' => auth()->user()->firstname.' '.auth()->user()->middlename.' '.auth()->user()->lastname,

                    ];



        } else {

            $getItems = Item::where('supplier_id', $request->supplier)->get();
            $getSupplier = Item::where('supplier_id', $request->supplier)->first();


            $alldata = [];
            $x = 0;
            $total_sales = 0;
            $total_profit = 0;

            foreach ($getItems as $k) {

                $item_id = $k['id'];

                $sum = Order::where('item_id', $item_id)
                                  ->whereBetween('date',[$from , $to])
                                  ->where('status', 'Locked')
                                  ->sum('suppliers_price');

                if ($sum != 0) {
                    
                    $getOrders = Order::where('item_id', $item_id)
                                      ->whereBetween('date',[$from , $to])
                                      ->where('status', 'Locked')
                                      ->get();

                    $alldata[$x] = [

                                      'title' => $k['item_name'],
                                      'sum' => $sum,
                                      'orders' => $getOrders,

                                    ]; 
                    $x++;

                    $total_sales = $total_sales + $sum;

                }
                

            }

            return [

                        'supplier' => $getSupplier['company'],
                        'alldata' => $alldata,
                        'total_sales' => number_format($total_sales,2),
                        'issued_by' => auth()->user()->firstname.' '.auth()->user()->middlename.' '.auth()->user()->lastname,

                    ];


        }

    }





































}
 










function userlogs($activity,$content){

        date_default_timezone_set('Asia/Manila');
        setlocale(LC_MONETARY, 'en_PH');

            if (isset(auth()->user()->id)) {
                    $user_id = auth()->user()->id;
                    $usertype = auth()->user()->usertype;
                    $user = auth()->user()->firstname.' '.auth()->user()->middlename.' '.auth()->user()->lastname; 

            } else {

                  $user_id = '';
                  $usertype = '';   
                  $content = ''; 

            }

            $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

            $userlog = new Userlog();
            $userlog->ip = $ip;
            $userlog->user_id = $user_id;
            $userlog->usertype = $usertype;
            $userlog->user = $user;
            $userlog->activity = $activity;
            $userlog->content = $content;
            $userlog->date = date("Y-m-d");
            $userlog->save(); 


   }