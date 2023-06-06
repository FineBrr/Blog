<footer id="footer" class="bg-dark ">
    <div class="container section">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center">
                <a class="d-inline-block mb-4 pb-2 navbar-brand order-1 py-0" href="../index.php">
                    YourBlog
                </a>
                <ul class="p-0 d-flex navbar-footer mb-0 list-unstyled">
                    <li class="nav-item my-0"><a class="nav-link" href="../partials/about_author.php">Про автора</a>
                    </li>
                    <li class="nav-item my-0"><a class="nav-link" href="../users/contact.php">Контакт</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="copyright bg-dark content">©2023. YourBlog. Всі права захищені</div>
</footer>


<script>
    $(document).ready(function () {
        setInterval(function () {
            var docHeight = $(window).height();
            var footerHeight = $('#footer').height();
            var footerTop = $('#footer').position().top + footerHeight;
            var marginTop = (docHeight - footerTop + 10);

            if (footerTop < docHeight)
                $('#footer').css('margin-top', marginTop + 'px'); // padding of 30 on footer
            else
                $('#footer').css('margin-top', '0px');
            // console.log("docheight: " + docHeight + "\n" + "footerheight: " + footerHeight + "\n" + "footertop: " + footerTop + "\n" + "new docheight: " + $(window).height() + "\n" + "margintop: " + marginTop);
        }, 250);
    });
</script>

