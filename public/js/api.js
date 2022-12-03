var app_url = base_url;

function ajaxGetApi(url,success_var,error_var)
{    
    $.ajax({
        url: base_url+url,                
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method:"GET",
        dataType:'json',
        success: function(result){                        
            success_var(result);
        },
        error: function(result){
            error_var(result);
        }
    });
}