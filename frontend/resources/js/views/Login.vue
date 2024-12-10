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
                    @submit.prevent="submitForm"
                >
                    <a-form-item
                    class="email-form"
                    :label="t('login.email')"
                    name="email"
                    :rules="emailRules"
                    >
                    <a-input v-model:value="formState.email" />
                    </a-form-item>

                    <a-form-item
                    class="pass-form"
                    :label="t('login.password')"
                    name="password"
                    :rules="passRules"
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
    import { ref, reactive, defineComponent } from 'vue';
    import { useStore } from 'vuex';
    import { useI18n } from 'vue-i18n';
    import { AxiosError } from 'axios';
    import router from '../router';
    import { RouterLink } from 'vue-router';
    import { State } from '@/types/stores/CommonStore';
    import { FormInstance } from 'ant-design-vue';
    import { loginAPI } from '@/APIs/AuthAPI';
    import { emailRules, passRules } from '@/Validation/Rules';

    interface FormState {
        email: string;
        password: string;
    }

    export default defineComponent ({
        setup() {
            const { t } = useI18n();
            const store = useStore<State>();
            const formState = reactive<FormState>({
                email: '',
                password: '',
            });
            const onFinish = (values: any) => {
                // console.log('Success:', values);
            };
            const onFinishFailed = (errorInfo: any) => {
                // console.log('Failed:', errorInfo);
            };

            const form = ref<FormInstance | null>(null);

            const submitForm = async () => {
                try {
                    await form.value?.validate();
                } catch (error) {
                    console.log('Validation failed:', error);
                }
            };

            const login = async (): Promise<void> => {
                try {
                    const response = await loginAPI({
                        email: formState.email,
                        password: formState.password,
                    });
                    store.dispatch('setLoginStatus');
                    store.dispatch('setUser', response.user);
                    localStorage.setItem('auth_token', response.token);
                    localStorage.setItem('user_id', JSON.stringify(store.getters.user.id));
                    localStorage.setItem('login_status', JSON.stringify(store.getters.loginStatus));
                    console.log('Login successful:', response.message);
                    router.push('/dashboard');
                } catch (e) {
                    if (e instanceof AxiosError && e.response) {
                    console.error('Login failed:', e.response.data.message);
                    } else if (e instanceof Error) {
                        console.error('An error occurred:', e.message);
                    }
                }
            };
            return {
                t,
                store,
                formState,
                onFinish,
                onFinishFailed,
                form,
                submitForm,
                login,
                emailRules,
                passRules,
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
    .email-form{
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
