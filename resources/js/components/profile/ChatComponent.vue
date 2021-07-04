<template>
    <div>
        <div class="container">
            <div class="message">
                <div class="row">
                    <div class="col-8">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="message in messages">
                                {{ message.text }}
                            </li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <form @submit.prevent="submit()">
                            <textarea v-model="form.text" id="" cols="30" rows="10"></textarea>
                            <button type="submit" class="btn btn-outline-success">
                                send
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import {ChatService} from "../../_services/chat.service";

export default {
    name: "ChatComponent",
    data() {
        return {
            chat_id: null,
            form: {
                sender_id: null,
                receiver_id: null,
                message: null,
                text: null,
            },
            messages: []
        }
    },
    beforeMount() {
        this.$store.commit('userDetails');
        this.form.sender_id = +this.$store.state.userDetails.id;
        this.form.receiver_id = +this.$route.params.id;
        this.chat_id = +this.$route.params.id;
        console.log(window.Echo.connector);
        this.loadMessages(this.chat_id)
    },
    mounted() {
        if (this.form.receiver_id !== this.form.sender_id) {
            // console.log('entered', this.form.receiver_id, this.form.sender_id);
            // this.listener(this.form.receiver_id, this.form.sender_id);
        }
        if (this.chat_id) {
            this.listener(this.chat_id, this.form.sender_id);
        }
    },
    methods: {
        listener(chat, sender) {
            window.Echo.channel(`chat.${chat}`)
                .listen("ChatMessageCreated", function(data) {
                    console.log('qwertyuio: ', data);
                    // if (this.form.sender_id) {
                    this.messages.push(data.message)
                })
        },
        loadMessages(chat_id) {
            this.$store.commit('userDetails');
            this.form.sender_id = +this.$store.state.userDetails.id;
            this.form.receiver_id = +this.$route.params.id;
            /*ChatService.getChatNew().then(resp => {
                console.log(resp);
            })*/
            ChatService.getMessages(chat_id).then(resp => {
                console.log(resp);
                this.messages = resp.data;
            })
        },
        submit() {
            console.log(this.form);
           /* ChatService.sendMessage(this.form).then(resp => {
                this.form.message = '';
            })*/
            ChatService.sendMessageNew(this.form.text, this.chat_id).then(resp => {
                console.log(resp);
                this.form.text = '';
            })
        },
    }
}
</script>

<style scoped>
    .message{
        min-height: 300px;
        max-height: 300px;
        overflow-x: auto;
        height: 100%;
    }
</style>
