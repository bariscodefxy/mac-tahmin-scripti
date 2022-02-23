<section class="container-sm" id="mac-container">
    Tahminler yükleniyor...
</section>
<script>
    setInterval(() => {
        $.ajax({
            url: "/api/canlimaclar.php?tarih=<?= date("d/m/Y") ?>&token=<?= getToken() ?>",
            dataType: "JSON",
            data: {},
            type:"POST",
            success: function(response){
                let maclar = response.maclar;
                let html = `<h1 class='display-2 text-center fw-bold'>Tahminler</h1>
                    <table class='table table-responsive table-dark table-bordered table-hover'>
                      <tr>
                        <th>Dakika</th>
                        <th>Ev Sahibi</th>
                        <th>Deplasman</th>
                        <th>Skor</th>
                        <th>İşlemler</th>
                      </tr>`;
                maclar.forEach(mac => {
                	console.log(mac)
                    html += `<tr><td>${mac[6]}</td><td>${mac[2]}</td><td>${mac[4]}</td><td>${mac[12]} - ${mac[13]}</td><td><a href="<?= app_base ?>tahmin/${mac[1]}">Tahmine Git</a></td></tr>`;
                });
                html += "</table>";
                $('#mac-container').html(html);
            }
        })
    }, 1000)
</script>
