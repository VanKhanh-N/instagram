 <template>
    <div>
    <div class="bottom-right position-relative" id="hihi">
        <div v-if="chats.length != 0"  v-for="chat in chats">
            <div class="my-messages position-relative" v-if="chat.user_id == userid">
                <div class="time">24 Tháng 7 2019 15:10</div>
                    <div class="me-messages"> 
                        <p> {{ chat.chat }}</p>
                    </div>
            </div>
            <div class="friend-messages position-relative" v-else>
                <div class="time">24 Tháng 7 2019 15:10</div>
                    <div class="your-messages"> 
                        <p>{{ chat.chat }}</p>
                    </div>
            </div>
        </div>
        <div v-else class="no-message">
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
</script>
