    $("#file").change(function(){
        $('#file_old').hide();
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
        
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
