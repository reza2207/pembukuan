<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class VoucherModel extends Model
{
	protected $table    = 'voucher';
    //protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

   
    protected $column_order = array(null, 'novoucher', 'tglvoucher', 'divisi', 'nominal', 'norekdebet', 'namarekdebet', 'norekkredit', 'namarekkredit', 'keterangan', 'nominaldpp', 'totppn', 'totpph21', 'totpph22', 'totpph23');//,'status');//field yang ada di table user
   	protected $column_search = array('id', 'novoucher', 'tglvoucher', 'divisi', 'nominal', 'norekdebet', 'namarekdebet', 'norekkredit', 'namarekkredit', 'keterangan', 'nominaldpp', 'totppn', 'totpph21', 'totpph22', 'totpph23');//,'status');//field yang dizinkan untuk pencarian
    protected $order = array('tglvoucher'=>'desc'); //default sort
	protected $request;
    protected $db;
    protected $dt;

	
	public function __construct(RequestInterface $request = null)
	{
		parent::__construct();
		$this->request = $request;
		$this->dt = $this->db->table($this->table);
		
	}

	private function _get_datatables_query() 
	{	
		$i = 0;
        foreach ($this->column_search as $item) {
			//belom nemu
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }

	}

	function getDatatables()
	{
		 $this->_get_datatables_query();
		  if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
			$query = $this->dt->get();
			return  $query->getResult();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
        return $this->dt->countAllResults();
	}

	public function count_all()
	{
		$tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
	}

	// public function save_pks($id, $nopenunjukan, $tglminta, $nousulan, $idtdr, $perihal, $tglawal, $tglakhir, $nominalrp, $nominalusd, $bankgaransi)
	// {
	// 	$data = array(
	// 		'id_pks'=>$id,
	// 		'no_srt_pelaksana' => $nopenunjukan,
	// 		'tgl_minta' =>$tglminta,
	// 		'id_vendor' =>$idtdr,
	// 		'no_notin' => $nousulan,
	// 		'perihal' => $perihal,
	// 		'tgl_krj_awal' => $tglawal,
	// 		'tgl_krj_akhir' =>$tglakhir,
	// 		'nominal_usd' =>$nominalusd,
	// 		'nominal_rp'=>$nominalrp,
	// 		'bg_rp' => $bankgaransi);
	// 	return $this->db->insert('pks', $data);
	// }

	// public function get_detail($id)
	// {
	// 	$this->db->select('a.id_pks, a.tgl_minta, a.no_srt_pelaksana, a.no_notin, a.perihal, a.tgl_krj_awal, a.tgl_krj_akhir, a.tgl_ke_legal, a.tgl_draft_ke_user, a.tgl_draft_ke_user, a.tgl_draft_ke_vendor, a.tgl_review_send_to_legal, a.tgl_ke_vendor, a.tgl_blk_dr_vendor_ke_legal, a.tgl_ke_vendor_kedua, a.nm_vendor, a.reminder, a.beda, a.nominal_rp, a.bg_rp, a.no_pks, a.tgl_pks, IFNULL(b.keterangan, "") segera, status.keterangan AS status, a.id_vendor, a.file, c.no_surat, c.tgl_surat, c.perihal as prhl');
	// 	$this->db->from('(SELECT 'pks'.'id_pks', 'pks'.'tgl_minta', 'pks'.'no_srt_pelaksana', 'pks'.'no_notin', 'pks'.'perihal', 'pks'.'nominal_rp', 'pks'.'tgl_krj_awal', 'pks'.'tgl_krj_akhir', 'pks'.'tgl_ke_legal', 'pks'.'tgl_draft_ke_user', 'pks'.'tgl_draft_ke_vendor', 'pks'.'tgl_review_send_to_legal', 'pks'.'tgl_ke_vendor', 'pks'.'tgl_blk_dr_vendor_ke_legal', 'tgl_ke_vendor_kedua', 'pks'.'bg_rp', 'pks'.'no_pks', 'pks'.'tgl_pks', 'tdr'.'nm_vendor', IF(pks.reminder = "y", "Done", "-") AS reminder, IF(pks.tgl_ke_legal = "0000-00-00", "1", IF(pks.tgl_draft_ke_user = "0000-00-00" AND pks.tgl_draft_ke_vendor = "0000-00-00", "2", IF(pks.tgl_review_send_to_legal = "0000-00-00", "3", IF(pks.tgl_ke_vendor = "0000-00-00", "4", IF(pks.tgl_blk_dr_vendor_ke_legal = "0000-00-00", "5", IF(pks.tgl_ke_vendor_kedua = "0000-00-00", "6", IF(pks.tgl_ke_vendor_kedua != "0000-00-00" AND pks.tgl_krj_akhir > current_date, "7", "8"))))))) AS status, datediff(pks.tgl_krj_akhir, curdate()) as beda, IF(datediff(pks.tgl_krj_akhir, curdate()) > 0 AND datediff(pks.tgl_krj_akhir, curdate()) < 180, "9", "") AS segera, 'pks'.'id_vendor', 'pks'.'file' FROM 'pks' LEFT JOIN 'tdr' ON 'pks'.'id_vendor' = 'tdr'.'id_vendor') a');
	// 	$this->db->join('status', 'a.status = status.id_status', 'LEFT');
	// 	$this->db->join('status AS b', 'a.segera = b.id_status', 'LEFT');
	// 	$this->db->join('(SELECT * FROM 'reminder_pks' WHERE tgl_surat in (SELECT MAX(tgl_surat) from reminder_pks GROUP BY id_pks) ) c', 'a.id_pks = c.id_pks', 'LEFT');
	// 	//$this->db->join('expired', 'a.segera = expired.id_exp', 'LEFT');
	// 	$this->db->where('a.id_pks', $id);
	// 	return $this->db->get();
	// }

	// public function get_id_comment($idpks)
	// {
	// 	$this->db->select('id_comment');
	// 	$this->db->from('comment_pks');
	// 	$this->db->where('id_pks', $idpks);
	// 	$this->db->order_by('id_comment desc');
	// 	$this->db->limit('1');
	// 	return $this->db->get();
	// }

	// public function input_comment($comment_id, $id_pks, $comment, $comment_by, $comment_date)
	// {
		

	// 	$data = array(
	// 		'id_comment' =>$comment_id,
	// 		'id_pks' =>$id_pks,
	// 		'comment'=>$comment,
	// 		'comment_by'=>$comment_by,
	// 		'comment_date'=>$comment_date);
	// 	return $this->db->insert('comment_pks', $data);

	// }

	// public function get_comment($id)
	// {
	// 	$this->db->select('comment_pks.id_comment, comment_pks.comment, user.nama, comment_pks.comment_date');
	// 	$this->db->from('comment_pks');
	// 	$this->db->join('user', 'comment_pks.comment_by = user.username', 'left');
	// 	$this->db->where('id_pks', $id);
	// 	$this->db->order_by('id_comment', 'DESC');
	// 	return $this->db->get();
	// }

	// public function update_pks($id, $nopenunjukan, $tglminta, $nousulan, $idtdr, $perihal, $tglawal, $tglakhir, $nominalrp, $nominalusd, $bankgaransi,$tgldraftdarilegal, $tgldraftkeuser,$tgldraftkevendor,$tglreviewkelegal,$tglttdkevendor,$tglttdkepemimpin,$tglserahterimapks, $tglpks, $nopks, $file)
	// {
	// 	$data = array(
	// 		'no_srt_pelaksana' => $nopenunjukan,
	// 		'tgl_minta' =>$tglminta,
	// 		'id_vendor' =>$idtdr,
	// 		'no_notin' => $nousulan,
	// 		'perihal' => $perihal,
	// 		'tgl_krj_awal' => $tglawal,
	// 		'tgl_krj_akhir' =>$tglakhir,
	// 		'nominal_usd' =>$nominalusd,
	// 		'nominal_rp'=>$nominalrp,
	// 		'bg_rp' => $bankgaransi,
	// 		'tgl_ke_legal' =>$tgldraftdarilegal,
	// 		'tgl_draft_ke_vendor' =>$tgldraftkevendor,
	// 		'tgl_draft_ke_user' =>$tgldraftkeuser,
	// 		'tgl_review_send_to_legal'=> $tglreviewkelegal,
	// 		'tgl_ke_vendor'=>$tglttdkevendor,
	// 		'tgl_blk_dr_vendor_ke_legal'=>$tglttdkepemimpin,
	// 		'tgl_ke_vendor_kedua'=>$tglserahterimapks,
	// 		'no_pks'=>$nopks,
	// 		'tgl_pks'=>$tglpks,
	// 		'file'=>$file);

	// 	$this->db->where('id_pks', $id);
	// 	return $this->db->update('pks', $data);
	// }

	// public function delete_pks($id)
	// {	
	// 	return $this->db->delete('pks', array('id_pks' => $id));
	// }

	// public function proses_pks($id,$tgldraftdarilegal,$tgldraftkeuser,$tgldraftkevendor,$tglreviewkelegal,$tglttdkevendor,$tglttdkepemimpin,$tglserahterimapks,$nopks,$tglpks)
	// {
	// 	$data = array(
	// 		'tgl_ke_legal' =>$tgldraftdarilegal,
	// 		'tgl_draft_ke_vendor' =>$tgldraftkevendor,
	// 		'tgl_draft_ke_user' =>$tgldraftkeuser,
	// 		'tgl_review_send_to_legal'=> $tglreviewkelegal,
	// 		'tgl_ke_vendor'=>$tglttdkevendor,
	// 		'tgl_blk_dr_vendor_ke_legal'=>$tglttdkepemimpin,
	// 		'tgl_ke_vendor_kedua'=>$tglserahterimapks,
	// 		'no_pks'=>$nopks,
	// 		'tgl_pks'=>$tglpks);

	// 	$this->db->where('id_pks', $id);
	// 	return $this->db->update('pks', $data);
	// }

	// public function list_reminder($days){
	// 	$this->db->select('pks.no_srt_pelaksana, pks.perihal, pks.tgl_krj_akhir, datediff(pks.tgl_krj_akhir, curdate()) as beda');
	// 	$this->db->from($this->table);
	// 	$this->db->where('datediff(pks.tgl_krj_akhir, curdate()) > ',0);
	// 	$this->db->where('datediff(pks.tgl_krj_akhir, curdate()) <= ',$days);
	// 	return $this->db->get();

	// }

	// public function last_id($year)
	// {
	// 	$this->db->select('pks.id_pks');
	// 	$this->db->from($this->table);
	// 	$this->db->where('YEAR(tgl_minta)',$year);
	// 	$this->db->order_by('id_pks', 'DESC');
	// 	$this->db->limit('1');

	// 	return $this->db->get();
	// }

	// public function get_file($id)
	// {
	// 	$this->db->select('file');
	// 	$this->db->from($this->table);
	// 	$this->db->where('id_pks', $id);
	// 	return $this->db->get();
	// }

	// public function add_reminder($id, $idpks, $no, $tgl, $perihal, $file)
	// {
	// 	$data = array('id'=>$id,
	// 		          'id_pks'=> $idpks,
	// 		          'no_surat'=>$no,
	// 		          'tgl_surat'=>$tgl,
	// 		          'perihal'=>$perihal,
	// 		          'file'=>$file);
	// 	return $this->db->insert('reminder_pks', $data);
	// }

	// public function data_reminder($id)

	// {
	// 	$this->db->from('reminder_pks');
	// 	$this->db->where('id_pks', $id);
	// 	$this->db->order_by('tgl_surat','DESC');
	// 	return $this->db->get();
	// }
}