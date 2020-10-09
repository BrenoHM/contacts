<template>
    <el-container style="height: 100vh; border: 1px solid #eee">
        <el-aside width="300px" style="background-color: rgb(238, 241, 246)">
            <Menu></Menu>
        </el-aside>

        <el-container>
            <el-header class="bread-header">
                {{currentRouteName || 'Dashboard'}}
            </el-header>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<style scoped>
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        line-height: 60px;
    }

    .el-aside {
        color: #333;
    }

    .bread-header {
        color: white !important;
        font-size: 15px;
    }

    .el-main {
        overflow-x: hidden !important;
    }
</style>

<script>
    import Menu from './Menu';

    export default {
        name: 'Principal',
        components: {
            Menu
        },
        computed: {
            currentRouteName() {
                return _.startCase(this.$route.name);
            }
        },
    };
</script>
