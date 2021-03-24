 <template>
 <div>
    <div class="bottom-right position-relative" id="hihi">
        <div  v-for="(group_chat,index) in chat_group.group_chats" :key="index" >
            <div class="my-messages position-relative" v-if="group_chat.user_id == userid">
                <div class="time">{{ group_chat.created_at | formatDate }}</div>  
                    <div class="me-messages"> 
                        <p> {{ group_chat.message }}</p>
                    </div>
            </div>
            <div class="friend-messages position-relative" v-else>
                <div class="time">{{ group_chat.created_at | formatDate }}</div>
                <a :href="'/'+group_chat.user" >
                <img :src="'/uploads/user/'+group_chat.avatar" class="friend-img rounded-circle" v-if="group_chat.avatar.substr(0,4)!='http'">
                <img :src="group_chat.avatar" class="friend-img rounded-circle" v-if="group_chat.avatar.substr(0,4)=='http'">
                </a>
                    <div class="your-messages position-absolute">
                    <span class="os ">{{group_chat.c_name}}</span>
                        <p class="position-absolute">{{ group_chat.message }}</p>
                    </div>
            </div>
        </div>
        <div v-if="chat_group.group_chats.length == 0"  class="no-message">
            There are no messages
        </div> 
        <!-- <img src="/img/typing.gif" style="height:100px"> -->
    </div>
        <chat-group-composer  v-bind:chat_group="chat_group.group_chats" v-bind:userid="userid" v-bind:roomid="chat_group.room"></chat-group-composer>
    </div>
</template>

<script>
    export default {
        props: ['chat_group', 'userid']
    }
</script>
