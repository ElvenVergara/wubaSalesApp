<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Item;
use App\Models\Unit;
use App\Models\ItemCategory;
use App\Models\PO;
use App\Models\Userlog;
use Illuminate\Support\Facades\Hash;

class ItemsController extends Controller
{
    



    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getItems(Request $request)
    {   

        $status = $request->status;
        $item_code = $request->item_code;
        $company = $request->company;
        $category = $request->category;
        $item_name = $request->item_name;
        $unit = $request->unit;
        $suppliers_price = $request->suppliers_price;
        $sellers_price = $request->sellers_price;
        $vat = $request->vat;
        $discountable = $request->discountable;
        $discount = $request->discount;
        $stock = $request->stock;
        $storage = $request->storage;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ( $status == '' &&
                $item_code == '' &&
                $company == '' &&
                $category == '' &&
                $item_name == '' &&
                $unit == '' &&
                $suppliers_price == '' &&
                $sellers_price == '' &&
                $vat == '' &&
                $discountable == '' &&
                $discount == '' &&
                $stock == '' &&
                $storage == ''
            ) {

                 $alldata_count = Item::orderBy('status')->get();
 
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


             $alldata = Item::limit($limit)
                          ->offset($offset)
                          ->orderBy('status')
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

                $alldata_count = Item::where('status', 'LIKE', '%'.$status.'%')
                                      ->where('item_code', 'LIKE', '%'.$item_code.'%' )
                                      ->where('company', 'LIKE', '%'.$company.'%' )
                                      ->where('category', 'LIKE', '%'.$category.'%' )
                                      ->where('item_name', 'LIKE', '%'.$item_name.'%' )
                                      ->where('unit', 'LIKE', '%'.$unit.'%' )
                                      ->where('suppliers_price', 'LIKE', '%'.$suppliers_price.'%' )
                                      ->where('sellers_price', 'LIKE', '%'.$sellers_price.'%' )
                                      ->where('vat', 'LIKE', '%'.$vat.'%' )
                                      ->where('discountable', 'LIKE', '%'.$discountable.'%' )
                                      ->where('discount', 'LIKE', '%'.$discount.'%' )
                                      ->where('stock', 'LIKE', '%'.$stock.'%' )
                                      ->where('storage', 'LIKE', '%'.$storage.'%' )
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


                $alldata = Item::where('status', 'LIKE', '%'.$status.'%')
                                  ->where('item_code', 'LIKE', '%'.$item_code.'%' )
                                  ->where('company', 'LIKE', '%'.$company.'%' )
                                  ->where('category', 'LIKE', '%'.$category.'%' )
                                  ->where('item_name', 'LIKE', '%'.$item_name.'%' )
                                  ->where('unit', 'LIKE', '%'.$unit.'%' )
                                  ->where('suppliers_price', 'LIKE', '%'.$suppliers_price.'%' )
                                  ->where('sellers_price', 'LIKE', '%'.$sellers_price.'%' )
                                  ->where('vat', 'LIKE', '%'.$vat.'%' )
                                  ->where('discountable', 'LIKE', '%'.$discountable.'%' )
                                  ->where('discount', 'LIKE', '%'.$discount.'%' )
                                  ->where('stock', 'LIKE', '%'.$stock.'%' )
                                  ->where('storage', 'LIKE', '%'.$storage.'%' )
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



        $allcount = Item::all();

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
    public function getSelectSuppliers(Request $request)
    {   

        $search = $request->search;
      
        // pagenumberview
        $pagenumber = $request->tablenum;



        if ( $search == '') {

                 $alldata_count = User::orderBy('status')
                                      ->where('usertype', 'Supplier')
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


             $alldata = User::limit($limit)
                          ->offset($offset)
                          ->orderBy('status')
                          ->where('usertype', 'Supplier')
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

                $alldata_count = User::where('status', 'LIKE', '%'.$search.'%')
                                      ->where('usertype', 'Supplier')
                                      ->orWhere('firstname', 'LIKE', '%'.$search.'%' )
                                      ->where('usertype', 'Supplier')
                                      ->orWhere('lastname', 'LIKE', '%'.$search.'%' )
                                      ->where('usertype', 'Supplier')
                                      ->orWhere('middlename', 'LIKE', '%'.$search.'%' )
                                      ->where('usertype', 'Supplier')
                                      ->orWhere('gender', 'LIKE', '%'.$search.'%' )
                                      ->where('usertype', 'Supplier')
                                      ->orWhere('contact', 'LIKE', '%'.$search.'%' )
                                      ->where('usertype', 'Supplier')
                                      ->orWhere('address', 'LIKE', '%'.$search.'%' )
                                      ->where('usertype', 'Supplier')
                                      ->orWhere('company', 'LIKE', '%'.$search.'%' )
                                      ->where('usertype', 'Supplier')
                                      ->orWhere('email', 'LIKE', '%'.$search.'%' )
                                      ->where('usertype', 'Supplier')
                                      ->orWhere('username', 'LIKE', '%'.$search.'%' )
                                      ->where('usertype', 'Supplier')
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


                $alldata = User::where('status', 'LIKE', '%'.$search.'%')
                                    ->where('usertype', 'Supplier')
                                    ->orWhere('firstname', 'LIKE', '%'.$search.'%' )
                                    ->where('usertype', 'Supplier')
                                    ->orWhere('lastname', 'LIKE', '%'.$search.'%' )
                                    ->where('usertype', 'Supplier')
                                    ->orWhere('middlename', 'LIKE', '%'.$search.'%' )
                                    ->where('usertype', 'Supplier')
                                    ->orWhere('gender', 'LIKE', '%'.$search.'%' )
                                    ->where('usertype', 'Supplier')
                                    ->orWhere('contact', 'LIKE', '%'.$search.'%' )
                                    ->where('usertype', 'Supplier')
                                    ->orWhere('address', 'LIKE', '%'.$search.'%' )
                                    ->where('usertype', 'Supplier')
                                    ->orWhere('company', 'LIKE', '%'.$search.'%' )
                                    ->where('usertype', 'Supplier')
                                    ->orWhere('email', 'LIKE', '%'.$search.'%' )
                                    ->where('usertype', 'Supplier')
                                    ->orWhere('username', 'LIKE', '%'.$search.'%' )
                                    ->where('usertype', 'Supplier')
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



        $allcount = User::where('usertype', 'Supplier')->get();

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
    public function getSelectItem(Request $request)
    {   

        $search = $request->search;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ($search == '') {

                 $alldata_count = Item::orderBy('status')->get();
 
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


             $alldata = Item::limit($limit)
                          ->offset($offset)
                          ->orderBy('status')
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

                $alldata_count = Item::orWhere('status', 'LIKE', '%'.$search.'%')
                                      ->orWhere('item_code', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('company', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('category', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('item_name', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('unit', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('suppliers_price', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('sellers_price', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('vat', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('discountable', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('discount', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('stock', 'LIKE', '%'.$search.'%' )
                                      ->orWhere('storage', 'LIKE', '%'.$search.'%' )
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


                $alldata = Item::orWhere('status', 'LIKE', '%'.$search.'%')
                                  ->orWhere('item_code', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('company', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('category', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('item_name', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('unit', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('suppliers_price', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('sellers_price', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('vat', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('discountable', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('discount', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('stock', 'LIKE', '%'.$search.'%' )
                                  ->orWhere('storage', 'LIKE', '%'.$search.'%' )
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



        $allcount = Item::all();

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
    public function getSelectItemStockIn(Request $request)
    {   

        $search = $request->search;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ($search == '') {

                 $alldata_count = Item::where('storage','>', 0)
                                      ->orderBy('status')->get();
 
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


             $alldata = Item::where('storage','>', 0)
                          ->limit($limit)
                          ->offset($offset)
                          ->orderBy('status')
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

                $alldata_count = Item::orWhere('status', 'LIKE', '%'.$search.'%')
                                      ->where('storage','>', 0)
                                      ->orWhere('item_code', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('company', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('category', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('item_name', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('unit', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('suppliers_price', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('sellers_price', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('vat', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('discountable', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('discount', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('stock', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
                                      ->orWhere('storage', 'LIKE', '%'.$search.'%' )
                                      ->where('storage','>', 0)
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


                $alldata = Item::orWhere('status', 'LIKE', '%'.$search.'%')
                                  ->where('storage','>', 0)
                                  ->orWhere('item_code', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('company', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('category', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('item_name', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('unit', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('suppliers_price', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('sellers_price', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('vat', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('discountable', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('discount', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('stock', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
                                  ->orWhere('storage', 'LIKE', '%'.$search.'%' )
                                  ->where('storage','>', 0)
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



        $allcount = Item::where('storage','>', 0)->get();

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
    public function getSelectItemPOS(Request $request)
    {   

        $search = $request->search;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ($search == '') {

                 $alldata_count = Item::where('stock','>', 0)
                                      ->orderBy('status')->get();
 
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


             $alldata = Item::where('stock','>', 0)
                          ->limit($limit)
                          ->offset($offset)
                          ->orderBy('status')
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

                $alldata_count = Item::orWhere('status', 'LIKE', '%'.$search.'%')
                                      ->where('stock','>', 0)
                                      ->orWhere('item_code', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('company', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('category', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('item_name', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('unit', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('suppliers_price', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('sellers_price', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('vat', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('discountable', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('discount', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('stock', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
                                      ->orWhere('stock', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','>', 0)
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


                $alldata = Item::orWhere('status', 'LIKE', '%'.$search.'%')
                                  ->where('stock','>', 0)
                                  ->orWhere('item_code', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('company', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('category', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('item_name', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('unit', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('suppliers_price', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('sellers_price', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('vat', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('discountable', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('discount', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('stock', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
                                  ->orWhere('stock', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','>', 0)
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



        $allcount = Item::where('stock','>', 0)->get();

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
    public function getSelectItemStockOut(Request $request)
    {   

        $search = $request->search;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ($search == '') {

                 $alldata_count = Item::where('stock','<>', 0)
                                      ->orderBy('status')->get();
 
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


             $alldata = Item::where('stock','<>', 0)
                          ->limit($limit)
                          ->offset($offset)
                          ->orderBy('status')
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

                $alldata_count = Item::orWhere('status', 'LIKE', '%'.$search.'%')
                                      ->where('stock','<>', 0)
                                      ->orWhere('item_code', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('company', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('category', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('item_name', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('unit', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('suppliers_price', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('sellers_price', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('vat', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('discountable', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('discount', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('stock', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
                                      ->orWhere('storage', 'LIKE', '%'.$search.'%' )
                                      ->where('stock','<>', 0)
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


                $alldata = Item::orWhere('status', 'LIKE', '%'.$search.'%')
                                  ->where('stock','<>', 0)
                                  ->orWhere('item_code', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('company', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('category', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('item_name', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('unit', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('suppliers_price', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('sellers_price', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('vat', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('discountable', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('discount', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('stock', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
                                  ->orWhere('storage', 'LIKE', '%'.$search.'%' )
                                  ->where('stock','<>', 0)
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



        $allcount = Item::where('stock','<>', 0)->get();

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUnitSelect(Request $request)
    {
        return $get = Unit::all();
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getItemCategory(Request $request)
    {
        return $get = ItemCategory::all();
    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSupplier(Request $request)
    {
        $get = User::where('id', $request->data_id)->first();
        return $get;

    }








    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSuppliersItem(Request $request)
    {
        return $get = Item::where('supplier_id', $request->data_id)
                          ->where('storage', 0)->get();
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSuppliersPrice(Request $request)
    {
        $get = Item::where('id', $request->id)->first();
        return $get['suppliers_price'];

    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSuppliersSelect(Request $request)
    {
        return $get = User::where('usertype', 'Supplier')
                          ->where('status', 'Active')
                          ->orderBy('company')
                          ->get();
    }







    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_category(Request $request)
    {
            
            $this->validate($request,[
                'category_name' => 'required|unique:item_categories,category_name',
            ]);  

            $newdata = New ItemCategory;
            $newdata->category_name = $request->category_name;
            $newdata->save();

            userlogs('Added Item Category', $request->category_name);

    }




















    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPO(Request $request)
    {
            
            $this->validate($request,[
                'transaction_code' => 'required',
                'supplier_id' => 'required',
                'item_id' => 'required',
                'quantity' => 'required',
                'suppliers_price' => 'required',
                'payment_terms' => 'required',
            ]);  

            $getSupplier = User::where('id', $request->supplier_id)->first();
            $getItem = Item::where('id', $request->item_id)->first();

            if ($getItem['suppliers_price'] != $request->suppliers_price) {
              
                $update = Item::where('id', $request->item_id)->update([

                                      'suppliers_price' => $request->suppliers_price,

                                ]);

            }

            $total = intval($request->quantity) * $getItem['suppliers_price'];

            $newdata = New PO;
            $newdata->transaction_code = $request->transaction_code;
            $newdata->supplier_id = $request->supplier_id;
            $newdata->user_id = auth()->user()->id;
            $newdata->user_name = auth()->user()->firstname.' '.auth()->user()->middlename.' '.auth()->user()->lastname;
            $newdata->supplier_id = $request->supplier_id;
            $newdata->company = $getSupplier['company'];
            $newdata->supplier_name = $getSupplier['firstname'].' '.$getSupplier['middlename'].' '.$getSupplier['lastname'];
            $newdata->item_id = $request->item_id;
            $newdata->item_name = $getItem['item_name'];
            $newdata->quantity = $request->quantity;
            $newdata->suppliers_price = $request->suppliers_price;
            $newdata->total = $total;
            $newdata->payment_terms = $request->payment_terms;
            $newdata->date = date('Y-m-d');
            $newdata->save();

            userlogs('Added Purchase Order', $getItem['item_name']);



    }

















    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_unit(Request $request)
    {
            
            $this->validate($request,[
                'unit_name' => 'required|unique:units,unit_name',
            ]);  

            $newdata = New Unit;
            $newdata->unit_name = $request->unit_name;
            $newdata->save();

            userlogs('Added Items Unit', $request['unit_name']);

    }






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_category(Request $request)
    {
            
        $delete = ItemCategory::where('category_name', $request->name)->delete(); 
        userlogs('Deleted Item Category', $request['name']);

    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_unit(Request $request)
    {
            
        $delete = Unit::where('unit_name', $request->name)->delete(); 
        userlogs('Deleted Item Unit', $request['name']);
    }








    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getItemForEdit(Request $request)
    {
            
        return $get = Item::where('id', $request->data_id)->first(); 
           
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function additem(Request $request)
    {
            
            $this->validate($request,[
                'item_code' => 'required',
                'supplier_id' => 'required',
                'category' => 'required',
                'item_name' => 'required|unique:items,item_name',
                'unit' => 'required',
                'discountable' => 'required',
                'suppliers_price' => 'required',
                'sellers_price' => 'required',
                'vat' => 'required',
            ]);  


            $getCompany = User::where('id', $request->supplier_id)->first();


            $newdata = New Item;
            $newdata->status = 'Out of Stock';
            $newdata->discountable = $request->discountable;
            $newdata->discount = $request->discount;
            $newdata->item_code = $request->item_code;
            $newdata->supplier_id = $request->supplier_id;
            $newdata->supplier_name = $getCompany->firstname.' '.$getCompany->middlename.' '.$getCompany->lastname;
            $newdata->company = $getCompany['company'];
            $newdata->category = $request->category;
            $newdata->item_name = $request->item_name;
            $newdata->unit = $request->unit;
            $newdata->suppliers_price = $request->suppliers_price;
            $newdata->sellers_price = $request->sellers_price;
            $newdata->vat = $request->vat;
            $newdata->date = date('Y-m-d');
            $newdata->save();

            userlogs('Added a Item', $request['item_name']);

    }











    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateitem(Request $request)
    {
            
            $this->validate($request,[
                'item_code' => 'required',
                'supplier_id' => 'required',
                'category' => 'required',
                'item_name' => 'required|unique:items,item_name,'.$request->id,
                'unit' => 'required',
                'discountable' => 'required',
                'suppliers_price' => 'required',
                'sellers_price' => 'required',
                'vat' => 'required',
            ]);  


            $getCompany = User::where('id', $request->supplier_id)->first();


            $update = Item::where('id', $request->id)->update([

                            'discountable' => $request->discountable,
                            'discount' => $request->discount,
                            'item_code' => $request->item_code,
                            'supplier_id' => $request->supplier_id,
                            'company' => $getCompany['company'],
                            'category' => $request->category,
                            'item_name' => $request->item_name,
                            'unit' => $request->unit,
                            'suppliers_price' => $request->suppliers_price,
                            'sellers_price' => $request->sellers_price,
                            'vat' => $request->vat,

                      ]);

            userlogs('Updated a Item', $request['item_name']);

    }










    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteitem(Request $request)
    {
            
       $get = Item::where('id', $request->id)->first(); 

       if ($get['stock'] > 0 || $get['storage'] > 0) {
          return 'bad';
       } else {
          $get = Item::where('id', $request->id)->first(); 
          userlogs('Deleted a Item', $get['item_name']);
          $delete = Item::where('id', $request->id)->delete(); 
          return 'good';
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