<template>
    <div class="login">
        <div class="login-register">
            <a-space wrap>
                <a-button type="primary" class="register-btn">
                    <RouterLink to="/signin">Sign in</RouterLink>
                </a-button>
            </a-space>
        </div>
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
                    <a-button type="primary" html-type="submit" @click="login">{{ t('login.submit') }}</a-button>
                    </a-form-item>
                </a-form>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import { reactive, defineComponent } from 'vue';
    import { useStore } from 'vuex';
    import { useI18n } from 'vue-i18n';
    import axios from 'axios';
    import { AxiosError } from 'axios';
    import router from '../router';
    import { RouterLink } from 'vue-router';
    import { State } from '@/types/stores/CommonStore';
    import { Login } from '@/types/responses/LoginResponse';

    interface FormState {
        username: string;
        password: string;
    }

    export default defineComponent ({
        setup() {
            const { t } = useI18n();
            const store = useStore<State>();
            const formState = reactive<FormState>({
                username: '',
                password: '',
            });
            const onFinish = (values: any) => {
                console.log('Success:', values);
            };
            const onFinishFailed = (errorInfo: any) => {
                console.log('Failed:', errorInfo);
            };
            const login = async (): Promise<void> => {
                try {
                    const response = await axios.post<Login>('http://127.0.0.1:8000/api/login', {
                        name: formState.username,
                        password: formState.password,
                    });
                    store.dispatch('setLoginStatus');
                    store.dispatch('setUser', response.data.user);
                    localStorage.setItem('auth_token', response.data.token);
                    localStorage.setItem('login_status', JSON.stringify(store.getters.loginStatus));
                    console.log('Login successful:', response.data);
                    router.push('/dashboard');
                } catch (e) {
                    if (e instanceof AxiosError && e.response) {
                    console.error('Registering favorite cocktail failed:', e.response.data.message);
                    } else if (e instanceof Error) {
                        console.error('An error occurred:', e.message);
                    }
                }
            };
            return {
                t,
                formState,
                onFinish,
                onFinishFailed,
                login,
            };
        },
    });
</script>

<style>
    .login{
        height: 100vh;
    }
    .login-register {
        height: 10vh;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }
    .register-btn {
        margin-right: 3vw;
    }
    .login-wrapper{
        width: 80vw;
        margin: 25vh auto 0 auto;
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
