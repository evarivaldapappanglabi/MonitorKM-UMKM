<footer>
    <!-- Footer Start-->
    <div class="footer-area">
        <div class="container">
            <div class="footer-top footer-padding">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Kontak</h4>
                                <p> 
                                    </p>
                                <p> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Tautan</h4>
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="footer-bottom">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-xl-9 col-lg-8">
                        <div class="footer-copy-right">
                            <p>
                                Dibuat Oleh : Eva Rivalda Pappang La'bi' | Teknik Informatika 2024
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="back-top">
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<script src="assets_home/assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="assets_home/assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="assets_home/assets/js/popper.min.js"></script>
<script src="assets_home/assets/js/bootstrap.min.js"></script>
<script src="assets_home/assets/js/jquery.slicknav.min.js"></script>
<script src="assets_home/assets/js/owl.carousel.min.js"></script>
<script src="assets_home/assets/js/slick.min.js"></script>
<script src="assets_home/assets/js/wow.min.js"></script>
<script src="assets_home/assets/js/animated.headline.js"></script>
<script src="assets_home/assets/js/jquery.magnific-popup.js"></script>
<script src="assets_home/assets/js/jquery.nice-select.min.js"></script>
<script src="assets_home/assets/js/jquery.sticky.js"></script>
<script src="assets_home/assets/js/contact.js"></script>
<script src="assets_home/assets/js/jquery.form.js"></script>
<script src="assets_home/assets/js/jquery.validate.min.js"></script>
<script src="assets_home/assets/js/mail-script.js"></script>
<script src="assets_home/assets/js/jquery.ajaxchimp.min.js"></script>
<script src="assets_home/assets/js/plugins.js"></script>
<script src="assets_home/assets/js/main.js"></script>
<script src="admin/assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script src="admin/assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="admin/assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script src="admin/assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/jquery/jquery.validate.min.js"></script>
<script src="assets/numeraljs/numeral.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tabel').DataTable();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script>
    feather.replace({
        'aria-hidden': 'true'
    });
    $(".togglePassword").click(function(e) {
        e.preventDefault();
        var type = $(this).parent().parent().find(".password").attr("type");
        console.log(type);
        if (type == "password") {
            $("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
            $(this).parent().parent().find(".password").attr("type", "text");
        } else if (type == "text") {
            $("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
            $(this).parent().parent().find(".password").attr("type", "password");
        }
    });
</script>
</body>

</html>