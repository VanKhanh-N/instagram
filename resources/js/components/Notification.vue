   <template>
   <li class="d-inline-block position-relative noti">
      <a href="javascript:;" class="position-relative">
      <img class="mr-20 rounded-circle w-30 heart" src="/img/heart.png">
      <span class="count-action">{{notifications.length }}</span>
      </a>
      <ul class="notification  d-none set-noti-width">

         <li class="position-relative" v-for="notification in notifications" >
            <a href="#" v-on:click="MarkAsRead(notification)">
               <div class="noti-img">
                  <img :src="'uploads/user/'+notification.data.post.user.avatar" class="rounded-circle">
               </div>
               <div class="noti-content" > 
                     <p>{{notification.data.post.user.c_name}}</p>
                     <span>Đã bình luận về bài viết của bạn</span>
                     <span class="time">10 tuần trước</span>  
                  <!-- <button>Theo doi</button>  -->
               </div>   
            </a>
         </li> 
         <li v-if="notifications.length ==0">
             <div class="no-action">  Bạn không có hoạt động mới nào </div>
         </li>
      </ul>
   </li>
</template>
<script>
   export default {
      props:['notifications'],
      methods: {
         MarkAsRead:function(notification) {
            var data ={
               id:notification.id
            };
            
            axios.post('/notification/read',data).then(res =>{
               window.location.href ="/p/"+notification.data.post.id;

            })
         }
      },
   }
</script>