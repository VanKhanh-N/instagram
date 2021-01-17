//  add and update avatar  
function uploadUserAvatar(input,form){ 
   UpdateUserAvatar(form); 
}

function ReadUrl(input){
$('#myModal-5').hide();
 if(input.files && input.files[0]){
    var reader =new FileReader();
    reader.onload= function(e){
       $('.avatar_user_uploaded').attr('src',e.target.result); 
    }
 } 
 reader.readAsDataURL(input.files[0]);
}
function UpdateUserAvatar(form){
 let myForm = document.getElementById(form);
 let formData = new FormData(myForm);
 $('#myModal-5').hide();
  var url="/upload_user";
  $.ajax({
       type: 'POST',
       data: formData,
       dataType: 'JSON',
       contentType: false,
       cache: false,
       processData: false,
       url:url,
       beforeSend:function(){
         $('.imguser').show();
         $('.avatar_user_uploaded').addClass('constrast');
       },
       complete:function(){
         $('.avatar_user_uploaded').removeClass('constrast');
         $('.imguser').hide();
       },
       success:function(e){    
         $('.img').empty();
         $('.img').prepend(`
         <img src="uploads/user/'+${e.avatar}" class="rounded-circle user cs avatar_user_uploaded" id="myBtn-5">
         <img src="img/loading.gif" class=" uploadavatar imguser" style="display:none;">
         `);
         $('.avatar_user_uploaded').attr('src','uploads/user/'+e.avatar);
       }
  })
} 

 
//remove_current_photo
$('.remove_current_photo').on('click',function(){
var url="/delete"; 
$('#myModal-5').hide();    
 $.get({
    url:url,
    beforeSend:function(){
      $('.imguser').show();
      $('.avatar_user_uploaded').addClass('constrast');
    },
    complete:function(){
      $('.imguser').hide();
      $('.avatar_user_uploaded').removeClass('constrast');
    },success:function(){
    $('.img').empty();
    $('.img').prepend(`
    <label for="upload_user_avatar"> <img src="/img/no-user.png" class="rounded-circle user cs avatar_user_uploaded"></label> 
    <img src="img/loading.gif" class=" uploadavatar imguser" style="display:none;">
    `);
    $('.avatar_user_uploaded').attr('src','/img/no-user.png');
    }
 })
}) 