<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("movetop").style.display = "block";
        } else {
            document.getElementById("movetop").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
<!-- //move top -->

<!-- common jquery plugin -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<!-- //common jquery plugin -->

<!-- magnific popup -->
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',

            fixedContentPos: false,
            fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true,
            preloader: false,

            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });

        $('.popup-with-move-anim').magnificPopup({
            type: 'inline',

            fixedContentPos: false,
            fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true,
            preloader: false,

            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-slide-bottom'
        });
    });
</script>
<!-- //magnific popup -->

<!-- counter for stats -->
<script src="{{asset('js/counter.js')}}"></script>
<!-- //counter for stats -->

<!-- theme switch js (light and dark)-->
<script src="{{asset('js/theme-change.js')}}"></script>
<script>
    function autoType(elementClass, typingSpeed) {
        var thhis = $(elementClass);
        thhis.css({
            "position": "relative",
            "display": "inline-block"
        });
        thhis.prepend('<div class="cursor" style="right: initial; left:0;"></div>');
        thhis = thhis.find(".text-js");
        var text = thhis.text().trim().split('');
        var amntOfChars = text.length;
        var newString = "";
        thhis.text("|");
        setTimeout(function () {
            thhis.css("opacity", 1);
            thhis.prev().removeAttr("style");
            thhis.text("");
            for (var i = 0; i < amntOfChars; i++) {
                (function (i, char) {
                    setTimeout(function () {
                        newString += char;
                        thhis.text(newString);
                    }, i * typingSpeed);
                })(i + 1, text[i]);
            }
        }, 1500);
    }

    $(document).ready(function () {
        // Now to start autoTyping just call the autoType function with the 
        // class of outer div
        // The second paramter is the speed between each letter is typed.   
        autoType(".type-js", 200);
    });
</script>
<!-- //theme switch js (light and dark)-->

<!-- MENU-JS -->
<script>
    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 80) {
            $("#site-header").addClass("nav-fixed");
        } else {
            $("#site-header").removeClass("nav-fixed");
        }
    });

    //Main navigation Active Class Add Remove
    $(".navbar-toggler").on("click", function () {
        $("header").toggleClass("active");
    });
    $(document).on("ready", function () {
        if ($(window).width() > 991) {
            $("header").removeClass("active");
        }
        $(window).on("resize", function () {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
        });
    });
</script>
<!-- //MENU-JS -->

<!-- disable body scroll which navbar is in active -->
<script>
    $(function () {
        $('.navbar-toggler').click(function () {
            $('body').toggleClass('noscroll');
        })
    });
</script>
<!-- //disable body scroll which navbar is in active -->

<!--bootstrap-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- //bootstrap-->
<!-- //Js scripts -->