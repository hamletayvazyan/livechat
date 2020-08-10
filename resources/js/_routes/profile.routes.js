import UsersComponent from "../components/profile/UsersComponent";
import ChatComponent from "../components/profile/ChatComponent";

export const ProfileRoutes = [
    {
        path: 'users',
        component: UsersComponent,
        name: 'users'
    },
    {
        path: 'chat',
        component: ChatComponent,
        name: 'chat'
    }
]
