<template>
    <div>
        <ul class="list-group">
            <li class="list-group-item" v-for="user in users">
                <router-link :to="{name: 'chat', params: {id: user.id}}">{{ user.name }}</router-link>
            </li>
            <li class="list-group-item" v-for="chatt in chats">
                <router-link :to="{name: 'chat', params: {id: chatt.id}}">{{ chatt.users[1].name }}</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
import {ProfileService} from "../../_services/profile.service";
import {ChatService} from "../../_services/chat.service";

export default {
    name: "UsersComponent",
    data() {
        return {
            users: [],
            chats: [],
        }
    },
    mounted() {
        ProfileService.users().then(resp => {
            console.log(resp);
            this.users = resp;
        });
        ChatService.getChatNew().then(resp => {
            console.log(resp.data);
            this.chats = resp.data;
        })
    }
}
</script>

<style scoped>

</style>
