import { UserResponse } from "./CommonResponse";

export interface Signin {
    token: string;
    user: UserResponse;
}
