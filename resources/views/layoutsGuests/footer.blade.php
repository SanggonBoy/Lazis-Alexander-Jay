@section('footer')
    <footer class="footer py-4" id="privacy&policy">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Lazis 2024</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    {{-- <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i
                            class="fab fa-linkedin-in"></i></a> --}}
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!" data-bs-toggle="modal"
                        data-bs-target="#privacy">
                        Privacy Policy
                    </a>
                    <a class="link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#terms"
                        href="#!">Terms of Use</a>
                </div>

                {{-- policy --}}
                <div class="modal fade" id="privacy" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Privacy Policy</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                "Komitmen Privacy & Policy Kami di LAZIS menghargai dan melindungi privasi setiap pengguna
                                kami.
                                Kami dengan tulus memahami pentingnya informasi pribadi Anda. Dengan menggunakan layanan
                                kami,
                                Anda setuju dengan kebijakan privasi ini. Kami bertekad untuk melindungi data pribadi Anda
                                sebagaimana yang diatur dalam kebijakan privasi ini.
                                Setiap informasi yang Anda berikan kepada kami akan dijaga kerahasiaannya sesuai dengan
                                standar keamanan yang ketat.
                                Kami tidak akan menyebarkan atau memanfaatkan informasi pribadi Anda tanpa izin Anda."
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- terms --}}
                <div class="modal fade" id="terms" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Terms of Use</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                "Syarat Penggunaan Layanan Zakat: Dengan menggunakan layanan kami di LAZIS, Anda setuju
                                untuk mematuhi syarat-syarat berikut ini.
                                Layanan yang kami sediakan bertujuan untuk memberikan informasi tentang zakat dan
                                menghubungkan Anda dengan sumber daya yang sesuai.
                                Anda setuju untuk menggunakan informasi yang diberikan hanya untuk tujuan yang sah dan
                                sesuai dengan prinsip-prinsip zakat.
                                Kami tidak bertanggung jawab atas kesalahan interpretasi atau penggunaan informasi yang
                                disediakan di situs kami.
                                Anda setuju untuk menggunakan layanan kami dengan penuh tanggung jawab dan menghormati hak
                                privasi pengguna lain.
                                Pelanggaran terhadap syarat penggunaan ini dapat mengakibatkan penghentian akses Anda ke
                                situs kami.
                                Dengan menggunakan layanan kami, Anda menyetujui semua syarat dan ketentuan yang tercantum
                                di sini."
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Privacy&Terms --}}
                <div class="modal fade" id="pt" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Privacy Policy & Terms of Use</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-bg-success">Privacy & Policy</p>
                                "Komitmen Privacy & Policy Kami di LAZIS menghargai dan melindungi privasi setiap pengguna
                                kami.
                                Kami dengan tulus memahami pentingnya informasi pribadi Anda. Dengan menggunakan layanan
                                kami,
                                Anda setuju dengan kebijakan privasi ini. Kami bertekad untuk melindungi data pribadi Anda
                                sebagaimana yang diatur dalam kebijakan privasi ini.
                                Setiap informasi yang Anda berikan kepada kami akan dijaga kerahasiaannya sesuai dengan
                                standar keamanan yang ketat.
                                Kami tidak akan menyebarkan atau memanfaatkan informasi pribadi Anda tanpa izin Anda."
                                <hr>
                                <p class="text-bg-success">Terms of Use</p>
                                "Syarat Penggunaan Layanan Zakat: Dengan menggunakan layanan kami di LAZIS, Anda setuju
                                untuk mematuhi syarat-syarat berikut ini.
                                Layanan yang kami sediakan bertujuan untuk memberikan informasi tentang zakat dan
                                menghubungkan Anda dengan sumber daya yang sesuai.
                                Anda setuju untuk menggunakan informasi yang diberikan hanya untuk tujuan yang sah dan
                                sesuai dengan prinsip-prinsip zakat.
                                Kami tidak bertanggung jawab atas kesalahan interpretasi atau penggunaan informasi yang
                                disediakan di situs kami.
                                Anda setuju untuk menggunakan layanan kami dengan penuh tanggung jawab dan menghormati hak
                                privasi pengguna lain.
                                Pelanggaran terhadap syarat penggunaan ini dapat mengakibatkan penghentian akses Anda ke
                                situs kami.
                                Dengan menggunakan layanan kami, Anda menyetujui semua syarat dan ketentuan yang tercantum
                                di sini."
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
