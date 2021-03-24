<template lang="html"> 
     <div class="form-chat position-absolute" >
        <img src="/img/happy.png" class="img-1 w-30">
        <textarea class="input" id="myTextarea" placeholder="Nhắn tin..." autofocus  v-on:keyup.enter="sendChat" v-model="chat"></textarea>
        <button  v-on:click="sendChat">Gửi</button>
        <img src="/img/picture.png" class="img-2  ">
        <img src="/img/heart.png" class="img-3 ">
    </div>
</template>

<script>
    export default {
        props: ['chat_group', 'userid', 'roomid'],
        data() {
            return {
                chat: ''
            }
        },
        methods: {  
            sendChat: function(e) {

                if (this.chat != '') {
                    var data = {
                        message: this.chat,
                        group_id: this.roomid,
                        user_id: this.userid,
                        created_at:new Date().toLocaleString()
                    }
                    this.chat = ''; 
                    axios.post('/group_chat/sendChat',data).then((response) => {
                        this.chat_group.push(data)
                    })
                }
            }
        }
    }
</script>
