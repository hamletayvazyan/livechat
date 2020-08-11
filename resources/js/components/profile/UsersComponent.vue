<template>
    <div>
        users works
    </div>
</template>

<script>
import {ProfileService} from "../../_services/profile.service";

export default {
    name: "UsersComponent",
    mounted() {
        ProfileService.user();
    }
}
</script>

<style scoped>

</style>
