<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Lpurchase {



    //Purchase add form

    public function purchase_add_form() {

        $CI = & get_instance();
        $CI1 = & get_instance();
        $CI1->load->model('Purchases');
            $CI->load->model('Suppliers');
        $CI->load->model('Categories');
        $CI->load->model('Units');
        $CI->load->model('Products');
   



        $CI->load->model('Web_settings');

        $all_product_list = $CI1->Products->all_product_list();
        $all_supplier = $CI1->Purchases->select_all_supplier();
           $supplier      = $CI->Suppliers->supplier_list("110", "0");

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $bank_list        = $CI->Web_settings->bank_list();


        $category_list = $CI->Categories->category_list_product();

        $unit_list     = $CI->Units->unit_list();
        $taxfield1 = $CI->db->select('tax_id,tax')
        ->from('tax_information')
        ->get()
        ->result_array();

        $data = array(

            'title'         => display('add_purchase'),

            'all_supplier'  => $all_supplier,
            'product_list'  => $all_product_list,

            'tax'           => $taxfield1,

            'invoice_no'    => $CI->auth->generator(10),

            'category_list'=> $category_list,

            'unit_list'    => $unit_list,

            'discount_type' => $currency_details[0]['discount_type'],

            'bank_list'     => $bank_list,

        );

    
      
        $purchaseForm = $CI->parser->parse('purchase/purchase_order', $data, true);
      
        return $purchaseForm;

    }
    public function purchase_add_form1() {
        $CI = & get_instance();
        $CI1 = & get_instance();
        $CI1->load->model('Purchases');
        $CI->load->model('Suppliers');
        $CI->load->model('Categories');
        $CI->load->model('Units');
        $CI->load->model('Products');
        $CI->load->model('Invoices');
        $CI->load->model('Web_settings');
        $all_product_list = $CI1->Products->all_product_list();
        $all_supplier = $CI1->Purchases->select_all_supplier();
        $expense_packing_list        = $CI1->Purchases->expense_package();
           $supplier      = $CI->Suppliers->supplier_list("110", "0");
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $bank_list        = $CI->Web_settings->bank_list();
       
        $category_list = $CI->Categories->category_list_product();
        $unit_list     = $CI->Units->unit_list();
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
     $products=$CI->Invoices->allproduct();
 
     $taxfield1 = $CI->db->select('tax_id,tax')
     ->from('tax_information')
     ->get()
     ->result_array();
     $po_number = $CI->db->select('chalan_no')
     ->from('purchase_order')
     ->get()
     ->result_array();
        $data = array(
            'curn_info_default' =>$curn_info_default[0]['currency_name'],
            'currency' => $currency_details[0]['currency'],
            'title'         => display('add_purchase'),
            'all_supplier'  => $all_supplier,
            'product_list'  => $all_product_list,
            'tax'           => $taxfield1,
           'products' =>$products,
           'po'  => $po_number,
            'invoice_no'    => $CI->auth->generator(10),
            'category_list'=> $category_list,
            'unit_list'    => $unit_list,
            'discount_type' => $currency_details[0]['discount_type'],
            'bank_list'     => $bank_list,
            'packinglist'=>$expense_packing_list,
            
        );
        
        $purchaseForm = $CI->parser->parse('purchase/add_purchase_form', $data, true);
        return $purchaseForm;
    }

     
 
    public function packing_add_form() {

        $CI = & get_instance();

        
        $CI->auth->check_admin_auth();
        $CI->load->model('Products');
     
        $CI->load->library('linvoice');


        $products=$CI->Products->get_all_products();




        $CI->load->model('Purchases');

        $CI->load->model('Categories');

        $CI->load->model('Units');


        $CI->load->model('Web_settings');

        $all_supplier = $CI->Purchases->select_all_supplier();

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $bank_list        = $CI->Web_settings->bank_list();


        $category_list = $CI->Categories->category_list_product();

        $unit_list     = $CI->Units->unit_list();

        $voucher_no = $CI->Purchases->packing_voucher_no();




        $data = array(

            'title'         => 'Add Packing List',

            'all_supplier'  => $all_supplier,

            'invoice_no'    => $CI->auth->generator(10),

            'category_list'=> $category_list,

            'unit_list'    => $unit_list,

            'voucher_no'   => $voucher_no,

        //    'product_id'    => $product_id,
        'products'=> $products,

            'discount_type' => $currency_details[0]['discount_type'],

            'bank_list'     => $bank_list,

        );

        $purchaseForm = $CI->parser->parse('purchase/add_packing_list', $data, true);

        return $purchaseForm;

    }


    
    public function packing_list() {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Categories');

        $CI->load->model('Units');

        $CI->load->model('Web_settings');

        $all_supplier = $CI->Purchases->select_all_supplier();

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $bank_list        = $CI->Web_settings->bank_list();


        $category_list = $CI->Categories->category_list_product();

        $unit_list     = $CI->Units->unit_list();


        $data = array(

            'title'         => 'Packing List',

            'all_supplier'  => $all_supplier,

            'invoice_no'    => $CI->auth->generator(10),

            'category_list'=> $category_list,

            'unit_list'    => $unit_list,

            'discount_type' => $currency_details[0]['discount_type'],

            'bank_list'     => $bank_list,

        );

        $purchaseForm = $CI->parser->parse('purchase/packing_list', $data, true);

        return $purchaseForm;

    }


       //Purchase add form

    public function ocean_import_form() {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Categories');
        $CI->load->model('Units');
   



        $CI->load->model('Web_settings');

        $all_supplier = $CI->Purchases->select_all_supplier();

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $bank_list        = $CI->Web_settings->bank_list();


        $category_list = $CI->Categories->category_list_product();

        $unit_list     = $CI->Units->unit_list();


        $data = array(

            'title'         => display('add_purchase'),

            'all_supplier'  => $all_supplier,

            'invoice_no'    => $CI->auth->generator(10),

            'category_list'=> $category_list,

            'unit_list'    => $unit_list,

            'discount_type' => $currency_details[0]['discount_type'],

            'bank_list'     => $bank_list,

        );

        $purchaseForm = $CI->parser->parse('purchase/ocean_import_tracking', $data, true);

        return $purchaseForm;

    }




      //Purchase Order form

      public function purchase_order_form() {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Categories');

        $CI->load->model('Units');
   
        $CI->load->model('Web_settings');
        $CI->load->model('Products');

      

        $all_supplier = $CI->Purchases->select_all_supplier();
        $products = $CI->Products->get_products();
       
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
      

        $bank_list        = $CI->Web_settings->bank_list();

        $category_list = $CI->Categories->category_list_product();

        $unit_list     = $CI->Units->unit_list();

     
        $voucher_no = $CI->Purchases->voucher_no();

        $taxfield1 = $CI->db->select('tax_id,tax')
        ->from('tax_information')
        ->get()
        ->result_array();

        $data = array(
            'curn_info_default' =>$curn_info_default[0]['currency_name'],
          
            'currency' => $currency_details[0]['currency'],
            'title'         => 'Add Purchase Order',

            'all_supplier'  => $all_supplier,
            'tax'           => $taxfield1,
            
            'voucher_no' => $voucher_no ,

            'invoice_no'    => $CI->auth->generator(10),

            'category_list'=> $category_list,

            'unit_list'    => $unit_list,

            'discount_type' => $currency_details[0]['discount_type'],
            
            'bank_list'     => $bank_list,
            'products'  => $products,

        );

        // echo "<pre>";   print_r($data);die();

    

        $purchaseForm = $CI->parser->parse('purchase/purchase_order', $data, true);

        return $purchaseForm;

    }


       public function random_no()
    {
        $inc_id = '';
        do {
            $id = rand(100000, 999999);
            $id2 = "PO" . $id;
            // $newcheck = $this->AdminInvestmentModel->random($id2);

            foreach ($newcheck as $newcheck) {
                if ($newcheck->c > 0) {
                    $id = rand(100000, 999999);
                } else {
                    $inc_id = "PO" . $id;
                }
            }
        } while ($inc_id == '');
        echo $inc_id;
    }


    // Retrieve Purchase List

    public function purchase_list() {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Web_settings');

        $CI->load->library('occational');

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $company_info = $CI->Purchases->retrieve_company();

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(

            'title'          => display('manage_purchase'),

            'company_info'   => $company_info,

            'currency'       => $currency_details[0]['currency'],

            'total_purhcase' => $CI->Purchases->count_purchase(),

        );



        $purchaseList = $CI->parser->parse('purchase/purchase', $data, true);

        return $purchaseList;

    }


    public function purchase_order_list() {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Web_settings');

        $CI->load->library('occational');

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $company_info = $CI->Purchases->retrieve_company();

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(

            'title'          => 'Manage Purchase Order',

            'company_info'   => $company_info,

            'currency'       => $currency_details[0]['currency'],

            'total_purhcase' => $CI->Purchases->count_purchase_order(),

        );




        $purchaseList = $CI->parser->parse('purchase/purchase_order_list', $data, true);

        return $purchaseList;

    }



     


     public function ocean_import_list() {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Web_settings');

        $CI->load->library('occational');

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $company_info = $CI->Purchases->retrieve_company();

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(

            'title'          => display('manage_purchase'),

            'company_info'   => $company_info,

            'currency'       => $currency_details[0]['currency'],

            'total_purhcase' => $CI->Purchases->count_ocean_import(),

        );



        $purchaseList = $CI->parser->parse('purchase/ocean_import_list', $data, true);

        return $purchaseList;

    }


     public function trucking_list() {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Web_settings');

        $CI->load->library('occational');

    

        $company_info = $CI->Purchases->retrieve_company();

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
      

        $data = array(
            'curn_info_default' =>$curn_info_default[0]['currency_name'],
            
              'currency'  =>$currency_details[0]['currency'],
            'title'          => display('manage_purchase'),

            'company_info'   => $company_info,

            'currency'       => $currency_details[0]['currency'],

            'total_purhcase' => $CI->Purchases->count_trucking(),

        );



        $purchaseList = $CI->parser->parse('purchase/trucking_list', $data, true);

        return $purchaseList;

    }



    //purchase search by supplier

    public function purchase_search_supplier($supplier_id, $links, $per_page, $page) {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Web_settings');

        $CI->load->library('occational');

        $purchases_list = $CI->Purchases->purchase_search($supplier_id, $per_page, $page);

        if (!empty($purchases_list)) {

            $j = 0;

            foreach ($purchases_list as $k => $v) {

                $purchases_list[$k]['final_date'] = $CI->occational->dateConvert($purchases_list[$j]['purchase_date']);

                $j++;

            }



            $i = 0;

            foreach ($purchases_list as $k => $v) {

                $i++;

                $purchases_list[$k]['sl'] = $i + $CI->uri->segment(3);

            }

        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(

            'title'          => display('manage_purchase'),

            'purchases_list' => $purchases_list,

            'links'          => $links,

            'currency'       => $currency_details[0]['currency'],

            'position'       => $currency_details[0]['currency_position'],

        );



        $purchaseList = $CI->parser->parse('purchase/purchase', $data, true);

        return $purchaseList;

    }



// purchase info by invoice no

    public function purchase_list_invoice_no($invoice_no) {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Web_settings');

        $CI->load->library('occational');

        $purchases_list = $CI->Purchases->purchase_list_invoice_id($invoice_no);

        if (!empty($purchases_list)) {

            $j = 0;

            foreach ($purchases_list as $k => $v) {

                $purchases_list[$k]['final_date'] = $CI->occational->dateConvert($purchases_list[$j]['purchase_date']);

                $j++;

            }



            $i = 0;

            foreach ($purchases_list as $k => $v) {

                $i++;

                $purchases_list[$k]['sl'] = $i + $CI->uri->segment(3);

            }

        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(

            'title'          => display('manage_purchase'),

            'purchases_list' => $purchases_list,

            'links'          => '',

            'currency'       => $currency_details[0]['currency'],

            'position'       => $currency_details[0]['currency_position'],

        );



        $purchaseList = $CI->parser->parse('purchase/purchase', $data, true);

        return $purchaseList;

    }



    //Purchase Item By Search

    public function purchase_by_search($supplier_id) {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->library('occational');

        $purchases_list = $CI->Purchases->purchase_by_search($supplier_id);

        $j = 0;

        if (!empty($purchases_list)) {

            foreach ($purchases_list as $k => $v) {

                $purchases_list[$k]['final_date'] = $CI->occational->dateConvert($purchases_list[$j]['purchase_date']);

                $j++;

            }

            $i = 0;

            foreach ($purchases_list as $k => $v) {

                $i++;

                $purchases_list[$k]['sl'] = $i;

            }

        }

        $data = array(

            'title' => display('manage_purchase'),

            'purchases_list' => $purchases_list

        );

        $purchaseList = $CI->parser->parse('purchase/purchase', $data, true);

        return $purchaseList;

    }



    //Insert Purchase

    public function insert_purchase($data) {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->Purchases->purchase_entry($data);

        return true;

    }



    //purchase Edit Data

    public function purchase_edit_data($purchase_id) {
        $CI = & get_instance();
        $CI->load->model('Purchases');
        $CI->load->model('Suppliers');
        $CI->load->model('Web_settings');
         $bank_list        = $CI->Web_settings->bank_list();
        $purchase_detail = $CI->Purchases->retrieve_purchase_editdata($purchase_id);
        // $supplier_id = $purchase_detail[0]['supplier_id'];
        $supplier_list = $CI->Suppliers->supplier_list("110", "0");
        $supplier_selected = $CI->Suppliers->supplier_search_item($purchase_id);
        if (!empty($purchase_detail)) {
            $i = 0;
            foreach ($purchase_detail as $k => $v) {
                $i++;
                $purchase_detail[$k]['sl'] = $i;
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
        $bank_list        = $CI->Web_settings->bank_list();
        $expense_packing_list        = $CI->Purchases->expense_package();
        $taxfield1 = $CI->db->select('tax_id,tax')
        ->from('tax_information')
        ->get()
        ->result_array();
       
        $data = array(
            'curn_info_default' =>$curn_info_default[0]['currency_name'],
            'currency' => $currency_details[0]['currency'],
            'all_tax' =>$taxfield1,
            'title'         => display('purchase_edit'),
            'purchase_id'   => $purchase_detail[0]['purchase_id'],
            'chalan_no'     => $purchase_detail[0]['chalan_no'],
            'supplier_name' => $purchase_detail[0]['supplier_name'],
            'supplier_id'   => $purchase_detail[0]['supplier_id'],
             'description'   => $purchase_detail[0]['description'],
            'grand_total'   => $purchase_detail[0]['grand_total_amount'],
            'purchase_details' => $purchase_detail[0]['purchase_details'],
            'purchase_date' => $purchase_detail[0]['purchase_date'],
            'remarks'       => $purchase_detail[0]['remarks'],
            'total_discount'=> $purchase_detail[0]['total_discount'],
            'total'         => number_format($purchase_detail[0]['grand_total_amount'] + (!empty($purchase_detail[0]['total_discount'])?$purchase_detail[0]['total_discount']:0),2),
            'bank_id'       =>  $purchase_detail[0]['bank_id'],
            'purchase_info' => $purchase_detail,
            'supplier_list' => $supplier_list,
            'paid_amount'   => $purchase_detail[0]['paid_amount'],
            'balance'    => $purchase_detail[0]['balance'],
            'payment_id'    => $purchase_detail[0]['payment_id'],
            'bank_list'     => $bank_list,
            'supplier_selected' => $supplier_selected,
            'discount_type' => $currency_details[0]['discount_type'],
            'paytype'       => $purchase_detail[0]['payment_type'],
           'total_tax'       => $purchase_detail[0]['total_tax'],
           'packing_id'    => $purchase_detail[0]['packing_id'],
           'isf_filling'    => $purchase_detail[0]['isf_filling'],
           'packinglist'=>$expense_packing_list,
        );
      
        $chapterList = $CI->parser->parse('purchase/edit_purchase_form', $data, true);
        return $chapterList;
    }

        //purchase Edit Data

    public function purchase_order_edit_data($purchase_id) {

        $CI = & get_instance();

        $CI->load->model('Purchases');
   
        $CI->load->model('Suppliers');

        $CI->load->model('Web_settings');
        $CI->load->model('Products');

         $bank_list        = $CI->Web_settings->bank_list();

        $purchase_detail = $CI->Purchases->retrieve_purchase_order_editdata($purchase_id);



        $supplier_id = $purchase_detail[0]['supplier_id'];

        $supplier_list = $CI->Suppliers->supplier_list("110", "0");

        $supplier_selected = $CI->Suppliers->supplier_search_item($supplier_id);



        if (!empty($purchase_detail)) {

            $i = 0;

            foreach ($purchase_detail as $k => $v) {

                $i++;

                $purchase_detail[$k]['sl'] = $i;

            }

        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
      

$products = $CI->Products->get_products();
        $data = array(
            'curn_info_default' =>$curn_info_default[0]['currency_name'],
          
            'currency' => $currency_details[0]['currency'],
            'title'  => display('purchase_edit'),

            'ship_to'  => $purchase_detail[0]['ship_to'],

            'quantity'  => $purchase_detail[0]['quantity'],

            'created_by' => $purchase_detail[0]['created_by'],

            'payment_terms' => $purchase_detail[0]['payment_terms'],
            
            'shipment_terms' => $purchase_detail[0]['shipment_terms'],

            'est_ship_date' => $purchase_detail[0]['est_ship_date'],

            'slabs' => $purchase_detail[0]['slabs'],

            'purchase_id'   => $purchase_detail[0]['purchase_id'],

            'chalan_no'     => $purchase_detail[0]['chalan_no'],

            'supplier_name' => $purchase_detail[0]['supplier_name'],

            'supplier_id'   => $purchase_detail[0]['supplier_id'],

            'grand_total'   => $purchase_detail[0]['grand_total_amount'],

            'purchase_details' => $purchase_detail[0]['purchase_details'],

            'purchase_date' => $purchase_detail[0]['purchase_date'],

            'remarks'       => $purchase_detail[0]['remarks'],

            'total_discount'=> $purchase_detail[0]['total_discount'],

            'total'         => number_format($purchase_detail[0]['grand_total_amount'] + (!empty($purchase_detail[0]['total_discount'])?$purchase_detail[0]['total_discount']:0),2),

            'bank_id'       =>  $purchase_detail[0]['bank_id'],

            'purchase_info' => $purchase_detail,

            'supplier_list' => $supplier_list,

            'paid_amount'   => $purchase_detail[0]['paid_amount'],

            'due_amount'    => $purchase_detail[0]['due_amount'],

            'bank_list'     => $bank_list,

            'supplier_selected' => $supplier_selected,

            'discount_type' => $currency_details[0]['discount_type'],

            'paytype'       => $purchase_detail[0]['payment_type'],
            'products'  => $products

        );


        $chapterList = $CI->parser->parse('purchase/edit_purchase_order_form', $data, true);

        return $chapterList;

    }


        //ocean import tracking Edit Data

    public function ocean_import_tracking_edit_data($purchase_id) {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Suppliers');

        $CI->load->model('Web_settings');

         $bank_list        = $CI->Web_settings->bank_list();

        $purchase_detail = $CI->Purchases->retrieve_ocean_import_tracking_editdata($purchase_id);


        $supplier_id = $purchase_detail[0]['supplier_id'];

        $supplier_list = $CI->Suppliers->supplier_list("110", "0");

        $supplier_selected = $CI->Suppliers->supplier_search_item($supplier_id);



        if (!empty($purchase_detail)) {

            $i = 0;

            foreach ($purchase_detail as $k => $v) {

                $i++;

                $purchase_detail[$k]['sl'] = $i;

            }

        }



        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(

            'title'         => display('purchase_edit'),

            'ocean_import_tracking_id'   => $purchase_detail[0]['ocean_import_tracking_id'],

            'booking_no'     => $purchase_detail[0]['booking_no'],

            'container_no' => $purchase_detail[0]['container_no'],

            'seal_no'   => $purchase_detail[0]['seal_no'],

            'shipper' => $purchase_detail[0]['shipper'],

            'invoice_date' => $purchase_detail[0]['invoice_date'],

            'consignee' => $purchase_detail[0]['consignee'],

            'notify_party' => $purchase_detail[0]['notify_party'],

            'vessel' =>  $purchase_detail[0]['vessel'],

            'voyage_no' =>  $purchase_detail[0]['voyage_no'],

            'port_of_loading' =>  $purchase_detail[0]['port_of_loading'],

            'port_of_discharge' => $purchase_detail[0]['port_of_discharge'],

            'place_of_delivery' => $purchase_detail[0]['place_of_delivery'],

            'freight_forwarder'  => $purchase_detail[0]['freight_forwarder'],

            'particular' => $purchase_detail[0]['particular'],

            'attachment' => $purchase_detail[0]['attachment'],
'remarks' => $purchase_detail[0]['remarks'],
            'status'  => $purchase_detail[0]['status'],
            'country_origin'  => $purchase_detail[0]['country_origin'],

          'supplier_list'=>$supplier_list,

            'supplier_name'   => $purchase_detail[0]['supplier_name'],
            'supplier_id'   => $purchase_detail[0]['supplier_id'],

        );


        $chapterList = $CI->parser->parse('purchase/edit_ocean_import_tracking_form', $data, true);

        return $chapterList;

    }




        //trucking Edit Data

    public function trucking_edit_data($purchase_id) {

        $CI = & get_instance();
        $CI->load->model('Invoices');
        $CI->load->model('Purchases');

        $CI->load->model('Suppliers');

        $CI->load->model('Web_settings');

         //$bank_list        = $CI->Web_settings->bank_list();

        $purchase_detail = $CI->Purchases->retrieve_trucking_editdata($purchase_id);

        $customer_id = $purchase_detail[0]['customer_id'];

        // $supplier_list = $CI->Suppliers->supplier_list("110", "0");

        // $supplier_selected = $CI->Suppliers->supplier_search_item($supplier_id);



        if (!empty($purchase_detail)) {

            $i = 0;

            foreach ($purchase_detail as $k => $v) {

                $i++;

                $purchase_detail[$k]['sl'] = $i;

            }

        }



        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $all_supplier = $CI1->Purchases->select_all_supplier();
        $get_customer= $this->accounts_model->get_customer();
        
        $taxfield = $CI->db->select('tax_name,default_value')->from('tax_settings')->get()->result_array();
        $taxfield1 = $CI->db->select('tax_id,tax')
        ->from('tax_information')
        ->get()
        ->result_array();
        $dropdown = $CI->Purchases->invoice_dropdown();
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
        $data = array(
            'curn_info_default' =>$curn_info_default[0]['currency_name'],
            'currency'  =>$currency_details[0]['currency'],
            'customer_list' => $get_customer,
            'all_supplier'  => $all_supplier,
            'title'         => display('purchase_edit'),
            'taxes'         => $taxfield,
            'dropdown'    =>   $dropdown,
            'tax'         => $taxfield1,
            'trucking_id'   => $purchase_detail[0]['trucking_id'],

            'invoice_no'     => $purchase_detail[0]['invoice_no'],

            'customer_name' => $purchase_detail[0]['customer_name'],

            'customer_id'   => $purchase_detail[0]['customer_id'],

            'bill_to'   => $purchase_detail[0]['bill_to'],

            'shipment_company'   => $purchase_detail[0]['shipment_company'],

            'container_pickup_date'   => $purchase_detail[0]['container_pickup_date'],

            'delivery_date'   => $purchase_detail[0]['delivery_date'],

            'total'         => number_format($purchase_detail[0]['grand_total_amount'] + (!empty($purchase_detail[0]['total_discount'])?$purchase_detail[0]['total_discount']:0),2),

         

        );

print_r($purchase_detail);

        $chapterList = $CI->parser->parse('purchase/edit_trucking_form', $data, true);

        return $chapterList;

    }



         //trucking Edit Data

    public function packing_list_edit_data($purchase_id) {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Suppliers');

        $CI->load->model('Web_settings');

         //$bank_list        = $CI->Web_settings->bank_list();

        $purchase_detail = $CI->Purchases->retrieve_packing_editdata($purchase_id);
   
        // $customer_id = $purchase_detail[0]['customer_id'];

        // $supplier_list = $CI->Suppliers->supplier_list("110", "0");

        // $supplier_selected = $CI->Suppliers->supplier_search_item($supplier_id);



        if (!empty($purchase_detail)) {

            $i = 0;

            foreach ($purchase_detail as $k => $v) {

                $i++;

                $purchase_detail[$k]['sl'] = $i;

            }

        }



        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(

            'title'         => 'Packing List Edit',

            'expense_packing_id'   => $purchase_detail[0]['expense_packing_id'],

            'invoice_no'     => $purchase_detail[0]['invoice_no'],

            'invoice_date'   => $purchase_detail[0]['invoice_date'],

            'gross_weight' => $purchase_detail[0]['gross_weight'],

            'container_no' => $purchase_detail[0]['container_no'],

            'thickness' => $purchase_detail[0]['thickness'],

            'description' =>  $purchase_detail[0]['description'],

            'grand_total_amount' =>  $purchase_detail[0]['grand_total_amount'],

            'serial_no' =>   $purchase_detail[0]['serial_no'],

            'purchase_info' => $purchase_detail,

            'slab_no' =>   $purchase_detail[0]['slab_no'],

            'prouduct_name' =>  $purchase_detail[0]['product_name'],

            'net_measure' =>   $purchase_detail[0]['net_measure'],

            'height' =>   $purchase_detail[0]['height'],

            'width'=>   $purchase_detail[0]['width'],
            'area'=>   $purchase_detail[0]['area'],

        );
print_r($purchase_detail);
die();

        $chapterList = $CI->parser->parse('purchase/edit_packing_form', $data, true);
      //  $chapterList = $CI->parser->parse('purchase/editpackinglist', $data, true);
        return $chapterList;

    }



    //Search purchase

    public function purchase_search_list($cat_id, $company_id) {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $category_list = $CI->Purchases->retrieve_category_list();

        $purchases_list = $CI->Purchases->purchase_search_list($cat_id, $company_id);

        $data = array(

            'title'          => display('manage_purchase'),

            'purchases_list' => $purchases_list,

            'category_list'  => $category_list

        );

        $purchaseList = $CI->parser->parse('purchase/purchase', $data, true);

        return $purchaseList;

    }



    //Purchase details data
public function purchase_details_data($purchase_id) {


    $CI = & get_instance();

    $CI->load->model('Purchases');
    $CI->load->model('Products');

   

    $CI->load->library('occational');
    $CI->load->library('Products');



    $purchase_detail = $CI->Purchases->purchase_details_data($purchase_id);
      // print_r($purchase_detail); die();
    $Products = $CI->Products->get_invoice_product($purchase_id);
  

    $get_invoice_design = $CI->Purchases->get_invoice_design();
    $CI->load->model('invoice_design');



    

    if (!empty($purchase_detail)) {

        $i = 0;

        foreach ($purchase_detail as $k => $v) {

            $i++;

            $purchase_detail[$k]['sl'] = $i;

        }



        foreach ($purchase_detail as $k => $v) {

            $purchase_detail[$k]['convert_date'] = $CI->occational->dateConvert($purchase_detail[$k]['purchase_date']);

        }

    }



    $currency_details = $CI->Web_settings->retrieve_setting_editdata();

    $company_info = $CI->Purchases->retrieve_company();

    $curn_info_default = $CI->db->select('*')->from('currency_tbl')->where('icon',$currency_details[0]['currency'])->get()->result_array();
      
    $dataw = $CI->invoice_design->retrieve_data();
   
 $supplier_currency = $CI->db->select('*')->from('supplier_information')->where('supplier_name',$purchase_detail[0]['supplier_name'])->get()->result_array();
    $data = array(
        'header'=> $dataw[0]['header'],
        'logo'=> $dataw[0]['logo'],
        'color'=> $dataw[0]['color'],
        'template'=> $dataw[0]['template'],
       
        'curn_info_default' =>$curn_info_default[0]['currency_name'],
        'title'            => display('purchase_details'),
      'supplier_currency' => $supplier_currency[0]['currency_type'],
        'purchase_id'      => $purchase_detail[0]['purchase_id'],

        'email_address'      => $purchase_detail[0]['email_address'],

        'mobile'      => $purchase_detail[0]['mobile'],

        'address'      => $purchase_detail[0]['address'],

        'message_invoice' => $purchase_detail[0]['message_invoice'],

        'purchase_details' => $purchase_detail[0]['purchase_details'],

        'remarks'  => $purchase_detail[0]['remarks'],
          'packing_id'    => $purchase_detail[0]['packing_id'],
        'isf_filling'    => $purchase_detail[0]['isf_filling'],

        'product'  => $Products[0]['product_name'],

        'supplier_name'    => $purchase_detail[0]['supplier_name'],

        'desc'    => $purchase_detail[0]['description'],

        'qty'    => $purchase_detail[0]['quantity'],

        'rate'    => $purchase_detail[0]['rate'],

        'final_date'       => $purchase_detail[0]['convert_date'],
        'payment_due_date'       => $purchase_detail[0]['payment_due_date'],

        'sub_total_amount' => number_format($purchase_detail[0]['grand_total_amount'], 2, '.', ','),

        'chalan_no'        => $purchase_detail[0]['chalan_no'],

        'total'            =>  number_format($purchase_detail[0]['grand_total_amount']+(!empty($purchase_detail[0]['total_discount'])?$purchase_detail[0]['total_discount']:0), 2),

        'discount'         => number_format((!empty($purchase_detail[0]['total_discount'])?$purchase_detail[0]['total_discount']:0),2),

        'paid_amount'      => number_format($purchase_detail[0]['paid_amount'],2),

     

        'purchase_all_data'=> $purchase_detail,

        'company_info'     => $company_info,

        'currency'         => $currency_details[0]['currency'],

        'position'         => $currency_details[0]['currency_position'],
'total_tax'  => $purchase_detail[0]['total_tax'],
        'Web_settings'     => $currency_details,
        'products'     => $Products,
        'invoice_setting'     => $get_invoice_design,

    );



 

    $chapterList = $CI->parser->parse('purchase/purchase_detail', $data, true);

    return $chapterList;

}




    //Purchase details data

    public function ocean_import_tracking_details_data($purchase_id) {



        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Web_settings');

        $CI->load->library('occational');



        $purchase_detail = $CI->Purchases->ocean_import_tracking_details_data($purchase_id);


        if (!empty($purchase_detail)) {

            $i = 0;

            foreach ($purchase_detail as $k => $v) {

                $i++;

                $purchase_detail[$k]['sl'] = $i;

            }



            foreach ($purchase_detail as $k => $v) {

                $purchase_detail[$k]['convert_date'] = $CI->occational->dateConvert($purchase_detail[$k]['invoice_date']);

            }

        }

        $CI->load->model('invoice_design');
       
        $dataw = $CI->invoice_design->retrieve_data();

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $company_info = $CI->Purchases->retrieve_company();
        $customer_name = $CI->db->select('*')->from('customer_information')->where('customer_id', $purchase_detail[0]['consignee'])->get()->result_array();
        $data = array(
            'header'=> $dataw[0]['header'],
            'logo'=> $dataw[0]['logo'],
            'color'=> $dataw[0]['color'],
            'template'=> $dataw[0]['template'],
            'company'    => $company_info[0]['company_name'],
            'address'    => $company_info[0]['address'],
            'email'    => $company_info[0]['email'],
            'phone'    => $company_info[0]['mobile'],
        'title'            => display('purchase_details'),

        'ocean_import_tracking_id'      => $purchase_detail[0]['ocean_import_tracking_id'],

            'booking_no' => $purchase_detail[0]['booking_no'],
'remarks' => $purchase_detail[0]['remarks'],
            'container_no'    => $purchase_detail[0]['container_no'],
'origin'  =>$purchase_detail[0]['country_origin'],
            'seal_no'       => $purchase_detail[0]['seal_no'],
            'etd' => $purchase_detail[0]['etd'],
            'eta' => $purchase_detail[0]['eta'],
            'bl_shipment' =>$purchase_detail[0]['bl_shipment_date'],
            'supplier_id' => $purchase_detail[0]['supplier_id'],
            'supplier_name' => $purchase_detail[0]['supplier_name'],
            'shipper' => $purchase_detail[0]['shipper'],
            'invoice_date' => $purchase_detail[0]['invoice_date'],
            'consignee' => $purchase_detail[0]['consignee'],
            'notify_party' => $purchase_detail[0]['notify_party'],
            'vessel' => $purchase_detail[0]['vessel'],
            'voyage_no' => $purchase_detail[0]['voyage_no'],
            'port_of_loading' => $purchase_detail[0]['port_of_loading'],
            'port_of_discharge' => $purchase_detail[0]['port_of_discharge'],
            'place_of_delivery' => $purchase_detail[0]['place_of_delivery'],
            'freight_forwarder' => $purchase_detail[0]['freight_forwarder'],
            'particular' => $purchase_detail[0]['particular'],
            'attachment' => $purchase_detail[0]['attachment'],
            'status' => $purchase_detail[0]['status'],
            'create_by' => $purchase_detail[0]['create_by'],
            'customer_name'  => $customer_name[0]['customer_name'],
            'remarks' => $purchase_detail[0]['remarks']

            // 'sub_total_amount' => number_format($purchase_detail[0]['grand_total_amount'], 2, '.', ','),

        );



        $chapterList = $CI->parser->parse('purchase/ocean_import_invoice_html', $data, true);

        return $chapterList;

    }



    // purchase list date to date

    public function purchase_list_date_to_date($start, $end) {

        $CI = & get_instance();

        $CI->load->model('Purchases');

        $CI->load->model('Web_settings');

        $CI->load->library('occational');

        $purchases_list = $CI->Purchases->purchase_list_date_to_date($start, $end);

        if (!empty($purchases_list)) {

            $j = 0;

            foreach ($purchases_list as $k => $v) {

                $purchases_list[$k]['final_date'] = $CI->occational->dateConvert($purchases_list[$j]['purchase_date']);

                $j++;

            }



            $i = 0;

            foreach ($purchases_list as $k => $v) {

                $i++;

                $purchases_list[$k]['sl'] = $i + $CI->uri->segment(3);

            }

        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(

            'title'          => display('manage_purchase'),

            'purchases_list' => $purchases_list,

            'links'          => '',

            'currency'       => $currency_details[0]['currency'],

            'position'       => $currency_details[0]['currency_position'],

        );



        $purchaseList = $CI->parser->parse('purchase/purchase', $data, true);

        return $purchaseList;

    }

    public function packing_update_form($purchase_id)
    {
         $CI = & get_instance();
         $CI->load->model('Purchases');
          $invoice = $CI->Purchases->invoice_edit($purchase_id);
    
          $invoice_detail = $CI->Purchases->invoice_detail_edit($purchase_id);
          $purchase_detail = $CI->Purchases->retrieve_packing_editdata($purchase_id);
       
          // $customer_id = $purchase_detail[0]['customer_id'];
    
          // $supplier_list = $CI->Suppliers->supplier_list("110", "0");
    
          // $supplier_selected = $CI->Suppliers->supplier_search_item($supplier_id);
    
    
    
          if (!empty($purchase_detail)) {
    
              $i = 0;
    
              foreach ($purchase_detail as $k => $v) {
    
                  $i++;
    
                  $purchase_detail[$k]['sl'] = $i;
    
              }
    
          }
    
    
          $get_invoice_product = $CI->Purchases->invoice_product_edit($purchase_id);
    
          $data['packinglist']=$purchase_detail;
        $data['invoice']=$invoice;
        $data['invoice_detail']=$invoice_detail;
        $data['invoice_product']=$get_invoice_product;
        $prodt = $CI->db->select('product_name,product_model,p_quantity')
        ->from('product_information')
        ->where('created_by',$get_invoice_product[0]['create_by'])
        ->get()
        ->result_array();
      $data=array(
        'packinglist'  =>$purchase_detail,
        'invoice'   => $invoice,
        'invoice_detail'   => $invoice_detail,
        'invoice_product'  => $get_invoice_product,
        'prodt'   =>  $prodt

      );
   
        
    $packingedit  = $CI->parser->parse('purchase/editpackinglist', $data, true);
    return $packingedit;
    }

}



?>