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
                    :rules="[{ required: true, message: 'Please input your email!' }]"
                >
                    <a-input v-model:value="formState.email" />
                </a-form-item>

                <a-form-item
                    class="pass-form"
                    label="Password"
                    name="password"
                    :rules="[{ required: true, message: 'Please input your password!' }]"
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

<script>
    import { defineComponent, reactive } from 'vue';
    import axios from 'axios';
    import router from '../router';

    export default defineComponent ({
        setup() {
            const formState = reactive({
            username: '',
            email: '',
            password: '',
            });
            const onFinish = values => {
                console.log('Success:', values);
            };
            const onFinishFailed = errorInfo => {
                console.log('Failed:', errorInfo);
            };

            const signin = async() => {
                try {
                    const response = await axios.post('http://127.0.0.1:8000/api/signin', {
                        name: formState.username,
                        email: formState.email,
                        password: formState.password
                    });
                    store.dispatch('setLoginStatus');
                    store.dispatch('setUser', response.data.user);
                    console.log(computed(() => store.getters.loginStatus).value);
                    localStorage.setItem('auth_token', response.data.token);
                    localStorage.setItem('login_status', JSON.stringify(store.getters.loginStatus));
                    router.push('/dashboard');
                } catch (error) {
                    if (error.response) {
                        console.error('Signin failed:', error.response.data.message);
                    } else {
                        console.error('An error occurred:', error.message);
                    }
                }
            };

            return{
                axios,
                formState,
                onFinish,
                onFinishFailed,
                signin,
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
