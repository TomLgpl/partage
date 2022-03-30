<div class="ui basic segment">
    <h2 class="ui header" ><?= __('Gérer les albums') ?></h2>
    <div style="border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 2%"></div>
    <br>
    <a class="ui button" id="btnalbum">album</a>
</div>


<script>

    $('#btnalbum').click(function(){
        $.ajax({
            url: "admin/getAlbum",
            type: "post"
        });
    });

</script>
