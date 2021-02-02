 <template>
    <div>
    <div class="bottom-right position-relative" id="hihi">
        <div v-if="chats.length != 0"  v-for="chat in chats">
            <div class="my-messages position-relative" v-if="chat.user_id == userid">
                <div class="time">{{ timestamp }}</div>
                    <div class="me-messages"> 
                        <p> {{ chat.chat }}</p>
                    </div>
            </div>
            <div class="friend-messages position-relative" v-else>
                <div class="time">{{ timestamp }}</div>
                    <div class="your-messages"> 
                        <p>{{ chat.chat }}</p>
                    </div>
            </div>
        </div>
        <div v-if="chats.length == 0"  class="no-message">
            There are no messages
        </div>
    </div>
        <chat-composer v-bind:userid="userid" v-bind:chats="chats" v-bind:friendid="friendid"></chat-composer>
    </div>
</template>

<script>
    export default {
        props: ['chats', 'userid', 'friendid']
    }
      var vue_det = new Vue({
            el: '#intro',
            data: {
               timestamp: ""
            },
            created() {
                setInterval(this.getNow, 1000);
            },
            methods: {
                getNow: function() {
                    const today = new Date();
                    const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                    const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    const dateTime = date +' '+ time;
                    this.timestamp = dateTime;
                }
            }
         });
</script>
