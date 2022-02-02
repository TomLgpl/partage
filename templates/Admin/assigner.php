<div class="ui basic segment">

    <h2 class="ui header" style="border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 2%"><?= __('Assigner des photos') ?></h2>

    <br>
    <div id="nb_a_assigner"></div>

</div>

<script>

    $(document).ready(function(){
        updateNbAAssigner();
    });

    function updateNbAAssigner(){
        $.ajax({
            url: "admin/nbAAssigner",
            type: "post",
            success: function (data) {
                nb = parseInt(data);
                div = $('#nb_a_assigner');
                if(nb === 0)
                    div.text("<?= __('Aucune photo n\'est à assigner.') ?>");
                else if(nb === 1)
                    div.text("<?= __('Il reste 1 photo à assigner') ?>");
                else if(nb > 1)
                    div.text("<?= __('Il reste ') ?>" + nb + "<?= __(' photos à assigner.') ?>");
            },
            error: function () {
                console.log('erreur');
            }
        });
    }

</script>
