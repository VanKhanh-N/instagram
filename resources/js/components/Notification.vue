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
                  <!-- <img src="img/be-giang.png" class="rounded-circle"> -->
               </div>
               <div class="noti-content" > 
                     <p>{{notification.data.post.p_content}}</p>
                     <span>Đã bắt đầu theo dõi bạn</span>
                     <span class="time">10 tuần</span>  
                  <button>Theo doi</button> 
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
               window.location.href ="/post/"+notification.data.post.id
            })
         }
      },
   }
</script>