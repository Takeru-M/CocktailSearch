import { UserResponse } from "./CommonResponse";

export interface Login {
    message: string;
    token: string;
    user: UserResponse;
}
