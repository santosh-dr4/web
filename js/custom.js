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
			$.post("https://mbrinformatics.com/DEV/Dr4/sendmail.php", $("#sendRequestForm").serialize() ,function(data,status){
				if(status == "success" && data.hasOwnProperty("success") && data.success == true){
					swal("success","Request Sent To Admin");
				}else{
					swal("error","Something Went Wrong");
				}
				Loader.close();
			});

			// $.ajax({
			// 	url : "http://dr4.mbrinfo.com/mailphp_dr4/sendmail.php",
			// 	async: false,
			// 	beforeSend: function(xhr,setting){
			// 		console.log("beforesend",xhr,setting);
			// 		xhr.setRequestHeader("Access-Control-Allow-Headers", "Origin, Content-Type, Accept");
			// 		xhr.setRequestHeader("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT");
			// 		xhr.setRequestHeader("Access-Control-Allow-Origin","http://shrvnkummr.com/");
			// 		// xhr.overrideMimeType("text/plain; charset=x-user-defined" );
			// 	},
			// 	cache : false,
			// 	complete : function(xhr,statustext){
			// 		console.log("complete",xhr,statustext);
			// 	},
			// 	// contentType : "application/x-www-form-urlencoded; charset=UTF-8",
			// 	dataType: "json",
			// 	error : function(error){
			// 		debugger;
			// 		console.log("error",error);
			// 	},

			// 	contents: {
			// 		mycustomtype: "mycustomtype",
			// 	},
			// 	method : "GET",
			// 	// xhrFields: {
			// 	// 	withCredentials: true
			// 	// },
			// 	// crossDomain : true,
			// 	// data : $("#sendRequestForm").serialize(),
			// 	success : function(data,status){
			// 		console.log(data,status);
			// 	},
			// }).done(function(data){
			// 	grecaptcha.reset();
			// 	Loader.close();
			// });
		});
	}

// if($(".btn_type.g-recaptcha").length){
// 	$(".btn_type.g-recaptcha").click(function(){
// 		$.post("../php/sendmail.php", new FormData(document.getElementById("sendRequestForm")),function(data,status){
// 			console.log(data,status);
// 		});
// 	})
// }
