$('#myTable').DataTable({
    "order": [],
    "sFilterInput": "form-control",
    "sLengthSelect": "form-control form-control-sm",
    "language": {
        "sSearch": "Tìm Kiếm:",
        "lengthMenu": "Hiển Thị _MENU_ dòng",
        "zeroRecords": "Không tìm thấy kết quả phù hợp",
        "info": "Hiển thị _START_  đến _END_  của _TOTAL_ dòng",
        "infoEmpty": "Hiển thị 0 đến 0 của 0 dòng ",
        "infoFiltered": "(Đã lọc từ _MAX_ dòng)",
        "oPaginate": {
            "sFirst": "Sau",
            "sPrevious": "Trước",
            "sNext": "Sau",
            "sLast": "Trước"
        }
    }
});

function formatGia(input) {
    input.value = parseFloat(input.value.replace(/,/g, ""))
        .toFixed(0)
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

function dinhDangGia(input) {
    var giaTri = input.value.split(","); // format tien ,,, lai thanh so
    var temp = "";
    for (var i = 0; i < giaTri.length; i++) {
        temp += giaTri[i];
    }
    input.value = parseFloat(temp);
    if (isNaN(input.value)) {
        input.value = 0;
    } else {
        formatGia(input);
    }
};
// Hien & An Gia Khuyen Mai
$('#noiDungGiaKhuyenMai').hide();
$('#giaKhuyenMai').hide();

function hienThiGiaKhuyenMai() {
    var giaKhuyenMaiCheck = document.getElementById('giaKhuyenMaiCheck');
    var giaKhuyenMai = document.getElementById('giaKhuyenMai');
    if (giaKhuyenMaiCheck.checked) {
        $('#noiDungGiaKhuyenMai').show();
        $('#giaKhuyenMai').show();
    } else {
        $('#noiDungGiaKhuyenMai').hide();
        $('#giaKhuyenMai').hide();
    }
    giaKhuyenMai.required = giaKhuyenMaiCheck.checked;
};

// ONLY DEV
// =======================================================

if (window.localStorage.getItem('hs-builder-popover') === null) {
    $('#builderPopover').popover('show')
        .on('shown.bs.popover', function() {
            $('.popover').last().addClass('popover-dark')
        });

    $(document).on('click', '#closeBuilderPopover', function() {
        window.localStorage.setItem('hs-builder-popover', true);
        $('#builderPopover').popover('dispose');
    });
} else {
    $('#builderPopover').on('show.bs.popover', function() {
        return false
    });
}

// END ONLY DEV
// =======================================================


// BUILDER TOGGLE INVOKER
// =======================================================
$('.js-navbar-vertical-aside-toggle-invoker').click(function() {
    $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
});


// INITIALIZATION OF MEGA MENU
// =======================================================
var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
    desktop: {
        position: 'left'
    }
}).init();



// INITIALIZATION OF NAVBAR VERTICAL NAVIGATION
// =======================================================
var sidebar = $('.js-navbar-vertical-aside').hsSideNav();


// INITIALIZATION OF TOOLTIP IN NAVBAR VERTICAL MENU
// =======================================================
$('.js-nav-tooltip-link').tooltip({
    boundary: 'window'
})

$(".js-nav-tooltip-link").on("show.bs.tooltip", function(e) {
    if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
        return false;
    }
});


// INITIALIZATION OF UNFOLD
// =======================================================
$('.js-hs-unfold-invoker').each(function() {
    var unfold = new HSUnfold($(this)).init();
});


// INITIALIZATION OF FORM SEARCH
// =======================================================
$('.js-form-search').each(function() {
    new HSFormSearch($(this)).init()
});


// INITIALIZATION OF SELECT2
// =======================================================
$('.js-select2-custom').each(function() {
    var select2 = $.HSCore.components.HSSelect2.init($(this));
});