<template>
    <div class="login">
        <div class="login-wrapper">
            <div class="login-contents">
                <a-form
                    :model="formState"
                    name="basic"
                    :label-col="{ span: 8 }"
                    :wrapper-col="{ span: 16 }"
                    autocomplete="off"
                    @finish="onFinish"
                    @finishFailed="onFinishFailed"
                >
                    <a-form-item
                    class="name-form"
                    :label="t('login.username')"
                    name="username"
                    :rules="[{ required: true, message: 'Please input your username!' }]"
                    >
                    <a-input v-model:value="formState.username" />
                    </a-form-item>

                    <a-form-item
                    class="pass-form"
                    :label="t('login.password')"
                    name="password"
                    :rules="[{ required: true, message: 'Please input your password!' }]"
                    >
                    <a-input-password v-model:value="formState.password" />
                    </a-form-item>

                    <a-form-item :wrapper-col="{ offset: 8, span: 16 }" class="login-btn">
                    <a-button type="primary" html-type="submit" @click="doLogin">{{ t('login.submit') }}</a-button>
                    </a-form-item>
                </a-form>
            </div>
            <RouterLink to="/menu">Menuへ移動</RouterLink>
        </div>
    </div>
</template>

<script>
    import { reactive, ref, computed, defineComponent } from 'vue';
    import { useStore } from 'vuex';
    import axios from 'axios';
    import { useI18n } from 'vue-i18n';

    export default defineComponent ({
        setup() {
            const { t } = useI18n();
            const store = useStore();
            const formState = reactive({
            username: '',
            password: '',
            });
            const onFinish = values => {
            console.log('Success:', values);
            };
            const onFinishFailed = errorInfo => {
            console.log('Failed:', errorInfo);
            };
            const count = computed(() => store.getters.count);
            const increment = () => {
                    store.dispatch('increment');
                };
            // const doLogin = () => {
            //     store.dispatch('ex', {
            //         name: formState.username,
            //         pass: formState.password
            //     });
            // }
            const doLogin = async () => {
                try {
                    // バックエンドAPIにPOSTリクエストを送る
                    const response = await axios.post('http://localhost/api/login', {
                        username: formState.username,
                        password: formState.password,
                    });

                    // 成功時の処理
                    console.log('Login successful:', response.data);
                    // ログイン成功後に追加の処理（例: トークンの保存やリダイレクト）を行う
                } catch (error) {
                    // エラーメッセージを表示
                    if (error.response) {
                        console.error('Login failed:', error.response.data.message);
                    } else {
                        console.error('An error occurred:', error.message);
                    }
                }
            };
            return {
                t,
                formState,
                onFinish,
                onFinishFailed,
                doLogin,
                count,
                increment,
            };
        }
    })
</script>

<style>
    .login{
        margin-top: 35vh;
        margin-bottom: 35vh;
    }
    .login-wrapper{
        width: 80vw;
        margin: 0 auto;
    }
    .name-form{
        position: relative;
        left: 15vw;
        width: 50%;
    }
    .pass-form{
        position: relative;
        left: 15vw;
        width: 50%;
    }
    .login-btn{
        position: relative;
        left: 10vw;
        margin-top: 10vh;
    }
</style>
