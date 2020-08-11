<template>
    <div>
        <ul class="list-group">
            <li class="list-group-item" v-for="user in users">
                <router-link :to="{name: 'chat', params: {id: user.id}}">{{ user.name }}</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
import {ProfileService} from "../../_services/profile.service";

export default {
    name: "UsersComponent",
    data() {
        return {
            users: []
        }
    },
    mounted() {
        ProfileService.users().then(resp => {
            console.log(resp);
            this.users = resp;
        });
    }
}
</script>

<style scoped>

</style>
