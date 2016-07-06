(function ($) {
	"use strict";
	$(document).ready(function(){
    $("#palto_autoplay1").attr("data-labelauty","Active");
    $("#palto_autoplay2").attr("data-labelauty","Hide");

    $("#falto_arrows1").attr("data-labelauty","Active");
    $("#falto_arrows2").attr("data-labelauty","Hide");

    $("#falto_dots1").attr("data-labelauty","Active");
    $("#falto_dots2").attr("data-labelauty","Hide");
	
    $("#use_border1").attr("data-labelauty","Yes");
    $("#use_border2").attr("data-labelauty","No");
	
    $("#position_border1").attr("data-labelauty","No border");
    $("#position_border2").attr("data-labelauty","Full carousel border");
    $("#position_border3").attr("data-labelauty","Carousel items border");
	
    $("#falto_center_mode1").attr("data-labelauty","Active");
    $("#falto_center_mode2").attr("data-labelauty","Hide");

    $("#use_lightbox1").attr("data-labelauty","Active");
    $("#use_lightbox2").attr("data-labelauty","Hide");

    $("#img_hover1").attr("data-labelauty","Active");
    $("#img_hover2").attr("data-labelauty","Hide");

    $("#arrows_icons1").attr("data-labelauty","<i class=\"icon-left-1\"></i><i class=\"icon-right-1\"></i>");
	
    $("#arrows_icons2").attr("data-labelauty","<i class=\"icon-left-2\"></i><i class=\"icon-right-2\"></i>");
    $("#arrows_icons3").attr("data-labelauty","<i class=\"icon-left-3\"></i><i class=\"icon-right-3\"></i>");
    $("#arrows_icons4").attr("data-labelauty","<i class=\"icon-left-4\"></i><i class=\"icon-right-4\"></i>");
    $("#arrows_icons5").attr("data-labelauty","<i class=\"icon-left-5\"></i><i class=\"icon-right-5\"></i>");
    $("#arrows_icons6").attr("data-labelauty","<i class=\"icon-left-6\"></i><i class=\"icon-right-6\"></i>");
    $("#arrows_icons7").attr("data-labelauty","<i class=\"icon-left-7\"></i><i class=\"icon-right-7\"></i>");
    $("#arrows_icons8").attr("data-labelauty","<i class=\"icon-left-8\"></i><i class=\"icon-right-8\"></i>");
    $("#arrows_icons9").attr("data-labelauty","<i class=\"icon-left-9\"></i><i class=\"icon-right-9\"></i>");
    $("#arrows_icons10").attr("data-labelauty","<i class=\"icon-left-10\"></i><i class=\"icon-right-10\"></i>");
    $("#arrows_icons11").attr("data-labelauty","<i class=\"icon-left-11\"></i><i class=\"icon-right-11\"></i>");

    

	
    $("[name='palto_autoplay']").labelauty({ minimum_width: "80px" });
    $("[name='falto_arrows']").labelauty({ minimum_width: "80px" });
    $("[name='falto_dots']").labelauty({ minimum_width: "80px" });
    $("[name='falto_direction']").labelauty({ minimum_width: "80px" });
    $("[name='use_border']").labelauty({ minimum_width: "80px" });
    $("[name='use_lightbox']").labelauty({ minimum_width: "80px" });
    $("[name='img_hover']").labelauty({ minimum_width: "80px" });
    $("[name='position_border']").labelauty({ minimum_width: "80px" });
    $("[name='falto_center_mode']").labelauty({ minimum_width: "80px" });
    $("[name='arrows_icons']").labelauty({ minimum_width: "80px" });
    
	});
}(jQuery));	