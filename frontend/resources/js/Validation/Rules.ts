import type { RuleObject } from 'ant-design-vue/es/form';

export const nameRules: RuleObject[] = [
    { required: true, message: 'Please input your username!' },
];

export const emailRules: RuleObject[] = [
    { required: true, message: 'Please input your email!' },
    { type: 'email', message: 'The input is not valid email!' },
];

export const passRules: RuleObject[] = [
    { required: true, message: 'Please input your password!' },
    { min: 8, message: 'Password must be at least 8 characters!' },
];
