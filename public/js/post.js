//like
function likepost(postId){    
    $.get({
        url:"/like/post",
        data:{r_post:postId},
        success:function(e){     
        $('.like'+postId).text(e.p_favourite+' lượt thích');
        $('.likes'+postId).text(e.p_favourite);
        }
    })
 }  
//folow 

function follow(followed){      
    $.get({
        url:"/follow",
        data:{followed:followed},
        success:function(data){ 
            $('.follower').text(data.user.follower);
            if(data.user.follower==1){
                document.getElementsById("k-none").Classlist.add('d-none');
            }   
        }
    })
}
 