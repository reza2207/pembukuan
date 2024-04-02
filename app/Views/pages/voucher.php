<link rel="stylesheet" href="<?= base_url().'assets/voucher.css';?>" />
<style>
    table.dataTable th, td{
  font-size: 12px;
}
</style>
<div class="container">
 
    <h5>Input Voucher</h5>

    <ul>
    <span>
        Pilih Divisi :
    </span>
        <li><a href="voucher/new/CRD"><span>CRD</span></a></li>
        <li><a href="voucher/new/CRP"><span>CRP</span></a></li>
        <li><a href="voucher/new/CRS"><span>CRS</span></a></li>
        <li><a href="voucher/new/RPP"><span>RPP</span></a></li>
        <li><a href="voucher/new/RDC"><span>RDC</span></a></li>
        <li><a href="voucher/new/SORX3"><span>SORX3</span></a></li>
    </ul>
</div>

<div class="container">
    <table id="example">
        <thead>
        <tr>
                <th>No.</th>
                <th>No. Voucher</th>
                <th>Tgl Voucher</th>
                <th>Divisi</th>
                <th>Nominal</th>
                <th>No Rek Debet</th>
                <th>Nama Rek Debet</th>
                <th>No Rek Kredit</th>
                <th>Nama Rek Kredit</th>
                <th>Keterangan</th>
                <th>DPP</th>
                <th>PPN</th>
                <th>PPh21</th>
                <th>PPh22</th>
                <th>PPh23</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    let table = new DataTable('#example', {
                    scrollX: true,
                    lengthMenu: [[25, 50, -1],[25,50, "All"]],
                    processing : true,
                    serverSide: true,
                    orderClasses: false,
                    order: [],
                    ajax: {
                        url: "<?= base_url('voucher/getData');?>",
                        type: "POST",
                    },
                    autoWidth: false,
                    columns: [
                        {'data' : ['no']},
                        {'data' : ['novoucher']},
                        {'data' : ['tglvoucher']},
                        {'data' : ['divisi']},
                        {'data' : ['nominal']},
                        {'data' : ['norekdebet']},
                        {'data': ['namarekdebet']},
                        {'data' : ['norekkredit']},
                        {'data' : ['namarekkredit']},
                        {'data' : ['keterangan']},
                        {'data' : ['nominaldpp']},
                        {'data' : ['totppn']},
                        {'data': ['totpph21']},
                        {'data' : ['totpph22']},
                        {'data' : ['totpph23']}

                    ],
                });

</script>