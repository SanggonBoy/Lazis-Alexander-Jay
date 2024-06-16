@section('services')
    <section class="page-section">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase" id="berita">Berita</h2>
                <h3 class="section-subheading text-muted"></h3>
                {{-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> --}}
            </div>
            <div class="row" id="berita-list">
            </div>
        </div>
    </section>



    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase" id="pelayanan">Pelayanan</h2>
                <h3 class="section-subheading text-muted"></h3>
                {{-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> --}}
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-success"></i>
                        <i class="fas fa-hand-holding-dollar fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Berzakat</h4>
                    <p class="text-muted">"Tinggallah di dalam setiap harta, satu bagian untuk menyucikan hati,
                        dan itulah zakat. Buah dari kasih dan tindakan penuh berkah"</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-success"></i>
                        <i class="fas fa-hand-holding-heart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Donasi</h4>
                    <p class="text-muted">"Seberkas cinta, setetes kebaikan.
                        Berdonasi adalah melodi hati yang mengalun indah, menyinari dunia dengan sinar kasih."</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-success"></i>
                        <i class="fas fa-handshake-angle fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Relawan</h4>
                    <p class="text-muted">"Relawan adalah kisah pahlawan tanpa tanda jasa,
                        menyulam harapan di setiap langkah, mengukir jejak kebaikan dalam tiap detik."</p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('/api/berita')
                .then(response => response.json())
                .then(data => {
                    if (data.status === "ok") {
                        const beritaList = document.getElementById('berita-list');
                        beritaList.innerHTML = ""; // Clear existing content
                        data.articles.forEach(article => {
                            const colDiv = document.createElement('div');
                            colDiv.classList.add('col-md-4', 'mb-4');

                            const card = document.createElement('div');
                            card.classList.add('card', 'h-100', 'shadow-sm');

                            const img = document.createElement('img');
                            img.src = article.urlToImage;
                            img.classList.add('card-img-top');
                            img.alt = article.title;

                            const cardBody = document.createElement('div');
                            cardBody.classList.add('card-body', 'd-flex', 'flex-column');

                            const cardTitle = document.createElement('h5');
                            cardTitle.classList.add('card-title');
                            cardTitle.textContent = article.title;

                            const cardText = document.createElement('p');
                            cardText.classList.add('card-text', 'flex-grow-1');
                            cardText.textContent = article.description;

                            const cardLink = document.createElement('a');
                            cardLink.href = article.url;
                            cardLink.textContent = "Baca Selengkapnya";
                            cardLink.classList.add('btn', 'btn-primary', 'mt-auto');
                            cardLink.target = "_blank";

                            cardBody.appendChild(cardTitle);
                            cardBody.appendChild(cardText);
                            cardBody.appendChild(cardLink);

                            card.appendChild(img);
                            card.appendChild(cardBody);

                            colDiv.appendChild(card);
                            beritaList.appendChild(colDiv);
                        });
                    } else {
                        console.error("Failed to fetch articles");
                    }
                })
                .catch(error => {
                    console.error("Error fetching data: ", error);
                });
        });
    </script>
@endsection
