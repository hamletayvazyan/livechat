<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <router-link class="navbar-brand" :to="{name: ''}">Navbar</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" v-if="!$store.state.isLoggedIn">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{name: 'login'}">
                            Login
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'register'}">
                            Register
                        </router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto" v-if="$store.state.isLoggedIn">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{name: 'login'}">
                            Users
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <button class="btn nav-link" v-on:click="logout()">
                            Log Out
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
import {AuthService} from "../../_services/auth.service";

export default {
    name: "HeaderComponent",
    methods: {
        logout() {
            AuthService.logOut(this.$store).then(() => {
                this.$router.replace('/login')
            });
        }
    }
}
</script>

<style scoped>

</style>
