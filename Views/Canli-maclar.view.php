<div class="alert alert-info m-3" role="alert">
  Sitemizdeki tahminleri görebilmek için kayıt olup parayla üyelik almanız gerekmektedir.
</div>
<section class="container-sm" id="mac-container">
    Maçlar yükleniyor...
</section>
<script>
    setInterval(() => {
        $.ajax({
            url: "/api/canlimaclar.php?tarih=<?= date("d/m/Y") ?>",
            dataType: "JSON",
            data: {},
            type:"POST",
            success: function(response){
                let maclar = response.maclar;
                let html = `<h1 class='display-2 text-center fw-bold'>Canlı Maç Sonuçları</h1>
                    <table class='table table-responsive table-dark table-bordered table-hover'>
                      <tr>
                        <th>Dakika</th>
                        <th>Ev Sahibi</th>
                        <th>Deplasman</th>
                        <th>Tahmin</th>
                        <th>Skor</th>
                      </tr>`;
                maclar.forEach(mac => {
                    html += `<tr><td>${mac[6]}</td><td>${mac[2]}</td><td>${mac[4]}</td><td>***</td><td>${mac[12]} - ${mac[13]}</td></tr>`;
                });
                html += "</table>";
                $('#mac-container').html(html);
            }
        })
    }, 1000)
</script>
