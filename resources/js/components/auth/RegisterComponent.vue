<template>
    <div>
        <form @submit.prevent="submit()">
            <div class="form-group">
                <label for="name">Name </label>
                <input type="text" class="form-control"
                       v-model="form.name"
                       id="name" aria-describedby="emailHelp">
            </div>
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
            <div class="form-group">
                <label for="conf_pass">Confirm Password</label>
                <input type="password" class="form-control"
                       v-model="form.password_confirmation"
                       id="conf_pass">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
import {AuthService} from "../../_services/auth.service";

export default {
    name: "RegisterComponent",
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            }
        }
    },
    methods: {
        submit(){
            console.log(this.form);
            AuthService.register(this.form, this.$store).then()
        }
    }
}
</script>

<style scoped>

</style>
