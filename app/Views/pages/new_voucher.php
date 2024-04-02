<div>
    <form action="" id="form_voucher">
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Divisi</label>
            <div class="col-sm-3">
                <input type="text" name="divisi" class="form-control-plaintext form-control form-control-sm" id="divisi" value="<?= $divisi;?>" readonly >
            </div>
            <label for="staticEmail" class="col-sm-2 col-form-label">No</label>
            <div class="col-sm-5">
                <input type="text" class="form-control-plaintext form-control form-control-sm" id="no" value="<?= $ent;?>" readonly >
            </div>
        </div>
        <div class="row">
            <label  class="col-sm-2 col-form-label">No Rek Debet</label>
            <div class="col-sm-3">
                <select type="text" name="rek_debet" class="form-control form-control-sm myselect2" ></select>
            </div>
            <label  class="col-sm-2 col-form-label">Nama Rekening Debet</label>
            <div class="col-sm-5">
                <input type="text" name="nama_rek_debet" class="form-control form-control-sm" id="nama_rek_debet">
            </div>
        </div>
        <div class="row">
            <label  class="col-sm-2 col-form-label">No Rek Kredit</label>
            <div class="col-sm-3">
                <select type="text" name="rek_kredit" class="form-control form-control-sm myselect2" ></select>
            </div>
            <label  class="col-sm-2 col-form-label">Nama Rekening Kredit</label>
            <div class="col-sm-5">
                <input type="text" name="nama_rek_kredit" class="form-control form-control-sm" id="nama_rek_kredit">
            </div>
        </div>
        <div class="mb-3 row">
            <label  class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
                <textarea type="text" name="keterangan" class="form-control form-control-sm" id="keterangan"></textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Nominal</label>
            <div class="col-sm-10">
                <input type="number" name="nominal" class="form-control form-control-sm" min=0 id="nominal">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="pajak_cek">
                    <label class="form-check-label">PAJAK</label>
                </div>
            </div>
        </div>
        
        <div id="pajak" class="d-none">
            <hr>    
            <div class="mb-3 row">
                
                <label class="col-sm-2 col-form-label">DPP</label>
                <div class="col-sm-10">
                    <input type="number" name="dpp" class="form-control form-control-sm" id="dpp">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="row input-group ">
                        <div class="col-sm-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_ppn11" data-id="ppn11">
                                <label class="form-check-label">PPN 11%</label>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-check form-check-inline">
                                <input class="form-control form-control-sm" type="number" name="ppn11" id="ppn11">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row input-group ">
                        <div class="col-sm-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_pph21"  data-id="pph21">
                                <label class="form-check-label">PPh 21%</label>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-check form-check-inline">
                                    <input class="form-control form-control-sm" type="number" name="pph21" id="pph21">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5"> 
                    <div class="mb-3 row input-group ">
                        <div class="col-sm-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_pph22" data-id="pph22">
                                <label class="form-check-label">PPh 22 1.5%</label>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-check form-check-inline">
                                    <input class="form-control form-control-sm" type="number" name="pph22" id="pph22">    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6"> 
                    <div class="mb-3 row input-group ">
                        <div class="col-sm-5">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="check_pph23"  data-id="pph23">
                                <label class="form-check-label">PPh 23 2%</label>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-check form-check-inline">
                                <input class="form-control form-control-sm" name="pph23" type="number" id="pph23">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div class="float">
            <h1><a class="text-muted" id="total"></a></h1>
            <h2><span class="text-muted" id="terbilang"></span></h2>
            <button class="btn btn-sm btn-primary" id="save">Save</button>
        </div>
        
        
    </form>
</div>

<script>
$(document).ready(function() {
    $('.myselect2').select2({
        tags: true
    });
    $('#pajak').addClass('d-none');
    $('#ppn11, #pph21, #pph22, #pph23').prop('disabled', true)
    $('#pajak_cek').on('click', function(e){
        
        if ($(this).prop('checked') == true)
        {
            $('#pajak').removeClass('d-none')
        }else{
            $('#pajak').addClass('d-none')
        }
    })
    $('.form-check-input').on('click', function(e){
        let id = $(this).attr('data-id');
        let cls = "#"+id;
        let dpp = $('#dpp').val();

        if($(cls).prop('disabled') == true){
            $(cls).prop('disabled',false);
            
            $(cls).val(eval(id+"("+dpp+")"));

        }else{
            $(cls).prop('disabled',true);
            $(cls).val('');
        }
        update()
       
    })

    $('#dpp').on('keyup', function(){
        let val = this.value
        
        $('#ppn11').prop('disabled') == true ?  $('#ppn11').val("") : $('#ppn11').val(ppn11(val));
        $('#pph21').prop('disabled') == true ? $('#pph21').val("") : $('#pph21').val(pph21(val));
        $('#pph22').prop('disabled') == true ? $('#pph22').val("") : $('#pph22').val(pph22(val));
        $('#pph23').prop('disabled') == true ? $('#pph23').val("") : $('#pph23').val(pph23(val));
        update()
    })

    $('#nominal, #dpp, #ppn11, #pph21, #pph22, #pph23, #check_ppn11').each(function(){
        $(this).on('keyup', function(){
            update()
        })
    })

    function update(){
        let val = $('#dpp').val();
        let nom = $('#nominal').val();
        let ppn11 = $('#ppn11').val();
        let pph21 = $('#pph21').val();
        let pph22 = $('#pph22').val();
        let pph23 = $('#pph23').val();
        $('#total').text(numberWithCommas(total(nom,ppn11,pph21,pph22,pph23)));
        $('#terbilang').text(angkaTerbilang(total(nom,ppn11,pph21,pph22,pph23)).toProperCase() == "Nol Rupiah" ? "" : angkaTerbilang(total(nom,ppn11,pph21,pph22,pph23)).toProperCase());
    }
    function ppn11(dpp){
        
        return Math.floor(dpp*0.11);
    }
    function pph21(dpp){
        
        return Math.floor(dpp*0.21);
    }
    function pph22(dpp){
        
        return Math.floor(dpp*0.22);
    }
    function pph23(dpp){
        
        return Math.floor(dpp*0.23);
    }
   
    function total(nom,ppn11,pph21,pph22,pph23){
        return nom-ppn11-pph21-pph22-pph23;
    }
    function numberWithCommas(x) {
        var parts = x.toString().split(".");
        parts[0]= parts[0].replace(/\B(?=(\d{3})+(?!\d))/g,".") == 0 ? "" : "Rp "+parts[0].replace(/\B(?=(\d{3})+(?!\d))/g,".");
        return parts.join(",");
    }

    $('#save').on('click', function(e){
        e.preventDefault()
        console.table($('#form_voucher').serialize())

    })
   
});

</script>