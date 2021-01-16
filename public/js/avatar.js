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
 
  var url="/upload_user";
  $.ajax({
       type: 'POST',
       data: formData,
       dataType: 'JSON',
       contentType: false,
       cache: false,
       processData: false,
       url:url,
       success:function(e){  
        location.reload(); 
       }
  })
} 

 
//remove_current_photo
$('.remove_current_photo').on('click',function(){
var url="/delete";
$('#myModal-5').hide();  
$('.avatar_user_uploaded').attr('src','/img/no-user.png');  
 $.get({
    url:url,
    success:function(){
        location.reload();
    }
 })
}) 