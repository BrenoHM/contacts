<template>
    <el-menu>
        <el-menu-item index="5" @click="alterarRota('ContactList')">
            <i class="el-icon-notebook-1"></i>
            <span>Manage Contacts</span>
        </el-menu-item>
    </el-menu>
</template>

<script>
    export default {
        name: "Menu",
        methods: {
            alterarRota(rota){
                this.$router.push({name: rota});
            }
        }
    }
</script>

<style scoped>

</style>
