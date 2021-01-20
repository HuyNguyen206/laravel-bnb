import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import SecondComponent from "./components/SecondComponent";

const routes = [
    {
        path:'/',
        component: ExampleComponent,
        name: 'home',
    },
    {
        path:'/second',
        component: SecondComponent,
        name:'second'
    }
]
const router = new VueRouter({routes,   mode: 'history'})
export default router;
