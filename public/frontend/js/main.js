/*
Template Name: ShopGrids - Bootstrap 5 eCommerce HTML Template.
Author: GrayGrids
*/

(function () {
    //===== Prealoder

    window.onload = function () {
        window.setTimeout(fadeout, 500);
    };

    function fadeout() {
        document.querySelector(".preloader").style.opacity = "0";
        document.querySelector(".preloader").style.display = "none";
    }

    /*=====================================
    Sticky
    ======================================= */
    window.onscroll = function () {
        var header_navbar = document.querySelector(".navbar-area");
        var sticky = header_navbar.offsetTop;

        // show or hide the back-top-top button
        var backToTo = document.querySelector(".scroll-top");
        if (
            document.body.scrollTop > 50 ||
            document.documentElement.scrollTop > 50
        ) {
            backToTo.style.display = "flex";
        } else {
            backToTo.style.display = "none";
        }
    };

    //===== mobile-menu-btn
    let navbarToggler = document.querySelector(".mobile-menu-btn");
    navbarToggler.addEventListener("click", function () {
        navbarToggler.classList.toggle("active");
    });

    $(".images-list").on("click", function () {
        let id = $(this).data("id");
        let current = $("#current").data("id");
        // console.log(id);
        // console.log(current);
        let src_click = $(this).attr("src");
        let src_curr = $("#current").attr("src");

        $(this).attr("src", src_curr);
        $("#current").attr("src", src_click);
        $(this).data("id", current);
        $("#current").data("id", id);

        // Array.from(images).forEach(element => {
        //     console.log(element)
        // });
    });
})();

$("#lang").on("change", function () {
    window.location = $(this).val();
});

$("#profileChange").on("change", function () {
    const file = this.files[0];
    console.log(file);
    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
            console.log(event.target.result);
            $("#editProfileShow").attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
    }
});

$(".deleteBtn").on("click", function (e) {
    e.preventDefault();
    var form = $(this).parents("form");
    Swal.fire({
        title: "Delete Data : " + $(this).attr("value") + " ?",
        text: "This action can't be undone!",
        icon: "question",
        showDenyButton: true,
        confirmButtonText: "Delete",
        denyButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            return true;
        } else if (result.isDenied) {
            Swal.fire("Action Canceled!", "", "info");
            return false;
        }
    });
});

$(".denyBtn").on("click", function (e) {
    e.preventDefault();
    var form = $(this).parents("form");
    Swal.fire({
        title: "Deny Game : " + $(this).attr("value") + " ?",
        text: "This action can't be undone!",
        icon: "question",
        showDenyButton: true,
        confirmButtonText: "Deny",
        denyButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            return true;
        } else if (result.isDenied) {
            Swal.fire("Action Canceled!", "", "info");
            return false;
        }
    });
});

$(".removeBtn").on("click", function (e) {
    e.preventDefault();
    var form = $(this).parents("form");
    Swal.fire({
        title: "Remove : " + $(this).attr("value") + " ?",
        text: "This action will remove this game from your wishlist!",
        icon: "question",
        showDenyButton: true,
        confirmButtonText: "Remove",
        denyButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            return true;
        } else if (result.isDenied) {
            Swal.fire("Action Canceled!", "", "info");
            return false;
        }
    });
});
