AOS.init({
	once: true
})

$(document).ready(function(){

	$(".review_slider").slick({
		slidesToShow:1,
		loop: true,
		dots: false,
		autoplay: true,
		autoplaySpeed: 3000,
		speed: 300,
		centerMode: false,
		nextArrow: '<button class="navs previous"><i class="bi bi-chevron-right"></i></button>',
		prevArrow: '<button class="navs next"><i class="bi bi-chevron-left"></i></button>'
		// responsive: [
		//     {
		//       breakpoint: 1024,
		//       settings: {
		//         slidesToShow: 3,
		//         slidesToScroll: 3,
		//         infinite: true,
		//         dots: true
		//       }
		//     },
		//     {
		//       breakpoint: 600,
		//       settings: {
		//         slidesToShow: 2,
		//         slidesToScroll: 2,
		//         initialSlide: 2
		//       }
		//     },
		//     {
		//       breakpoint: 480,
		//       settings: {
		//         slidesToShow: 1,
		//         slidesToScroll: 1
		//       }
		//     }
		//   ]
	});


	$(".review_slider2").slick({
		slidesToShow:1,
		loop: true,
		dots: true,
		autoplay: true,
		autoplaySpeed: 3000,
		speed: 300,
		centerMode: false,
		nextArrow: '<button class="navs previous"><i class="bi bi-chevron-right"></i></button>',
		prevArrow: '<button class="navs next"><i class="bi bi-chevron-left"></i></button>'
		// responsive: [
		//     {
		//       breakpoint: 1024,
		//       settings: {
		//         slidesToShow: 3,
		//         slidesToScroll: 3,
		//         infinite: true,
		//         dots: true
		//       }
		//     },
		//     {
		//       breakpoint: 600,
		//       settings: {
		//         slidesToShow: 2,
		//         slidesToScroll: 2,
		//         initialSlide: 2
		//       }
		//     },
		//     {
		//       breakpoint: 480,
		//       settings: {
		//         slidesToShow: 1,
		//         slidesToScroll: 1
		//       }
		//     }
		//   ]
	});
 
});



	function onSubmit(token) {
		if($("#sendRequestForm").length && $("#sendRequestForm").get(0).reportValidity()){
			$("#sendRequestForm").trigger("submit");
		}
	}

// $(document).ready(function(){})
if(sessionStorage.getItem("mailresponse") == 'true'){
	swal("success","Request Sent To Admin");
}else if(sessionStorage.getItem("mailresponse") == 'false'){
	swal("error","Something Went Wrong");
}

sessionStorage.removeItem("mailresponse");

	if($("#sendRequestForm").length){
		$("#sendRequestForm").submit(function(event){
			event.preventDefault();
			Loader.open();
			$.post("php/sendmail.php", $("#sendRequestForm").serialize() ,function(data,status){
				if(status == "success" && data.hasOwnProperty("success") && data.success == true){
					swal("success","Request Sent To Admin");
				}else{
					swal("error","Something Went Wrong");
				}
				grecaptcha.reset();
				Loader.close()
			});
		});
	}

// if($(".btn_type.g-recaptcha").length){
// 	$(".btn_type.g-recaptcha").click(function(){
// 		$.post("../php/sendmail.php", new FormData(document.getElementById("sendRequestForm")),function(data,status){
// 			console.log(data,status);
// 		});
// 	})
// }
