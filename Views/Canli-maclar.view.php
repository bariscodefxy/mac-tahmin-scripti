<section class="container-sm" id="mac-container">
    Maçlar yükleniyor...
</section>
<script>
    setInterval(() => {
        $.ajax({
            url: "/api/canlimaclar.php?tarih=<?= date("d/m/Y") ?>",
            type:"POST",
            success: function(response){
                $('#mac-container').html(response)
            }
        })
    }, 1000)
</script>