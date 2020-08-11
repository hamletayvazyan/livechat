<template>
    <div>
        <form @submit.prevent="submit()">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control"
                       v-model="form.email"
                       id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control"
                       v-model="form.password"
                       id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
import {AuthService} from "../../_services/auth.service";

export default {
    name: "LoginComponent",
    data() {
        return {
            form: {
                email: null,
                password: null
            }
        }
    },
    methods: {
        submit(){
            console.log(this.form);
            AuthService.login(this.form, this.$store).then(() => {
                this.$router.replace('/users')
            })
        }
    }
}
</script>

<style scoped>

</style>
