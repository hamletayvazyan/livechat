import LoginComponent from "../components/auth/LoginComponent";
import RegisterComponent from "../components/auth/RegisterComponent";
import ResetPassword from "../components/auth/ResetPassword";

export const AuthRoutes = [
    {
        path: 'login',
        component: LoginComponent,
        name: 'login',
    },
    {
        path: 'register',
        component: RegisterComponent,
        name: 'register',
    },
    {
        path: 'reset-password',
        component: ResetPassword,
        name: 'resetPassword',
    },
]
