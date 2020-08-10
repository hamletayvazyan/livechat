<template>
    <div>
        <HeaderComponent/>
        <RouterView/>
    </div>
</template>

<script>
import HeaderComponent from "./HeaderComponent";
export default {
    name: "AppComponent",
    components: {HeaderComponent}
}
</script>

<style scoped>

</style>
