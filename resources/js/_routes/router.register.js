import {AuthRoutes} from "./auth.routes";
import AppComponent from "../components/layout/AppComponent";
import NotFoundComponent from "../components/NotFoundComponent";

const allRoutes = [
    {
        path: '/',
        component: AppComponent,
        name: 'app',
        // redirect: { name: 'foo' },
        children: [
        ]
    },
    {
        path: '*',
        component: NotFoundComponent
    },
];

AuthRoutes.map((i) => {
    allRoutes.push(i)
});
// TasksRoutes.map((i) => {
//     routes[0].children.push(i)
// });

export default allRoutes;
