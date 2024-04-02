<?php

namespace App\Controllers;

//load model
use App\Models\VoucherModel;
use Config\Services;

class Voucher extends BaseController
{
    // public function __construct(){
    
    //     //$Voucher_model = new VoucherModel();
    // }

    public function index($page = "voucher")
    {
        //$this->view('fragments/header');
        //$this->view('welcome_message');

        $data['title'] = "VOUCHER";
        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');
    }

    public function new(string $div)
    {
        //check if div is exist in database
        //..code is here
        helper('terbilang');
        //put the title if true
        $data = ['divisi' => $div,
                'title' => 'New Voucher Divisi '.$div
        ];
        $divisi = $div;

        $year =  date("y");
        $year = substr( $year, -2);
        switch ($divisi) {
        case "CRD":
            $data['ent'] = "S97/767/           /$year";
            break;
        case "CRP":
            $data['ent'] = "743/00/           /$year";
            break;
        case "CRS":
            $data['ent'] = "785/00/           /$year";
            break;
        case "RPP":
            $data['ent'] = "774/00/           /$year";
            break;
        case "RDC":
            $data['ent']= "713/00/           /$year";
            break;
        case "SORX3":
            $data['ent'] = "783/00/           /$year";
            break;            
        default:
            $data['ent'] = "Divisi not valid!";
        }
        return view('templates/header', $data)
            . view('pages/new_voucher',$data)
            .view('templates/footer');

    }
    public function voucherLookup(string $id)
    {   
        
        $data['id'] = $id;
        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');
        //return view('voucher',$id);

        
    }

    public function getData()
    {
        $request = Services::request();
        $Voucher_model = new VoucherModel($request);
        
        // echo "<pre>";
        // print_r($Voucher_model->getDatatables());
        // echo "</pre>";
        
        $list = $Voucher_model->getDatatables();
        $data = [];
        $no = $request->getPost('start');
        foreach ($list as $field) {
            $no++;
            $row = [];
            $row['no'] = $no;
            $row['novoucher'] = $field->novoucher;
            $row['tglvoucher'] = $field->tglvoucher;
            $row['divisi'] = $field->divisi;
            $row['nominal'] = $field->nominal;
            $row['norekdebet'] = $field->norekdebet;
            $row['namarekdebet'] = $field->namarekdebet;
            $row['norekkredit'] = $field->norekkredit;
            $row['namarekkredit'] = $field->namarekkredit;
            $row['keterangan'] = $field->keterangan;
            $row['nominaldpp'] = $field->nominaldpp;
            $row['totppn'] = $field->totppn;
            $row['totpph21'] = $field->totpph21;
            $row['totpph22'] = $field->totpph22;
            $row['totpph23'] = $field->totpph23;
            
            $data[] = $row;
            
        }

        $output = array(
            "draw"=> $request->getPost('draw'),
            "recordsTotal" =>$Voucher_model->count_all(),
            "recordsFiltered"=>$Voucher_model->count_filtered(),
            "data"=>$data,
        );
        echo json_encode($output);


    }





}
