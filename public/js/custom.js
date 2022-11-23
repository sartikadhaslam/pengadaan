    $("#file").change(function(){
        $('#file_old').hide();
    });

    $("#surat_tagihan").change(function(){
        $('#st_old').hide();
    });

    $("#packing_list").change(function(){
        $('pl_old').hide();
    });
    
    function validateForm(){
        if (confirm("Yakin data akan dihapus?") == true) {
        return true;
        } else {
        return false;
        }
    }

    function validateFormAjukan(){
        if (confirm("Yakin data akan diproses?") == true) {
        return true;
        } else {
        return false;
        }
    }
        
