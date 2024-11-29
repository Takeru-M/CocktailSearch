import { UserResponse } from "./CommonResponse";

export interface Login {
    token: string;
    user: UserResponse;
}
