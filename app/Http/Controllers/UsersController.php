<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Userlog;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    


    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getUsers(Request $request)
    {   

        $status = $request->status;
        $usertype = $request->usertype;
        $lastname = $request->lastname;
        $firstname = $request->firstname;
        $middlename = $request->middlename;
        $gender = $request->gender;
        $contact = $request->contact;
        $address = $request->address;
        $email = $request->email;
        $username = $request->username;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ( $status == '' &&
               $usertype == '' &&
               $lastname == '' &&
               $firstname == '' &&
               $middlename == '' &&
               $gender == '' &&
               $contact == '' &&
               $address == '' &&
               $email == '' &&
               $username == ''
            ) {

                 $alldata_count = User::orderBy('status')
                                      ->where('usertype', '<>', 'Admin')
                                      ->where('usertype', '<>', 'Supplier')
                                      ->where('usertype', '<>', 'Customer')
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
                          ->where('usertype', '<>', 'Admin')
                          ->where('usertype', '<>', 'Supplier')
                          ->where('usertype', '<>', 'Customer')
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

                $alldata_count = User::where('status', 'LIKE', '%'.$status.'%')
                                      ->where('usertype', 'LIKE', '%'.$usertype.'%' )
                                      ->where('firstname', 'LIKE', '%'.$firstname.'%' )
                                      ->where('lastname', 'LIKE', '%'.$lastname.'%' )
                                      ->where('middlename', 'LIKE', '%'.$middlename.'%' )
                                      ->where('gender', 'LIKE', '%'.$gender.'%' )
                                      ->where('contact', 'LIKE', '%'.$contact.'%' )
                                      ->where('address', 'LIKE', '%'.$address.'%' )
                                      ->where('email', 'LIKE', '%'.$email.'%' )
                                      ->where('username', 'LIKE', '%'.$username.'%' )
                                      ->where('usertype', '<>', 'Admin')
                                      ->where('usertype', '<>', 'Supplier')
                                      ->where('usertype', '<>', 'Customer')
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


                $alldata = User::where('status', 'LIKE', '%'.$status.'%')
                                  ->where('usertype', 'LIKE', '%'.$usertype.'%' )
                                  ->where('firstname', 'LIKE', '%'.$firstname.'%' )
                                  ->where('lastname', 'LIKE', '%'.$lastname.'%' )
                                  ->where('middlename', 'LIKE', '%'.$middlename.'%' )
                                  ->where('gender', 'LIKE', '%'.$gender.'%' )
                                  ->where('contact', 'LIKE', '%'.$contact.'%' )
                                  ->where('address', 'LIKE', '%'.$address.'%' )
                                  ->where('email', 'LIKE', '%'.$email.'%' )
                                  ->where('username', 'LIKE', '%'.$username.'%' )
                                  ->where('usertype', '<>', 'Admin')
                                  ->where('usertype', '<>', 'Supplier')
                                  ->where('usertype', '<>', 'Customer')
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



        $allcount = User::where('usertype', '<>', 'Admin')
                        ->where('usertype', '<>', 'Supplier')
                        ->where('usertype', '<>', 'Customer')->get();

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
    public function getSuppliers(Request $request)
    {   

        $status = $request->status;
        $lastname = $request->lastname;
        $firstname = $request->firstname;
        $middlename = $request->middlename;
        $gender = $request->gender;
        $contact = $request->contact;
        $address = $request->address;
        $company = $request->company;
        $email = $request->email;
        $username = $request->username;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ( $status == '' &&
               $lastname == '' &&
               $firstname == '' &&
               $middlename == '' &&
               $gender == '' &&
               $contact == '' &&
               $address == '' &&
               $company == '' &&
               $email == '' &&
               $username == ''
            ) {


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

                $alldata_count = User::where('status', 'LIKE', '%'.$status.'%')
                                      ->where('firstname', 'LIKE', '%'.$firstname.'%' )
                                      ->where('lastname', 'LIKE', '%'.$lastname.'%' )
                                      ->where('middlename', 'LIKE', '%'.$middlename.'%' )
                                      ->where('gender', 'LIKE', '%'.$gender.'%' )
                                      ->where('contact', 'LIKE', '%'.$contact.'%' )
                                      ->where('address', 'LIKE', '%'.$address.'%' )
                                      ->where('company', 'LIKE', '%'.$company.'%' )
                                      ->where('email', 'LIKE', '%'.$email.'%' )
                                      ->where('username', 'LIKE', '%'.$username.'%' )
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


                $alldata = User::where('status', 'LIKE', '%'.$status.'%')
                                  ->where('firstname', 'LIKE', '%'.$firstname.'%' )
                                  ->where('lastname', 'LIKE', '%'.$lastname.'%' )
                                  ->where('middlename', 'LIKE', '%'.$middlename.'%' )
                                  ->where('gender', 'LIKE', '%'.$gender.'%' )
                                  ->where('contact', 'LIKE', '%'.$contact.'%' )
                                  ->where('address', 'LIKE', '%'.$address.'%' )
                                  ->where('company', 'LIKE', '%'.$company.'%' )
                                  ->where('email', 'LIKE', '%'.$email.'%' )
                                  ->where('username', 'LIKE', '%'.$username.'%' )
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
    public function getCustomers(Request $request)
    {   

        $status = $request->status;
        $lastname = $request->lastname;
        $firstname = $request->firstname;
        $middlename = $request->middlename;
        $gender = $request->gender;
        $contact = $request->contact;
        $address = $request->address;
        $email = $request->email;
        $username = $request->username;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ( $status == '' &&
               $lastname == '' &&
               $firstname == '' &&
               $middlename == '' &&
               $gender == '' &&
               $contact == '' &&
               $address == '' &&
               $email == '' &&
               $username == ''
            ) {


                 $alldata_count = User::orderBy('status')
                                      ->where('usertype', 'Customer')
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
                          ->where('usertype', 'Customer')
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

                $alldata_count = User::where('status', 'LIKE', '%'.$status.'%')
                                      ->where('firstname', 'LIKE', '%'.$firstname.'%' )
                                      ->where('lastname', 'LIKE', '%'.$lastname.'%' )
                                      ->where('middlename', 'LIKE', '%'.$middlename.'%' )
                                      ->where('gender', 'LIKE', '%'.$gender.'%' )
                                      ->where('contact', 'LIKE', '%'.$contact.'%' )
                                      ->where('address', 'LIKE', '%'.$address.'%' )
                                      ->where('email', 'LIKE', '%'.$email.'%' )
                                      ->where('username', 'LIKE', '%'.$username.'%' )
                                      ->where('usertype', 'Customer')
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


                $alldata = User::where('status', 'LIKE', '%'.$status.'%')
                                  ->where('firstname', 'LIKE', '%'.$firstname.'%' )
                                  ->where('lastname', 'LIKE', '%'.$lastname.'%' )
                                  ->where('middlename', 'LIKE', '%'.$middlename.'%' )
                                  ->where('gender', 'LIKE', '%'.$gender.'%' )
                                  ->where('contact', 'LIKE', '%'.$contact.'%' )
                                  ->where('address', 'LIKE', '%'.$address.'%' )
                                  ->where('email', 'LIKE', '%'.$email.'%' )
                                  ->where('username', 'LIKE', '%'.$username.'%' )
                                  ->where('usertype', 'Customer')
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


        $allcount = User::where('usertype', 'Customer')->get();

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
    public function loginme(Request $request)
    {
        
        $this->validate($request,[
                'username' => 'required|max:255',
                'password' => 'required|max:255',
            ]);  

        $getEmail = User::where('username', $request->username)->first();

        if (isset($getEmail['email'])) {
            $request->email = $getEmail['email'];
        } else {
            $request->email = '____@a.com';
        }


        if (Auth::attempt(['email' => $request->email,'password' => $request->password])) {

                $get_user = User::where('id',auth()->user()->id)->first();

                if($get_user['status'] == 'Blocked'){

                    Auth::logout();
                    return 'blocked';

                } else {

                    userlogs('Logged In', $get_user->usertype.': '.$get_user->firstname.' '.$get_user->middlename.' '.$get_user->lastname);
                    return $get_user['usertype'];

                }


        } else {

            return 'nouser';

        }


    }










    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adduser(Request $request)
    {
            
            $this->validate($request,[
                'status' => 'required',
                'usertype' => 'required',
                'lastname' => 'required',
                'firstname' => 'required',
                'middlename' => 'required',
                'gender' => 'required',
                'contact' => 'required',
                'address' => 'required',
                'email' => 'required|unique:users,email',
                'username' => 'required|unique:users,username',
                'password' => 'required',
                'retype_password' => 'required',
            ]);  



              if ($request->company == '') {
                  $request->company = '';
              }


              if ($request->password === $request->retype_password) {
                    
                    $newuser = New User;
                    $newuser->status = $request->status;
                    $newuser->usertype = $request->usertype;
                    $newuser->firstname = $request->firstname;
                    $newuser->middlename = $request->middlename;
                    $newuser->lastname = $request->lastname;  
                    $newuser->gender = $request->gender;  
                    $newuser->contact = $request->contact;
                    $newuser->company = $request->company;
                    $newuser->address = $request->address;
                    $newuser->email = $request->email;
                    $newuser->username = $request->username;
                    $newuser->password = bcrypt($request['password']);
                    $newuser->save(); 

                    userlogs('Added a User', $request->usertype.': '.$request->firstname.' '.$request->middlename.' '.$request->lastname);

                    return 'good';

              } else {

                    return 'not match';

              }


    }














    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edituser(Request $request)
    {
        
            $this->validate($request,[
                'status' => 'required',
                'usertype' => 'required',
                'lastname' => 'required',
                'firstname' => 'required',
                'middlename' => 'required',
                'gender' => 'required',
                'contact' => 'required',
                'address' => 'required',
                'email' => 'required|email|unique:users,email,'.$request->id,
                'username' => 'required|unique:users,username,'.$request->id,
            ]);   


              if ($request->company == '') {
                  $request->company = '';
              }


              $update = User::where('id', $request->id)->update([

                              'status' => $request->status,
                              'usertype' => $request->usertype,
                              'lastname' => $request->lastname,
                              'firstname' => $request->firstname,
                              'middlename' => $request->middlename,
                              'gender' => $request->gender,
                              'contact' => $request->contact,
                              'gender' => $request->gender,
                              'company' => $request->company,
                              'address' => $request->address,
                              'email' => $request->email,
                              'username' => $request->username,

                        ]);

              userlogs('Updated a User', $request->usertype.': '.$request->firstname.' '.$request->middlename.' '.$request->lastname);

              if ($request->password != '') {
                
                  $update = User::where('id', $request->id)->update([

                                'password' => bcrypt($request['password']),

                            ]);

              }



    }












    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editAccountProccess(Request $request)
    {
        
            $this->validate($request,[
                'lastname' => 'required',
                'firstname' => 'required',
                'middlename' => 'required',
                'gender' => 'required',
                'contact' => 'required',
                'address' => 'required',
                'email' => 'required|email|unique:users,email,'.auth()->user()->id,
                'username' => 'required|unique:users,username,'.auth()->user()->id,
                'old_password' => 'required',
            ]);   


            if (Hash::check($request->old_password, auth()->user()->password)) {

                $update = User::where('id', $request->id)->update([

                              'lastname' => $request->lastname,
                              'firstname' => $request->firstname,
                              'middlename' => $request->middlename,
                              'gender' => $request->gender,
                              'contact' => $request->contact,
                              'gender' => $request->gender,
                              'address' => $request->address,
                              'email' => $request->email,
                              'username' => $request->username,

                        ]);


              userlogs('Updated Account', $request->usertype.': '.$request->firstname.' '.$request->middlename.' '.$request->lastname);


                if (isset($request->new_password)) {
                    
                    $update = User::where('id', $request->id)->update([

                                    'password' => bcrypt($request->new_password),

                              ]);

                }
            
            } else {

                return 'bad';

            }
            

    }








    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function blockUser(Request $request)
    {
          
        $update = User::where('id', $request->id)->update([

                        'status' => 'Blocked',

                  ]);

        $getuser = User::where('id', $request->id)->first();

        userlogs('Blocked a User', $getuser->usertype.': '.$getuser->firstname.' '.$getuser->middlename.' '.$getuser->lastname);

    }









    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteuser(Request $request)
    {
          
        $getuser = User::where('id', $request->id)->first();

        userlogs('Deleted a User', $getuser->usertype.': '.$getuser->firstname.' '.$getuser->middlename.' '.$getuser->lastname);

        $delete = User::where('id', $request->id)->delete();

    }












    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getdataforedit(Request $request)
    {
          
       return $get = User::where('id', $request->data_id)->first();

    }












    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCurrentUser(Request $request)
    {
          
       return $get = User::where('id', auth()->user()->id)->first();

    }






    



    



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkUserLogin(Request $request)
    {
        if (isset(auth()->user()->id)) {
            return auth()->user()->usertype;
        } else {
            return '';
        }
    }















    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    { 

        $getuser = User::where('id', $request->id)->first();

        userlogs('Logged Out', $getuser->usertype.': '.$getuser->firstname.' '.$getuser->middlename.' '.$getuser->lastname);

        return Auth::logout();  

    }

















    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getUserlogs(Request $request)
    {   

        $usertype = $request->usertype;
        $user = $request->user;
        $created_at = $request->created_at;
        $activity = $request->activity;
        $content = $request->content;

        // pagenumberview
        $pagenumber = $request->tablenum;



        if ( $usertype == '' &&
               $user == '' &&
               $created_at == '' &&
               $activity == '' &&
               $content == ''
            ) {

                 $alldata_count = Userlog::orderBy('created_at')->get();
 
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


             $alldata = Userlog::limit($limit)
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

                $alldata_count = Userlog::where('usertype', 'LIKE', '%'.$usertype.'%')
                                      ->where('user', 'LIKE', '%'.$user.'%' )
                                      ->where('created_at', 'LIKE', '%'.$created_at.'%' )
                                      ->where('activity', 'LIKE', '%'.$activity.'%' )
                                      ->where('content', 'LIKE', '%'.$content.'%' )
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


                $alldata = Userlog::where('usertype', 'LIKE', '%'.$usertype.'%')
                                  ->where('user', 'LIKE', '%'.$user.'%' )
                                  ->where('created_at', 'LIKE', '%'.$created_at.'%' )
                                  ->where('activity', 'LIKE', '%'.$activity.'%' )
                                  ->where('content', 'LIKE', '%'.$content.'%' )
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



        $allcount = Userlog::all();

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