<template>
    <div>
        <div class="container">
            <div class="message">
                <div class="row">
                    <div class="col-8">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="message in messages">
                                {{ message.message }}
                            </li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <form @submit.prevent="submit()">
                            <textarea v-model="form.message" id="" cols="30" rows="10"></textarea>
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
            form: {
                sender_id: null,
                receiver_id: null,
                message: null,
            },
            messages: []
        }
    },
    mounted() {
        this.$store.commit('userDetails');
        this.form.sender_id = +this.$store.state.userDetails.id;
        this.form.receiver_id = +this.$route.params.id;

        if (this.form.receiver_id !== this.form.sender_id) {
            console.log('entered', this.form.receiver_id, this.form.sender_id);
            window.Echo.channel(`newMessage-${this.form.receiver_id}-${this.form.sender_id}`)
                .listen('MessageSent', (data) => {
                    console.log('channel listening: ',data);
                    if (this.form.sender_id) {
                        this.messages.push(data.message)
                    }
                })
            this.loadMessages()
        }
    },
    methods: {
        loadMessages() {
            this.$store.commit('userDetails');
            this.form.sender_id = +this.$store.state.userDetails.id;
            this.form.receiver_id = +this.$route.params.id;
            ChatService.getChat({
                sender_id: this.$route.params.id
            }).then(resp => {
                console.log(resp);
                this.messages = resp;
            })
        },
        submit() {
            console.log(this.form);
            ChatService.sendMessage(this.form).then(resp => {
                console.log(resp);
                this.messages.push(resp)
                this.form.message = '';
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
