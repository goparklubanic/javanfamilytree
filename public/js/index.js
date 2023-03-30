$(document).ready(function(){
    // alert(apiurl);
    $.getJSON({
        url: apiurl + '/keluarga',
        success: function(res){
            // console.log(res.klg)
            let csrf = document.querySelector('meta[name="csrf-token"]').content;
            $("#dataKeluarga tr").remove();
            $("#namaKeluarga option").remove();
            $.each(res.klg, function(i,data){
                // let rand1 = Math.floor(Math.random() * 901 + 98);
                // let rand2 = Math.floor(Math.random() * 891 + 11);
                $("#dataKeluarga").append(`
                    <tr>
                        <td>${data.id}</td>
                        <td class="text-center">${data.generasiKe}</td>
                        <td>${data.orangtua}</td>
                        <td>${data.urutKe}</td>
                        <td>${data.nama}</td>
                        <td>${data.jnKelamin}</td>
                        <td class='px-2'>
                        <div class="text-end">
                            <a href="javascript:void(0)" id="${data.id}x${data.generasiKe}x${data.parentId}" class="d-inline ml-1 btn btn-primary btn-sm tambahanak">Tambah Anak</a>
                            <a href="javascript:void(0)" id="${data.id}x${data.generasiKe}x${data.parentId}" class="d-inline ml-1 btn btn-warning btn-sm editanak">Edit</a>
                            <form method="post" action="${delurl.replace(':id',data.id)}" class="d-inline ml-1">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="${csrf}">
                                <button type="submit" class="btn btn-sm btn-danger usiranak">Hapus</button>
                            </form>
                        </div>
                        </td>
                    </tr>
                `)

                $("#namaKeluarga").append(`<option>${data.nama}</option>`)
            })
        }
    })
})

$("#hubungan").change( function(){
    // alert(this.value);
    let hubungan = this.value;
    let anak = $("#namaKeluarga").val();
    let endpoint;
    let result = "";
    switch(hubungan){
        case 'anak':
            endpoint = apiurl + '/anak/'+anak;
            break;
        case 'anakL':
            endpoint = apiurl + '/anak/'+anak+'/L';
            break;
        case 'anakP':
            endpoint = apiurl + '/anak/'+anak+'/P';
            break;
        case 'cucu':
            endpoint = apiurl + '/cucu/'+anak;
            break;
        case 'cucuL':
            endpoint = apiurl + '/cucu/'+anak+'/L';
            break;
        case 'cucuP':
            endpoint = apiurl + '/cucu/'+anak+'/P';
            break;
        case 'sepupu':
            endpoint = apiurl + '/sepupu/'+anak;
            break;
        case 'sepupuL':
            endpoint = apiurl + '/sepupu/'+anak+'/L';
            break;
        case 'sepupuP':
            endpoint = apiurl + '/sepupu/'+anak+'/P';
            break;
        case 'paman':
            endpoint = apiurl + '/paman/'+anak;
            break;
        case 'bibi':
            endpoint = apiurl + '/bibi/'+anak;
            break;
        default:
    }

    $.getJSON({
        url: endpoint,
        success: function(res){
            $("#kerabat").html('');

            $.each(res.klg, function(i,data){
                result = result + data.nama + ", ";
            })
            result = result.slice(0, -2);
            $("#kerabat").append(result);
        }
    })
})

$("#dataKeluarga").on('click','.tambahanak',function(){
    let par, generasiKe, parentId;
    par = this.id.split('x');
    parentId = par[0];
    generasiKe = parseInt(par[1]) + 1;

    // id,parentId,generasike,urutKe,nama,jnKelamin
    $("#fkg_id").val(null);
    $("#fkg_method").val('POST');
    $("#fkg_parentId").val(parentId);
    $("#fkg_generasiKe").val(generasiKe);
    $("#modalKeluarga").modal('show');

})

$("#dataKeluarga").on('click','.editanak',function(){
    let par, id , generasiKe, parentId, updateUrl;
    par = this.id.split('x');
    id = par[0];
    generasiKe = par[1];
    parentId = par[2];

    
    updateUrl = updurl.replace(":id",id);
    $("form").prop('action',updateUrl);
    // alert(updateUrl);
    let urutKe = $(this).parent('div').parent('td').parent('tr').children('td:nth-child(4)').text().trim();
    let nama = $(this).parent('div').parent('td').parent('tr').children('td:nth-child(5)').text().trim();
    
    $("#fkg_id").val(id);
    $("#fkg_method").val('PUT');
    $("#fkg_parentId").val(parentId);
    $("#fkg_generasiKe").val(generasiKe);
    $("#fkg_urutKe").val(urutKe);
    $("#fkg_nama").val(nama);
    $("#modalKeluarga").modal('show');

})

$("#dataKeluarga").on('click','.usiranak',function(event){
    let tenan = confirm("Data akan dihapus!");
    if( tenan == false ){
        event.preventDefault();
    }
})