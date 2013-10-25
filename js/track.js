function disable_track(track_id)
{
    bootbox.confirm("Вы хотите отключить данный трек?",function(res)
    {
        if (res)
        {
            $.ajax({
                type:"GET",
                url: curl+"/products/disable/?id="+track_id,
                success: function(data){
                    $("#tr_"+track_id).hide();
                }
            });
        }
    });
}