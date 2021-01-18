//like
function likepost(postId){    
    $.get({
        url:"/like/post",
        data:{r_post:postId},
        success:function(e){     
        $('.like'+postId).text(e.p_favourite);
        $('.likes'+postId).text(e.p_favourite);
        }
    })
 }  
//folow 

function follow(followed){      
    $.get({
        url:"/follow",
        data:{followed:followed},
        beforeSend:function(){
            //welcome (Gợi ý cho bạn)
            $('.load'+followed).show();
            $('.follow'+followed).hide();
            //button gần user
            $('.follow').addClass('os');   
            $('.unfollow').addClass('os');  
            $('.text-follows'+followed).empty();
            $('.fa-user-times').addClass('d-none');
            
        },
        complete:function(){
            //welcome (Gợi ý cho bạn)
            $('.load'+followed).hide();
            $('.follow'+followed).show();
            //button gần user
            $('.follow').removeClass('os');
            $('.unfollow').removeClass('os');
        },
        success:function(data){  
            $('.list-follow').empty();
            $('.follower').text(data.user.follower);
            if(data.action =='bot'){
            //welcome (Gợi ý cho bạn)
            $('.follow'+followed).text('Theo dõi');
           //button gần user
           $('.list-follow').prepend(` 
           <button class="follow" onclick="follow('${data.user.id}')">
                 <img src="img/loading.gif" class="w-30 load${data.user.id}" style="display:none">
                 <p class="text-follows${data.user.id}">Theo dõi</p>
            </button>  
           `);
           //hiện user trong số người theo dõi
           if(!data.user.follower){
               $('.settingss').empty();
               $('.settingss').prepend(`
               <li class="k-none"><i class="fa fa-lg fa-user-plus"></i></li>
               <li class="k-none two">Người theo dõi</li>
               <li class="k-none three">Bạn sẽ thấy tất cả những người theo dõi bạn ở đây.</li>
               `);
           }else    $('.user'+data.auth.id).remove();  
            }
            else{
            //welcome(gợi ý cho bạn)
            $('.follow'+followed).text('Đang theo dõi');
             //button gần user
            $('.list-follow').prepend(` 
            <a href="/direct/${data.user.id}" class="message">Nhắn tin</a>
            <a class="unfollow follows${data.user.id} "href="javascript:;"  onclick="follow('${data.user.id}')"><i class="fa fa-user-times"></i>
            <img src="img/loading.gif" class="w-30 load${data.user.id}" style="display:none;margin-top: -11px;">
            </a>
            `);
            //user trong số người theo dõi
            if(data.user.follower==1) $('.settingss').empty();
            
            $('.settingss').prepend(`
                <li class="clr user${data.auth.id}" style="height: 50px;">
                     <a href="${data.auth.user}" class="zx position-relative ">
                     <img src="uploads/user/${data.auth.avatar}" class="w-35 rounded-circle"> 
                     <b class="zz">${data.auth.user}</b><br>
                     <b class="os">${data.auth.c_name}</b>
                     </a>
            `);
             
            
            }
        
        }
    })
}
 
//user trong số người theo dõi trong trang của người khác
function follows(followed){      
    $.get({
        url:"/follow",
        data:{followed:followed},
        beforeSend:function(){
             
            $('.load'+followed).show(); 
            
            $('.zc'+followed).addClass('os'); 
            $('.cen'+followed).text('');
            
        },
        complete:function(){ 
            $('.load'+followed).hide();
            $('.zc'+followed).removeClass('os');
        },
        success:function(data){
            $('.zc'+followed).toggleClass('follows');
            $('.zc'+followed).toggleClass('followss'); 
            if(data.action=='bot'){ 
                $('.cen'+followed).text('Theo dõi');
            }
            else{ 
            $('.cen'+followed).text('Đang theo dõi');
            }
        }
    })
    }

    
 //user trong số  người đang theo dõi trong auth
function followss(followed){      
    $.get({
        url:"/follow",
        data:{followed:followed},
        beforeSend:function(){
             
            $('.load'+followed).show(); 
           
            $('.zc'+followed).addClass('os'); 
            $('.cen'+followed).text('');
            
        },
        complete:function(){
            //welcome (Gợi ý cho bạn)
            $('.load'+followed).hide();
            $('.zc'+followed).removeClass('os');
        },
        success:function(data){   
            $('.count').text(data.followed);
            $('.zc'+followed).toggleClass('follows');
            $('.zc'+followed).toggleClass('followss'); 
            if(data.action=='bot'){ 
                $('.cen'+followed).text('Theo dõi');
                if(!data.followed){
                    $('.list').empty();
                    $('.list').prepend(`
                    <li><i class="fa fa-lg fa-user-plus"></i></li>
                    <li class="two">Người đang theo dõi</li>
                    <li class="three">Bạn sẽ thấy tất cả những người bạn đang theo dõi ở đây.</li>
                    `);
                }
                else  $('.users'+followed).remove(); 
            }
            else{ 
            $('.cen'+followed).text('Đang theo dõi');
            if(data.followed==1) $('.list').empty();
            $('.list').prepend(`
            <li class="clr users${followed}" style="height: 50px;">
            <a href="${data.user.user}" class="zx position-relative">
            <img src="uploads/user/${data.user.avatar}" class="w-35 rounded-circle"> 
            <b class="zz">${data.user.user}</b><br>
            <b class="os">${data.user.c_name}</b>
            </a>
            <button class="followss zc${followed}" onclick="followss('${followed}')" ><cen class="cen${followed}">Đang theo dõi</cen>
            <img src="img/loading.gif" class="w-30 load${followed}" style="display:none;margin-top: -11px;">
            `);
            }
        }
    })
    }