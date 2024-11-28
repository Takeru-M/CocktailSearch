<template>
    <a-layout-footer :style="{ textAlign: 'center' }" class="footer">
        Ant Design ©2018 Created by Ant UED
    </a-layout-footer>
</template>

<script>
    import { defineComponent } from 'vue';

    export default defineComponent ({
        // setup() {
        //     const ex = 'Footer';
        //     return {
        //         ex,
        //     }
        // }
    })
</script>

<style scoped>
.footer {
    height: 10vh;
}
.site-layout-content {
    min-height: 280px;
    padding: 24px;
    background: #fff;
}
#components-layout-demo-top .logo {
    float: left;
    width: 120px;
    height: 31px;
    margin: 16px 24px 16px 0;
    background: rgba(255, 255, 255, 0.3);
}
.ant-row-rtl #components-layout-demo-top .logo {
    float: right;
    margin: 16px 0 16px 24px;
}

[data-theme='dark'] .site-layout-content {
    background: #141414;
}
</style>