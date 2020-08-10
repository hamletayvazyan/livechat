import {AuthRoutes} from "./auth.routes";
import AppComponent from "../components/layout/AppComponent";
import NotFoundComponent from "../components/NotFoundComponent";
import {ProfileRoutes} from "./profile.routes";

const allRoutes = [
    {
        path: '/',
        component: AppComponent,
        name: 'app',
        children: [
        ]
    },
    {
        path: '*',
        component: NotFoundComponent
    },
];

AuthRoutes.map((i) => {
    allRoutes[0].children.push(i)
});
ProfileRoutes.map((i) => {
    allRoutes[0].children.push(i)
});

export default allRoutes;
