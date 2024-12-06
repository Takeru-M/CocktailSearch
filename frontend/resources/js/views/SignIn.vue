<template>
    <div class="signin">
        <div class="signin-wrapper">
            <div class="signin-contents">
                <a-form
                    :model="formState"
                    name="basic"
                    :label-col="{ span: 8 }"
                    :wrapper-col="{ span: 16 }"
                    autocomplete="off"
                    @finish="onFinish"
                    @finishFailed="onFinishFailed"
                    @submit.prevent="submitForm"
                >
                <a-form-item
                    class="name-form"
                    label="Username"
                    name="username"
                    :rules="[{ required: true, message: 'Please input your username!' }]"
                >
                    <a-input v-model:value="formState.username" />
                </a-form-item>

                <a-form-item
                    class="mail-form"
                    label="email"
                    name="email"
                    :rules="[{ required: true, message: 'Please input your email!' }, { type: 'email', message: 'The input is not valid email!' }]"
                >
                    <a-input v-model:value="formState.email" />
                </a-form-item>

                <a-form-item
                    class="pass-form"
                    label="Password"
                    name="password"
                    :rules="[{ required: true, message: 'Please input your password!' }, { min: 8, message: 'Password must be at least 8 characters!' }]"
                >
                    <a-input-password v-model:value="formState.password" />
                </a-form-item>

                <a-form-item :wrapper-col="{ offset: 8, span: 16 }" class="signin-btn">
                    <a-button type="primary" html-type="submit" @click="signin">Submit</a-button>
                </a-form-item>
                </a-form>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import { defineComponent, reactive, ref } from 'vue';
    import { useStore } from 'vuex';
    import axios from 'axios';
    import { AxiosError } from 'axios';
    import router from '../router';
    import { State } from '@/types/stores/CommonStore';
    import { Signin } from '@/types/responses/SigninResponse';
    import { FormInstance } from 'ant-design-vue';
import { signinAPI } from '@/utils/AuthAPI';

    interface FormState {
        username: string;
        email: string;
        password: string;
    }

    export default defineComponent ({
        setup() {
            const store = useStore<State>();
            const formState = reactive<FormState>({
                username: '',
                email: '',
                password: '',
            });
            const onFinish = (values: any) => {
                console.log('Success:', values);
            };
            const onFinishFailed = (errorInfo: any) => {
                console.log('Failed:', errorInfo);
            };

            const signin = async(): Promise<void> => {
                try {
                    const response = await signinAPI({
                        name: formState.username,
                        email: formState.email,
                        password: formState.password
                    });
                    store.dispatch('setLoginStatus');
                    store.dispatch('setUser', response.user);
                    localStorage.setItem('auth_token', response.token);
                    localStorage.setItem('user_id', JSON.stringify(store.getters.user.id));
                    localStorage.setItem('login_status', JSON.stringify(store.getters.loginStatus));
                    console.log('Signin successful:', response.message);
                    router.push('/dashboard');
                } catch (e) {
                    if (e instanceof AxiosError && e.response) {
                    console.error('Sign in failed:', e.response.data.message);
                    } else if (e instanceof Error) {
                        console.error('An error occurred:', e.message);
                    }
                }
            };

            const form = ref<FormInstance | null>(null);

            const submitForm = async () => {
                try {
                    await form.value?.validate();
                } catch (error) {
                    console.log('Validation failed:', error);
                }
            };

            return{
                axios,
                formState,
                onFinish,
                onFinishFailed,
                signin,
                form,
                submitForm,
            };
        },
    });
</script>

<style>
    .signin{
        height: 90vh;
    }
    .signin-wrapper{
        width: 80vw;
        margin: 20vh auto 0 auto;
    }
    .name-form{
        position: relative;
        left: 15vw;
        width: 50%;
    }
    .mail-form {
        position: relative;
        left: 15vw;
        width: 50%;
    }
    .pass-form{
        position: relative;
        left: 15vw;
        width: 50%;
    }
    .signin-btn{
        position: relative;
        left: 10vw;
        margin-top: 10vh;
    }
</style>
