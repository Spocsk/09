var res = document.querySelector("#res");
 
$("form#data").submit(function(e) {
   e.preventDefault();    
   var formData = new FormData(this);

   $.ajax({
       url: "upload.php",
       type: 'POST',
       data: formData,
       success: function (data) {
         console.log(data);
        res.innerHTML = "Status : " + data;
       },
       cache: false,
       contentType: false,
       processData: false,
       crossOrigin: null
   });
});


