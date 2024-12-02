import { UserResponse } from "./CommonResponse";

export interface Signin {
    message: string;
    token: string;
    user: UserResponse;
}
